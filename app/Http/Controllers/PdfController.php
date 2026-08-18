<?php

namespace App\Http\Controllers;

use App\Models\Audifono;
use App\Services\AudifonoPdfService;
use App\Mail\AudifonoPdfMail;
use Illuminate\Support\Facades\Mail;

class PdfController extends Controller
{
    protected $pdfService;

    public function __construct(AudifonoPdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    // PREVIEW
    public function preview($id)
    {
        $audifono = Audifono::findOrFail($id);
        $pdf = $this->pdfService->generarPdf($audifono);

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="audifono.pdf"');
    }

    // DESCARGA
    public function descargar($id)
    {
        $audifono = Audifono::findOrFail($id);
        $pdf = $this->pdfService->generarPdf($audifono);

        return response($pdf)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="audifono.pdf"');
    }

    // ENVÍO
    public function enviar($id)
    {
        $audifono = Audifono::findOrFail($id);
        $pdf = $this->pdfService->generarPdf($audifono);

        Mail::to($audifono->funcionario->email)
            ->send(new AudifonoPdfMail($pdf));

        return back()->with('success', 'PDF enviado correctamente');
    }
}