<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle user login.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        // Attempt authentication
        if (!Auth::attempt($request->validated())) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $request->user()->tokens()->delete();

        $token = $request->user()->createToken(
            name: 'api-token',
            abilities: ['*']
        )->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => new UserResource ($request->user()),
            'user_role' => $request->user()->load('roles'), // Eager load relationships
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out']);
    }
}
