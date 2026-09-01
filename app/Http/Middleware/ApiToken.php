<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        $tokenConfigurado = config('services.funcionarios_api.token');

        if (
            empty($token) ||
            empty($tokenConfigurado) ||
            !hash_equals($tokenConfigurado, $token)
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Token no válido'
            ], 401);
        }

        return $next($request);
    }
}