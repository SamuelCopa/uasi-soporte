<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        // Cargar las especialidades del usuario
        $user->load('especialidades');

        // ==========================================
        // SOLICITUDES NUEVAS
        // ==========================================

        // Para Administrador:
        // todas las solicitudes que todavía no fueron vistas
        $nuevasSolicitudes = Servicio::where('visto', 0)->count();

        // Para Técnico:
        // solamente sus solicitudes que todavía no fueron vistas
        $nuevasSolicitudesTecnico = Servicio::where('visto', 0)
            ->where('user_id', $user->id)
            ->count();


        // ==========================================
        // ADMINISTRADOR Y SUPERADMINISTRADOR
        // ==========================================

        if ($user->hasAnyRole(['Administrador', 'SuperAdministrador'])) {

            return view('home', [
                'user' => $user,
                'nuevasSolicitudes' => $nuevasSolicitudes,
                'nuevasSolicitudesTecnico' => $nuevasSolicitudesTecnico,
            ]);
        }


        // ==========================================
        // TÉCNICO CON ESPECIALIDAD SOPORTE
        // ==========================================

        if (
            $user->hasRole('Tecnico') &&
            $user->especialidades->contains('codigo', 'SOPORTE')
        ) {

            return view('home', [
                'user' => $user,
                'nuevasSolicitudes' => $nuevasSolicitudes,
                'nuevasSolicitudesTecnico' => $nuevasSolicitudesTecnico,
            ]);
        }


        // ==========================================
        // LOS DEMÁS TÉCNICOS
        // ==========================================

        if ($user->hasRole('Tecnico')) {
            return redirect()->route('asignaciones.asistencia');
        }


        // ==========================================
        // CUALQUIER OTRO USUARIO
        // ==========================================

        return redirect()->route('asignaciones.asistencia');
    }

}
}
