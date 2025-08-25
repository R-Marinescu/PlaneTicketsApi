<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController
{
    public function index() {
        $users = User::paginate(request('per_page', 15));

        return UserResource::collection($users)->response();
    }

    public function getAuthenticatedUser(UserRequest $request)
    {
        return new UserResource($request->user());
    }

    public function show($userId) {
        $user = User::findOrFail($userId);

        return (new UserResource($user))->response();
    }

    public function store(UserRequest $request) {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->assignRoleByName($request->input('role_name', 'passenger'));

        return response()->json(['message' => 'User created successfully', 'data' => new UserResource($user)], 201);
    }

    public function register(UserRequest $request) {
        $user = User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $user->assignRoleByName('passenger');

        return response()->json(['message' => 'User registered successfully', 'data' => new UserResource($user)], 201);
    }

    public function update(UserRequest $request, $id){
        $user = User::findOrFail($id);

        $user->update([
            'first_name' => $request->filled('first_name') ? $request->input('first_name') : $user->first_name,
            'last_name' => $request->filled('last_name') ? $request->input('last_name') : $user->last_name,
            'email' => $request->filled('email') ? $request->input('email') : $user->email,
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
        ]);

        return response()->json([
            'message' => 'User updated successfully',
            'data' => new UserResource($user)], 200);
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

}
