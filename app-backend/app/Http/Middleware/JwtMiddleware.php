<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

class JwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(["status" => 401, "message" => 'El token es inválido'], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(["status" => 401, "message" => 'El token ha expirado'], 401);
            } else {
                return response()->json(["status" => 403, "message" => 'El token de autorización no ha sido encontrado'], 403);
            }
        }
        return $next($request);
    }
}
