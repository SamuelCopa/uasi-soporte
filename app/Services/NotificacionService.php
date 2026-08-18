<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaMantenimiento;

class NotificacionService
{
    /**
     * Enviar notificaciones por correo
     */
    public function enviar($destinatario, $estadoId, $equipo = null)
    {
        if (!$destinatario) {
            \Log::error("Destinatario no definido");
            return;
        }

        $correo = $destinatario->email ?? null;

        // =========================
        // CORREO
        // =========================
        if (!empty($correo)) {
            try {
                Mail::to($correo)
                    ->send(new AlertaMantenimiento($estadoId, $equipo));
            } catch (\Exception $e) {
                \Log::error("Error correo: " . $e->getMessage());
            }
        }
    }
}