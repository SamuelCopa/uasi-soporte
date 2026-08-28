```html
<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Reporte de Servicios</title>

    <style>

        @page {
            margin: 25px 20px 35px 20px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 7px;
            color: #222;
        }

        .encabezado {
            width: 100%;
            border-bottom: 2px solid #0052cc;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }

        .institucion {
            text-align: center;
            font-size: 11px;
            font-weight: bold;
        }

        .unidad {
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            margin-top: 3px;
        }

        .titulo {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            margin-top: 8px;
            margin-bottom: 5px;
        }

        .fecha-reporte {
            text-align: right;
            font-size: 7px;
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th {
            background-color: #0052cc;
            color: white;
            border: 1px solid #333;
            padding: 4px 2px;
            text-align: center;
            font-size: 6.5px;
            font-weight: bold;
        }

        td {
            border: 1px solid #999;
            vertical-align: middle;
            word-wrap: break-word;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .center {
            text-align: center;
        }

        .pendiente {
            color: #c62828;
            font-weight: bold;
        }

        .atendido {
            color: #1565c0;
            font-weight: bold;
        }

        .sin-evaluar {
            color: #777;
        }

        .puntaje {
            text-align: center;
            font-size: 6.5px;
        }

        .emoji {
            font-size: 9px;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 7px;
            color: #666;
        }

        .resumen {
            margin-top: 10px;
            text-align: right;
            font-size: 8px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="encabezado">
        <div class="institucion">
            GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
        </div>
        <div class="unidad">
            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN - UASI
        </div>
    </div>
    <div class="titulo">
        REPORTE DE SERVICIOS DE SOPORTE TÉCNICO
    </div>
    <div class="fecha-reporte">
        Fecha de generación:
        {{ now()->format('d-m-Y H:i') }}
    </div>
    <table>
        <thead>
            <tr>
                <th style="width: 3%;">No</th>
                <th style="width: 7%;">Fecha</th>
                <th style="width: 10%;">Nombre</th>
                <th style="width: 5%;">CI</th>
                <th style="width: 9%;">Dependencia</th>
                <th style="width: 7%;">Equipo</th>
                <th style="width: 11%;">Falla</th>
                <th style="width: 8%;">Tipo de Servicio</th>
                <th style="width: 10%;">Técnico</th>
                <th style="width: 7%;">Fecha de Asignación</th>
                <th style="width: 7%;">Fecha de Atención</th>
                <th style="width: 5%;">Estado</th>
                <th style="width: 6%;">Puntaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $index => $servicio)
                <tr>
                    <td class="center">
                        {{ $index + 1 }}
                    </td>
                    <td class="center">
                        {{ $servicio->created_at ? date('d-m-Y H:i', strtotime($servicio->created_at)) : '-' }}
                    </td>
                    <td>
                        {{ $servicio->funcionario?->nombre }}
                        {{ $servicio->funcionario?->paterno }}
                        {{ $servicio->funcionario?->materno }}
                    </td>
                    <td class="center">
                        {{ $servicio->funcionario?->ci ?? '-' }}
                    </td>
                    <td>
                        {{ $servicio->Dependencia?->dependencias ?? '-' }}
                    </td>
                    <td>
                        {{ $servicio->equipo ?? '-' }}
                    </td>
                    <td>
                        {{ $servicio->falla ?? '-' }}
                    </td>
                    <td>
                        {{ $servicio->servicio ?? '-' }}
                    </td>
                    <td>
                        @if($servicio->user_id)
                            {{ $servicio->user?->name }}
                            {{ $servicio->user?->paterno }}
                            {{ $servicio->user?->materno }}
                        @else
                            <span class="pendiente">
                                SIN ASIGNAR
                            </span>
                        @endif
                    </td>
                    <td class="center">
                        @if($servicio->fecha_asignacion)
                            {{ date(
                                'd-m-Y H:i',
                                strtotime($servicio->fecha_asignacion)
                            ) }}
                        @else
                            <span class="pendiente">
                                SIN ASIGNAR
                            </span>
                        @endif
                    </td>
                    <td class="center">
                        @if($servicio->fecha_atencion)
                            {{ date(
                                'd-m-Y H:i',
                                strtotime($servicio->fecha_atencion)
                            ) }}
                        @else
                            <span class="pendiente">
                                PENDIENTE
                            </span>
                        @endif
                    </td>
                    <td class="center">
                        @if($servicio->user_id)
                            @if($servicio->visto)
                                <span class="atendido">
                                    ATENDIDO
                                </span>
                            @else
                                <span class="pendiente">
                                    PENDIENTE
                                </span>
                            @endif
                        @else
                            <span class="pendiente">
                                PENDIENTE
                            </span>
                        @endif
                    </td>
                    <td class="puntaje">
                        @switch($servicio->puntuacion)
                            @case(1)
                                Muy malo
                                @break
                            @case(2)
                                Malo
                                @break
                            @case(3)
                                Regular
                                @break
                            @case(4)
                                Bueno
                                @break
                            @case(5)
                                Excelente
                                @break
                            @default
                                <span class="sin-evaluar">
                                    Sin evaluar
                                </span>
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="resumen">

        TOTAL DE SERVICIOS:
        {{ $servicios->count() }}

    </div>

<!-- 
    <div class="footer">

        UASI - Área de Soporte Técnico |
        Página <span class="pageNumber"></span>

    </div> -->

</body>

</html>
