<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Handle user login.
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Email and password are required'], 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password_hash)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }

        // Create session token
        $session = Session::createForUser($user);

        return response()->json([
            'success' => true,
            'user' => array_merge($user->toApiArray(), [
                'session_token' => $session->session_token,
            ]),
            'expires_at' => $session->expires_at->toDateTimeString(),
        ]);
    }

    /**
     * Handle user signup.
     */
    public function signup(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
            'address1' => 'required|string|max:100',
            'address2' => 'nullable|string|max:100',
            'country_code' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Required fields are missing'], 400);
        }

        // Check if email already exists
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'Email already registered'], 409);
        }

        // Create user
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'address1' => $request->address1,
            'address2' => $request->address2,
            'country_code' => $request->country_code ?? '+64',
            'phone' => $request->phone,
            'role' => 'user',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Account created successfully',
        ]);
    }

    /**
     * Check if email exists.
     */
    public function checkEmail(Request $request): JsonResponse
    {
        $email = $request->query('email', '');

        if (empty($email)) {
            return response()->json(['error' => 'Email is required'], 400);
        }

        $exists = User::where('email', $email)->exists();

        return response()->json(['exists' => $exists]);
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request): JsonResponse
    {
        $sessionToken = $request->input('session_token', '');

        if (empty($sessionToken)) {
            return response()->json(['error' => 'Session token required'], 400);
        }

        Session::where('session_token', $sessionToken)->delete();

        return response()->json(['success' => true]);
    }
}
