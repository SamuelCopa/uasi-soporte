<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Audifono;
use Illuminate\Http\Request;

class AudifonoController extends Controller
{
    public function index()
    {
    $gestionPasada = date('Y') - 1;

    // Últimos 30 días de la gestión pasada
    $fechaFinPasada = Carbon::create($gestionPasada, 12, 31); // 31 dic gestión pasada
    $fechaInicioPasada = $fechaFinPasada->copy()->subDays(29); // últimos 30 días exactos

    // Consulta: últimos 30 días gestión pasada OR registros de la gestión actual
    $audifonos = Audifono::where(function ($query) use ($fechaInicioPasada, $fechaFinPasada) {
            $query->whereBetween('fecha', [$fechaInicioPasada, $fechaFinPasada])
            ->where('estado_id', '!=', 5);
        })
        ->orWhereYear('fecha', date('Y'))
        ->orderByDesc('fecha')
        ->paginate();

    $estado = Estado::all();
    $resultado = Resultado::all();
    $dependencia = Dependencia::orderBy('dependencias', 'asc')->get();

    $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'Tecnico');
        })
        ->where('id_estadousuario', '1')
        ->orderBy('paterno', 'asc')
        ->get();

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