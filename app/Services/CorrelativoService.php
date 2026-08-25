<?php

namespace App\Services;

use App\Models\Correlativo;

class CorrelativoService
{
    public function generarNumeroRecepcion()
    {
        $anio = now()->year;

        $correlativo = Correlativo::where('anio', $anio)
            ->lockForUpdate()
            ->first();

        if (!$correlativo) {
            $correlativo = Correlativo::create([
                'anio' => $anio,
                'ultimo_numero' => 0,
            ]);
        }

        $correlativo->increment('ultimo_numero');

        return str_pad(
            $correlativo->ultimo_numero,
            3,
            '0',
            STR_PAD_LEFT
        ) . '/' . $anio;
    }
}