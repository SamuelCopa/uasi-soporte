<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSingleSession
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            $user = Auth::user();

            $sessionToken = $request->session()->get('session_token');

            // Si el token de la sesión no coincide con el usuario
            if (
                empty($sessionToken) ||
                empty($user->session_token) ||
                !hash_equals($user->session_token, $sessionToken)
            ) {

                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()
                    ->route('login')
                    ->with(
                        'error',
                        'Tu sesión fue cerrada porque tu cuenta inició sesión en otro navegador o dispositivo.'
                    );
            }
        }

        return $next($request);
    }
}