<?php


namespace App\Mail;

use Illuminate\Mail\Mailable;

class AudifonoPdfMail extends Mailable
{
    public $pdf;

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    public function build()
    {
        return $this->subject('Documento Audífono')
            ->view('emails.audifono')
            ->attachData($this->pdf, 'audifono.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}