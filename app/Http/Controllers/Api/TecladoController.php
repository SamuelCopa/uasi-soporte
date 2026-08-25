<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teclado;
use Illuminate\Http\Request;

class TecladoController extends Controller
{
    public function index()
    {
        $teclados = Teclado::all();

        return response()->json([
            'success' => true,
            'data' => $teclados
        ]);
    }

    public function show($id)
    {
        $teclado = Teclado::find($id);

        if (!$teclado) {
            return response()->json([
                'success' => false,
                'message' => 'Teclado no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $teclado
        ]);
    }
}