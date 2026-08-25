<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laptop;
use Illuminate\Http\Request;

class laptopController extends Controller
{
    public function index()
    {
        $laptops = Laptop::all();

        return response()->json([
            'success' => true,
            'data' => $laptops
        ]);
    }

    public function show($id)
    {
        $laptop = Laptop::find($id);

        if (!$laptop) {
            return response()->json([
                'success' => false,
                'message' => 'Laptop no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $laptop
        ]);
    }
}