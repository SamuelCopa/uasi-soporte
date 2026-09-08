<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertaMantenimiento extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $estadoId;
    public $equipo;
    public $nombreEquipo;

    public function __construct($estadoId, $equipo = null)
    {
        $this->estadoId = $estadoId;
        $this->equipo = $equipo;

        // Detectar automáticamente el tipo de equipo
        $this->nombreEquipo = match (class_basename($equipo)) {

            'RegistroCpu'   => 'CPU',
            'Impresora'     => 'IMPRESORA',
            'Monitor'       => 'MONITOR',
            'Audifono'      => 'AUDÍFONO',
            'Laptop'        => 'LAPTOP',
            'Teclado'       => 'TECLADO',
            'Parlante'      => 'PARLANTE',
            'Raton'         => 'MOUSE',
            'Upese'         => 'UPS',
            'Estabilizador' => 'ESTABILIZADOR',

            // Otros equipos
            'OtrosEquipo'   => $equipo->tipoEquipo?->nombre ?? 'OTRO EQUIPO',

            default         => 'EQUIPO',
        };
    }

    public function build()
    {
        return $this->subject($this->getAsunto())
                    ->view('emails.alerta')
                    ->with([
                        'estadoId'     => $this->estadoId,
                        'equipo'       => $this->equipo,
                        'nombreEquipo' => $this->nombreEquipo,
                    ]);
    }

    // =========================
    // ASUNTO
    // =========================

    private function getAsunto()
    {
        return match ($this->estadoId) {

            2 => 'Equipo en mantenimiento',

            3 => 'Revisión requerida',

            4 => 'Equipo listo para recoger',

            default => 'Actualización de estado del equipo',
        };
    }
}

