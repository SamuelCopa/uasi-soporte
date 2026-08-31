<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Detalle por Activos
    </title>

    <style>
        @page {
            margin: 25px 30px 35px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #222;
            margin: 0;
            padding: 0;
        }


        /* ======================================================
           ENCABEZADO
        ====================================================== */

        .encabezado {
            text-align: center;
            margin-bottom: 12px;
        }

        .institucion {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .unidad {
            font-size: 10px;
            margin-top: 3px;
            text-transform: uppercase;
        }

        .titulo {
            font-size: 15px;
            font-weight: bold;
            margin-top: 10px;
            text-transform: uppercase;
        }

        .subtitulo {
            font-size: 9px;
            margin-top: 5px;
        }


        /* ======================================================
           LINEA DECORATIVA
        ====================================================== */

        .linea {
            border-top: 2px solid #0052cc;
            margin-top: 8px;
            margin-bottom: 12px;
        }


        /* ======================================================
           FILTROS
        ====================================================== */

        .filtros {
            margin-bottom: 12px;
            border: 1px solid #999;
            padding: 7px;
        }

        .filtros table {
            width: 100%;
            border-collapse: collapse;
        }

        .filtros td {
            padding: 3px 5px;
            vertical-align: middle;
        }

        .filtro-label {
            width: 10%;
            font-weight: bold;
        }

        .filtro-valor {
            width: 40%;
        }


        /* ======================================================
           TABLA PRINCIPAL
        ====================================================== */

        .reporte {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .reporte thead {
            display: table-header-group;
        }

        .reporte tfoot {
            display: table-row-group;
        }

        .reporte th {
            background-color: #0052cc;
            color: white;
            border: 1px solid #333;
            padding: 6px 4px;
            text-align: center;
            font-size: 9px;
            font-weight: bold;
        }

        .reporte td {
            border: 1px solid #777;
            padding: 5px 4px;
            text-align: center;
        }

        .reporte tbody tr {
            page-break-inside: avoid;
        }

        .reporte tbody tr:nth-child(even) {
            background-color: #f4f6f8;
        }

        .equipo {
            text-align: left !important;
            font-weight: bold;
            padding-left: 8px !important;
        }

        .total {
            font-weight: bold;
        }

        .total-general {
            background-color: #d9e8ff;
            font-weight: bold;
        }

        .total-general td {
            padding: 6px 4px;
        }


        /* ======================================================
           MENSAJE SIN RESULTADOS
        ====================================================== */

        .sin-resultados {
            text-align: center;
            padding: 12px !important;
            font-style: italic;
        }


        /* ======================================================
           PIE DE PÁGINA
        ====================================================== */

        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 7px;
            color: #666;
        }
    </style>

</head>


<body>


    {{-- ==========================================================
     ENCABEZADO INSTITUCIONAL
========================================================== --}}

    <div class="encabezado">

        <div class="institucion">
            GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
        </div>

        <div class="unidad">
            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
        </div>

        <div class="titulo">
            DETALLE POR ACTIVOS
        </div>

        <div class="subtitulo">

            <strong>Gestión:</strong>
            {{ $year }}

            &nbsp;&nbsp;|&nbsp;&nbsp;

            <strong>Mes:</strong>

            @if($month && $nombreMes)

            {{ $nombreMes }}

            @else

            Todos los meses

            @endif

        </div>

    </div>


    <div class="linea"></div>


    {{-- ==========================================================
     FILTROS UTILIZADOS
========================================================== --}}

    <div class="filtros">

        <table>

            <tr>

                <td class="filtro-label">
                    Año:
                </td>

                <td class="filtro-valor">
                    {{ $year }}
                </td>

                <td class="filtro-label">
                    Mes:
                </td>

                <td class="filtro-valor">

                    @if($month && $nombreMes)

                    {{ $nombreMes }}

                    @else

                    Todos los meses

                    @endif

                </td>

            </tr>


            <tr>

                <td class="filtro-label">
                    Equipo:
                </td>

                <td class="filtro-valor">

                    {{ $equipoFiltro ?: 'Todos los equipos' }}

                </td>


                <td class="filtro-label">
                    Resultado:
                </td>

                <td class="filtro-valor">

                    @if($resultadoFiltro)

                    {{ ucfirst($resultadoFiltro) }}

                    @else

                    Todos

                    @endif

                </td>

            </tr>

        </table>

    </div>


    {{-- ==========================================================
     TABLA PRINCIPAL
========================================================== --}}

    <table class="reporte">

        <thead>

            <tr>

                <th width="25%">
                    EQUIPO
                </th>

                <th width="12%">
                    DEVOLUCIÓN
                </th>

                <th width="12%">
                    REPOSICIÓN
                </th>

                <th width="12%">
                    REPLIEGUE
                </th>

                <th width="12%">
                    CUSTODIO
                </th>

                <th width="12%">
                    BAJA
                </th>

                <th width="15%">
                    TOTAL
                </th>

            </tr>

        </thead>


        <tbody>

            @forelse($detalle as $modelo => $datos)

            @php

            $totalFila = array_sum($datos);

            @endphp

            <tr>

                <td class="equipo">
                    {{ strtoupper($modelo) }}
                </td>

                <td>
                    {{ $datos['devolucion'] ?? 0 }}
                </td>

                <td>
                    {{ $datos['reposicion'] ?? 0 }}
                </td>

                <td>
                    {{ $datos['repliegue'] ?? 0 }}
                </td>

                <td>
                    {{ $datos['custodio'] ?? 0 }}
                </td>

                <td>
                    {{ $datos['baja'] ?? 0 }}
                </td>

                <td class="total">
                    {{ $totalFila }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="7" class="sin-resultados">

                    No existen registros para los filtros seleccionados.

                </td>

            </tr>

            @endforelse

        </tbody>


        {{-- ======================================================
         TOTAL GENERAL
    ======================================================= --}}

        <tfoot>

            <tr class="total-general">

                <td>
                    TOTAL GENERAL
                </td>

                <td>
                    {{ $totales['devolucion'] ?? 0 }}
                </td>

                <td>
                    {{ $totales['reposicion'] ?? 0 }}
                </td>

                <td>
                    {{ $totales['repliegue'] ?? 0 }}
                </td>

                <td>
                    {{ $totales['custodio'] ?? 0 }}
                </td>

                <td>
                    {{ $totales['baja'] ?? 0 }}
                </td>

                <td>
                    {{ array_sum($totales) }}
                </td>

            </tr>

        </tfoot>

    </table>


    {{-- ==========================================================
     PIE DE PÁGINA
========================================================== --}}

    <div class="footer">

        Gobierno Autónomo Municipal de El Alto
        -
        Unidad de Administración de Sistemas de Información

    </div>


</body>

</html>