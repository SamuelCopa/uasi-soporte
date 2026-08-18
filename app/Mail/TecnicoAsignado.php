<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TecnicoAsignado extends Mailable
{
    public $equipo;
    public $tecnico;

    public function __construct($equipo, $tecnico)
    {
        $this->equipo = $equipo;
        $this->tecnico = $tecnico;
    }

    public function build()
    {
        return $this->subject('Asignación de equipo')
                    ->view('emails.tecnico_asignado')
                    ->with([
                        'equipo' => $this->equipo,
                        'tecnico' => $this->tecnico
                    ]);
    }
}
