<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
class AdminMiddleware
{
    public function handel(Request $request, Closure $next) {
        $user = auth()->user();

        if (!$user || !$user->hasRole('admin')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
