<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\RegistroCpu;
use App\Models\Impresora;
use App\Models\Monitor;
use App\Models\Estabilizador;
use App\Models\Teclado;
use App\Models\Raton;
use App\Models\Upese;
use App\Models\Parlante;
use App\Models\Audifono;
use App\Models\Laptop;
use App\Models\OtrosEquipo;

class AsignacionTecnicoController extends Controller
{
    /**
     * Modelos correspondientes a cada tipo de equipo.
     */
    private array $modelos = [
        'cpu'           => RegistroCpu::class,
        'impresora'     => Impresora::class,
        'monitor'       => Monitor::class,
        'estabilizador' => Estabilizador::class,
        'teclado'       => Teclado::class,
        'mouse'         => Raton::class,
        'ups'           => Upese::class,
        'parlante'      => Parlante::class,
        'audifono'      => Audifono::class,
        'laptop'        => Laptop::class,
        'otros-equipo'  => OtrosEquipo::class,
    ];

    /**
     * Asignar un técnico a un equipo.
     *
     * Campos:
     * user_id
     * fecha_asignacion
     */
    public function asignar(Request $request, string $tipo, int $id)
    {
        // 1. Validar el tipo de equipo.
        if (!isset($this->modelos[$tipo])) {
            return response()->json([
                'success' => false,
                'message' => 'El tipo de equipo no es válido.',
            ], 404);
        }

        // 2. Validar los datos recibidos.
        $validator = Validator::make($request->all(), [
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id'),
            ],
            'fecha_asignacion' => [
                'nullable',
                'date',
            ],
        ], [
            'user_id.required' => 'Debe seleccionar un técnico.',
            'user_id.integer' => 'El identificador del técnico no es válido.',
            'user_id.exists' => 'El técnico seleccionado no existe.',
            'fecha_asignacion.date' => 'La fecha de asignación no es válida.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Los datos enviados no son válidos.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // 3. Obtener el modelo correspondiente.
        $modelo = $this->modelos[$tipo];

        // 4. Buscar el equipo y actualizar la asignación.
        $equipo = $modelo::find($id);

        if (!$equipo) {
            return response()->json([
                'success' => false,
                'message' => 'No se encontró el equipo solicitado.',
            ], 404);
        }

        // 5. Registrar técnico y fecha.
        $fechaAsignacion = $request->filled('fecha_asignacion')
            ? $request->input('fecha_asignacion')
            : now();

        DB::transaction(function () use (
            $equipo,
            $request,
            $fechaAsignacion
        ) {
            $equipo->user_id = $request->input('user_id');
            $equipo->fecha_asignacion = $fechaAsignacion;
            $equipo->save();
        });

        // 6. Responder en formato JSON.
        return response()->json([
            'success' => true,
            'message' => 'Técnico asignado correctamente.',
            'data' => [
                'tipo' => $tipo,
                'equipo_id' => $equipo->id,
                'user_id' => $equipo->user_id,
                'fecha_asignacion' => $equipo->fecha_asignacion,
            ],
        ], 200);
    }
}
