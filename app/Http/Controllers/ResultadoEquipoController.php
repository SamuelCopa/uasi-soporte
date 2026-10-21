<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Impresora;
use App\Models\Monitor;
use App\Models\Laptop;
use App\Models\Teclado;
use App\Models\Raton;
use App\Models\Upese;
use App\Models\Parlante;
use App\Models\Estabilizador;
use App\Models\OtrosEquipo;
use App\Models\RegistroCpu;
use App\Models\Audifono;

class ResultadoEquipoController extends Controller
{
public function guardar(Request $request, string $tipo, int $id)
{
    $request->validate([
        'detalle_trabajo' => 'required|string|min:3',
        'resultado_id' => 'required|integer|in:1,2,3,4,5',
    ]);

    $modelos = [
        'audifono' => Audifono::class,
        'cpu' => RegistroCpu::class,
        'estabilizador' => Estabilizador::class,
        'impresora' => Impresora::class,
        'laptop' => Laptop::class,
        'ups' => Upese::class,
        'parlante' => Parlante::class,
        'teclado' => Teclado::class,
        'mouse' => Raton::class,
        'monitor' => Monitor::class,
        'otro' => OtrosEquipo::class,
    ];

    abort_unless(
        isset($modelos[$tipo]),
        404,
        'Tipo de equipo no válido.'
    );

    $modelo = $modelos[$tipo];

    $equipo = $modelo::findOrFail($id);

    $equipo->detalle_trabajo = $request->detalle_trabajo;
    $equipo->resultado_id = $request->resultado_id;
    $equipo->save();

    return redirect()->back()
        ->with('success', 'REGISTRADO CORRECTAMENTE')
        ->with('text', 'El detalle del trabajo y el resultado se guardaron correctamente.')
        ->with('icono', 'success');
}
}