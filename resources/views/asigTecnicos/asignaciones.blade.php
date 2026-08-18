<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>Reporte de Asignaciones</title>
    <link rel="stylesheet" href="{{ public_path('estilos/asignaciones.css') }}">

</head>

<body>

    <div class="header">
        <h1>GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO</h1>
        <h2>UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN </h2>
        <div> REPORTE DE EQUIPOS ASIGNADOS</div>
    </div>

    <table class="datos">
        <tr>
            <td>
                <strong>Técnico:</strong>
                {{ $user->name }} {{ $user->paterno }} {{ $user->materno }}
            </td>
            <td>
                <strong>Año:</strong>
                {{ $anio }}
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
    @foreach($datos as $item)

        <div class="titulo-equipo">
            {{ $item['titulo'] }}
        </div>
        <table>
            <thead>
                <tr>
                    <th width="40%">Estado</th>
                    <th width="15%">Cantidad</th>
                    <!-- <th width="15%">Porcentaje</th>
                    <th width="30%">Distribución</th> -->
                </tr>
            </thead>

            <tbody>

                @foreach($item['estados'] as $estado)
                    <tr>
                        <td>
                            {{ $estado['nombre'] }}
                        </td>
                        <td style="text-align:center;">
                            {{ $estado['cantidad'] }}
                        </td>
                        <!-- <td style="text-align:center;">
                            {{ $estado['porcentaje'] }}%
                        </td>
                        <td>
                            <div class="barra">
                                <div
                                    class="relleno estado-{{ $estado['id'] }}"
                                    style="width: {{ $estado['porcentaje'] }}%;">
                                </div>
                            </div>
                        </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            Total asignado: {{ $item['total'] }}
        </div>
    @endforeach

    <!-- <div class="footer">
GOBIERNO AUTONOMO MUNICIPAL DE EL ALTO
        <br>
        GAMEA - UASI
    </div> -->
</body>
</html>