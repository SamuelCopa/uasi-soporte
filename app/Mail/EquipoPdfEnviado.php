<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EquipoPdfEnviado extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $rutaPdf;

    public function __construct($rutaPdf)
    {
        $this->rutaPdf = $rutaPdf;
    }

    public function build()
    {
        return $this->subject(
            'Remisión del formulario de recepción correspondiente'
        )
        ->view('emails.equipo')
        ->attach($this->rutaPdf, [
            'as' => 'documento.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}