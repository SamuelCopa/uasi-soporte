<?php

namespace App\Services;

use TCPDF;

class EquipoPdfService
{
    public function generar(array $data, string $view)
    {
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'LETTER', true, 'UTF-8', false);

        $pdf->SetTitle('Documento');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        // Vista dinámica
        $html = view($view, $data)->render();
        $pdf->writeHTML($html);

        // QR dinámico
        if (!empty($data['qr'])) {
            $this->generarQr($pdf, $data['qr']);
        }

        // Footer dinámico
        if (!empty($data['footer'])) {
            $this->generarFooter($pdf, $data['footer']);
        }

        return $pdf->Output('documento.pdf', 'S');
    }

    private function generarQr($pdf, $texto)
    {
        $style = [
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => [0,0,0],
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        ];

        $pdf->write2DBarcode($texto, 'QRCODE,H', 165, 210, 45, 45, $style, 'N');
    }

    private function generarFooter($pdf, $lineas)
    {
        $pdf->SetY(-70);

        foreach ($lineas as $linea) {
            $pdf->Cell(0, 5, $linea, 0, 1, 'C');
        }
    }
}