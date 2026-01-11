<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Optional Bearer token authentication for web routes.
 * 
 * - If no token: continue as guest (cart works via cookie)
 * - If valid token: set auth_user_id on request attributes
 * - If invalid/expired token: return 401 (so frontend can clear stale token)
 */
class WebTokenAuthOptional
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        
        // No token = guest mode, continue normally
        if (!$token) {
            return $next($request);
        }
        
        // Token provided - validate it
        $session = Session::where('session_token', $token)
            ->where('expires_at', '>', now())
            ->first();
        
        if (!$session) {
            // Token is invalid or expired - return 401 so frontend can clear it
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired token.',
            ], 401);
        }
        
        // Valid token - attach user ID to request for downstream use
        $request->attributes->set('auth_user_id', $session->user_id);
        
        return $next($request);
    }
}
