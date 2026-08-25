<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        $monitors = Monitor::all();

        return response()->json([
            'success' => true,
            'data' => $monitors
        ]);
    }

    public function show($id)
    {
        $Monitor = Monitor::find($id);

        if (!$monitor) {
            return response()->json([
                'success' => false,
                'message' => 'Monitor no encontrada'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $monitor
        ]);
    }
}