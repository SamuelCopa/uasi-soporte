<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Services\NotificacionService;

// Modelos de equipos
use App\Models\RegistroCpu;
use App\Models\Upese;
use App\Models\Impresora;
use App\Models\Monitor;
use App\Models\Teclado;
use App\Models\Raton;
use App\Models\Laptop;
use App\Models\Audifono;
use App\Models\Parlante;
use App\Models\Estabilizador;
use App\Models\OtrosEquipo;

class EstadoEquipoController extends Controller
{
    protected NotificacionService $notificacionService;

    public function __construct(NotificacionService $notificacionService)
    {
        $this->notificacionService = $notificacionService;
    }

    /**
     * Cambiar estado de cualquier equipo.
     *
     * POST /api/equipos/{tipo}/{id}/cambiar-estado
     */
    public function cambiarEstado(
        Request $request,
        string $tipo,
        int $id
    ) {
        // 1. VALIDAR EL NUEVO ESTADO
        $datos = $request->validate([
            'estado_id' => 'required|integer|in:2,3,4,5',
        ]);

        $tipo = strtolower($tipo);
        $estadoId = (int) $datos['estado_id'];

        // 2. MAPEAR MODELOS PERMITIDOS
        $modelos = [
            'cpu'           => RegistroCpu::class,
            'ups'           => Upese::class,
            'impresora'     => Impresora::class,
            'monitor'       => Monitor::class,
            'teclado'       => Teclado::class,
            'raton'         => Raton::class,
            'laptop'        => Laptop::class,
            'audifono'      => Audifono::class,
            'parlante'      => Parlante::class,
            'estabilizador' => Estabilizador::class,
            'otros'         => OtrosEquipo::class,
        ];

        // 3. VALIDAR TIPO DE EQUIPO
        if (!isset($modelos[$tipo])) {
            return response()->json([
                'success' => false,
                'message' => 'El tipo de equipo no es válido.',
            ], 422);
        }

        $modelo = $modelos[$tipo];

        // 4. BUSCAR EQUIPO
        $equipo = $modelo::find($id);

        if (!$equipo) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el equipo solicitado.',
            ], 404);
        }

        // 5. VERIFICAR COLUMNAS
        $tabla = $equipo->getTable();

        if (!Schema::hasColumn($tabla, 'estado_id')) {
            return response()->json([
                'success' => false,
                'message' => 'El modelo no tiene el campo estado_id.',
            ], 422);
        }

        // 6. VALIDAR ENTREGA
        if ($estadoId === 5) {
            $tieneResultado = false;

            if (method_exists($equipo, 'resultado')) {
                $tieneResultado = $equipo->resultado()->exists();
            }

            if (!$tieneResultado) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede entregar el equipo: falta registrar el resultado del trabajo.',
                ], 422);
            }
        }

        // 7. ACTUALIZAR ESTADO Y FECHAS
        $fechas = [
            2 => 'fecha_inicio',
            5 => 'fecha_entrega',
        ];

        $equipo->estado_id = $estadoId;

        if (isset($fechas[$estadoId])) {
            $campoFecha = $fechas[$estadoId];

            if (
                Schema::hasColumn($tabla, $campoFecha)
                && empty($equipo->$campoFecha)
            ) {
                $equipo->$campoFecha = now();
            }
        }

        $equipo->save();

        // 8. ENVIAR NOTIFICACIONES
        if (in_array($estadoId, [3, 4], true)) {
            if (method_exists($equipo, 'funcionario')) {
                $funcionario = $equipo->funcionario;

                if ($funcionario) {
                    $this->notificacionService->enviar(
                        $funcionario,
                        $estadoId,
                        $equipo
                    );
                }
            }
        }

        // 9. RESPUESTA JSON
        $mensajes = [
            2 => 'El equipo pasó a EN PROCESO.',
            3 => 'El estado cambió a APERSONARSE CON EL TÉCNICO.',
            4 => 'El equipo fue marcado como CONCLUIDO.',
            5 => 'El equipo fue marcado como ENTREGADO.',
        ];

        return response()->json([
            'success' => true,
            'message' => $mensajes[$estadoId],
            'equipo' => $tipo,
            'id' => $equipo->getKey(),
            'estado_id' => $equipo->estado_id,
        ]);
    }
}