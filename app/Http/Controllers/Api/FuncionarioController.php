<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Dependencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Casts\Attribute;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();

        return response()->json([
            'success' => true,
            'data' => $funcionarios
        ]);
    }

    public function show($id)
    {
        $funcionario = Funcionario::find($id);

        if (!$funcionario) {
            return response()->json([
                'success' => false,
                'message' => 'Funcionario no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $funcionario
        ]);
    }

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Validar datos recibidos
        |--------------------------------------------------------------------------
        */

        try {

            $datos = $request->validate([
                // Datos del funcionario
                'first_name' => 'required|string|max:255',
                'second_name' => 'nullable|string|max:255',
                'last_name' => 'required|string|max:255',
                'mother_last_name' => 'nullable|string|max:255',
                'surname_husband' => 'nullable|string|max:255',
                'identity_card' => 'required|string|max:20',

                // Datos adicionales
                'cellphone' => 'nullable|string|max:20',
                'work_email' => 'nullable|email|max:255',
                'proffesion' => 'nullable|string|max:255',

                // Dependencia
                'dependence' => 'required|array',
                'dependence.id' => 'required|integer',
                'dependence.name' => 'required|string|max:255',

                // Cargo
                'position' => 'required|array',
                'position.id' => 'required|integer',
                'position.name' => 'required|string|max:255',

                // Solicitud de servicio
                'type' => 'required|string|max:255',
                'desc' => 'required|string',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {

            /*
            |--------------------------------------------------------------------------
            | Datos incompletos o incorrectos
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => false,
                'message' => 'Los datos enviados están incompletos o contienen errores.',
                'errors' => $e->errors(),
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | 2. Procesar información dentro de una transacción
        |--------------------------------------------------------------------------
        */

        try {

            DB::beginTransaction();
            /*
            |--------------------------------------------------------------------------
            | 3. Sincronizar dependencia
            |--------------------------------------------------------------------------
            */

            $dependencia = Dependencia::updateOrCreate(
                [
                    'id' => $datos['dependence']['id']
                ],
                [
                    'dependencias' => $datos['dependence']['name']
                ]
            );
            /*
            |--------------------------------------------------------------------------
            | 4. Buscar funcionario por CI
            |--------------------------------------------------------------------------
            */

            $funcionario = Funcionario::where(
                'ci',
                $datos['identity_card']
            )->first();

            /*
            |--------------------------------------------------------------------------
            | 5. Preparar datos del funcionario
            |--------------------------------------------------------------------------
            */

            $datosFuncionario = [
                'paterno' => $datos['last_name'],
                'materno' => $datos['mother_last_name'] ?? null,
                'ap_casada' => $datos['surname_husband']?? null,
                'nombre' => trim(
                    $datos['first_name'] . ' ' .
                    ($datos['second_name'] ?? '')
                ),
                'ci' => $datos['identity_card'],
                'celular' => $datos['cellphone'] ?? null,
                'email' => $datos['work_email'] ?? null,
                'grado_academico' => $datos['proffesion'] ?? null,
                'cargo' => $datos['position']['name'] ?? null,
                'dependencia_id' => $dependencia->id,
            ];
            /*
            |--------------------------------------------------------------------------
            | 6. Crear o actualizar funcionario
            |--------------------------------------------------------------------------
            */

            if ($funcionario) {
                $funcionario->update($datosFuncionario);
                $accionFuncionario = 'actualizado';
            } else {
                $funcionario = Funcionario::create($datosFuncionario);
                $accionFuncionario = 'creado';
            }
            /*
            |--------------------------------------------------------------------------
            | 7. Registrar solicitud de servicio
            |--------------------------------------------------------------------------
            */
            $servicio = Servicio::create([
                'equipo' => $datos['type'],
                'falla' => $datos['desc'],
                'visto' => false,
                'dependencia_id' => $dependencia->id,
                'funcionario_id' => $funcionario->id,
            ]);
            /*
            |--------------------------------------------------------------------------
            | 8. Confirmar transacción
            |--------------------------------------------------------------------------
            */
            DB::commit();
            /*
            |--------------------------------------------------------------------------
            | 9. Respuesta exitosa
            |--------------------------------------------------------------------------
            */
            return response()->json([
                'success' => true,
                'message' => 'Funcionario y solicitud registrados correctamente',
                'funcionario_accion' => $accionFuncionario,
                'dependencia' => $dependencia,
                'funcionario' => $funcionario,
                'servicio' => $servicio,
            ], 201);
        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | 10. Revertir cambios si ocurre un error
            |--------------------------------------------------------------------------
            */
            DB::rollBack();
            /*
            |--------------------------------------------------------------------------
            | 11. Registrar error en Laravel
            |--------------------------------------------------------------------------
            */
            \Log::error('Error al registrar funcionario y solicitud mediante API', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
            /*
            |--------------------------------------------------------------------------
            | 12. Respuesta al sistema externo
            |--------------------------------------------------------------------------
            */
            return response()->json([
                'success' => false,
                'message' => 'No fue posible registrar la información. El sistema presentó un error interno.',
            ], 500);
        }
    }
}