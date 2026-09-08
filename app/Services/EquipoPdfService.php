<?php

namespace App\Services;

use TCPDF;

class EquipoPdfService
{
    public function generar(array $data, string $view)
    {
        $pdf = new TCPDF(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            'LETTER',
            true,
            'UTF-8',
            false
        );

        $pdf->SetTitle('Documento');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();

        // ==========================
        // CONTENIDO DEL PDF
        // ==========================
        $html = view($view, $data)->render();

        $pdf->writeHTML($html);

        // ==========================
        // QR
        // ==========================
        if (!empty($data['qr'])) {
            $this->generarQr($pdf, $data['qr']);
        }

        // ==========================
        // FOOTER
        // ==========================
        if (!empty($data['footer'])) {
            $this->generarFooter($pdf, $data['footer']);
        }

        // ==========================
        // DEVOLVER PDF
        // ==========================
        return $pdf->Output('documento.pdf', 'S');
    }

    private function generarQr($pdf, $texto)
    {
        $style = [
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => [0, 0, 0],
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        ];

        $pdf->write2DBarcode(
            $texto,
            'QRCODE,H',165, 210, 45, 45, $style,'N'
        );
    }

private function generarFooter($pdf, $lineas)
{
    $pdf->SetFont('helvetica', '', 9);

    $pdf->SetY(-50);

    // $datos1
    if (!empty($lineas[0])) {
        $pdf->Cell(0, 4, $lineas[0], 0, 1, 'C');
    }

    // $datos2
    if (!empty($lineas[1])) {
        $pdf->Cell(0, 4, $lineas[1], 0, 1, 'C');
    }

    // $datos3
    if (!empty($lineas[2])) {
        $pdf->Cell(0, 4, $lineas[2], 0, 1, 'C');
    }

    // $datos4
    if (!empty($lineas[3])) {
        $pdf->MultiCell(0, 4, $lineas[3], 0, 'C', false);
    }
}
}