<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (JWTAuth::user()->role !== $role) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
