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

    </style>

</head>

<body>

    <div class="titulo">
        GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
    </div>

    <div class="subtitulo">
        UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
    </div>

    <div class="titulo">
        REPORTE DE EQUIPOS INGRESADOS
    </div>

    <br>

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

                            {{ $equipo->tipoEquipo?->nombre
                                ?? 'OTRO EQUIPO' }}

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

                        {{ $equipo->user?->name }}
                        {{ $equipo->user?->paterno }}
                        {{ $equipo->user?->materno }}

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

                    <td colspan="10" class="centro">
                        No se encontraron registros.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</body>

</html>