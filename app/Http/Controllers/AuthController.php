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
        if(!Auth::attempt($request->validated())) {
            return response()->json([
               'message' => __('Invalid credentials'),
            ], 401);
        }

        $request->user()->tokens()->delete();

        $token = $request->user()->createToken(
            name: 'api-token',
            abilities: ['*']
        );

        $expiresAt = now()->addMinutes(30);
        $token->accessToken->expires_at = $expiresAt;
        $token->accessToken->save();

        return response()->json([
            'token' => $token->plainTextToken,
            'expires_at' => $expiresAt->toIsoString(),
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
