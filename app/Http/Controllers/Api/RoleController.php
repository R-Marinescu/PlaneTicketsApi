<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;

class RoleController
{
    public function index() {
        $roles = Role::paginate(request('per_page', 15));

        return RoleResource::collection($roles)->response();
    }

    public function show($RoleId) {
        $role = Role::findOrFail($RoleId);

        return (new RoleResource($role))->response();
    }

    public function store(RoleRequest $request) {
        $role = Role::create([
            'role_name' => $request->input('role_name'),
        ]);

        return response()->json([
            'message' => 'Role created successfully',
            'data' => new RoleResource($role)
        ], 201);
    }

    public function update(RoleRequest $request, $id) {
        $role = Role::findOrFail($id);

        $role->update([
            'role_name' => $request->input('role_name', $role->role_name),
        ]);

        return response()->json([
            'message' => 'Role updated successfully',
            'data' => new RoleResource($role)
        ], 200);
    }

    public function destroy($id) {
        $role = Role::findOrFail($id);

        $role->delete();

        return response()->json(['message' => 'Role deleted successfully'], 200);
    }
}
