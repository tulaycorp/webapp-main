<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Get cart data.
     */
    public function index(Request $request): JsonResponse
    {
        $cart = $this->cartService->getActiveCart($request);
        return response()->json($cart->load('items.product'));
    }

    /**
     * Sync cart items from frontend.
     * This is a full sync - items not in the request will be removed.
     */
    public function sync(Request $request): JsonResponse
    {
        $cart = $this->cartService->getActiveCart($request);
        $localItems = $request->input('cart', []);

        // Get product IDs from the incoming cart
        $incomingProductIds = collect($localItems)->pluck('id')->map(fn($id) => (string) $id)->toArray();

        // Delete items not in the incoming cart
        $cart->items()->whereNotIn('product_id', $incomingProductIds)->delete();

        // Update or create items from frontend
        $messages = [];

        foreach ($localItems as $item) {
            $productId = $item['id'];
            $quantity = $item['qty'] ?? 1;

            $product = Product::find($productId);

            if (!$product)
                continue;

            // Check stock limit
            if ($product->track_inventory && !$product->continue_selling_when_out_of_stock) {
                if ($quantity > $product->stock_quantity) {
                    $quantity = max(0, $product->stock_quantity);
                    $messages[] = "Quantity for {$product->name} adjusted to available stock ({$quantity}).";
                }
            }

            if ($quantity <= 0)
                continue;

            $existing = $cart->items()->where('product_id', $productId)->first();

            if ($existing) {
                // Update quantity (client is authoritative for sync)
                $existing->quantity = $quantity;
                $existing->save();
            } else {
                // Create new item
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => count($messages) > 0 ? implode(' ', $messages) : null,
            'cart' => $cart->fresh()->load('items.product')->items->map(function ($i) {
                return ['id' => $i->product_id, 'qty' => $i->quantity];
            })
        ]);
    }

    /**
     * Add item to cart.
     */
    public function add(Request $request): JsonResponse
    {
        $cart = $this->cartService->getActiveCart($request);
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        $existingItem = $cart->items()->where('product_id', $productId)->first();
        $currentQty = $existingItem ? $existingItem->quantity : 0;
        $newQty = $currentQty + $quantity;

        // Check stock limit
        if ($product->track_inventory && !$product->continue_selling_when_out_of_stock) {
            // Strict check: Total quantity (in cart + new) must not exceed stock
            if ($newQty > $product->stock_quantity) {
                $maxAddable = max(0, $product->stock_quantity - $currentQty);
                $message = $maxAddable > 0
                    ? "You can only add {$maxAddable} more of this item."
                    : "You already have the max available stock in your cart.";

                return response()->json([
                    'success' => false,
                    'message' => $message
                ], 422);
            }
        }

        if ($existingItem) {
            $existingItem->quantity = $newQty;
            $existingItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Reset guest session - called on logout to give user a fresh cart.
     */
    public function resetGuest(Request $request): JsonResponse
    {
        $newGuestId = $this->cartService->resetGuestSession($request);

        return response()->json([
            'success' => true,
            'message' => 'Guest session reset',
            'new_session_id' => $newGuestId
        ]);
    }
}
