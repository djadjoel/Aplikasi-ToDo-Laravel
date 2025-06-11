<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthToken
{
    public function handle($request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = substr($authHeader, 7);
        $userId = cache('user_token_' . $token);

        if (!$userId) {
            return response()->json(['message' => 'Token tidak valid atau kadaluarsa'], 401);
        }

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User tidak ditemukan'], 401);
        }

        auth()->guard()->setUser($user); // ✅ FIXED
        return $next($request);
    }
}