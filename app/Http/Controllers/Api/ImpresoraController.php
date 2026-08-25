<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Impresora;
use Illuminate\Http\Request;

class ImpresoraController extends Controller
{
    public function index()
    {
        $impresoras = Impresora::all();

        return response()->json([
            'success' => true,
            'data' => $impresoras
        ]);
    }

    public function show($id)
    {
        $impresora = Impresora::find($id);

        if (!$impresora) {
            return response()->json([
                'success' => false,
                'message' => 'impresora no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $impresora
        ]);
    }
}