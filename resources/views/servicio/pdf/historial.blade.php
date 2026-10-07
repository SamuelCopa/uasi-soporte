<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: helvetica, sans-serif;
            font-size: 9px;
            color: #222222;
        }

        .titulo-institucional {
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            color: #1e3a5f;
        }

        .subtitulo {
            text-align: center;
            font-size: 9px;
            color: #555555;
        }

        .titulo-documento {
            margin-top: 12px;
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            color: #1e3a5f;
        }

        .linea {
            border-bottom: 1px solid #1e3a5f;
        }

        .seccion {
            background-color: #1e3a5f;
            color: #ffffff;
            font-size: 10px;
            font-weight: bold;
            padding: 5px;
        }

        .datos {
            border: 1px solid #bfc5cc;
            padding: 5px;
        }

        .label {
            font-weight: bold;
            color: #1e3a5f;
        }

        .valor {
            color: #222222;
        }

        .resumen {
            border: 1px solid #c7cdd3;
            text-align: center;
            padding: 6px;
        }

        .resumen-numero {
            font-size: 15px;
            font-weight: bold;
            color: #1e3a5f;
        }

        .resumen-label {
            font-size: 8px;
            color: #555555;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: #1e3a5f;
            color: #ffffff;
            font-size: 7.5px;
            font-weight: bold;
            padding: 5px;
            border: 1px solid #1e3a5f;
        }

        td {
            font-size: 7.5px;
            padding: 4px;
            border: 1px solid #c7cdd3;
            vertical-align: top;
        }

        .fila-alternativa {
            background-color: #f5f6f7;
        }

        .resultado {
            font-weight: bold;
            color: #1e3a5f;
        }

        .centro {
            text-align: center;
        }

        .derecha {
            text-align: right;
        }

        .fecha {
            white-space: nowrap;
        }

        .observaciones {
            font-size: 7px;
            color: #555555;
        }

        .sin-registros {
            text-align: center;
            padding: 15px;
            color: #777777;
        }
        
  .imagen-titulo {
    display: flex;
    align-items: center;
  }
  
  .imagen-titulo img {
    width: 130px;
    height: 130px;
    margin-right: 80px;
  }
    </style>
</head>

<body>

    {{-- =========================================================
         ENCABEZADO INSTITUCIONAL
         ========================================================= --}}

<table cellpadding="0" cellspacing="0">
    <tr>

        {{-- LOGO EL ALTO --}}
        <td width="20%" align="left">
            @if(file_exists(public_path('img1/elalto.jpg')))
                <img
                    src="{{ public_path('img1/elalto.jpg') }}"
                    width="60"
                    height="60"
                >
            @endif
        </td>

        {{-- TÍTULO INSTITUCIONAL --}}
        <td width="60%" align="center">
            <div class="titulo-institucional">
                GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
            </div>

            <div class="subtitulo">
                UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
            </div>

            <div class="subtitulo">
                SOPORTE TÉCNICO
            </div>
        </td>

        {{-- SELLO --}}
        <td width="20%" align="right">
            @if(file_exists(public_path('img1/sello1.jpg')))
                <img
                    src="{{ public_path('img1/sello1.jpg') }}"
                    width="60"
                    height="60"
                >
            @endif
        </td>

    </tr>
