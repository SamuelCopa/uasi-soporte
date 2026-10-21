<?php

namespace App\Services;

use App\Models\Correlativo;
use Illuminate\Support\Facades\DB;

class CorrelativoService
{
    public function generarNumeroRecepcion(): string
    {
        $anio = (int) now()->year;

        // Debe ejecutarse dentro de una transacción.
        $correlativo = Correlativo::query()
            ->where('anio', $anio)
            ->lockForUpdate()
            ->first();

        if (!$correlativo) {
            $correlativo = Correlativo::create([
                'anio' => $anio,
                'ultimo_numero' => 0,
            ]);

            // Bloquear la fila recién creada.
            $correlativo = Correlativo::query()
                ->whereKey($correlativo->getKey())
                ->lockForUpdate()
                ->firstOrFail();
        }

        $correlativo->increment('ultimo_numero');

        return str_pad(
            (string) $correlativo->ultimo_numero,
            3,
            '0',
            STR_PAD_LEFT
        ) . '/' . $anio;
    }
}
