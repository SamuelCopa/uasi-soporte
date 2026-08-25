<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegistroCpu;
use Illuminate\Http\Request;

class RegistroCpuController extends Controller
{
    public function index()
    {
        $cpus = RegistroCpu::all();

        return response()->json([
            'success' => true,
            'data' => $cpus
        ]);
    }

    public function show($id)
    {
        $cpu = RegistroCpu::find($id);

        if (!$cpu) {
            return response()->json([
                'success' => false,
                'message' => 'CPU no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $cpu
        ]);
    }
}