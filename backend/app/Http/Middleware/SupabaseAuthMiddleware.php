<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupabaseAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => '認証が必要です'], 401);
        }

        try {
            $decoded = JWT::decode(
                $token,
                new Key(env('SUPABASE_JWT_SECRET'), 'HS256')
            );

            // JWTからユーザー情報を取得してリクエストに追加
            $request->merge(['user' => $decoded]);

            return $next($request);
        } catch (\Exception $e) {
            return response()->json(['error' => '無効なトークンです'], 401);
        }
    }
}
