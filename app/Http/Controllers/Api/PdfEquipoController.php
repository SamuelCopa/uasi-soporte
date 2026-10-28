<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegistroCpu;
use App\Models\Impresora;
use App\Models\Monitor;
use App\Models\Estabilizador;
use App\Models\Teclado;
use App\Models\Raton;
use App\Models\Upese;
use App\Models\Parlante;
use App\Models\Audifono;
use App\Models\Laptop;
use App\Models\OtrosEquipo;
use TCPDF;

class PdfEquipoController extends Controller
{
    /**
     * Modelos y vistas correspondientes a cada tipo de equipo.
     */
    private array $equipos = [
        'cpu'           => [RegistroCpu::class, 'registro-cpu.pdf'],
        'impresora'     => [Impresora::class, 'impresora.pdf'],
        'monitor'       => [Monitor::class, 'monitor.pdf'],
        'estabilizador' => [Estabilizador::class, 'estabilizador.pdf'],
        'teclado'       => [Teclado::class, 'teclado.pdf'],
        'mouse'         => [Raton::class, 'raton.pdf'],
        'ups'           => [Upese::class, 'upese.pdf'],
        'parlante'      => [Parlante::class, 'parlante.pdf'],
        'audifono'      => [Audifono::class, 'audifono.pdf'],
        'laptop'        => [Laptop::class, 'laptop.pdf'],
        'otros-equipo'  => [OtrosEquipo::class, 'otros-equipo.pdf'],
    ];

    /**
     * Nombre de la variable que recibe cada vista Blade.
     */
    private array $variablesVista = [
        'cpu'           => 'registroCpu',
        'impresora'     => 'impresora',
        'monitor'       => 'monitor',
        'estabilizador' => 'estabilizador',
        'teclado'       => 'teclado',
        'mouse'         => 'raton',
        'ups'           => 'upese',
        'parlante'      => 'parlante',
        'audifono'      => 'audifono',
        'laptop'        => 'laptop',
        'otros-equipo'  => 'otrosEquipo',
    ];

    /**
     * Generar PDF de un equipo.
     */
    public function generarPdf(string $tipo, int $id)
    {
        // Validar tipo de equipo.
        abort_unless(isset($this->equipos[$tipo]), 404, 'Tipo de equipo no válido.');

        [$modelo, $vista] = $this->equipos[$tipo];

        // Buscar equipo y relaciones.
        $equipo = $modelo::with([
            'funcionario',
            'dependencia',
        ])->findOrFail($id);

        // Datos del funcionario.
        $funcionario = $equipo->funcionario;

        $nombreCompleto = trim(implode(' ', array_filter([
            $funcionario?->grado_academico,
            $funcionario?->nombre,
            $funcionario?->paterno,
            $funcionario?->materno,
        ], fn ($valor) => $valor !== null && $valor !== '')));

        $ci = $funcionario?->ci ?? '';
        $expedido = $funcionario?->expedido ?? '';

        $datos1 = $nombreCompleto;
        $datos2 = trim($ci . ' ' . $expedido);
        $datos3 = $funcionario?->cargo ?? 'SIN CARGO';

        $datos4 = $equipo->dependencia?->dependencias
            ?? 'SIN DEPENDENCIA';

        // Construir el contenido del código QR.
        $datosQR = $nombreCompleto;

        if ($ci !== '') {
            $datosQR .= ' - ' . $ci;
        }

        if ($expedido !== '') {
            $datosQR .= ' ' . $expedido;
        }

        if (($equipo->funcionario_activo ?? 0) == 1) {
            $datosQR .= ' - ' . $datos4;
        } else {
            $datosQR .= ' - ' . $datos3;
        }

        $datosQR .= ' - SOPORTE TECNICO-GAMEA';

        // Determinar el tamaño de página.
        $tamanoPagina = 'LETTER';

        // Crear PDF TCPDF.
        $pdf = new TCPDF(
            PDF_PAGE_ORIENTATION,
            PDF_UNIT,
            $tamanoPagina,
            true,
            'UTF-8',
            false
        );

        $pdf->SetTitle('Doc. ' . ($ci !== '' ? $ci : 'SIN CI'));
        $pdf->SetAuthor('UASI - GAMEA');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetAutoPageBreak(true, 15);
        $pdf->AddPage();

        // Obtener la variable que utilizará la vista.
        $nombreVariable = $this->variablesVista[$tipo];

        // Renderizar la vista Blade.
        $html = view($vista, [
            $nombreVariable => $equipo,
        ])->render();

        // Escribir el contenido HTML en el PDF.
        $pdf->writeHTML(
            $html,
            true,
            false,
            true,
            false,
            ''
        );

        // Estilo del código QR.
        $styleQR = [
            'border'        => false,
            'vpadding'      => 'auto',
            'hpadding'      => 'auto',
            'fgcolor'       => [0, 0, 0],
            'bgcolor'       => false,
            'module_width'  => 1,
            'module_height' => 1,
        ];

        // Obtener las dimensiones de la página.
        $anchoPagina = $pdf->getPageWidth();
        $altoPagina = $pdf->getPageHeight();

        // Tamaño y posición del QR, en milímetros.
        $anchoQR = 35;
        $altoQR = 35;
        $margenDerecho = 15;
        $margenInferior = 65;

        $posX = $anchoPagina - $anchoQR - $margenDerecho;
        $posY = $altoPagina - $altoQR - $margenInferior;



        // Pie de página.
        $pdf->SetY(-50);


        $pdf->SetFont('helvetica', '', 9);

        // Dimensiones de la página Carta.
        $anchoPagina = $pdf->getPageWidth();
        $altoPagina = $pdf->getPageHeight();

        // Posición común desde la parte inferior.
        $posY = $altoPagina - 55;

        // Configuración del QR.
        $anchoQR = 35;
        $altoQR = 35;
        $margenDerecho = 15;

        $posX = $anchoPagina - $anchoQR - $margenDerecho;

        // Dibujar QR.
        $pdf->write2DBarcode(
            $datosQR,
            'QRCODE,H',
            $posX,
            $posY,
            $anchoQR,
            $altoQR,
            $styleQR,
            'N'
        );

        // Datos centrados en el espacio disponible.
        $margenIzquierdo = 15;
        $anchoDatos = $posX - $margenIzquierdo - 10;

        $textoDatos = $datos1 . "\n"
                    . $datos2 . "\n"
                    . $datos3 . "\n"
                    . $datos4;

        // Centrar verticalmente el bloque respecto al QR.
        $altoTexto = 20;
        $posTextoY = $posY + (($altoQR - $altoTexto) / 2);

        $pdf->SetXY($margenIzquierdo, $posTextoY);

        // Centrar horizontalmente cada línea.
        $pdf->MultiCell(
            $anchoDatos,
            5,
            $textoDatos,
            0,
            'C',
            false,
            1
        );



        // Nombre del archivo generado.
        $nombreArchivo = pathinfo($vista, PATHINFO_FILENAME)
            . '-' . $id . '.pdf';

        // Obtener el PDF como contenido binario.
        $contenido = $pdf->Output($nombreArchivo, 'S');

        // Mostrar el PDF en el navegador.
        return response($contenido, 200)
            ->header('Content-Type', 'application/pdf')
            ->header(
                'Content-Disposition',
                'inline; filename="' . $nombreArchivo . '"'
            )
            ->header('Cache-Control', 'private, no-store, max-age=0');
    }
}
