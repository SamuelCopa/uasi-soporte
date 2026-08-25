<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <style>

        @page {
            margin: 30px 25px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
        }

        .tecnico {
            background: #0052cc;
            color: white;
            padding: 7px;
            font-size: 11px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th {
            background: #e9ecef;
            border: 1px solid #333;

            text-align: center;
        }

        td {
            border: 1px solid #333;

        }

        .cantidad {
            text-align: center;
        }

        .fila-total {
            background: #e9ecef;
            font-weight: bold;
        }


    .encabezado table {
        width: 100%;
        border: none;
        border-collapse: collapse;
    }

    .encabezado table tr,
    .encabezado table td {
        border: none !important;
    }

    .encabezado td {
        padding: 0;
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


    .logo {
        margin-bottom: 5px;
    }

    .logo img {
        width: 70px;
        height: auto;
    }

</style>

    </style>

</head>

<body>
    <div class="pagina">
        <!-- ENCABEZADO -->
<div class="encabezado">

    <table width="100%">
        <tr>
            <td width="20%" align="center">
                <img src="{{ public_path('img1/elalto.jpg') }}"
                     width="65">
            </td>

            <td width="60%" align="center">
                <div class="titulo">
                    GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
                </div>

                <div class="subtitulo">
                    INFORME DE ASIGNACIONES DE EQUIPOS
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
@foreach($datosTecnicos as $index => $tecnico)


        <!-- TÉCNICO -->
        <div class="tecnico">
            TÉCNICO:
            {{ $tecnico['user']->paterno }}
            {{ $tecnico['user']->materno }}
            {{ $tecnico['user']->name }}
        </div>

        <!-- TABLA -->
        @php
            $totalRecepcionado = 0;
            $totalEnProceso = 0;
            $totalApersonarse = 0;
            $totalConcluido = 0;
            $totalEntregado = 0;
            $totalGeneral = 0;
        @endphp
        <table>
            <thead>
                <tr>
                    <th>Tipo de equipo</th>
                    <th> Recepcionado </th>
                    <th>En proceso</th>
                    <th>Apersonarse</th>
                    <th>Concluido</th>
                    <th> Entregado</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
            @foreach($tecnico['datos'] as $item)
                @php
                    $recepcionado = 0;
                    $enProceso = 0;
                    $apersonarse = 0;
                    $concluido = 0;
                    $entregado = 0;
                    foreach ($item['estados'] as $estado) {
                        $nombreEstado =
                            strtoupper(trim($estado['estado']));
                        $cantidad =
                            $estado['cantidad'];
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
                    $totalEquipo =
                        $recepcionado +
                        $enProceso +
                        $apersonarse +
                        $concluido +
                        $entregado;
                    $totalRecepcionado +=
                        $recepcionado;
                    $totalEnProceso +=
                        $enProceso;
                    $totalApersonarse +=
                        $apersonarse;
                    $totalConcluido +=
                        $concluido;
                    $totalEntregado +=
                        $entregado;
                    $totalGeneral +=
                        $totalEquipo;
                @endphp
                <tr>
                    <td>
                        <strong> {{ $item['titulo'] }} </strong>
                    </td>
                    <td class="cantidad">
                        {{ $recepcionado }}
                    </td>
                    <td class="cantidad">
                        {{ $enProceso }}
                    </td>
                    <td class="cantidad">
                        {{ $apersonarse }}
                    </td>
                    <td class="cantidad">
                        {{ $concluido }}
                    </td>
                    <td class="cantidad">
                        {{ $entregado }}
                    </td>
                    <td class="cantidad">
                        <strong>
                            {{ $totalEquipo }}
                        </strong>
                    </td>
                </tr>

            @endforeach

            <!-- TOTAL DEL TÉCNICO -->

            <tr class="fila-total">
                <td>
                    TOTAL DEL TÉCNICO
                </td>
                <td class="cantidad">
                    {{ $totalRecepcionado }}
                </td>
                <td class="cantidad">
                    {{ $totalEnProceso }}
                </td>
                <td class="cantidad">
                    {{ $totalApersonarse }}
                </td>
                <td class="cantidad">
                    {{ $totalConcluido }}
                </td>
                <td class="cantidad">
                    {{ $totalEntregado }}
                </td>
                <td class="cantidad">
                    {{ $totalGeneral }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endforeach
</body>
</html>