<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Upese;
use Illuminate\Http\Request;

class UpeseController extends Controller
{
    public function index()
    {
        $ups = Upese::all();

        return response()->json([
            'success' => true,
            'data' => $ups
        ]);
    }

    public function show($id)
    {
        $ups = Upese::find($id);

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