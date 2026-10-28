<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ConsultaEquiposController;
use App\Http\Controllers\Api\RegistroEquiposController;
use App\Http\Controllers\Controller;
use App\Models\Funcionario;
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
use App\Services\CorrelativoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegistroEquiposController extends Controller
{
public function store(
    Request $request,
    CorrelativoService $correlativoService,
    string $tipo
) {
    // Modelos disponibles para registrar equipos
    $modelos = [
        'impresora'     => Impresora::class,
        'monitor'       => Monitor::class,
        'estabilizador' => Estabilizador::class,
        'teclado'       => Teclado::class,
        'mouse'         => Raton::class,
        'ups'           => Upese::class,
        'parlante'      => Parlante::class,
        'audifono'      => Audifono::class,
        'laptop'        => Laptop::class,
        'otro'          => OtrosEquipo::class,
    ];

    // Verificar el tipo de equipo
    if (!isset($modelos[$tipo])) {
        return response()->json([
            'success' => false,
            'message' => 'Tipo de equipo no válido.',
            'tipos_disponibles' => array_keys($modelos),
        ], 400);
    }

    // Validar los datos recibidos
    $datos = $request->validate([
        // Datos del funcionario
        'ci'                 => 'required|string|max:30',
        'celular'            => 'required|string|max:30',
        'email'              => 'required|email|max:255',
        'grado_academico'    => 'nullable|string|max:255',
        'paterno'             => 'nullable|string|max:255',
        'materno'             => 'nullable|string|max:255',
        'nombre'              => 'nullable|string|max:255',
        'expedido'            => 'nullable|string|max:20',
        'cargo'               => 'nullable|string|max:255',
        'dependencia_id'      => 'nullable|integer',

        // Datos generales del equipo
        'cod_gamea'           => 'required|integer',
        'marca'               => 'required|string|max:255',
        'modelo'              => 'required|string|max:255',
        'falla'               => 'required|string',
        'fecha'               => 'nullable|date_format:Y-m-d',
        'observaciones'       => 'nullable|string',
        'funcionario_activo'  => 'sometimes|boolean',
        'estado_id'           => 'sometimes|integer',

        // Campo específico del monitor
        'tamano'              => 'nullable|string|max:100',

        // Campos específicos de la laptop
        'usuario'             => 'nullable|string|max:255',
        'contrasena'          => 'nullable|string|max:255',
    ]);

    // Registrar funcionario y equipo dentro de una transacción
    $equipo = DB::transaction(function () use (
        $datos,
        $modelos,
        $tipo,
        $correlativoService
    ) {
        // Buscar al funcionario por su CI o crear uno nuevo
        $funcionario = Funcionario::firstOrNew([
            'ci' => $datos['ci'],
        ]);

        // Actualizar sus datos de contacto
        $funcionario->celular = $datos['celular'];
        $funcionario->email = $datos['email'];

        // Actualizar únicamente los datos opcionales recibidos
        foreach ([
            'grado_academico',
            'paterno',
            'materno',
            'nombre',
            'expedido',
            'cargo',
            'dependencia_id',
        ] as $campo) {
            if (array_key_exists($campo, $datos)) {
                $funcionario->{$campo} = $datos[$campo];
            }
        }

        $funcionario->save();

        // Crear el equipo correspondiente al tipo solicitado
        $claseModelo = $modelos[$tipo];
        $equipo = new $claseModelo();

        // Relacionar el equipo con el funcionario
        $equipo->funcionario_id = $funcionario->id;
        $equipo->cargo = $datos['cargo'] ?? null;
        $equipo->dependencia_id = $datos['dependencia_id'] ?? null;

        // Datos generales del equipo
        $equipo->cod_gamea = $datos['cod_gamea'];
        $equipo->cod_registro =
            $correlativoService->generarNumeroRecepcion();

        $equipo->fecha = $datos['fecha'] ?? now();
        $equipo->marca = $datos['marca'];
        $equipo->modelo = $datos['modelo'];
        $equipo->falla = $datos['falla'];

        $equipo->observaciones =
            $datos['observaciones'] ?? null;

        $equipo->funcionario_activo =
            $datos['funcionario_activo'] ?? 1;

        // Estado 1 = Recepcionado, por defecto
        $equipo->estado_id = $datos['estado_id'] ?? 1;

        // Usuario autenticado que realiza el registro
        $equipo->reguser_id = Auth::id();

        // Campos particulares según el tipo de equipo
        switch ($tipo) {
            case 'monitor':
                $equipo->tamano = $datos['tamano'] ?? null;
                break;

            case 'laptop':
                $equipo->usuario = $datos['usuario'] ?? null;

                // Guardar la contraseña solo si se recibió
                if (!empty($datos['contrasena'])) {
                    $equipo->contrasena = $datos['contrasena'];
                }
                break;
        }

        // Guardar el equipo en la base de datos
        $equipo->save();

        return $equipo;
    });

    // Respuesta de la API
    return response()->json([
        'success' => true,
        'message' => 'Equipo registrado correctamente.',
        'tipo' => $tipo,
        'cod_registro' => $equipo->cod_registro,
        'data' => $equipo->fresh(),
    ], 201);
}
// ==============================================================================================



public function update(Request $request, string $tipo, int $id)
{\Log::info('ACTUALIZAR EQUIPO API', [
    'tipo' => $tipo,
    'id' => $id,
    'metodo' => $request->method(),
    'datos' => $request->all(),
]);
    // Modelos permitidos para actualizar.
    $modelos = [
            'impresora'     => Impresora::class,
            'monitor'       => Monitor::class,
            'estabilizador' => Estabilizador::class,
            'teclado'       => Teclado::class,
            'mouse'         => Raton::class,
            'ups'           => Upese::class,
            'parlante'      => Parlante::class,
            'audifono'      => Audifono::class,
            'laptop'        => Laptop::class,
            'otro'          => OtrosEquipo::class,
    ];

    if (!isset($modelos[$tipo])) {
        return response()->json([
            'success' => false,
            'mensaje' => 'Tipo de equipo no válido.'
        ], 422);
    }

    $modelo = $modelos[$tipo];

    // Validar los datos recibidos.
    $reglas = [
        'ci' => ['sometimes', 'required', 'string', 'max:30'],
        'grado_academico' => ['sometimes', 'nullable', 'string'],
        'paterno' => ['sometimes', 'nullable', 'string'],
        'materno' => ['sometimes', 'nullable', 'string'],
        'nombre' => ['sometimes', 'nullable', 'string'],
        'expedido' => ['sometimes', 'nullable', 'string'],
        'celular' => ['sometimes', 'nullable', 'string'],
        'cargo' => ['sometimes', 'nullable', 'string'],
        'email' => ['sometimes', 'nullable', 'email'],
        'dependencia_id' => ['sometimes', 'nullable', 'integer'],
        'cod_gamea' => ['sometimes', 'nullable', 'string'],
        'cod_registro' => ['sometimes', 'nullable', 'string'],
        'marca' => ['sometimes', 'nullable', 'string'],
        'fecha' => ['sometimes', 'nullable', 'date'],
        'fecha_asignacion' => ['sometimes', 'nullable', 'date'],
        'fecha_inicio' => ['sometimes', 'nullable', 'date'],
        'modelo' => ['sometimes', 'nullable', 'string'],
        'falla' => ['sometimes', 'nullable', 'string'],
        'observaciones' => ['sometimes', 'nullable', 'string'],
        'funcionario_activo' => ['sometimes', 'nullable'],
        'estado_id' => ['sometimes', 'integer'],
        'user_id' => ['sometimes', 'nullable', 'integer'],

        // Campos particulares.
        'tamano' => ['sometimes', 'nullable', 'string'],
        'usuario' => ['sometimes', 'nullable', 'string'],
        'contrasena' => ['sometimes', 'nullable', 'string'],
    ];

    $validator = Validator::make($request->all(), $reglas);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'mensaje' => 'Los datos enviados no son válidos.',
            'errores' => $validator->errors()
        ], 422);
    }

    try {
        $equipo = DB::transaction(function () use (
            $request, $modelo, $tipo, $id
        ) {
            $equipo = $modelo::whereKey($id)
                ->lockForUpdate()
                ->first();

            if (!$equipo) {
                abort(404, 'Equipo no encontrado.');
            }

            // Actualizar funcionario solo si se enviaron
            // datos del funcionario.
            $camposFuncionario = [
                'ci',
                'grado_academico',
                'paterno',
                'materno',
                'nombre',
                'expedido',
                'celular',
                'cargo',
                'email',
                'dependencia_id',
            ];

            $actualizaFuncionario = collect($camposFuncionario)
                ->contains(fn ($campo) => $request->exists($campo));

            if ($actualizaFuncionario) {
                $funcionario = Funcionario::find(
                    $equipo->funcionario_id
                );

                if (!$funcionario) {
                    abort(422, 'El funcionario asociado no existe.');
                }

                if ($request->exists('ci')) {
                    $funcionarioExistente = Funcionario::where(
                        'ci', $request->input('ci')
                    )->first();

                    if (
                        $funcionarioExistente &&
                        $funcionarioExistente->id != $funcionario->id
                    ) {
                        // Reutilizar funcionario existente.
                        $equipo->funcionario_id =
                            $funcionarioExistente->id;
                    } else {
                        $datosFuncionario = $request->only(
                            $camposFuncionario
                        );

                        if (empty($datosFuncionario['cargo'] ??
                            $funcionario->cargo)) {
                            $datosFuncionario['cargo'] =
                                'EX FUNCIONARIO';
                        }

                        $funcionario->fill($datosFuncionario);
                        $funcionario->save();
                    }
                } else {
                    $datosFuncionario = $request->only(
                        $camposFuncionario
                    );

                    if (empty($datosFuncionario['cargo'] ??
                        $funcionario->cargo)) {
                        $datosFuncionario['cargo'] =
                            'EX FUNCIONARIO';
                    }

                    $funcionario->fill($datosFuncionario);
                    $funcionario->save();
                }

                if ($request->exists('dependencia_id')) {
                    $equipo->dependencia_id =
                        $request->input('dependencia_id');
                }

                if ($request->exists('cargo')) {
                    $equipo->cargo = $request->input('cargo');
                }
            }

            // Campos comunes del equipo.
            $camposEquipo = [
                'cod_gamea',
                'cod_registro',
                'marca',
                'fecha',
                'fecha_asignacion',
                'fecha_inicio',
                'modelo',
                'falla',
                'observaciones',
                'funcionario_activo',
                'estado_id',
                'user_id',
            ];

            // Campos específicos.
            if ($tipo === 'monitor') {
                $camposEquipo[] = 'tamano';
            }

            if ($tipo === 'laptop') {
                $camposEquipo[] = 'usuario';
                $camposEquipo[] = 'contrasena';
            }

            // Actualizar solamente los campos enviados.
            $equipo->fill($request->only($camposEquipo));
            $equipo->save();

            return $equipo->fresh();
        });

        return response()->json([
            'success' => true,
            'mensaje' => 'Equipo actualizado correctamente.',
            'datos' => $equipo
        ], 200);

    } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
        return response()->json([
            'success' => false,
            'mensaje' => $e->getMessage()
        ], $e->getStatusCode());
    } catch (\Throwable $e) {
        \Log::error('Error al actualizar equipo por API', [
            'tipo' => $tipo,
            'id' => $id,
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'success' => false,
            'mensaje' => 'No se pudo actualizar el equipo.'
        ], 500);
    }
}

}
