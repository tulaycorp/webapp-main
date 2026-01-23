<?php

namespace App\Http\Middleware;

use App\Models\UserSession;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Optional Bearer token authentication for web routes.
 * 
 * - If no token: continue as guest (cart works via cookie)
 * - If valid token: set auth_user_id on request attributes
 * - If invalid/expired token: continue as guest, set X-Auth-Token-Status header (frontend can clear stale token)
 * 
 * Note: This middleware is for routes that support BOTH authenticated and guest access.
 * Routes requiring authentication should check for auth_user_id and return their own 401 if missing.
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
        $session = UserSession::where('session_token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$session) {
            // Token is invalid or expired
            // For OPTIONAL auth, we should NOT block the request
            // Instead, log it and set a header for frontend to clear the token
            \Log::warning('WebTokenAuthOptional: Invalid or expired token detected', [
                'token_prefix' => substr($token, 0, 10),
                'path' => $request->path()
            ]);

            // Continue processing as guest, but set header to signal frontend
            $response = $next($request);
            if ($response instanceof \Illuminate\Http\JsonResponse || $response instanceof \Illuminate\Http\Response) {
                $response->header('X-Auth-Token-Status', 'Invalid');
            }
            return $response;
        }

        // Valid token - attach user ID to request for downstream use
        $request->attributes->set('auth_user_id', $session->user_id);
        \Log::info('WebTokenAuthOptional: Valid token, authenticated as user ' . $session->user_id);

        return $next($request);
    }
}
