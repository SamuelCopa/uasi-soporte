<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estabilizador;
use Illuminate\Http\Request;

class EstabilizadorController extends Controller
{
    public function index()
    {
        $estabilizadors = Estabilizador::all();

        return response()->json([
            'success' => true,
            'data' => $estabilizadors
        ]);
    }

    public function show($id)
    {
        $estabilizador = Estabilizador::find($id);

        if (!$estabilizador) {
            return response()->json([
                'success' => false,
                'message' => 'Estabilizador no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $estabilizador
        ]);
    }
}