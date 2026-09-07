<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audifono;
use App\Models\Estabilizador;
use App\Models\Impresora;
use App\Models\Laptop;
use App\Models\Monitor;
use App\Models\Parlante;
use App\Models\Raton;
use App\Models\RegistroCpu;
use App\Models\Teclado;
use App\Models\Upese;
use App\Models\OtrosEquipo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use App\Models\TiposEquipo;
use App\Models\Dependencia;

class EquipoController extends Controller
{
public function reporte(Request $request)
{
    /*
    |--------------------------------------------------------------------------
    | COLECCIÓN DE RESULTADOS
    |--------------------------------------------------------------------------
    */

    $equipos = collect();


    /*
    |--------------------------------------------------------------------------
    | DEPENDENCIAS
    |--------------------------------------------------------------------------
    */

    $dependencias = Dependencia::orderBy(
        'dependencias',
        'asc'
    )->get();


    /*
    |--------------------------------------------------------------------------
    | EQUIPOS PRINCIPALES
    |--------------------------------------------------------------------------
    */

    $modelos = [

        'CPU' => RegistroCpu::class,
        'IMPRESORA' => Impresora::class,
        'MONITOR' => Monitor::class,
        'AUDIFONO' => Audifono::class,
        'LAPTOP' => Laptop::class,
        'TECLADO' => Teclado::class,
        'PARLANTE' => Parlante::class,
        'MOUSE' => Raton::class,
        'UPS' => Upese::class,
        'ESTABILIZADOR' => Estabilizador::class,

    ];


    /*
    |--------------------------------------------------------------------------
    | TIPOS DE OTROS EQUIPOS
    |--------------------------------------------------------------------------
    */

    $otrosEquipos = TiposEquipo::orderBy(
        'nombre',
        'asc'
    )->get();


    /*
    |--------------------------------------------------------------------------
    | LISTA PARA EL SELECT
    |--------------------------------------------------------------------------
    */

    $tiposEquipos = collect(
        array_keys($modelos)
    )->merge(
        $otrosEquipos->pluck('nombre')
    )->unique()->values();


    /*
    |--------------------------------------------------------------------------
    | EQUIPO SELECCIONADO
    |--------------------------------------------------------------------------
    */

    $tipoSeleccionado = $request->input(
        'tipo_equipo'
    );


    /*
    |--------------------------------------------------------------------------
    | BUSCAR SI EL EQUIPO SELECCIONADO ES UN OTRO EQUIPO
    |--------------------------------------------------------------------------
    */

    $tipoOtroEquipo = null;

    if ($tipoSeleccionado) {

        $tipoOtroEquipo = $otrosEquipos->firstWhere(
            'nombre',
            $tipoSeleccionado
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ¿ES UN EQUIPO PRINCIPAL?
    |--------------------------------------------------------------------------
    */

    $esEquipoPrincipal = array_key_exists(
        strtoupper($tipoSeleccionado ?? ''),
        $modelos
    );


    /*
    |--------------------------------------------------------------------------
    | PROCESAR EQUIPOS PRINCIPALES
    |--------------------------------------------------------------------------
    */

    foreach ($modelos as $tipo => $modelo) {

        /*
        |--------------------------------------------------------------------------
        | SI SE SELECCIONÓ OTRO EQUIPO
        |--------------------------------------------------------------------------
        |
        | No debemos consultar CPU, impresoras, etc.
        |
        */

        if (
            $tipoSeleccionado &&
            !$esEquipoPrincipal
        ) {

            break;

        }


        /*
        |--------------------------------------------------------------------------
        | SI SE SELECCIONÓ UN EQUIPO ESPECÍFICO
        |--------------------------------------------------------------------------
        */

        if (
            $tipoSeleccionado &&
            strtoupper($tipoSeleccionado)
            !== strtoupper($tipo)
        ) {

            continue;

        }


        /*
        |--------------------------------------------------------------------------
        | CONSULTA
        |--------------------------------------------------------------------------
        */

        $query = $modelo::query();


        /*
        |--------------------------------------------------------------------------
        | AÑO
        |--------------------------------------------------------------------------
        */

        if ($request->filled('year')) {

            $query->whereYear(
                'fecha',
                $request->year
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FECHA DESDE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fecha_desde')) {

            $query->whereDate(
                'fecha',
                '>=',
                $request->fecha_desde
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FECHA HASTA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fecha_hasta')) {

            $query->whereDate(
                'fecha',
                '<=',
                $request->fecha_hasta
            );

        }


        /*
        |--------------------------------------------------------------------------
        | DEPENDENCIA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('dependencia')) {

            $query->where(
                'dependencia_id',
                $request->dependencia
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CÓDIGO
        |--------------------------------------------------------------------------
        */

        if ($request->filled('codigo')) {

            $query->where(
                'cod_gamea',
                'LIKE',
                '%' . $request->codigo . '%'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | RELACIONES
        |--------------------------------------------------------------------------
        */

        $registros = $query
            ->with([
                'funcionario',
                'Dependencia',
                'user',
                'resultado',
                'estado'
            ])
            ->get();


        /*
        |--------------------------------------------------------------------------
        | IDENTIFICAR TIPO
        |--------------------------------------------------------------------------
        */

        foreach ($registros as $registro) {

            $registro->tipo_equipo = $tipo;

        }


        /*
        |--------------------------------------------------------------------------
        | AGREGAR RESULTADOS
        |--------------------------------------------------------------------------
        */

        $equipos = $equipos->merge(
            $registros
        );

    }


    /*
    |--------------------------------------------------------------------------
    | PROCESAR OTROS EQUIPOS
    |--------------------------------------------------------------------------
    */

    /*
    | Se consulta OtrosEquipo cuando:
    |
    | 1. No se seleccionó ningún equipo
    | 2. Se seleccionó Cámara, Proyector, Scanner, etc.
    |
    */

    if (
        !$tipoSeleccionado ||
        !$esEquipoPrincipal
    ) {

        $query = OtrosEquipo::query();


        /*
        |--------------------------------------------------------------------------
        | FILTRO POR TIPO
        |--------------------------------------------------------------------------
        */

        if (
            $tipoSeleccionado &&
            $tipoOtroEquipo
        ) {

            $query->where(
                'tipo_equipo_id',
                $tipoOtroEquipo->id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | AÑO
        |--------------------------------------------------------------------------
        */

        if ($request->filled('year')) {

            $query->whereYear(
                'fecha',
                $request->year
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FECHA DESDE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fecha_desde')) {

            $query->whereDate(
                'fecha',
                '>=',
                $request->fecha_desde
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FECHA HASTA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fecha_hasta')) {

            $query->whereDate(
                'fecha',
                '<=',
                $request->fecha_hasta
            );

        }


        /*
        |--------------------------------------------------------------------------
        | DEPENDENCIA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('dependencia')) {

            $query->where(
                'dependencia_id',
                $request->dependencia
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CÓDIGO
        |--------------------------------------------------------------------------
        */

        if ($request->filled('codigo')) {

            $query->where(
                'cod_gamea',
                'LIKE',
                '%' . $request->codigo . '%'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | RELACIONES
        |--------------------------------------------------------------------------
        */

        $registros = $query
            ->with([
                'funcionario',
                'Dependencia',
                'user',
                'resultado',
                'estado',
                'tipoEquipo'
            ])
            ->get();


        /*
        |--------------------------------------------------------------------------
        | IDENTIFICAR COMO OTRO EQUIPO
        |--------------------------------------------------------------------------
        */

        foreach ($registros as $registro) {

            $registro->tipo_equipo = 'OTRO EQUIPO';

        }


        /*
        |--------------------------------------------------------------------------
        | AGREGAR RESULTADOS
        |--------------------------------------------------------------------------
        */

        $equipos = $equipos->merge(
            $registros
        );

    }


    /*
    |--------------------------------------------------------------------------
    | ORDENAR RESULTADOS
    |--------------------------------------------------------------------------
    */

    $equipos = $equipos
        ->sortByDesc('fecha')
        ->values();


    /*
    |--------------------------------------------------------------------------
    | RETORNAR VISTA
    |--------------------------------------------------------------------------
    */

    return view(
        'equipos.reporte',
        compact(
            'equipos',
            'dependencias',
            'tiposEquipos'
        )
    );
}

public function reportePdf(Request $request)
{
    $equipos = collect();

    /*
    |--------------------------------------------------------------------------
    | MODELOS DE EQUIPOS
    |--------------------------------------------------------------------------
    */

    $modelos = [

        'CPU' => RegistroCpu::class,
        'IMPRESORA' => Impresora::class,
        'MONITOR' => Monitor::class,
        'AUDIFONO' => Audifono::class,
        'LAPTOP' => Laptop::class,
        'TECLADO' => Teclado::class,
        'PARLANTE' => Parlante::class,
        'MOUSE' => Raton::class,
        'UPS' => Upese::class,
        'ESTABILIZADOR' => Estabilizador::class,
        'OTRO EQUIPO' => OtrosEquipo::class,

    ];


    /*
    |--------------------------------------------------------------------------
    | TIPO DE EQUIPO SELECCIONADO
    |--------------------------------------------------------------------------
    */

    $tipoSeleccionado = $request->input('tipo_equipo');


    /*
    |--------------------------------------------------------------------------
    | BUSCAR TIPO EN tipos_equipos
    |--------------------------------------------------------------------------
    */

    $tipoOtroEquipo = null;

    if ($tipoSeleccionado) {

        $tipoOtroEquipo = TiposEquipo::where(
            'nombre',
            $tipoSeleccionado
        )->first();

    }


    /*
    |--------------------------------------------------------------------------
    | RECORRER LOS MODELOS
    |--------------------------------------------------------------------------
    */

    foreach ($modelos as $tipo => $modelo) {


        /*
        |--------------------------------------------------------------------------
        | FILTRO DEL TIPO DE EQUIPO
        |--------------------------------------------------------------------------
        */

        if ($tipoSeleccionado) {

            /*
            | EQUIPOS NORMALES
            */

            if (
                $tipo !== 'OTRO EQUIPO' &&
                strtoupper($tipoSeleccionado)
                    !== strtoupper($tipo)
            ) {

                continue;

            }


            /*
            | OTROS EQUIPOS
            */

            if ($tipo === 'OTRO EQUIPO') {

                if (!$tipoOtroEquipo) {

                    continue;

                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | CREAR CONSULTA
        |--------------------------------------------------------------------------
        */

        $query = $modelo::query();


        /*
        |--------------------------------------------------------------------------
        | FILTRO OTRO EQUIPO
        |--------------------------------------------------------------------------
        */

        if (
            $tipo === 'OTRO EQUIPO' &&
            $tipoOtroEquipo
        ) {

            $query->where(
                'tipo_equipo_id',
                $tipoOtroEquipo->id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | AÑO
        |--------------------------------------------------------------------------
        */

        if ($request->filled('year')) {

            $query->whereYear(
                'fecha',
                $request->year
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FECHA DESDE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fecha_desde')) {

            $query->whereDate(
                'fecha',
                '>=',
                $request->fecha_desde
            );

        }


        /*
        |--------------------------------------------------------------------------
        | FECHA HASTA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fecha_hasta')) {

            $query->whereDate(
                'fecha',
                '<=',
                $request->fecha_hasta
            );

        }


        /*
        |--------------------------------------------------------------------------
        | DEPENDENCIA
        |--------------------------------------------------------------------------
        */

        if ($request->filled('dependencia')) {

            $query->where(
                'dependencia_id',
                $request->dependencia
            );

        }


        /*
        |--------------------------------------------------------------------------
        | CÓDIGO
        |--------------------------------------------------------------------------
        */

        if ($request->filled('codigo')) {
            $query->where(
                'cod_gamea',
                'LIKE',
                '%' . $request->codigo . '%'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | RELACIONES
        |--------------------------------------------------------------------------
        */

        $relaciones = [
            'funcionario',
            'Dependencia',
            'user',
            'resultado',
            'estado'
        ];


        /*
        | Relación para OtrosEquipo
        */

        if ($modelo === OtrosEquipo::class) {
            $relaciones[] = 'tipoEquipo';

        }


        /*
        |--------------------------------------------------------------------------
        | OBTENER REGISTROS
        |--------------------------------------------------------------------------
        */

        $registros = $query
            ->with($relaciones)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | IDENTIFICAR TIPO
        |--------------------------------------------------------------------------
        */

        foreach ($registros as $registro) {
            $registro->tipo_equipo = $tipo;

        }


        /*
        |--------------------------------------------------------------------------
        | AGREGAR RESULTADOS
        |--------------------------------------------------------------------------
        */
        $equipos = $equipos->merge(
            $registros
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ORDENAR
    |--------------------------------------------------------------------------
    */
    $equipos = $equipos
        ->sortBy('fecha')
        ->values();
    /*
    |--------------------------------------------------------------------------
    | GENERAR PDF
    |--------------------------------------------------------------------------
    */
    $pdf = Pdf::loadView(
        'equipos.reporte-pdf',
        compact('equipos')
    );


    /*
    |--------------------------------------------------------------------------
    | ORIENTACIÓN
    |--------------------------------------------------------------------------
    */

    $pdf->setPaper(
        'letter'
    );
    /*
    |--------------------------------------------------------------------------
    | MOSTRAR
    |--------------------------------------------------------------------------
    */

    return $pdf->stream(
        'reporte-equipos.pdf'
    );
}
}
