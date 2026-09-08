<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TecnicoAsignado extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $equipo;
    public $tecnico;
    public $nombreEquipo;

    public function __construct($equipo, $tecnico)
    {
        $this->equipo = $equipo;
        $this->tecnico = $tecnico;

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

            // Para OtrosEquipo obtener el nombre desde su relación
            'OtrosEquipo'   => $equipo->tipoEquipo?->nombre ?? 'OTRO EQUIPO',

            // Si aparece un modelo nuevo
            default         => 'EQUIPO',
        };
    }

    public function build()
    {
        return $this->subject('Asignación de equipo')
                    ->view('emails.tecnico_asignado')
                    ->with([
                        'equipo'       => $this->equipo,
                        'tecnico'      => $this->tecnico,
                        'nombreEquipo' => $this->nombreEquipo,
                    ]);
    }
}