<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //$users = User::all();
        $user= Auth::user();

        return view('panelTecnico.panel', compact('user'));
    }

    public function asignacionesImpresora()
    {
        $user = Auth::user();
        return view('panelTecnico.asigImpresora', compact('user'));
    }
    
    public function asignacionesCpu()
    {
        $user = Auth::user();
        return view('panelTecnico.asigCpu', compact('user'));
    }

    public function asignacionesTeclado()
    {
        $user = Auth::user();
        return view('panelTecnico.asigTeclado', compact('user'));
    }

    public function asignacionesMouse()
    {
        $user = Auth::user();
        return view('panelTecnico.asigMouse', compact('user'));
    }
    public function asignacionesParlante()
    {
        $user = Auth::user();
        return view('panelTecnico.asigParlante', compact('user'));
    }

    public function asignacionesAudifono()
    {
        $user = Auth::user();
        return view('panelTecnico.asigAudifono', compact('user'));
    }

    public function asignacionesMonitor()
    {
        $user = Auth::user();
        return view('panelTecnico.asigMonitor', compact('user'));
    }

    public function asignacionesEstabilizador()
    {
        $user = Auth::user();
        return view('panelTecnico.asigEstabilizador', compact('user'));
    }

    public function asignacionesUps()
    {
        $user = Auth::user();
        return view('panelTecnico.asigUps', compact('user'));
    }

    public function asignacionesLaptop()
    {
        $user = Auth::user();
        return view('panelTecnico.asigLaptop', compact('user'));
    }

        public function panelRegistro()
    {
        $user = Auth::user();
        return view('panel.panelUsuario', compact('user'));

    }

    public function reportes()
    {
        $user = Auth::user();
        return view('reportes.reporte', compact('user'));

    }

    public function vistas()
{
         $user = Auth::user();
         $nuevasSolicitudes = Servicio::where('visto', false)->count();

        return view('panel.vista', compact('user', 'nuevasSolicitudes'));
}

    public function manual()
{
        return view('manual.manual');
}

public function equiposTotales()
{
    $laptopCount = Laptop::count();

    return view('inicio.inicio', compact('laptopCount'));
}




}