</table>

    <br>

    <div class="linea"></div>

    <div class="titulo-documento">
        HISTORIAL DEL EQUIPO
    </div>

    <br>


    {{-- =========================================================
         DATOS DEL ACTIVO
         ========================================================= --}}

    <div class="seccion">
        DATOS DEL ACTIVO
    </div>

 <table cellpadding="5" cellspacing="0" border="0" width="100%">

    @if(
        strtoupper(trim($equipo['tipo'] ?? '')) === 'CPU' ||
        strtoupper(trim($equipo['tipo'] ?? '')) === 'C.P.U.'
    )

        {{-- ================================
             CPU / C.P.U.
             ================================ --}}
        <tr>

            <td width="50%" style="border:1px solid #cccccc;">
                <span style="font-size:8pt; color:#666666;">
                    CÓDIGO GAMEA
                </span>
                <br>
                <strong style="font-size:10pt;">
                    {{ $equipo['cod_gamea'] ?? '-' }}
                </strong>
            </td>

            <td width="50%" style="border:1px solid #cccccc;">
                <span style="font-size:8pt; color:#666666;">
                    TIPO DE EQUIPO
                </span>
                <br>
                <strong style="font-size:10pt;">
                    {{ $equipo['tipo'] ?? '-' }}
                </strong>
            </td>

        </tr>

    @else

        {{-- ================================
             OTROS EQUIPOS
             ================================ --}}
        <tr>

            <td width="25%" style="border:1px solid #cccccc;">
                <span style="font-size:8pt; color:#666666;">
                    CÓDIGO GAMEA
                </span>
                <br>
                <strong style="font-size:10pt;">
                    {{ $equipo['cod_gamea'] ?? '-' }}
                </strong>
            </td>

            <td width="25%" style="border:1px solid #cccccc;">
                <span style="font-size:8pt; color:#666666;">
                    TIPO DE EQUIPO
                </span>
                <br>
                <strong style="font-size:10pt;">
                    {{ $equipo['tipo'] ?? '-' }}
                </strong>
            </td>

            <td width="25%" style="border:1px solid #cccccc;">
                <span style="font-size:8pt; color:#666666;">
                    MARCA
                </span>
                <br>
                <strong style="font-size:10pt;">
                    {{ $equipo['marca'] ?: '-' }}
                </strong>
            </td>

            <td width="25%" style="border:1px solid #cccccc;">
                <span style="font-size:8pt; color:#666666;">
                    MODELO
                </span>
                <br>
                <strong style="font-size:10pt;">
                    {{ $equipo['modelo'] ?: '-' }}
                </strong>
            </td>

        </tr>

    @endif

