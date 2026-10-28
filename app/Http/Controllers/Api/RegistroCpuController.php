<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use App\Models\RegistroCpu;
use App\Services\CorrelativoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class RegistroCpuController extends Controller
{
public function store(Request $request,CorrelativoService $correlativoService) {
        // =====================================================
        // 1. ADAPTAR EL JSON ANIDADO A LOS CAMPOS DEL CONTROLADOR
        // =====================================================

        $solicitante = $request->input('solicitante', []);
        $equipo      = $request->input('equipo', []);
        $asignacion  = $request->input('asignacion_tecnica', []);

        $case       = data_get($equipo, 'case', []);
        $disco      = data_get($equipo, 'disco', []);
        $fuente     = data_get($equipo, 'fuente', []);
        $lector     = data_get($equipo, 'lector', []);
        $memoria    = data_get($equipo, 'memoria.modulos', []);
        $procesador = data_get($equipo, 'procesador', []);
        $madre      = data_get($equipo, 'tarjetaMadre', []);
        $red        = data_get($equipo, 'tarjetaRed', []);
        $video      = data_get($equipo, 'tarjetaVideo', []);
        $wifi       = data_get($equipo, 'tarjetaWifi', []);

        // Campos generales y del funcionario.
        $normalizados = [
            'ci'                  => data_get($solicitante, 'ci'),
            'celular'             => data_get($solicitante, 'celular'),
            'email'               => data_get($solicitante, 'email'),
            'cargo'               => data_get($solicitante, 'cargo'),
            'dependencia_id'      => data_get($solicitante, 'dependencia_id'),
            'funcionario_id'      => data_get($solicitante, 'id_funcionario'),

            'cod_gamea'           => $request->input('codigo_gamea'),
            'fecha'               => $request->input('fecha_registro')
                ? substr($request->input('fecha_registro'), 0, 10)
                : now()->toDateString(),

            'fecha_inicio'        => data_get($asignacion, 'fechaInicio'),
            'user_id'             => data_get($asignacion, 'idTecnico'),

            'usuario'             => $request->input('usuario_equipo'),
            'contrasena'          => $request->input('password_equipo'),

            'falla'               => data_get($equipo, 'falla'),
            'respaldo'            => data_get($equipo, 'respaldo', 'NO'),
            'observaciones'       => data_get($equipo, 'observaciones'),

            'funcionario_activo'  => data_get($solicitante, 'es_ex_funcionario') === true
                ? 0
                : 1,

            'estado_id'           => 1,
        ];

        // CASE.
        $normalizados['marcacase_id'] = data_get($case, 'marcacase_id');
        $normalizados['colorcase_id'] = data_get($case, 'colorcase_id');

        // DISCO.
        $normalizados['capacdisco_id'] = data_get($disco, 'capacdisco_id');
        $normalizados['marcadisco_id'] = data_get($disco, 'marcadisco_id');
        $normalizados['moddisco_id']   = data_get($disco, 'moddisco_id');
        $normalizados['tipodisco_id']  = data_get($disco, 'tipodisco_id');

        // FUENTE.
        $normalizados['cable_id']       = data_get($fuente, 'cable_id');
        $normalizados['marcafuente_id'] = data_get($fuente, 'marcafuente_id');
        $normalizados['potfuente_id']   = data_get($fuente, 'potfuente_id');

        // LECTOR.
        $normalizados['marcacd_id'] = data_get($lector, 'marcacd_id');

        // PROCESADOR.
        $normalizados['genprocesador_id']     = data_get($procesador, 'genprocesador_id');
        $normalizados['marcaprocesador_id']   = data_get($procesador, 'marcaprocesador_id');
        $normalizados['modeloprocesador_id'] = data_get($procesador, 'modeloprocesador_id');

        // TARJETA MADRE.
        $normalizados['marcatmadre_id'] = data_get($madre, 'marcatmadre_id');
        $normalizados['modtmadre_id']   = data_get($madre, 'modtmadre_id');

        // TARJETA DE RED.
        $normalizados['marcatred_id'] = data_get($red, 'marcatred_id');
        $normalizados['modtred_id']   = data_get($red, 'modtred_id');

        // TARJETA DE VIDEO.
        $normalizados['capactvideo_id'] = data_get($video, 'capactvideo_id');
        $normalizados['marcatvideo_id'] = data_get($video, 'marcatvideo_id');
        $normalizados['tipotvideo_id']  = data_get($video, 'tipotvideo_id');

        // WIFI.
        $normalizados['marcawifi_id'] = data_get($wifi, 'marcawifi_id');
        $normalizados['modcawifi_id'] = data_get($wifi, 'modcawifi_id');
        $normalizados['antena_id']    = data_get($wifi, 'antena_id');

        // CUATRO MÓDULOS DE RAM.
        // Cada módulo se convierte a los nombres de columnas existentes.
        for ($i = 0; $i < 4; $i++) {
            $modulo = $memoria[$i] ?? [];

            $sufijo = $i === 0 ? '' : (string) ($i + 1);

            foreach ([
                'capacram_id',
                'disipador_id',
                'marcaram_id',
                'tiporam_id',
                'cantidad_id',
            ] as $campo) {
                $campoDestino = $i === 0
                    ? $campo
                    : str_replace('_id', $sufijo . '_id', $campo);

                $normalizados[$campoDestino] = data_get($modulo, $campo);
            }
        }

        // Permitir que el código original siga utilizando input('campo').
        $request->merge($normalizados);

    // =====================================================
    // 5. VALIDAR LOS DATOS
    // =====================================================
    $datos = $request->validate([
        'funcionario_id' => 'required|integer|exists:funcionarios,id',
        'ci' => 'required|string|max:30',
        'celular' => 'required|string|max:30',

        'email' => 'nullable|email|max:255',

        'cod_gamea' => 'required|integer',
        'falla' => 'required|string',
        'respaldo' => 'nullable|string',

        'fecha' => 'required|date_format:Y-m-d',
        'fecha_inicio' => 'nullable|date_format:Y-m-d',
        'observaciones' => 'nullable|string',
        'funcionario_activo' => 'sometimes|boolean',

        'grado_academico' => 'nullable|string|max:255',
        'paterno' => 'nullable|string|max:255',
        'materno' => 'nullable|string|max:255',
        'nombre' => 'nullable|string|max:255',
        'expedido' => 'nullable|string|max:20',
        'cargo' => 'nullable|string|max:255',
        'dependencia_id' => 'nullable|integer',

        'usuario' => 'nullable|string|max:255',
        'contrasena' => 'nullable|string|max:255',
        'otro' => 'nullable|string',
        'condiciones' => 'nullable|integer|in:0,1',
        'estado_id' => 'sometimes|integer',

        'user_id' => 'required|integer|exists:users,id',

        // Componentes y claves foráneas
        'marcacase_id' => 'nullable|integer',
        'colorcase_id' => 'nullable|integer',

        'marcaprocesador_id' => 'nullable|integer',
        'modeloprocesador_id' => 'nullable|integer',
        'genprocesador_id' => 'nullable|integer',

        'marcatmadre_id' => 'nullable|integer',
        'modtmadre_id' => 'nullable|integer',

        'marcadisco_id' => 'nullable|integer',
        'moddisco_id' => 'nullable|integer',
        'capacdisco_id' => 'nullable|integer',
        'tipodisco_id' => 'nullable|integer',
        'disipador_id' => 'nullable|integer',

        'marcaram_id' => 'nullable|integer',
        'tiporam_id' => 'nullable|integer',
        'capacram_id' => 'nullable|integer',
        'cantidad_id' => 'nullable|integer',

        'marcaram2_id' => 'nullable|integer',
        'disipador2_id' => 'nullable|integer',
        'capacram2_id' => 'nullable|integer',
        'tiporam2_id' => 'nullable|integer',
        'cantidad2_id' => 'nullable|integer',

        'marcaram3_id' => 'nullable|integer',
        'disipador3_id' => 'nullable|integer',
        'capacram3_id' => 'nullable|integer',
        'tiporam3_id' => 'nullable|integer',
        'cantidad3_id' => 'nullable|integer',

        'marcaram4_id' => 'nullable|integer',
        'disipador4_id' => 'nullable|integer',
        'capacram4_id' => 'nullable|integer',
        'tiporam4_id' => 'nullable|integer',
        'cantidad4_id' => 'nullable|integer',

        'marcatvideo_id' => 'nullable|integer',
        'capactvideo_id' => 'nullable|integer',
        'tipotvideo_id' => 'nullable|integer',

        'marcatred_id' => 'nullable|integer',
        'modtred_id' => 'nullable|integer',

        'marcawifi_id' => 'nullable|integer',
        'modcawifi_id' => 'nullable|integer',

        'marcafuente_id' => 'nullable|integer',
        'potfuente_id' => 'nullable|integer',
        'marcacd_id' => 'nullable|integer',

        'cable_id' => 'nullable|integer',
        'antena_id' => 'nullable|integer',
    ]);

    // =====================================================
    // 6. VERIFICAR QUE ID Y CI SEAN DEL MISMO FUNCIONARIO
    // =====================================================
    $funcionario = Funcionario::find($datos['funcionario_id']);

    if (
        !$funcionario ||
        (string) $funcionario->ci !== (string) $datos['ci']
    ) {
        return response()->json([
            'success' => false,
            'message' => 'El CI no corresponde al funcionario seleccionado.',
            'errors' => [
                'solicitante.ci' => [
                    'Verifica el ID y el CI del funcionario.'
                ]
            ]
        ], 422);
    }

    // =====================================================
    // 7. REGISTRAR EL CPU EN UNA TRANSACCIÓN
    // =====================================================
    try {
        $cpu = DB::transaction(function () use (
            $datos,
            $correlativoService,
            $funcionario
        ) {
            // El funcionario ya existe y su ID/CI fueron comprobados.
            $funcionario->celular = $datos['celular'];

            if (!empty($datos['cargo'])) {
                $funcionario->cargo = $datos['cargo'];
            }

            if (!empty($datos['dependencia_id'])) {
                $funcionario->dependencia_id = $datos['dependencia_id'];
            }

            if (!empty($datos['email'])) {
                $funcionario->email = $datos['email'];
            }

            $funcionario->save();

            $cpu = new RegistroCpu();

            $cpu->funcionario_id = $funcionario->id;
            $cpu->dependencia_id = $datos['dependencia_id'] ?? null;
            $cpu->cargo = $datos['cargo'] ?? null;

            $cpu->fecha = $datos['fecha'];
            $cpu->fecha_inicio = $datos['fecha_inicio'] ?? null;

            $cpu->cod_gamea = $datos['cod_gamea'];
            $cpu->cod_registro =
                $correlativoService->generarNumeroRecepcion();

            $cpu->usuario = $datos['usuario'] ?? null;
            $cpu->contrasena = $datos['contrasena'] ?? null;

            $componentes = [
                'marcacase_id',
                'colorcase_id',
                'marcaprocesador_id',
                'modeloprocesador_id',
                'genprocesador_id',
                'marcatmadre_id',
                'modtmadre_id',
                'marcadisco_id',
                'moddisco_id',
                'capacdisco_id',
                'tipodisco_id',
                'disipador_id',

                'marcaram_id',
                'tiporam_id',
                'capacram_id',
                'cantidad_id',

                'marcaram2_id',
                'disipador2_id',
                'capacram2_id',
                'tiporam2_id',
                'cantidad2_id',

                'marcaram3_id',
                'disipador3_id',
                'capacram3_id',
                'tiporam3_id',
                'cantidad3_id',

                'marcaram4_id',
                'disipador4_id',
                'capacram4_id',
                'tiporam4_id',
                'cantidad4_id',

                'marcatvideo_id',
                'capactvideo_id',
                'tipotvideo_id',
                'marcatred_id',
                'modtred_id',
                'marcawifi_id',
                'modcawifi_id',
                'marcafuente_id',
                'potfuente_id',
                'marcacd_id',
                'cable_id',
                'antena_id',
            ];

            foreach ($componentes as $campo) {
                $cpu->{$campo} = $datos[$campo] ?? null;
            }

            $cpu->falla = $datos['falla'];

            // Ajusta este valor si tu sistema usa otra convención.
            $cpu->respaldo = $datos['respaldo'] ?? 'NO';

            $cpu->observaciones = $datos['observaciones'] ?? null;
            $cpu->funcionario_activo =
                $datos['funcionario_activo'] ?? 1;

            $cpu->otro = $datos['otro'] ?? null;
            $cpu->condiciones = $datos['condiciones'] ?? 0;
            $cpu->estado_id = $datos['estado_id'] ?? 1;

            // Técnico responsable del mantenimiento
            $cpu->user_id = $datos['user_id'];

            // El modelo asigna reguser_id en su evento creating.
            $cpu->save();

            return $cpu;
        });

return response()->json([
    'success' => true,
    'mensaje' => 'CPU registrada correctamente',
    'data' => [
        'id' => $cpu->id,
        'cod_gamea' => $cpu->cod_gamea,
        'cod_registro' => $cpu->cod_registro,
        'user_id' => $cpu->user_id,
        'fecha_inicio' => $cpu->fecha_inicio,
    ],
], 201);

    } catch (\Throwable $e) {
        report($e);

        return response()->json([
            'success' => false,
            'message' => 'No se pudo registrar el CPU.',
        ], 500);
    }
}

public function update(Request $request, $id)
{
    $registroCpu = RegistroCpu::find($id);

    if (!$registroCpu) {
        return response()->json([
            'success' => false,
            'message' => 'El registro de CPU no existe.',
        ], 404);
    }

    // Validar solamente los campos enviados.
    $datos = $request->validate([
        // Datos del funcionario
        'ci' => 'sometimes|required|string|max:20',
        'grado_academico' => 'sometimes|nullable|string|max:100',
        'paterno' => 'sometimes|nullable|string|max:100',
        'materno' => 'sometimes|nullable|string|max:100',
        'nombre' => 'sometimes|nullable|string|max:150',
        'expedido' => 'sometimes|nullable|string|max:10',
        'celular' => 'sometimes|nullable|string|max:20',
        'email' => 'sometimes|nullable|email|max:150',
        'cargo' => 'sometimes|nullable|string|max:150',
        'dependencia_id' => 'sometimes|nullable|integer',

        // Datos generales de la CPU
        'fecha' => 'sometimes|nullable|date',
        'cod_gamea' => 'sometimes|nullable|string|max:100',
        'cod_registro' => 'sometimes|nullable|string|max:100',
        'usuario' => 'sometimes|nullable|string|max:100',
        'contrasena' => 'sometimes|nullable|string|max:255',
        'fecha_asignacion' => 'sometimes|nullable|date',
        'fecha_inicio' => 'sometimes|nullable|date',
        'falla' => 'sometimes|nullable|string',
        'respaldo' => 'sometimes|required|string',
        'observaciones' => 'sometimes|nullable|string',
        'funcionario_activo' => 'sometimes|nullable|boolean',
        'otro' => 'sometimes|nullable|string',
        'estado_id' => 'sometimes|nullable|integer',
        'user_id' => 'sometimes|nullable|integer',
        'condiciones' => 'sometimes|boolean',

        // Componentes de la CPU
        'marcacase_id' => 'sometimes|nullable|integer',
        'colorcase_id' => 'sometimes|nullable|integer',
        'marcaprocesador_id' => 'sometimes|nullable|integer',
        'modeloprocesador_id' => 'sometimes|nullable|integer',
        'genprocesador_id' => 'sometimes|nullable|integer',
        'marcatmadre_id' => 'sometimes|nullable|integer',
        'modtmadre_id' => 'sometimes|nullable|integer',
        'marcadisco_id' => 'sometimes|nullable|integer',
        'capacdisco_id' => 'sometimes|nullable|integer',
        'tipodisco_id' => 'sometimes|nullable|integer',
        'marcadisco2_id' => 'sometimes|nullable|integer',
        'capacdisco2_id' => 'sometimes|nullable|integer',
        'tipodisco2_id' => 'sometimes|nullable|integer',
        'disipador_id' => 'sometimes|nullable|integer',
        'marcaram_id' => 'sometimes|nullable|integer',
        'tiporam_id' => 'sometimes|nullable|integer',
        'capacram_id' => 'sometimes|nullable|integer',
        'cantidad_id' => 'sometimes|nullable|integer',
        'marcatvideo_id' => 'sometimes|nullable|integer',
        'capactvideo_id' => 'sometimes|nullable|integer',
        'tipotvideo_id' => 'sometimes|nullable|integer',
        'marcatred_id' => 'sometimes|nullable|integer',
        'modtred_id' => 'sometimes|nullable|integer',
        'marcawifi_id' => 'sometimes|nullable|integer',
        'modcawifi_id' => 'sometimes|nullable|integer',
        'marcafuente_id' => 'sometimes|nullable|integer',
        'potfuente_id' => 'sometimes|nullable|integer',
        'marcacd_id' => 'sometimes|nullable|integer',
        'marcaram2_id' => 'sometimes|nullable|integer',
        'disipador2_id' => 'sometimes|nullable|integer',
        'capacram2_id' => 'sometimes|nullable|integer',
        'tiporam2_id' => 'sometimes|nullable|integer',
        'cantidad2_id' => 'sometimes|nullable|integer',
        'marcaram3_id' => 'sometimes|nullable|integer',
        'disipador3_id' => 'sometimes|nullable|integer',
        'capacram3_id' => 'sometimes|nullable|integer',
        'tiporam3_id' => 'sometimes|nullable|integer',
        'cantidad3_id' => 'sometimes|nullable|integer',
        'marcaram4_id' => 'sometimes|nullable|integer',
        'disipador4_id' => 'sometimes|nullable|integer',
        'capacram4_id' => 'sometimes|nullable|integer',
        'tiporam4_id' => 'sometimes|nullable|integer',
        'cantidad4_id' => 'sometimes|nullable|integer',
        'cable_id' => 'sometimes|nullable|integer',
        'antena_id' => 'sometimes|nullable|integer',
    ]);

    try {
        \Illuminate\Support\Facades\DB::transaction(function () use (
            $datos,
            $registroCpu
        ) {
            // Actualizar o vincular al funcionario cuando se envíen sus datos.
            $camposFuncionario = [
                'ci',
                'grado_academico',
                'paterno',
                'materno',
                'nombre',
                'expedido',
                'celular',
                'email',
                'cargo',
                'dependencia_id',
            ];

            $actualizaFuncionario = count(
                array_intersect(array_keys($datos), $camposFuncionario)
            ) > 0;

            if ($actualizaFuncionario) {
                $funcionarioActual = Funcionario::find(
                    $registroCpu->funcionario_id
                );

                if (!$funcionarioActual) {
                    throw new \RuntimeException(
                        'No se encontró el funcionario asociado a la CPU.'
                    );
                }

                if (empty($datos['cargo'] ?? $funcionarioActual->cargo)) {
                    $datos['cargo'] = 'EX FUNCIONARIO';
                }

                // Si se envía una CI diferente, reutilizar el funcionario
                // que ya tenga esa CI, si existe.
                if (isset($datos['ci'])) {
                    $funcionarioExistente = Funcionario::where(
                        'ci',
                        $datos['ci']
                    )->first();

                    if (
                        $funcionarioExistente &&
                        $funcionarioExistente->id !== $funcionarioActual->id
                    ) {
                        $registroCpu->funcionario_id =
                            $funcionarioExistente->id;
                    } else {
                        $funcionarioActual->fill(
                            array_intersect_key(
                                $datos,
                                array_flip($camposFuncionario)
                            )
                        );

                        $funcionarioActual->save();
                    }
                } else {
                    $funcionarioActual->fill(
                        array_intersect_key(
                            $datos,
                            array_flip($camposFuncionario)
                        )
                    );

                    $funcionarioActual->save();
                }
            }

            // Actualizar los campos de la CPU que fueron enviados.
            $camposCpu = [
                'dependencia_id',
                'fecha',
                'cod_gamea',
                'cod_registro',
                'usuario',
                'contrasena',
                'fecha_asignacion',
                'fecha_inicio',
                'falla',
                'respaldo',
                'observaciones',
                'funcionario_activo',
                'otro',
                'estado_id',
                'user_id',
                'condiciones',
                'marcacase_id',
                'colorcase_id',
                'marcaprocesador_id',
                'modeloprocesador_id',
                'genprocesador_id',
                'marcatmadre_id',
                'modtmadre_id',
                'marcadisco_id',
                'capacdisco_id',
                'tipodisco_id',
                'marcadisco2_id',
                'capacdisco2_id',
                'tipodisco2_id',
                'disipador_id',
                'marcaram_id',
                'tiporam_id',
                'capacram_id',
                'cantidad_id',
                'marcatvideo_id',
                'capactvideo_id',
                'tipotvideo_id',
                'marcatred_id',
                'modtred_id',
                'marcawifi_id',
                'modcawifi_id',
                'marcafuente_id',
                'potfuente_id',
                'marcacd_id',
                'marcaram2_id',
                'disipador2_id',
                'capacram2_id',
                'tiporam2_id',
                'cantidad2_id',
                'marcaram3_id',
                'disipador3_id',
                'capacram3_id',
                'tiporam3_id',
                'cantidad3_id',
                'marcaram4_id',
                'disipador4_id',
                'capacram4_id',
                'tiporam4_id',
                'cantidad4_id',
                'cable_id',
                'antena_id',
            ];

            foreach ($camposCpu as $campo) {
                if (array_key_exists($campo, $datos)) {
                    $registroCpu->{$campo} = $datos[$campo];
                }
            }

            // Mantener sincronizados los datos de dependencia y cargo
            // de la CPU cuando se envíen explícitamente.
            if (array_key_exists('dependencia_id', $datos)) {
                $registroCpu->dependencia_id = $datos['dependencia_id'];
            }

            if (array_key_exists('cargo', $datos)) {
                $registroCpu->cargo = $datos['cargo'];
            }

            $registroCpu->save();
        });

        return response()->json([
            'success' => true,
            'message' => 'CPU actualizada correctamente.',
            'data' => RegistroCpu::find($id),
        ], 200);

    } catch (\RuntimeException $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 422);

    } catch (\Throwable $e) {
        report($e);

        return response()->json([
            'success' => false,
            'message' => 'Ocurrió un error al actualizar la CPU.',
        ], 500);
    }
}

}
