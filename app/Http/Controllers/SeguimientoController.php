<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeguimientoController extends Controller
{


// public function buscar(Request $request)
// {
//     $request->validate([
//         'codigo' => 'required|string',
//     ]);

//     $codigo = $request->codigo;

//     $tablas = [
//         'cpu'          => \App\Models\RegistroCpu::class,
//         'impresora'    => \App\Models\Impresora::class,
//         'teclado'      => \App\Models\Teclado::class,
//         'monitor'      => \App\Models\Monitor::class,
//         'audifono'     => \App\Models\Audifono::class,
//         'mouse'        => \App\Models\Raton::class,
//         'estabilizador'=> \App\Models\Estabilizador::class,
//         'ups'           => \App\Models\Upese::class,
//         'parlante'      => \App\Models\Parlante::class,
//         'laptop'        => \App\Models\Laptop::class,
//         'otroequipo'    => \App\Models\OtrosEquipo::class,
//     ];

//     $resultados = collect();

//     foreach ($tablas as $tipo => $modelo) {

//         $codigos = $modelo::where('cod_registro', $codigo)
//             ->whereYear('fecha', date('Y'))
//             ->where('estado_id', '!=', 5)
//             ->get();

//         foreach ($codigos as $codigoEncontrado) {
//             $codigoEncontrado->tipo_equipo = $tipo;
//             $resultados->push($codigoEncontrado);
//         }
//     }

//     if ($resultados->isEmpty()) {
//         return back()
//             ->with('success', 'INGRESE UN NÚMERO DE RECEPCIÓN VÁLIDO')
//             ->with('icono', 'error')
//             ->with('text', 'NÚMERO INCORRECTO');
//     }

//     return view(
//         'seguimiento.resultadoSeguimiento',
//         compact('resultados')
//     );
// }

public function buscar(Request $request)
{
    $request->validate([
        'codigo' => 'required|string',
    ]);

    $codigo = $request->codigo;

    $tablas = [
        'cpu' => [
            'modelo' => \App\Models\RegistroCpu::class,
            'nombre' => 'CPU',
        ],
        'impresora' => [
            'modelo' => \App\Models\Impresora::class,
            'nombre' => 'IMPRESORA',
        ],
        'teclado' => [
            'modelo' => \App\Models\Teclado::class,
            'nombre' => 'TECLADO',
        ],
        'monitor' => [
            'modelo' => \App\Models\Monitor::class,
            'nombre' => 'MONITOR',
        ],
        'audifono' => [
            'modelo' => \App\Models\Audifono::class,
            'nombre' => 'AUDÍFONO',
        ],
        'mouse' => [
            'modelo' => \App\Models\Raton::class,
            'nombre' => 'MOUSE',
        ],
        'estabilizador' => [
            'modelo' => \App\Models\Estabilizador::class,
            'nombre' => 'ESTABILIZADOR',
        ],
        'ups' => [
            'modelo' => \App\Models\Upese::class,
            'nombre' => 'UPS',
        ],
        'parlante' => [
            'modelo' => \App\Models\Parlante::class,
            'nombre' => 'PARLANTE',
        ],
        'laptop' => [
            'modelo' => \App\Models\Laptop::class,
            'nombre' => 'LAPTOP',
        ],
        'otroequipo' => [
            'modelo' => \App\Models\OtrosEquipo::class,
            'nombre' => 'OTRO EQUIPO',
        ],
    ];

    $resultados = collect();

    foreach ($tablas as $tipo => $datos) {

        $modelo = $datos['modelo'];

        $consulta = $modelo::where('cod_registro', $codigo)
            ->whereYear('fecha', date('Y'))
            ->where('estado_id', '!=', 5);

        /*
         * Si es Otro Equipo, cargar la relación
         * con TipoEquipo.
         */
        if ($tipo === 'otroequipo') {
            $consulta->with('tipoEquipo');
        }

        $codigos = $consulta->get();

        foreach ($codigos as $codigoEncontrado) {

            // Identificador del tipo
            $codigoEncontrado->tipo_equipo = $tipo;

            /*
             * Para OtrosEquipo obtener el nombre
             * desde la relación TipoEquipo.
             */
            if ($tipo === 'otroequipo') {

                $codigoEncontrado->nombre_equipo =
                    $codigoEncontrado->tipoEquipo?->nombre
                    ?? 'OTRO EQUIPO';

            } else {

                // Para los demás equipos usar nombre fijo
                $codigoEncontrado->nombre_equipo = $datos['nombre'];
            }

            $resultados->push($codigoEncontrado);
        }
    }

    if ($resultados->isEmpty()) {
        return back()
            ->with('success', 'INGRESE UN NÚMERO DE RECEPCIÓN VÁLIDO')
            ->with('icono', 'error')
            ->with('text', 'NÚMERO INCORRECTO');
    }

    return view(
        'seguimiento.resultadoSeguimiento',
        compact('resultados')
    );
}


}