</table>

    <br>


    {{-- =========================================================
         RESUMEN
         ========================================================= --}}

    <div class="seccion">
        RESUMEN DE ATENCIONES
    </div>

    <table cellpadding="4" cellspacing="3">

        <tr>

            <td width="25%" class="resumen">
                <div class="resumen-numero">
                    {{ $totalOficina }}
                </div>

                <div class="resumen-label">
                    SERVICIOS EN OFICINA
                </div>
            </td>

            <td width="25%" class="resumen">
                <div class="resumen-numero">
                    {{ $totalTaller }}
                </div>

                <div class="resumen-label">
                    MANTENIMIENTOS EN TALLER
                </div>
            </td>

            <td width="25%" class="resumen">
                <div class="resumen-numero">
                    {{ $totalAtenciones }}
                </div>

                <div class="resumen-label">
                    TOTAL DE ATENCIONES
                </div>
            </td>

            <td width="25%" class="resumen">
                <div class="resumen-numero">
                    @if($ultimaAtencion && $ultimaAtencion['fecha'])
                        {{ \Carbon\Carbon::parse($ultimaAtencion['fecha'])->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </div>

                <div class="resumen-label">
                    ÚLTIMA ATENCIÓN
                </div>
            </td>

        </tr>

    </table>

    <br>


    {{-- =========================================================
         FECHAS DEL HISTORIAL
         ========================================================= --}}

    <table cellpadding="5" cellspacing="0">

        <tr>

            <td width="25%" class="datos">
                <span class="label">
                    Primera atención:
                </span>
            </td>

            <td width="25%" class="datos">
                @if($primeraAtencion && $primeraAtencion['fecha'])
                    {{ \Carbon\Carbon::parse($primeraAtencion['fecha'])->format('d/m/Y') }}
                @else
                    -
                @endif
            </td>

            <td width="25%" class="datos">
                <span class="label">
                    Última atención:
                </span>
            </td>

            <td width="25%" class="datos">
                @if($ultimaAtencion && $ultimaAtencion['fecha'])
                    {{ \Carbon\Carbon::parse($ultimaAtencion['fecha'])->format('d/m/Y') }}
                @else
                    -
                @endif
            </td>

        </tr>

    </table>

    <br>


    {{-- =========================================================
         HISTORIAL
         ========================================================= --}}

    <div class="seccion">
        HISTORIAL DE ATENCIONES
    </div>

    <br>

    @if($historial->isNotEmpty())

<table cellpadding="3" cellspacing="0" width="100%">

    <thead>
        <tr>
            <th width="8%" align="center">
                FECHA
            </th>

            <th width="7%" align="center">
                LUGAR
            </th>

            <th width="8%" align="center">
                TIPO
            </th>

            <th width="9%" align="center">
                EQUIPO
            </th>

            <th width="17%" align="center">
                FALLA / REQUERIMIENTO
            </th>

            <th width="8%" align="center">
                INICIO
            </th>

            <th width="8%" align="center">
                ENTREGA
            </th>

            <th width="10%" align="center">
                RESULTADO
            </th>

            <th width="13%" align="center">
                TÉCNICO
            </th>

            <th width="12%" align="center">
                OBSERVACIONES
            </th>
        </tr>
    </thead>

    <tbody>

        @foreach($historial as $index => $item)

            <tr>

                {{-- FECHA --}}
                <td width="8%" align="center">
                    @if(!empty($item['fecha']))
                        {{ \Carbon\Carbon::parse($item['fecha'])->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>

                {{-- LUGAR --}}
                <td width="7%" align="center">
                    {{ $item['lugar'] ?? '-' }}
                </td>

                {{-- TIPO --}}
                <td width="8%" align="center">
                    {{ $item['tipo'] ?? '-' }}
                </td>

                {{-- EQUIPO --}}
                <td width="9%">
                    {{ $item['equipo'] ?? '-' }}
                </td>

                {{-- FALLA --}}
                <td width="17%">
                    {{ $item['falla'] ?? '-' }}
                </td>

                {{-- INICIO --}}
                <td width="8%" align="center">
                    @if(!empty($item['fecha_inicio']))
                        {{ \Carbon\Carbon::parse($item['fecha_inicio'])->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>

                {{-- ENTREGA --}}
                <td width="8%" align="center">
                    @if(!empty($item['fecha_entrega']))
                        {{ \Carbon\Carbon::parse($item['fecha_entrega'])->format('d/m/Y') }}
                    @else
                        -
                    @endif
                </td>

                {{-- RESULTADO --}}
                <td width="10%" align="center">
                    @if(!empty($item['resultado']))
                        <span class="resultado">
                            {{ $item['resultado'] }}
                        </span>
                    @else
                        -
                    @endif
                </td>

                {{-- TÉCNICO --}}
                <td width="13%">
                    {{ $item['tecnico'] ?? '-' }}
                </td>

                {{-- OBSERVACIONES --}}
                <td width="12%">
                    {{ $item['observaciones'] ?? '-' }}
                </td>

            </tr>

        @endforeach

    </tbody>

</table>

    @else

        <div class="sin-registros">
            No existen registros de atención asociados al código
            <strong>{{ $codigo }}</strong>.
        </div>

    @endif


    <br><br>

    {{-- =========================================================
         NOTA
         ========================================================= --}}

    <table cellpadding="5" cellspacing="0">

        <tr>

            <td
                style="
                    border: 1px solid #c7cdd3;
                    background-color: #f5f6f7;
                    color: #555555;
                    font-size: 8px;
                "
            >
                <strong>Nota:</strong>
                El presente documento contiene el historial de servicios
                registrados en oficina y mantenimientos realizados en el
                área de soporte técnico asociados al código GAMEA consultado.
            </td>

        </tr>

    </table>

</body>
</html>