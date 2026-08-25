<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Raton;
use Illuminate\Http\Request;

class RatonController extends Controller
{
    public function index()
    {
        $mouse = Raton::all();

        return response()->json([
            'success' => true,
            'data' => $mouse
        ]);
    }

    public function show($id)
    {
        $mouse = Raton::find($id);

        if (!$mouse) {
            return response()->json([
                'success' => false,
                'message' => 'Monitor no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mouse
        ]);
    }
}