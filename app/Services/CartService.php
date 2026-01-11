<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

/**
 * CartService - Single responsibility for cart identification and resolution.
 */
class CartService
{
    /**
     * Ensure guest session cookie exists, return the session ID.
     */
    public function ensureGuestIdCookie(Request $request): string
    {
        $guestId = $request->cookie('eshop_session_id');
        
        if (!$guestId) {
            $guestId = Str::uuid()->toString();
            Cookie::queue('eshop_session_id', $guestId, 60 * 24 * 30, null, null, null, false); // 30 days, not HttpOnly
        }
        
        return $guestId;
    }
    
    /**
     * Get the active cart for the current request.
     * 
     * If user is authenticated (via middleware), return user's cart.
     * Otherwise, return guest cart based on cookie session.
     */
    public function getActiveCart(Request $request): Cart
    {
        $userId = $request->attributes->get('auth_user_id');
        
        if ($userId) {
            // Authenticated user - get or create user cart
            return Cart::firstOrCreate(['user_id' => $userId]);
        }
        
        // Guest - get or create cart by session cookie
        $guestId = $this->ensureGuestIdCookie($request);
        return Cart::firstOrCreate(['session_id' => $guestId]);
    }
    
    /**
     * Rotate guest session cookie and optionally delete old guest cart.
     * Called on logout to ensure fresh guest cart.
     */
    public function resetGuestSession(Request $request): string
    {
        $oldGuestId = $request->cookie('eshop_session_id');
        
        // Delete old guest cart if it exists
        if ($oldGuestId) {
            Cart::where('session_id', $oldGuestId)->delete();
        }
        
        // Generate new session ID and queue cookie
        $newGuestId = Str::uuid()->toString();
        Cookie::queue('eshop_session_id', $newGuestId, 60 * 24 * 30, null, null, null, false); // 30 days, not HttpOnly
        
        return $newGuestId;
    }
}
