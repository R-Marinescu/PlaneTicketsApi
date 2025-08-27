<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class AdminController
{
    public function index() {
        $users = User::paginate(request('per_page', 15));

        return UserResource::collection($users)->response();
    }

}
