<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display the checkout page.
     */
    public function index(Request $request)
    {
        return view('pages.checkout');
    }

    /**
     * Validate card number using Luhn algorithm.
     */
    private function validateLuhn(string $cardNumber): bool
    {
        // Remove spaces and dashes
        $cardNumber = preg_replace('/[\s-]/', '', $cardNumber);

        // Check if it's all digits
        if (!ctype_digit($cardNumber)) {
            return false;
        }

        // Check length (typically 13-19 digits)
        $length = strlen($cardNumber);
        if ($length < 13 || $length > 19) {
            return false;
        }

        // Luhn algorithm
        $sum = 0;
        $alternate = false;

        for ($i = $length - 1; $i >= 0; $i--) {
            $digit = (int) $cardNumber[$i];

            if ($alternate) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
            $alternate = !$alternate;
        }

        return ($sum % 10) === 0;
    }

    /**
     * Validate card number via API endpoint.
     */
    public function validateCard(Request $request): JsonResponse
    {
        $cardNumber = $request->input('card_number', '');

        $isValid = $this->validateLuhn($cardNumber);

        // Determine card type
        $cardType = $this->getCardType($cardNumber);

        return response()->json([
            'valid' => $isValid,
            'card_type' => $cardType,
        ]);
    }

    /**
     * Determine card type from number.
     */
    private function getCardType(string $cardNumber): ?string
    {
        $cardNumber = preg_replace('/[\s-]/', '', $cardNumber);

        if (preg_match('/^4/', $cardNumber)) {
            return 'visa';
        }
        if (preg_match('/^5[1-5]/', $cardNumber) || preg_match('/^2[2-7]/', $cardNumber)) {
            return 'mastercard';
        }
        if (preg_match('/^3[47]/', $cardNumber)) {
            return 'amex';
        }
        if (preg_match('/^6(?:011|5)/', $cardNumber)) {
            return 'discover';
        }

        return null;
    }

    /**
     * Process the checkout and create an order.
     */
    public function process(Request $request): JsonResponse
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            // Shipping info
            'shipping_first_name' => 'required|string|max:100',
            'shipping_last_name' => 'required|string|max:100',
            'shipping_email' => 'required|email|max:255',
            'shipping_phone' => 'nullable|string|max:20',
            'shipping_address1' => 'required|string|max:255',
            'shipping_address2' => 'nullable|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_state' => 'required|string|max:100',
            'shipping_zip' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            // Payment info (mock)
            'card_number' => 'required|string',
            'card_expiry' => 'required|string|regex:/^\d{2}\/\d{2}$/',
            'card_cvc' => 'required|string|min:3|max:4',
            'card_name' => 'required|string|max:100',
            // Coupon (optional)
            'coupon_code' => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Validate card with Luhn
        $cardNumber = $request->input('card_number');
        if (!$this->validateLuhn($cardNumber)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid card number',
                'errors' => ['card_number' => ['The card number is invalid.']],
            ], 422);
        }

        // Get the cart
        \Log::info('Checkout process: Starting cart retrieval', [
            'auth_user_id' => $request->attributes->get('auth_user_id'),
            'has_session_cookie' => $request->hasCookie('eshop_session_id')
        ]);

        $cart = $this->cartService->getActiveCart($request);
        $cartItems = $cart->items()->with('product')->get();

        \Log::info('Checkout process: Cart retrieved', [
            'cart_id' => $cart->id,
            'items_count' => $cartItems->count()
        ]);

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Your cart is empty',
            ], 400);
        }

        // Check stock availability and calculate totals
        $subtotal = 0;
        $itemsData = [];
        $stockErrors = [];

        foreach ($cartItems as $item) {
            $product = $item->product;

            if (!$product) {
                $stockErrors[] = "Product not found for item {$item->product_id}";
                continue;
            }

            // Check stock if tracking inventory
            if ($product->track_inventory && !$product->continue_selling_when_out_of_stock) {
                if ($product->stock_quantity < $item->quantity) {
                    $stockErrors[] = "Insufficient stock for {$product->name}. Available: {$product->stock_quantity}";
                }
            }

            $itemTotal = $product->price * $item->quantity;
            $subtotal += $itemTotal;

            $itemsData[] = [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_price' => $product->price,
                'quantity' => $item->quantity,
                'total' => $itemTotal,
            ];
        }

        if (!empty($stockErrors)) {
            return response()->json([
                'success' => false,
                'message' => 'Stock availability issue',
                'errors' => ['stock' => $stockErrors],
            ], 400);
        }

        // Validate and apply coupon if provided
        $discountAmount = 0;
        $couponCode = $request->input('coupon_code');
        $coupon = null;

        if ($couponCode) {
            $coupon = Coupon::where('code', strtoupper($couponCode))->first();

            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code.',
                    'errors' => ['coupon_code' => ['Invalid coupon code.']],
                ], 400);
            }

            $validation = $coupon->isValid($subtotal);
            if (!$validation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => $validation['message'],
                    'errors' => ['coupon_code' => [$validation['message']]],
                ], 400);
            }

            $discountAmount = $coupon->calculateDiscount($subtotal);
        }

        // Calculate shipping and tax
        $shipping = $subtotal >= 150 ? 0 : 10;
        $tax = $subtotal * 0.08;
        $total = $subtotal + $shipping + $tax - $discountAmount;

        // Create order in a transaction
        try {
            DB::beginTransaction();

            // Create order
            $order = Order::create([
                'user_id' => $request->attributes->get('auth_user_id'),
                'order_number' => Order::generateOrderNumber(),
                'status' => Order::STATUS_PENDING,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'shipping' => $shipping,
                'total' => $total,
                'coupon_code' => $couponCode,
                'discount_amount' => $discountAmount,
                'shipping_first_name' => $request->input('shipping_first_name'),
                'shipping_last_name' => $request->input('shipping_last_name'),
                'shipping_email' => $request->input('shipping_email'),
                'shipping_phone' => $request->input('shipping_phone'),
                'shipping_address1' => $request->input('shipping_address1'),
                'shipping_address2' => $request->input('shipping_address2'),
                'shipping_city' => $request->input('shipping_city'),
                'shipping_state' => $request->input('shipping_state'),
                'shipping_zip' => $request->input('shipping_zip'),
                'shipping_country' => $request->input('shipping_country'),
            ]);

            // Create order items and decrement stock
            foreach ($itemsData as $itemData) {
                $order->items()->create($itemData);

                // Decrement stock
                $product = Product::find($itemData['product_id']);
                if ($product && $product->track_inventory) {
                    $product->decrement('stock_quantity', $itemData['quantity']);
                }
            }

            // Record coupon usage if applicable
            if ($coupon) {
                CouponUsage::create([
                    'coupon_id' => $coupon->id,
                    'order_id' => $order->id,
                    'user_id' => $request->attributes->get('auth_user_id'),
                    'discount_amount' => $discountAmount,
                    'created_at' => now(),
                ]);

                $coupon->incrementUsage();
            }

            // Clear the cart
            $cart->items()->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order' => [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'total' => $order->total,
                ],
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Failed to process order. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
