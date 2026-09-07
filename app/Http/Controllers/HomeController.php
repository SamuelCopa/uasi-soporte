<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
public function index()
{
    $user = auth()->user();

    // Administrador y SuperAdministrador
    if ($user->hasAnyRole(['Administrador', 'SuperAdministrador'])) {
        return view('home', [
            'user' => $user,
            'nuevasSolicitudes' => $this->nuevasSolicitudes ?? 0,
        ]);
    }

    // Técnico de SOPORTE
    if (
        $user->hasRole('Tecnico') &&
        $user->especialidad?->codigo === 'SOPORTE'
    ) {
        return view('home', [
            'user' => $user,
            'nuevasSolicitudesTecnico' => $this->nuevasSolicitudesTecnico ?? 0,
        ]);
    }

    // Los demás técnicos
    if ($user->hasRole('Tecnico')) {
        return redirect()->route('asignaciones.asistencia');
    }

    // Cualquier otro usuario
    return redirect()->route('asignaciones.asistencia');
}
}
