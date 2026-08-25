<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Audifono;
use Illuminate\Http\Request;

class AudifonoController extends Controller
{
    public function index()
    {
        $audifonos = Audifono::all();

        return response()->json([
            'success' => true,
            'data' => $audifonos
        ]);
    }

    public function show($id)
    {
        $audifono = Audifono::find($id);

        if (!$audifono) {
            return response()->json([
                'success' => false,
                'message' => 'audifono no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $audifono
        ]);
    }
}