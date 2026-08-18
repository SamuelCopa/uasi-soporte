<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class AlertaMantenimiento extends Mailable
{
    public $estadoId;
    public $equipo;

    public function __construct($estadoId, $equipo = null)
    {
        $this->estadoId = $estadoId;
        $this->equipo = $equipo;
    }

    public function build()
    {
        return $this->subject($this->getAsunto())
                    ->view('emails.alerta')
                    ->with([
                        'estadoId' => $this->estadoId,
                        'equipo' => $this->equipo
                    ]);
    }

    // =========================
    // ASUNTO

    private function getAsunto()
    {
        return match($this->estadoId) {
            2 => 'Equipo en mantenimiento',
            3 => 'Revisión requerida',
            4 => 'Equipo listo para recoger',
            default => 'Actualización de estado del equipo',
        };
    }
}