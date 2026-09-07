<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <style>

        @page {
            margin: 25px 20px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
        }

        .titulo {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }

        .subtitulo {
            text-align: center;
            font-size: 9px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #0052cc;
            color: white;
            padding: 5px;
            border: 1px solid #003f9e;
        }

        td {
            padding: 4px;
            border: 1px solid #ccc;
        }

        .centro {
            text-align: center;
        }

        .fecha-generacion {
    text-align: right;
    font-size: 10px;
    color: #555;
    margin-top: 5px;
    margin-bottom: 8px;
}


.membrete {
    width: 100%;
    border-collapse: collapse;
    border: none !important;
    margin-bottom: 10px;
}

.membrete tr,
.membrete td {
    border: none !important;
    padding: 0;
    vertical-align: middle;
}

/* Logo izquierdo y derecho */
.logo-izquierdo,
.logo-derecho {
    width: 18%;
    vertical-align: middle;
}

.logo-izquierdo {
    text-align: left;
}

.logo-derecho {
    text-align: right;
}

/* Tamaño de logos */
.logo-izquierdo img,
.logo-derecho img {
    width: 85px;
    height: 85px;
    object-fit: contain;
}

/* Título */
.titulo-central {
    width: 64%;
    text-align: center;
    vertical-align: middle;
}

.titulo {
    font-weight: bold;
    font-size: 13px;
    margin-bottom: 4px;
}

.subtitulo {
    font-size: 10px;
    margin-bottom: 4px;
}

.filtros-reporte {
    margin-top: 5px;
    font-size: 9px;
    font-weight: bold;
    text-align: center;
    text-transform: uppercase;
}
    </style>

</head>

<body>

<table class="membrete">
    <tr>

        <td class="logo-izquierdo">
            <img src="{{ public_path('img1/elalto.jpg') }}">
        </td>

            <td class="titulo-central">

                <div class="titulo">
                    GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
                </div>

                <div class="subtitulo">
                    UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
                </div>

                <div class="titulo">
                    REPORTE DE EQUIPOS ATENDIDOS
                </div>

                {{-- =====================================================
                    FILTROS UTILIZADOS PARA EL REPORTE
                    ===================================================== --}}
                <div class="filtros-reporte">

                    @php
                        $filtros = [];

                        if (!empty($year)) {
                            $filtros[] = 'GESTIÓN: ' . $year;
                        }

                        if (!empty($mesNombre)) {
                            $filtros[] = 'MES: ' . $mesNombre;
                        }

                        if (!empty($estadoNombre)) {
                            $filtros[] = 'ESTADO: ' . $estadoNombre;
                        }

                        if (!empty($tecnicoNombre)) {
                            $filtros[] = 'TÉCNICO: ' . $tecnicoNombre;
                        }

                        if (!empty($dependenciaNombre)) {
                            $filtros[] = 'DEPENDENCIA: ' . $dependenciaNombre;
                        }

                        if (!empty($fechaInicio) && !empty($fechaFin)) {
                            $filtros[] = 'PERIODO: ' .
                                date('d-m-Y', strtotime($fechaInicio)) .
                                ' AL ' .
                                date('d-m-Y', strtotime($fechaFin));
                        }
                    @endphp

                    @if(count($filtros) > 0)

                        {{ implode(' | ', $filtros) }}

                    @else

                        TODOS LOS REGISTROS

                    @endif

                </div>

            </td>

        <td class="logo-derecho">
            <img src="{{ public_path('img1/sello1.jpg') }}">
        </td>

    </tr>
</table>
<div class="fecha-generacion"> Fecha de generación: {{ now()->format('d-m-Y H:i') }} </div>
    <table>

        <thead>

            <tr>

                <th>No</th>
                <th>FECHA</th>
                <th>EQUIPO</th>
                <th>CÓDIGO</th>
                <th>FUNCIONARIO</th>
                <th>C.I.</th>
                <th>DEPENDENCIA</th>
                <th>TÉCNICO</th>
                <th>ESTADO</th>

            </tr>

        </thead>

        <tbody>

            @forelse($equipos as $equipo)

                <tr>

                    <td class="centro">
                        {{ $loop->iteration }}
                    </td>

                    <td class="centro">
                        {{ $equipo->fecha
                            ? date('d-m-Y', strtotime($equipo->fecha))
                            : '-' }}
                    </td>

                    <td>
                        @if($equipo->tipo_equipo === 'OTRO EQUIPO')
                            {{ $equipo->tipoEquipo?->nombre ?? 'OTRO EQUIPO' }}
                        @else
                            {{ $equipo->tipo_equipo }}
                        @endif
                    </td>

                    <td class="centro">
                        {{ $equipo->cod_gamea ?? '-' }}
                    </td>

                    <td>
                        {{ $equipo->funcionario?->nombre }}
                        {{ $equipo->funcionario?->paterno }}
                        {{ $equipo->funcionario?->materno }}
                    </td>

                    <td>
                        {{ $equipo->funcionario?->ci }}
                    </td>

                    <td>
                        {{ $equipo->Dependencia?->dependencias
                            ?? 'SIN DEPENDENCIA' }}
                    </td>

                    <td>
                        {{ $equipo->user
                            ? $equipo->user->name . ' ' . $equipo->user->paterno . ' ' . $equipo->user->materno
                            : 'SIN ASIGNAR' }}
                    </td>

                    <td class="centro">
                        @if($equipo->fecha_entrega)

                            {{ $equipo->resultado?->nombre }}<br>

                            {{ date('d-m-Y', strtotime($equipo->fecha_entrega)) }}

                        @else

                            {{ $equipo->estado?->nombre }}

                        @endif
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9" class="centro">
                        No se encontraron registros.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>

</html>