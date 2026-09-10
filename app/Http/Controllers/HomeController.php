<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;
use Illuminate\Http\Request;
use App\Models\RegistroCpu;
use App\Models\Impresora;
use App\Models\Monitor;
use App\Models\Audifono;
use App\Models\Laptop;
use App\Models\Teclado;
use App\Models\Raton;
use App\Models\Upese;
use App\Models\Parlante;
use App\Models\Estabilizador;
use App\Models\OtrosEquipo;

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

        $datosPanel = $this->datosPanel();

        return view('home', array_merge(
            [
                'user' => $user,
                'nuevasSolicitudes' => $nuevasSolicitudes,
                'nuevasSolicitudesTecnico' => $nuevasSolicitudesTecnico,
            ],
            $datosPanel
        ));
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

private function datosPanel()
{
    $modelos = [
        [
            'nombre' => 'CPU',
            'modelo' => RegistroCpu::class,
            'icono' => 'fas fa-desktop',
            'color' => '#0052cc',
            'ruta' => 'registroCpu.index',
        ],
        [
            'nombre' => 'IMPRESORAS',
            'modelo' => Impresora::class,
            'icono' => 'fas fa-print',
            'color' => '#198754',
            'ruta' => 'impresoras.index',
        ],
        [
            'nombre' => 'MONITORES',
            'modelo' => Monitor::class,
            'icono' => 'fas fa-tv',
            'color' => '#6f42c1',
            'ruta' => 'monitores.index',
        ],
        [
            'nombre' => 'AUDÍFONOS',
            'modelo' => Audifono::class,
            'icono' => 'fas fa-headphones',
            'color' => '#fd7e14',
            'ruta' => 'audifonos.index',
        ],
        [
            'nombre' => 'LAPTOPS',
            'modelo' => Laptop::class,
            'icono' => 'fas fa-laptop',
            'color' => '#0dcaf0',
            'ruta' => 'laptops.index',
        ],
        [
            'nombre' => 'TECLADOS',
            'modelo' => Teclado::class,
            'icono' => 'fas fa-keyboard',
            'color' => '#20c997',
            'ruta' => 'teclados.index',
        ],
        [
            'nombre' => 'MOUSE',
            'modelo' => Raton::class,
            'icono' => 'fas fa-mouse',
            'color' => '#6c757d',
            'ruta' => 'ratons.index',
        ],
        [
            'nombre' => 'UPS',
            'modelo' => Upese::class,
            'icono' => 'fas fa-bolt',
            'color' => '#ffc107',
            'ruta' => 'upeses.index',
        ],
        [
            'nombre' => 'PARLANTES',
            'modelo' => Parlante::class,
            'icono' => 'fas fa-volume-up',
            'color' => '#dc3545',
            'ruta' => 'parlantes.index',
        ],
        [
            'nombre' => 'ESTABILIZADORES',
            'modelo' => Estabilizador::class,
            'icono' => 'fas fa-plug',
            'color' => '#6610f2',
            'ruta' => 'estabilizadors.index',
        ],
        [
            'nombre' => 'OTROS EQUIPOS',
            'modelo' => OtrosEquipo::class,
            'icono' => 'fas fa-microchip',
            'color' => '#495057',
            'ruta' => 'otrosEquipos.index',
        ],
    ];

    $equipos = [];
    $pendientes = [];
    $pendientesInforme = [];

    foreach ($modelos as $item) {

        $modelo = $item['modelo'];

        // ==========================================
        // TOTALES POR ESTADO
        // ==========================================

        $recepcionados = $modelo::where('estado_id', 1)
            ->whereYear('created_at', now()->year)
            ->count();

        $enProceso = $modelo::where('estado_id', 2)
            ->whereYear('created_at', now()->year)
            ->count();

        $apersonarse = $modelo::where('estado_id', 3)
            ->whereYear('created_at', now()->year)
            ->count();

        $concluidos = $modelo::where('estado_id', 4)
            ->whereYear('created_at', now()->year)
            ->count();

        $entregados = $modelo::where('estado_id', 5)
            ->whereYear('created_at', now()->year)
            ->count();

        $total = $recepcionados
            + $enProceso
            + $apersonarse
            + $concluidos
            + $entregados;


        // ==========================================
        // EQUIPOS SIN CÓDIGO
        // ==========================================

        $sinCod = $modelo::whereNull('cod_registro')
            ->whereYear('created_at', now()->year)
            ->count();


        // ==========================================
        // EQUIPOS CON CÓDIGO PERO SIN TÉCNICO
        // ==========================================

        $sinUser = $modelo::whereNotNull('cod_registro')
            ->whereNull('user_id')
            ->whereYear('created_at', now()->year)
            ->count();


        // ==========================================
        // EQUIPOS RECEPCIONADOS DURANTE 3 DÍAS
        // SIN INFORME / RESULTADO
        // ==========================================

        $informePendiente = $modelo::where('estado_id', 1)
            ->whereNull('resultado_id')
            ->whereYear('created_at', now()->year)
            ->where('created_at', '<=', now()->subDays(3))
            ->count();


        // ==========================================
        // DATOS PARA LAS TARJETAS
        // ==========================================

        $equipos[] = [
            'nombre' => $item['nombre'],
            'icono' => $item['icono'],
            'color' => $item['color'],
            'ruta' => $item['ruta'],

            'total' => $total,

            'recepcionados' => $recepcionados,
            'en_proceso' => $enProceso,
            'apersonarse' => $apersonarse,
            'concluido' => $concluidos,
            'entregados' => $entregados,

            'sin_cod' => $sinCod,
            'sin_user' => $sinUser,
            'informePendiente' => $informePendiente,
        ];


        // ==========================================
        // PENDIENTES DE ASIGNACIÓN
        // ==========================================

        if ($sinUser > 0) {
            $pendientes[] = [
                'nombre' => $item['nombre'],
                'cantidad' => $sinUser,
                'icono' => $item['icono'],
            ];
        }


        // ==========================================
        // PENDIENTES DE INFORME
        // ==========================================

        if ($informePendiente > 0) {
            $pendientesInforme[] = [
                'nombre' => $item['nombre'],
                'cantidad' => $informePendiente,
                'icono' => $item['icono'],
            ];
        }
    }

    return [
        'equipos' => $equipos,
        'pendientes' => $pendientes,
        'pendientesInforme' => $pendientesInforme,
    ];
}
}