<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;

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
}