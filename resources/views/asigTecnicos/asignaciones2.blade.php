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

        <h1>
            GOBIERNO AUTÓNOMO MUNICIPAL DE EL ALTO
        </h1>

        <h2>
            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
        </h2>

        <div>
            REPORTE DE EQUIPOS ASIGNADOS
        </div>

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


    <!-- TABLAS DE EQUIPOS -->

    @foreach($datos as $item)

        <div class="titulo-equipo">
            {{ $item['titulo'] }}
        </div>


        <table class="tabla">

            <thead>

                <tr>

                    <th width="70%">
                        Estado
                    </th>

                    <th width="30%">
                        Cantidad
                    </th>

                </tr>

            </thead>


            <tbody>

                @foreach($item['estados'] as $estado)

                    <tr>

                        <td>
                            {{ $estado['estado'] }}
                        </td>

                        <td class="cantidad">
                            {{ $estado['cantidad'] }}
                        </td>

                    </tr>

                @endforeach


                <!-- TOTAL -->

                <tr class="fila-total">

                    <td>
                        <strong>
                            TOTAL {{ $item['titulo'] }}
                        </strong>
                    </td>

                    <td class="cantidad">

                        <strong>
                            {{ $item['total'] }}
                        </strong>

                    </td>

                </tr>

            </tbody>

        </table>

    @endforeach


    <!-- PIE DEL REPORTE -->

 
    <style>
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

.titulo-equipo {
    background-color: #0052cc;
    color: white;
    font-weight: bold;
    padding: 7px;
    margin-top: 12px;
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