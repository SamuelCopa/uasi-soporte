<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <style>

        @page {
            margin: 35px 30px 45px 30px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #222;
        }

        /* =========================
           ENCABEZADO
        ========================= */

        .header {
            width: 100%;
            border-bottom: 2px solid #0052cc;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .titulo-institucion {
            font-size: 13px;
            font-weight: bold;
            text-align: center;
        }

        .subtitulo {
            text-align: center;
            font-size: 10px;
            margin-top: 3px;
        }

        .titulo-reporte {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            margin: 12px 0 4px 0;
        }

        .periodo {
            text-align: center;
            font-size: 9px;
            margin-bottom: 12px;
        }


        /* =========================
           FILTROS
        ========================= */

        .filtros {
            border: 1px solid #ccc;
            padding: 8px;
            margin-bottom: 12px;
        }

        .filtros-title {
            font-weight: bold;
            margin-bottom: 7px;
        }

        .filtro {
            display: inline-block;
            width: 23%;
            vertical-align: top;
            margin-bottom: 5px;
        }


        /* =========================
           INDICADORES
        ========================= */

        .kpis {
            width: 100%;
            margin-bottom: 12px;
        }

        .kpi {
            width: 23%;
            display: inline-block;
            border: 1px solid #ccc;
            padding: 7px;
            text-align: center;
            margin-right: 1%;
        }

        .kpi strong {
            display: block;
            font-size: 15px;
        }


        /* =========================
           TABLAS
        ========================= */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #0052cc;
            color: white;
            padding: 5px;
            border: 1px solid #aaa;
            font-size: 8px;
        }

        td {
            padding: 4px;
            border: 1px solid #ccc;
            font-size: 7.5px;
        }

        .text-center {
            text-align: center;
        }


        /* =========================
           ESTADOS
        ========================= */

        .pendiente {
            font-weight: bold;
        }

        .atendido {
            font-weight: bold;
        }


        /* =========================
           SECCIONES
        ========================= */

        .seccion {
            font-size: 11px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 6px;
        }


        /* =========================
           PIE
        ========================= */

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


    {{-- =====================================================
         ENCABEZADO 
    ====================================================== --}}

    <div class="header">

        <div class="titulo-institucion">
            GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
        </div>

        <div class="subtitulo">
            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
        </div>

        <div class="subtitulo">
            SOPORTE TÉCNICO
        </div>

    </div>


    {{-- =====================================================
         TÍTULO
    ====================================================== --}}

    <div class="titulo-reporte">
        REPORTE DE ASISTENCIAS TÉCNICAS
    </div>

    <div class="periodo">

        Gestión:

        <strong>
            {{ $year ?? 'Todas' }}
        </strong>

    </div>


    {{-- =====================================================
         INDICADORES
    ====================================================== --}}

    <div class="kpis">


        <div class="kpi">

            <strong>
                {{ $total }}
            </strong>

            Total

        </div>


        <div class="kpi">

            <strong>
                {{ $atendidos }}
            </strong>

            Atendidos

        </div>


        <div class="kpi">

            <strong>
                {{ $pendientes }}
            </strong>

            Pendientes

        </div>


        <div class="kpi">

            <strong>
                {{ $porcentajeAtencion }}%
            </strong>

            Atención

        </div>

    </div>


    {{-- =====================================================
         DETALLE
    ====================================================== --}}

    <div class="seccion">
        DETALLE DE ASISTENCIAS
    </div>


    <table>

        <thead>

            <tr>

                <th>No</th>

                <th>FECHA</th>

                <th>NOMBRE</th>

                <th>DEPENDENCIA</th>

                <th>EQUIPO</th>

                <th>FALLA</th>

                <th>FECHA ASIGNACIÓN</th>

                <th>SERVICIO</th>

                <th>FECHA ATENCIÓN</th>

                <th>ESTADO</th>

            </tr>

        </thead>


        <tbody>

            @forelse($asignaciones as $asignacion)

                <tr>


                    {{-- No --}}

                    <td class="text-center">

                        {{ $loop->iteration }}

                    </td>


                    {{-- FECHA --}}

                    <td>

                        @if($asignacion->created_at)

                            {{ $asignacion->created_at->format('d-m-Y H:i') }}

                        @endif

                    </td>


                    {{-- NOMBRE --}}

                    <td>

                        {{ $asignacion->funcionario?->nombre ?? '' }}

                        {{ $asignacion->funcionario?->paterno ?? '' }}

                        {{ $asignacion->funcionario?->materno ?? '' }}

                    </td>


                    {{-- DEPENDENCIA --}}

                    <td>

                        {{ $asignacion->Dependencia?->dependencias ?? '' }}

                    </td>


                    {{-- EQUIPO --}}

                    <td>

                        {{ $asignacion->equipo ?? '' }}

                    </td>


                    {{-- FALLA --}}

                    <td>

                        {{ $asignacion->falla ?? '' }}

                    </td>


                    {{-- FECHA ASIGNACIÓN --}}

                    <td>

                        {{ $asignacion->fecha_asignacion ?? '' }}

                    </td>


                    {{-- SERVICIO --}}

                    <td>

                        {{ $asignacion->servicio ?? '' }}

                    </td>


                    {{-- FECHA ATENCIÓN --}}

                    <td>

                        @if($asignacion->fecha_atencion)

                            {{ date(
                                'd-m-Y H:i',
                                strtotime($asignacion->fecha_atencion)
                            ) }}

                        @else

                            EN ESPERA

                        @endif

                    </td>


                    {{-- ESTADO --}}

                    <td class="text-center">

                        @if($asignacion->visto == 0)

                            <span class="pendiente">
                                PENDIENTE
                            </span>

                        @else

                            <span class="atendido">
                                ATENDIDO
                            </span>

                        @endif

                    </td>


                </tr>

            @empty

                <tr>

                    <td colspan="10" class="text-center">

                        No existen registros para los filtros seleccionados.

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    {{-- =====================================================
         RESUMEN POR DEPENDENCIA
    ====================================================== --}}

    @if(isset($resumenDependencias) && $resumenDependencias->count() > 0)

        <div class="seccion">

            RESUMEN POR DEPENDENCIA

        </div>


        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>DEPENDENCIA</th>

                    <th>TOTAL</th>

                </tr>

            </thead>


            <tbody>

                @foreach($resumenDependencias as $dependencia => $cantidad)

                    <tr>

                        <td class="text-center">

                            {{ $loop->iteration }}

                        </td>


                        <td>

                            {{ $dependencia }}

                        </td>


                        <td class="text-center">

                            {{ $cantidad }}

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    @endif


    {{-- =====================================================
         PIE
    ====================================================== --}}

    <!-- <div class="footer">

        Sistema de Información para el Control y Seguimiento
        del Mantenimiento de Equipos y Dispositivos Computacionales
        | UASI - GAMEA

    </div> -->


</body>

</html>