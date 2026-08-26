<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>
        Informe de Mantenimiento {{ $year }}
    </title>

    <style>

        @page {
            margin: 35px 30px 45px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        .encabezado {
            width: 100%;
            margin-bottom: 15px;
        }

        .encabezado td {
            vertical-align: middle;
        }

        .logo {
            width: 80px;
        }

        .institucion {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            line-height: 1.5;
        }

        .titulo {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: bold;
        }

        .subtitulo {
            text-align: center;
            font-size: 11px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .tabla th,
        .tabla td {
            border: 1px solid #444;
            padding: 7px 5px;
        }

        .tabla thead th {
            background-color: #1f4e78;
            color: white;
            text-align: center;
            font-weight: bold;
        }

        .tabla tbody td {
            text-align: center;
        }

        .tabla tbody td:first-child {
            text-align: left;
            font-weight: bold;
        }

        .total {
            background-color: #d9eaf7;
            font-weight: bold;
        }

        .total td {
            font-weight: bold;
        }

        .fecha {
            text-align: right;
            font-size: 9px;
            margin-bottom: 10px;
        }

        .firma {
            margin-top: 50px;
            width: 100%;
        }

        .firma td {
            text-align: center;
            padding-top: 30px;
        }

        .linea {
            border-top: 1px solid #333;
            width: 220px;
            margin: auto;
        }

        .footer {
            position: fixed;
            bottom: -25px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8px;
            color: #666;
        }

    </style>

</head>

<body>

    {{-- ENCABEZADO --}}
    <table class="encabezado">

        <tr>

            <td width="20%">
                @if(file_exists(public_path('assets/assets/img/elalto.jpg')))
                    <img
                        src="{{ public_path('img1/elalto.jpg') }}"
                        class="logo"
                    >
                    <img src="{{ public_path('img1/elalto.jpg') }}" >
                @endif
            </td>

            <td width="60%" class="institucion">

                GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO<br>

                UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN<br>

                ÁREA DE SOPORTE TÉCNICO

            </td>

            <td width="20%"></td>

        </tr>

    </table>


    {{-- TÍTULO --}}

    <div class="titulo">
        INFORME DE RESULTADOS DEL MANTENIMIENTO
    </div>

    <div class="subtitulo">
        DETALLE POR ACTIVOS - GESTIÓN {{ $year }}
    </div>

    <div class="fecha">
        Fecha:
        {{ now()->format('d/m/Y H:i') }}
    </div>


    {{-- TABLA --}}

    <table class="tabla">

        <thead>

            <tr>

                <th width="24%">
                    Equipo
                </th>

                <th>
                    Devolución
                </th>

                <th>
                    Reposición
                </th>

                <th>
                    Repliegue
                </th>

                <th>
                    Custodio
                </th>

                <th>
                    Baja
                </th>

                <th>
                    TOTAL
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach ($detalle as $modelo => $datos)

                @php
                    $totalFila = array_sum($datos);
                @endphp

                <tr>

                    <td>
                        {{ strtoupper($modelo) }}
                    </td>

                    <td>
                        {{ $datos['devolucion'] }}
                    </td>

                    <td>
                        {{ $datos['reposicion'] }}
                    </td>

                    <td>
                        {{ $datos['repliegue'] }}
                    </td>

                    <td>
                        {{ $datos['custodio'] }}
                    </td>

                    <td>
                        {{ $datos['baja'] }}
                    </td>

                    <td>
                        {{ $totalFila }}
                    </td>

                </tr>

            @endforeach

        </tbody>


        {{-- TOTAL GENERAL --}}

        <tfoot>

            <tr class="total">

                <td>
                    TOTAL GENERAL
                </td>

                <td>
                    {{ $totales['devolucion'] }}
                </td>

                <td>
                    {{ $totales['reposicion'] }}
                </td>

                <td>
                    {{ $totales['repliegue'] }}
                </td>

                <td>
                    {{ $totales['custodio'] }}
                </td>

                <td>
                    {{ $totales['baja'] }}
                </td>

                <td>
                    {{ array_sum($totales) }}
                </td>

            </tr>

        </tfoot>

    </table>


</body>

</html>