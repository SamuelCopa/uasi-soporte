<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\Dependencia;

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
        'dependence.id' => 'required|integer',
        'dependence.name' => 'required|string|max:255',

        // Cargo
        'position.id' => 'required|integer',
        'position.name' => 'required|string|max:255',

        // Solicitud de servicio
        'type' => 'required|string|max:255',
        'desc' => 'required|string',
    ]);


    /*
    |--------------------------------------------------------------------------
    | 2. Sincronizar dependencia
    |--------------------------------------------------------------------------
    |
    | El sistema externo envía:
    |
    | "dependence": {
    |     "id": 1,
    |     "name": "Despacho"
    | }
    |
    | En nuestra BD:
    |
    | id = 1
    | dependencias = Despacho
    |
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
    | 3. Buscar funcionario por CI
    |--------------------------------------------------------------------------
    |
    | identity_card del sistema externo
    | se compara con ci de nuestra BD.
    |
    */

    $funcionario = Funcionario::where(
        'ci',
        $datos['identity_card']
    )->first();


    /*
    |--------------------------------------------------------------------------
    | 4. Preparar datos del funcionario
    |--------------------------------------------------------------------------
    */

    $datosFuncionario = [

        // Apellido paterno
        'paterno' => $datos['last_name'],

        // Apellido materno
        'materno' => $datos['mother_last_name'] ?? null,

        // Primer nombre + segundo nombre
        'nombre' => trim(
            $datos['first_name'] . ' ' .
            ($datos['second_name'] ?? '')
        ),

        // Carnet de identidad
        'ci' => $datos['identity_card'],

        // Celular
        'celular' => $datos['cellphone'] ?? null,

        // Correo institucional
        'email' => $datos['work_email'] ?? null,

        // Profesión
        'grado_academico' => $datos['proffesion'] ?? null,

        // Cargo
        'cargo' => $datos['position']['name'] ?? null,

        // Dependencia
        'dependencia_id' => $dependencia->id,
    ];


    /*
    |--------------------------------------------------------------------------
    | 5. Crear o actualizar funcionario
    |--------------------------------------------------------------------------
    */

    if ($funcionario) {

        // El funcionario ya existe
        $funcionario->update($datosFuncionario);

        $accionFuncionario = 'actualizado';

    } else {

        // El funcionario no existe
        $funcionario = Funcionario::create($datosFuncionario);

        $accionFuncionario = 'creado';
    }


    /*
    |--------------------------------------------------------------------------
    | 6. Registrar solicitud de servicio
    |--------------------------------------------------------------------------
    |
    | JSON:
    |
    | "type": "Impresora",
    | "desc": "Mi impresora no quiere conectarse a la laptop"
    |
    | BD:
    |
    | equipo = Impresora
    | falla  = Mi impresora no quiere conectarse a la laptop
    |
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
    | 7. Respuesta JSON
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
}
}