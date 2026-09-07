<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        return $this->attemptLogin($request)
            ? $this->sendLoginResponse($request)
            : $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->id_estadousuario !== 1) {

            Auth::logout();

            return redirect()->route('login')
                ->with(
                    'error',
                    'Tu cuenta está inactiva. Por favor, contacta con el administrador.'
                );
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $user = Auth::user();

        // Generar nuevo token de sesión
        $token = Str::random(64);

        // Guardar token en el usuario
        $user->session_token = $token;
        $user->save();

        // Guardar token en la sesión actual
        $request->session()->put('session_token', $token);

        return redirect()->back()
            ->with('login_success', true);
    }
}