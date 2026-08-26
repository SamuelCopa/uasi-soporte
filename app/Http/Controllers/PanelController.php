<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;

class PanelController extends Controller
{

public function index()
{
      //$users = User::all();
        $cpu = RegistroCpu::whereYear('fecha_asignacion', date('Y'))->count();
        $impresora = Impresora::whereYear('fecha_asignacion', date('Y'))->count();
        $audifono = Audifono::whereYear('fecha_asignacion', date('Y'))->count();
        $monitor = Monitor::whereYear('fecha_asignacion', date('Y'))->count();
        $laptop = Laptop::whereYear('fecha_asignacion', date('Y'))->count();
        $parlante = Parlante::whereYear('fecha_asignacion', date('Y'))->count();
        $estabilizador = Estabilizador::whereYear('fecha_asignacion', date('Y'))->count();
        $mouse = Raton::whereYear('fecha_asignacion', date('Y'))->count();
        $teclado = Teclado::whereYear('fecha_asignacion', date('Y'))->count();
        $ups = Upese::whereYear('fecha_asignacion', date('Y'))->count();

        $totales = [
            'CPU' => $cpu,
            'Impresora' => $impresora,
            'Monitor' => $monitor,
            'Audifono' => $audifono,
            'Parlante' => $parlante,
            'Estabilizador' => $estabilizador,
            'Mouse' => $mouse,
            'Teclado' => $teclado,
            'UPS' => $ups,
            'Laptop' => $laptop,
        ];
// -------------------------------admin---------------------------------------------
    $cpuPorMes = RegistroCpu::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesCpu = [];
    foreach ($cpuPorMes as $cpu) {
        
        $mes = date('F', mktime(0, 0, 0, $cpu->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesCpu[$mes] = $cpu->total;
    }
// -------------------------------admin---------------------------------------------
    $audifonosPorMes = Audifono::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesAudifono = [];
    foreach ($audifonosPorMes as $audifono) {
        
        $mes = date('F', mktime(0, 0, 0, $audifono->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesAudifono[$mes] = $audifono->total;
    }
// -------------------------------admin---------------------------------------------
    $impresoraPorMes = Impresora::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();

    $totalesImpresora = [];
    foreach ($impresoraPorMes as $impresora) {
        
        $mes = date('F', mktime(0, 0, 0, $impresora->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesImpresora[$mes] = $impresora->total;
    }
// -------------------------------admin---------------------------------------------
    $monitorPorMes = Monitor::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();

    $totalesMonitor = [];
    foreach ($monitorPorMes as $monitor) {
        
        $mes = date('F', mktime(0, 0, 0, $monitor->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesMonitor[$mes] = $monitor->total;
    }
// -------------------------------admin---------------------------------------------
    $tecladoPorMes = Teclado::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();

    $totalesTeclado = [];
    foreach ($tecladoPorMes as $teclado) {        
        $mes = date('F', mktime(0, 0, 0, $teclado->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesTeclado[$mes] = $teclado->total;
    }
// -------------------------------admin---------------------------------------------
    $parlantePorMes = Parlante::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();

    $totalesParlante = [];
    foreach ($parlantePorMes as $parlante) {        
        $mes = date('F', mktime(0, 0, 0, $parlante->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesParlante[$mes] = $parlante->total;
    }
// -------------------------------admin---------------------------------------------
    $mousePorMes = Raton::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesMouse = [];
    foreach ($mousePorMes as $mouse) {        
        $mes = date('F', mktime(0, 0, 0, $mouse->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesMouse[$mes] = $mouse->total;
    }
// -------------------------------admin---------------------------------------------
    $upsPorMes = Upese::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesUps = [];
    foreach ($upsPorMes as $ups) {        
        $mes = date('F', mktime(0, 0, 0, $ups->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesUps[$mes] = $ups->total;
    }
// -------------------------------admin---------------------------------------------
    $estabilizadorPorMes = Estabilizador::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesEstabilizador = [];
    foreach ($estabilizadorPorMes as $estabilizador) {        
        $mes = date('F', mktime(0, 0, 0, $estabilizador->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesEstabilizador[$mes] = $estabilizador->total;
    }
// -------------------------------admin---------------------------------------------
    $laptopPorMes = Laptop::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesLaptop = [];
    foreach ($laptopPorMes as $laptop) {        
        $mes = date('F', mktime(0, 0, 0, $laptop->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesLaptop[$mes] = $laptop->total;
    }
// ----------------------------------------------------------------------------
        $user= Auth::user();

        return view('panel.estadisticas', compact('user', 'totales', 'totalesAudifono','totalesImpresora','totalesCpu',
        'totalesMouse', 'totalesMonitor', 'totalesTeclado', 'totalesParlante', 'totalesUps', 'totalesEstabilizador',
        'totalesLaptop'));

    }

    public function estadisticaTecnico1(){

        $userId = Auth::user()->id; // Obtiene el ID del usuario autenticado
        $audifonos = Audifono::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $monitors = Monitor::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $laptops = Laptop::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $cpus = RegistroCpu::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $impresoras = Impresora::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $estabilizadors = Estabilizador::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $teclados = Teclado::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $mouses = Raton::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $upss = Upese::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();
        $parlantes = Parlante::where('user_id', $userId)->whereYear('fecha_asignacion', date('Y'))->count();

        $totales1 = [
            'CPU' => $cpus,
            'Impresora' => $impresoras,
            'Monitor' => $monitors,
            'Audifono' => $audifonos,
            'Parlante' => $parlantes,
            'Estabilizador' => $estabilizadors,
            'Mouse' => $mouses,
            'Teclado' => $teclados,
            'UPS' => $upss,
            'Laptop' => $laptops,
        ];

        // ---------------------------TECNICO-------------------------------------------------
    $cpuPorMes = RegistroCpu::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesCpu2 = [];
    foreach ($cpuPorMes as $cpu) {
        
        $mes = date('F', mktime(0, 0, 0, $cpu->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesCpu2[$mes] = $cpu->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $audifonosPorMes = Audifono::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesAudifono2 = [];
    foreach ($audifonosPorMes as $audifono) {
        $mes = date('F', mktime(0, 0, 0, $audifono->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesAudifono2[$mes] = $audifono->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $impresoraPorMes = Impresora::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesImpresora2 = [];
    foreach ($impresoraPorMes as $impresora) {
        
        $mes = date('F', mktime(0, 0, 0, $impresora->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesImpresora2[$mes] = $impresora->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $monitorPorMes = Monitor::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesMonitor2 = [];
    foreach ($monitorPorMes as $monitor) {
        
        $mes = date('F', mktime(0, 0, 0, $monitor->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesMonitor2[$mes] = $monitor->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $tecladoPorMes = Teclado::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();

    $totalesTeclado2 = [];
    foreach ($tecladoPorMes as $teclado) {        
        $mes = date('F', mktime(0, 0, 0, $teclado->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesTeclado2[$mes] = $teclado->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $parlantePorMes = Parlante::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesParlante2 = [];
    foreach ($parlantePorMes as $parlante) {        
        $mes = date('F', mktime(0, 0, 0, $parlante->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesParlante2[$mes] = $parlante->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $mousePorMes = Raton::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesMouse2 = [];
    foreach ($mousePorMes as $mouse) {        
        $mes = date('F', mktime(0, 0, 0, $mouse->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesMouse2[$mes] = $mouse->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $upsPorMes = Upese::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesUps2 = [];
    foreach ($upsPorMes as $ups) {        
        $mes = date('F', mktime(0, 0, 0, $ups->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesUps2[$mes] = $ups->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $estabilizadorPorMes = Estabilizador::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesEstabilizador2 = [];
    foreach ($estabilizadorPorMes as $estabilizador) {        
        $mes = date('F', mktime(0, 0, 0, $estabilizador->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesEstabilizador2[$mes] = $estabilizador->total;
    }
// ---------------------------TECNICO-------------------------------------------------
    $laptopPorMes = Laptop::selectRaw('MONTH(fecha_asignacion) as mes, COUNT(*) as total')
    ->where('user_id', $userId)
    ->whereYear('fecha_asignacion', date('Y'))
    ->groupBy('mes')
    ->get();
    $totalesLaptop2 = [];
    foreach ($laptopPorMes as $laptop) {        
        $mes = date('F', mktime(0, 0, 0, $laptop->mes, 1));
        $mes = strtoupper(Carbon::parse($mes)->translatedFormat('F'));
        $totalesLaptop2[$mes] = $laptop->total;
    }

// ----------------------------------------------------------------------------
        $user= Auth::user();

        return view('panelTecnico.estadisticas', compact('user', 'totales1','totalesAudifono2',
        'totalesImpresora2','totalesCpu2', 'totalesMouse2', 'totalesMonitor2',
        'totalesTeclado2', 'totalesParlante2', 'totalesUps2', 'totalesEstabilizador2', 'totalesLaptop2'));
    }


// --------------------------------RESULTADOS MANTENIMIENTO--------------------------------------

public function resultado()
{
    $year = now()->year;

    $modelos = [
        'CPU' => RegistroCpu::class,
        'Impresora' => Impresora::class,
        'Monitor' => Monitor::class,
        'Audifono' => Audifono::class,
        'Laptop' => Laptop::class,
        'Teclado' => Teclado::class,
        'Parlante' => Parlante::class,
        'Mouse' => Raton::class,
        'UPS' => Upese::class,
        'Estabilizador' => Estabilizador::class,
    ];

    $totales = [
        'devolucion' => 0,
        'reposicion' => 0,
        'repliegue'  => 0,
        'custodio'   => 0,
        'baja'       => 0,
    ];

    $detalle = [];

    /*
    |--------------------------------------------------------------------------
    | EQUIPOS NORMALES
    |--------------------------------------------------------------------------
    */

    foreach ($modelos as $nombre => $modelo) {

        $query = $modelo::whereNotNull('fecha_entrega')
            ->whereYear('fecha_entrega', $year);

        $detalle[$nombre] = [
            'devolucion' => (clone $query)
                ->where('resultado_id', 1)
                ->count(),

            'reposicion' => (clone $query)
                ->where('resultado_id', 2)
                ->count(),

            'repliegue' => (clone $query)
                ->where('resultado_id', 3)
                ->count(),

            'custodio' => (clone $query)
                ->where('resultado_id', 4)
                ->count(),

            'baja' => (clone $query)
                ->where('resultado_id', 5)
                ->count(),
        ];

        foreach ($detalle[$nombre] as $key => $valor) {
            $totales[$key] += $valor;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | OTROS EQUIPOS
    |--------------------------------------------------------------------------
    */

    $otrosEquipos = OtrosEquipo::with('tipoEquipo')
        ->whereNotNull('fecha_entrega')
        ->whereYear('fecha_entrega', $year)
        ->get();


    /*
    |--------------------------------------------------------------------------
    | AGRUPAR POR TIPO DE EQUIPO
    |--------------------------------------------------------------------------
    */

    $otrosAgrupados = $otrosEquipos->groupBy(function ($equipo) {

        return $equipo->tipoEquipo?->nombre ?? 'OTRO EQUIPO';

    });


    /*
    |--------------------------------------------------------------------------
    | AGREGAR CADA TIPO DINÁMICAMENTE
    |--------------------------------------------------------------------------
    */

    foreach ($otrosAgrupados as $nombre => $equipos) {

        $detalle[$nombre] = [
            'devolucion' => $equipos
                ->where('resultado_id', 1)
                ->count(),

            'reposicion' => $equipos
                ->where('resultado_id', 2)
                ->count(),

            'repliegue' => $equipos
                ->where('resultado_id', 3)
                ->count(),

            'custodio' => $equipos
                ->where('resultado_id', 4)
                ->count(),

            'baja' => $equipos
                ->where('resultado_id', 5)
                ->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | SUMAR A LOS TOTALES GENERALES
        |--------------------------------------------------------------------------
        */

        foreach ($detalle[$nombre] as $key => $valor) {
            $totales[$key] += $valor;
        }
    }


    $user = Auth::user();

    return view(
        'panel.resultado',
        compact(
            'totales',
            'detalle',
            'user',
            'year'
        )
    );
}


public function resultadoPdf()
{
    $year = now()->year;

    $modelos = [
        'CPU' => RegistroCpu::class,
        'Impresora' => Impresora::class,
        'Monitor' => Monitor::class,
        'Audifono' => Audifono::class,
        'Laptop' => Laptop::class,
        'Teclado' => Teclado::class,
        'Parlante' => Parlante::class,
        'Mouse' => Raton::class,
        'UPS' => Upese::class,
        'Estabilizador' => Estabilizador::class,
    ];

    $totales = [
        'devolucion' => 0,
        'reposicion' => 0,
        'repliegue'  => 0,
        'custodio'   => 0,
        'baja'       => 0,
    ];

    $detalle = [];

    /*
    |--------------------------------------------------------------------------
    | EQUIPOS NORMALES
    |--------------------------------------------------------------------------
    */

    foreach ($modelos as $nombre => $modelo) {

        $query = $modelo::whereNotNull('fecha_entrega')
            ->whereYear('fecha_entrega', $year);

        $detalle[$nombre] = [
            'devolucion' => (clone $query)
                ->where('resultado_id', 1)
                ->count(),

            'reposicion' => (clone $query)
                ->where('resultado_id', 2)
                ->count(),

            'repliegue' => (clone $query)
                ->where('resultado_id', 3)
                ->count(),

            'custodio' => (clone $query)
                ->where('resultado_id', 4)
                ->count(),

            'baja' => (clone $query)
                ->where('resultado_id', 5)
                ->count(),
        ];

        foreach ($detalle[$nombre] as $key => $valor) {
            $totales[$key] += $valor;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | OTROS EQUIPOS
    |--------------------------------------------------------------------------
    */

    $otrosEquipos = OtrosEquipo::with('tipoEquipo')
        ->whereNotNull('fecha_entrega')
        ->whereYear('fecha_entrega', $year)
        ->get();

    $otrosAgrupados = $otrosEquipos->groupBy(function ($equipo) {

        return $equipo->tipoEquipo?->nombre
            ?? 'OTRO EQUIPO';

    });


    foreach ($otrosAgrupados as $nombre => $equipos) {

        $detalle[$nombre] = [
            'devolucion' => $equipos
                ->where('resultado_id', 1)
                ->count(),

            'reposicion' => $equipos
                ->where('resultado_id', 2)
                ->count(),

            'repliegue' => $equipos
                ->where('resultado_id', 3)
                ->count(),

            'custodio' => $equipos
                ->where('resultado_id', 4)
                ->count(),

            'baja' => $equipos
                ->where('resultado_id', 5)
                ->count(),
        ];

        foreach ($detalle[$nombre] as $key => $valor) {
            $totales[$key] += $valor;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | GENERAR PDF
    |--------------------------------------------------------------------------
    */

    $pdf = Pdf::loadView(
        'panel.resultadoPdf',
        compact(
            'detalle',
            'totales',
            'year'
        )
    );

    $pdf->setPaper('letter');

    return $pdf->stream(
        'informe_mantenimiento_' . $year . '.pdf'
    );
}




public function reportePdf(User $user)
{
    $anio = date('Y');

    $asignaciones = [
        ['titulo' => 'CPUs ASIGNADOS', 'relacion' => 'registro_cpus'],
        ['titulo' => 'IMPRESORAS ASIGNADAS', 'relacion' => 'impresoras'],
        ['titulo' => 'MONITORES ASIGNADOS', 'relacion' => 'monitor'],
        ['titulo' => 'AUDIFONOS ASIGNADOS', 'relacion' => 'audifonos'],
        ['titulo' => 'LAPTOPS ASIGNADOS', 'relacion' => 'laptop'],
        ['titulo' => 'TECLADOS ASIGNADOS', 'relacion' => 'teclados'],
        ['titulo' => 'PARLANTES ASIGNADOS', 'relacion' => 'parlantes'],
        ['titulo' => 'MOUSE ASIGNADOS', 'relacion' => 'raton'],
        ['titulo' => 'UPS ASIGNADOS', 'relacion' => 'upeses'],
        ['titulo' => 'ESTABILIZADORES ASIGNADOS', 'relacion' => 'estabilizador'],
    ];

    $estados = [
        1 => 'Recepcionados',
        2 => 'En proceso',
        3 => 'Apersonarse con el técnico',
        4 => 'Concluido',
        5 => 'Entregados',
    ];

    $datos = [];

    foreach ($asignaciones as $item) {

        $rel = $item['relacion'];

        $consulta = $user->$rel()
            ->whereYear('fecha_asignacion', $anio);

        $total = $consulta->count();

        $estadosData = [];

        foreach ($estados as $id => $nombre) {

            $cantidad = $user->$rel()
                ->whereYear('fecha_asignacion', $anio)
                ->where('estado_id', $id)
                ->count();

            $porcentaje = $total > 0
                ? round(($cantidad / $total) * 100)
                : 0;

            $estadosData[] = [
                'id' => $id,
                'nombre' => $nombre,
                'cantidad' => $cantidad,
                'porcentaje' => $porcentaje,
            ];
        }

        $datos[] = [
            'titulo' => $item['titulo'],
            'total' => $total,
            'estados' => $estadosData,
        ];
    }

    $pdf = Pdf::loadView('asigTecnicos.asignaciones', compact('user', 'datos', 'anio'));

    $pdf->setPaper('A4', 'portrait');

    return $pdf->stream(
        'reporte_asignaciones_' . $user->id . '_' . $anio . '.pdf'
    );
}

public function reportePdf2(Request $request, $id)
{
    $user = User::findOrFail($id);

    $tipo = $request->input('tipo', 'anio');
    $anio = $request->input('anio', date('Y'));
    $mes = $request->input('mes');

    $asignaciones = [
        ['titulo' => 'CPUs', 'relacion' => 'registro_cpus'],
        ['titulo' => 'Impresoras', 'relacion' => 'impresoras'],
        ['titulo' => 'Monitores', 'relacion' => 'monitor'],
        ['titulo' => 'Audífonos', 'relacion' => 'audifonos'],
        ['titulo' => 'Laptops', 'relacion' => 'laptop'],
        ['titulo' => 'Teclados', 'relacion' => 'teclados'],
        ['titulo' => 'Parlantes', 'relacion' => 'parlantes'],
        ['titulo' => 'Mouse', 'relacion' => 'raton'],
        ['titulo' => 'UPS', 'relacion' => 'upeses'],
        ['titulo' => 'Estabilizadores', 'relacion' => 'estabilizador'],
    ];

    $estados = [
        1 => 'Recepcionado',
        2 => 'En proceso',
        3 => 'Apersonarse',
        4 => 'Concluido',
        5 => 'Entregado',
    ];

    $datos = [];

    foreach ($asignaciones as $item) {

        $rel = $item['relacion'];

        $query = $user->$rel()
            ->whereYear('fecha_asignacion', $anio);

        // Si es reporte mensual
        if ($tipo === 'mes' && $mes) {
            $query->whereMonth('fecha_asignacion', $mes);
        }

        $total = $query->count();

        $estadosData = [];

        foreach ($estados as $idEstado => $nombreEstado) {

            $queryEstado = $user->$rel()
                ->whereYear('fecha_asignacion', $anio)
                ->where('estado_id', $idEstado);

            if ($tipo === 'mes' && $mes) {
                $queryEstado->whereMonth('fecha_asignacion', $mes);
            }

            $cantidad = $queryEstado->count();

            $estadosData[] = [
                'estado' => $nombreEstado,
                'cantidad' => $cantidad,
            ];
        }

        $datos[] = [
            'titulo' => $item['titulo'],
            'total' => $total,
            'estados' => $estadosData,
        ];
    }

    $meses = [
        1 => 'ENERO',
        2 => 'FEBRERO',
        3 => 'MARZO',
        4 => 'ABRIL',
        5 => 'MAYO',
        6 => 'JUNIO',
        7 => 'JULIO',
        8 => 'AGOSTO',
        9 => 'SEPTIEMBRE',
        10 => 'OCTUBRE',
        11 => 'NOVIEMBRE',
        12 => 'DICIEMBRE',
    ];

    $nombreMes = $mes
        ? $meses[(int) $mes]
        : null;

    $pdf = Pdf::loadView(
        'asigTecnicos.asignaciones2',
        compact(
            'user',
            'datos',
            'anio',
            'tipo',
            'nombreMes'
        )
    );

    return $pdf->stream(
        'reporte_asignaciones_' . $anio . '.pdf'
    );
}
}