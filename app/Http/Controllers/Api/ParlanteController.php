<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parlante;
use Illuminate\Http\Request;

class ParlanteController extends Controller
{
    public function index()
    {
        $mouse = Parlante::all();

        return response()->json([
            'success' => true,
            'data' => $mouse
        ]);
    }

    public function show($id)
    {
        $mouse = Parlante::find($id);

        if (!$mouse) {
            return response()->json([
                'success' => false,
                'message' => 'Parlante no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $mouse
        ]);
    }
}