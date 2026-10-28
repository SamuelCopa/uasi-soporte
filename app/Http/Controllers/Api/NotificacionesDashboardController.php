<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Schema;

// Modelos de equipos
use App\Models\RegistroCpu;
use App\Models\Impresora;
use App\Models\Monitor;
use App\Models\Audifono;
use App\Models\Teclado;
use App\Models\Parlante;
use App\Models\Raton;
use App\Models\Upese;
use App\Models\Estabilizador;
use App\Models\Laptop;
use App\Models\OtrosEquipo;

class NotificacionesDashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $gestion = now()->year;

        $modelos = [
            'CPU' => [
                'modelo' => RegistroCpu::class,
                'color' => '#3498db',
                'icon' => '💻',
            ],
            'Impresora' => [
                'modelo' => Impresora::class,
                'color' => '#2ecc71',
                'icon' => '🖨️',
            ],
            'Monitor' => [
                'modelo' => Monitor::class,
                'color' => '#f1c40f',
                'icon' => '🖥️',
            ],
            'Audífono' => [
                'modelo' => Audifono::class,
                'color' => '#9b59b6',
                'icon' => '🎧',
            ],
            'Teclado' => [
                'modelo' => Teclado::class,
                'color' => '#e67e22',
                'icon' => '⌨️',
            ],
            'Parlante' => [
                'modelo' => Parlante::class,
                'color' => '#1abc9c',
                'icon' => '🔊',
            ],
            'Mouse' => [
                'modelo' => Raton::class,
                'color' => '#e74c3c',
                'icon' => '🖱️',
            ],
            'UPS' => [
                'modelo' => Upese::class,
                'color' => '#34495e',
                'icon' => '🔋',
            ],
            'Estabilizador' => [
                'modelo' => Estabilizador::class,
                'color' => '#16a085',
                'icon' => '⚡',
            ],
            'Laptop' => [
                'modelo' => Laptop::class,
                'color' => '#8e44ad',
                'icon' => '💻',
            ],
            'Otros equipos' => [
                'modelo' => OtrosEquipo::class,
                'color' => '#8e44ad',
                'icon' => '🖥️',
            ],
        ];

        $totalSinCod = 0;
        $totalSinUser = 0;

        $pendientes = [];
        $pendientesInforme = [];

        foreach ($modelos as $nombre => $info) {
            $modelo = $info['modelo'];

            // Verificar que exista la tabla.
            $tabla = (new $modelo())->getTable();

            if (!Schema::hasTable($tabla)) {
                continue;
            }

            // Columnas necesarias para las consultas.
            $columnas = Schema::getColumnListing($tabla);

            // Sin código de registro.
            $sinCod = 0;

            if (
                in_array('cod_registro', $columnas, true) &&
                in_array('created_at', $columnas, true)
            ) {
                $sinCod = $modelo::whereNull('cod_registro')
                    ->whereYear('created_at', $gestion)
                    ->count();
            }

            // Sin técnico asignado, pero con código.
            $sinUser = 0;

            if (
                in_array('cod_registro', $columnas, true) &&
                in_array('user_id', $columnas, true) &&
                in_array('created_at', $columnas, true)
            ) {
                $sinUser = $modelo::whereNotNull('cod_registro')
                    ->whereNull('user_id')
                    ->whereYear('created_at', $gestion)
                    ->count();
            }

            // Guardar pendientes de asignación.
            if ($sinCod > 0 || $sinUser > 0) {
                $pendientes[] = [
                    'nombre' => $nombre,
                    'color' => $info['color'],
                    'icon' => $info['icon'],
                    'sinCod' => $sinCod,
                    'sinUser' => $sinUser,
                ];
            }

            $totalSinCod += $sinCod;
            $totalSinUser += $sinUser;

            // Informes pendientes.
            if (
                in_array('estado_id', $columnas, true) &&
                in_array('resultado_id', $columnas, true) &&
                in_array('created_at', $columnas, true)
            ) {
                $informePendiente = $modelo::where('estado_id', 1)
                    ->whereNull('resultado_id')
                    ->where('created_at', '<=', now()->subDays(3))
                    ->whereYear('created_at', $gestion)
                    ->count();

                if ($informePendiente > 0) {
                    $pendientesInforme[] = [
                        'nombre' => $nombre,
                        'color' => $info['color'],
                        'icon' => $info['icon'],
                        'cantidad' => $informePendiente,
                    ];
                }
            }
        }

        // Totales para la campana.
        $totalPendientesAsignacion = collect($pendientes)
            ->sum('sinUser');

        $totalPendientesInforme = collect($pendientesInforme)
            ->sum('cantidad');

        $totalNotificaciones =
            $totalPendientesAsignacion +
            $totalPendientesInforme;

        return response()->json([
            'success' => true,

            'gestion' => $gestion,

            'totales' => [
                'sin_codigo' => $totalSinCod,
                'sin_tecnico' => $totalSinUser,
                'pendientes_asignacion' => $totalPendientesAsignacion,
                'informes_pendientes' => $totalPendientesInforme,
                'notificaciones' => $totalNotificaciones,
            ],

            'pendientes_asignacion' => $pendientes,

            'informes_pendientes' => $pendientesInforme,
        ]);
    }
}