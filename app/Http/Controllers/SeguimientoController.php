<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
public function buscar(Request $request)
{
    $request->validate([
        'tipo' => 'required|string',
        'codigo' => 'required|numeric'
    ]);

    $tipo = $request->tipo;
    $codigo = $request->codigo; // ✅ ya no usar query

    $map = [
        'cpu' => \App\Models\RegistroCpu::class,
        'impresora' => \App\Models\Impresora::class,
        'teclado' => \App\Models\Teclado::class,
        'monitor' => \App\Models\Monitor::class,
        'audifono' => \App\Models\Audifono::class,
        'mouse' => \App\Models\Raton::class,
        'estabilizador' => \App\Models\Estabilizador::class,
        'ups' => \App\Models\Upese::class,
        'parlante' => \App\Models\Parlante::class,
        'laptop' => \App\Models\Laptop::class,
    ];

    if (!array_key_exists($tipo, $map)) {
        return back()->with('error', 'Tipo inválido');
    }

    $modelo = $map[$tipo];

    $codigos = $modelo::where('cod_registro', $codigo)
        ->whereYear('fecha', date('Y'))
        ->where('estado_id', '!=', 5)
        ->get();

    if ($codigos->isEmpty()) {
        return back()
            ->with('success', 'INGRESE UN NÚMERO DE RECEPCIÓN VALIDO')
            ->with('icono', 'error')
            ->with('text', 'NÚMERO INCORRECTO');
    }

    return view('seguimiento.resultadoSeguimiento', compact('codigos', 'tipo'));
}


}
