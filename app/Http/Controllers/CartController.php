<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    private function getCart(Request $request)
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
            
            // Merge session cart if exists
            $sessionId = $request->cookie('eshop_session_id');
            if ($sessionId) {
                $guestCart = Cart::where('session_id', $sessionId)->first();
                if ($guestCart) {
                    foreach ($guestCart->items as $item) {
                        $existing = $cart->items()->where('product_id', $item->product_id)->first();
                        if ($existing) {
                            $existing->increment('quantity', $item->quantity);
                        } else {
                            $cart->items()->create([
                                'product_id' => $item->product_id,
                                'quantity' => $item->quantity
                            ]);
                        }
                    }
                    $guestCart->delete(); // Clean up guest cart
                }
            }
            return $cart;
        }

        // Guest logic
        $sessionId = $request->cookie('eshop_session_id');
        if (!$sessionId) {
            $sessionId = Str::uuid()->toString();
            Cookie::queue('eshop_session_id', $sessionId, 60 * 24 * 30); // 30 days
        }

        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }

    public function index(Request $request)
    {
        $cart = $this->getCart($request);
        return response()->json($cart->load('items.product'));
    }

    public function sync(Request $request)
    {
        $cart = $this->getCart($request);
        $localItems = $request->input('cart', []);

        foreach ($localItems as $item) {
            $existing = $cart->items()->where('product_id', $item['id'])->first();
            if ($existing) {
                // Determine strategy: overwrite or add? Usually overwrite if syncing client state.
                // But if merging, maybe add. Let's assume client is authoritative for quantity if passed.
                // Wait, if logging in, we want merge.
                // For 'sync' endpoint called on page load, usually we fetch DB. 
                // Checks logic: If client has items and DB has items, merge them?
                // Let's implement simple "Add" logic for now.
                // Actually, efficient sync:
                // Frontend sends items only if it has 'unsynced' changes, or we just rely on API endpoints for actions.
                // Let's support "bulk add" for initial sync.
                $existing->quantity = $item['qty'];
                $existing->save();
            } else {
                $cart->items()->create([
                    'product_id' => $item['id'],
                    'quantity' => $item['qty']
                ]);
            }
        }
        
        return response()->json([
            'success' => true, 
            'cart' => $cart->load('items.product')->items->map(function($i) {
                return ['id' => $i->product_id, 'qty' => $i->quantity];
            })
        ]);
    }

    public function add(Request $request)
    {
        $cart = $this->getCart($request);
        $item = $cart->items()->where('product_id', $request->product_id)->first();

        if ($item) {
            $item->increment('quantity', $request->quantity ?? 1);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ?? 1
            ]);
        }

        return response()->json(['success' => true]);
    }
    
    // ... update/remove methods similar pattern
}
