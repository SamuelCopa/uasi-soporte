<?php
namespace App\Http\Controllers;
use App\Models\Laptop;
use App\Models\Impresora;
use App\Models\RegistroCpu;
use App\Models\Servicio;
use App\Models\Dependencia;
use App\Models\Documento;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $modelos = [
        \App\Models\RegistroCpu::class,
        \App\Models\Laptop::class,
        \App\Models\Impresora::class,
        \App\Models\Parlante::class,
        \App\Models\Teclado::class,
        \App\Models\Raton::class,
        \App\Models\Laptop::class,
        \App\Models\Upese::class,
        \App\Models\Audifono::class,
        \App\Models\Estabilizador::class,
    ];

    $totalEquipos = collect($modelos)->sum(function ($modelo) {
        return $modelo::count();
    });
    $totalEquipos2 = collect($modelos)->sum(function ($modelo) {
        return $modelo::where('estado_id', 2)->count();
    });
    $totalEquipos3 = collect($modelos)->sum(function ($modelo) {
        return $modelo::where('estado_id', 3)->count();
    });
    $totalEquipos4 = collect($modelos)->sum(function ($modelo) {
        return $modelo::where('estado_id', 4)->count();
    });
    $hayPendientes = Servicio::where('visto', 0)->exists();
    $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();
    $documentos = Documento::latest()->get();


    return view('inicio.inicio', compact('documentos', 'totalEquipos','totalEquipos2', 'totalEquipos3', 'totalEquipos4', 'hayPendientes', 'dependencia'));
}
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
