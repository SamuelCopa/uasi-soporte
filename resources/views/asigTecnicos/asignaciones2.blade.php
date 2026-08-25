<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>Reporte de Asignaciones</title>

    <link rel="stylesheet"
          href="{{ public_path('estilos/asignaciones.css') }}">

</head>

<body>

    <!-- ENCABEZADO -->

    <div class="header">
    <table width="100%">
        <tr>
            <td width="20%" align="center">
                <img src="{{ public_path('img1/elalto.jpg') }}"
                     width="65">
            </td>

            <td width="60%" align="center">
                <div class="titulo">
                    <h2>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</h2>
                </div>

                <div class="subtitulo">
                    <h2>INFORME DE ASIGNACIONES DE EQUIPOS</h2>
                </div>

                <div class="subtitulo">
                    @if($tipo === 'mes' && $nombreMes)
                        PERIODO: {{ $nombreMes }} {{ $anio }}
                    @else
                        GESTIÓN {{ $anio }}
                    @endif
                </div>
            </td>

            <td width="20%">
            </td>
        </tr>
    </table>
    </div>



    <!-- DATOS DEL REPORTE -->

    <table class="datos">

        <tr>

            <td>
                <strong>Técnico:</strong>

                {{ $user->name }}
                {{ $user->paterno }}
                {{ $user->materno }}
            </td>

            <td>

                <strong>Período:</strong>
                @if($tipo === 'mes')
                    {{ $nombreMes }} {{ $anio }}
                @else
                    AÑO {{ $anio }}
                @endif
            </td>
        </tr>
        <tr>
            <td>
                <strong>Fecha de reporte:</strong>
                {{ date('d/m/Y') }}
            </td>
            <td>
                <strong>Hora:</strong>
                {{ date('H:i') }}
            </td>
        </tr>
    </table>
<!-- TABLA RESUMEN DE EQUIPOS -->

@php
    $totalRecepcionado = 0;
    $totalEnProceso = 0;
    $totalApersonarse = 0;
    $totalConcluido = 0;
    $totalEntregado = 0;
    $totalGeneral = 0;
@endphp

<table class="tabla">
    <thead>
        <tr>
            <th>Tipo de equipo</th>
            <th>Recepcionado</th>
            <th>En proceso</th>
            <th>Apersonarse</th>
            <th>Concluido</th>
            <th>Entregado</th>
            <th>Total</th>
        </tr>
    </thead>

    <tbody>

        @foreach($datos as $item)

            @php
                $recepcionado = 0;
                $enProceso = 0;
                $apersonarse = 0;
                $concluido = 0;
                $entregado = 0;

                foreach ($item['estados'] as $estado) {

                    $nombreEstado = strtoupper(trim($estado['estado']));
                    $cantidad = $estado['cantidad'];

                    switch ($nombreEstado) {

                        case 'RECEPCIONADO':
                            $recepcionado = $cantidad;
                            break;

                        case 'EN PROCESO':
                            $enProceso = $cantidad;
                            break;
                        case 'APERSONARSE':
                            $apersonarse = $cantidad;
                            break;

                        case 'CONCLUIDO':
                            $concluido = $cantidad;
                            break;

                        case 'ENTREGADO':
                            $entregado = $cantidad;
                            break;
                    }
                }

                // Total por tipo de equipo
                $totalEquipo =
                    $recepcionado +
                    $enProceso +
                    $apersonarse +
                    $concluido +
                    $entregado;

                // Acumulados generales
                $totalRecepcionado += $recepcionado;
                $totalEnProceso += $enProceso;
                $totalApersonarse += $apersonarse;
                $totalConcluido += $concluido;
                $totalEntregado += $entregado;
                $totalGeneral += $totalEquipo;
            @endphp

            <tr>

                <!-- Tipo de equipo -->
                <td>
                    <strong>{{ $item['titulo'] }}</strong>
                </td>

                <!-- Recepcionado -->
                <td class="cantidad">
                    {{ $recepcionado }}
                </td>

                <!-- En proceso -->
                <td class="cantidad">
                    {{ $enProceso }}
                </td>

                <!-- En proceso -->
                <td class="cantidad">
                    {{ $apersonarse }}
                </td>

                <!-- Concluido -->
                <td class="cantidad">
                    {{ $concluido }}
                </td>

                <!-- Entregado -->
                <td class="cantidad">
                    {{ $entregado }}
                </td>

                <!-- Total por fila -->
                <td class="cantidad">
                    <strong>{{ $totalEquipo }}</strong>
                </td>

            </tr>

        @endforeach

        <!-- TOTAL GENERAL -->

        <tr class="fila-total">
            <td><strong>TOTAL GENERAL</strong></td>
            <td class="cantidad">
                <strong>{{ $totalRecepcionado }}</strong>
            </td>
            <td class="cantidad">
                <strong>{{ $totalEnProceso }}</strong>
            </td>
            <td class="cantidad">
                <strong>{{ $totalApersonarse }}</strong>
            </td>
            <td class="cantidad">
                <strong>{{ $totalConcluido }}</strong>
            </td>
            <td class="cantidad">
                <strong>{{ $totalEntregado }}</strong>
            </td>
            <td class="cantidad">
                <strong>{{ $totalGeneral }}</strong>
            </td>
        </tr>
    </tbody>
</table>

    <!-- PIE DEL REPORTE -->

    <style>
    .header table {
        width: 100%;
        border: none;
        border-collapse: collapse;
    }

    .header table tr,
    .header table td {
        border: none !important;
    }

    .header td {
        padding: 0;
    }
        body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 11px;
    color: #222;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h1 {
    font-size: 17px;
    margin: 0;
}

.header h2 {
    font-size: 13px;
    margin: 5px 0;
}

.datos {
    width: 100%;
    margin-bottom: 20px;
}

.datos td {
    padding: 5px;
}

    .titulo {
        font-size: 14px;
        font-weight: bold;
    }

    .subtitulo {
        font-size: 11px;
        font-weight: bold;
        margin-top: 3px;
    }

.tabla {
    width: 100%;
    border-collapse: collapse;
}

.tabla th,
.tabla td {
    border: 1px solid #000;
    padding: 6px;
}

.tabla th {
    background-color: #eeeeee;
    text-align: center;
}

.cantidad {
    text-align: center;
}

.fila-total {
    background-color: #eeeeee;
}

.footer {
    text-align: center;
    font-size: 9px;
    margin-top: 30px;
    padding-top: 8px;
    border-top: 1px solid #999;
}
    </style>
</body>

</html>