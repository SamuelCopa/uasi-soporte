<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dependencia;
use Illuminate\Http\Request;

class DependenciaController extends Controller
{
    public function index()
    {
        $ups = Dependencia::all();

        return response()->json([
            'success' => true,
            'data' => $ups
        ]);
    }

    public function show($id)
    {
        $ups = Dependencia::find($id);

        if (!$ups) {
            return response()->json([
                'success' => false,
                'message' => 'Monitor no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ups
        ]);
    }
}