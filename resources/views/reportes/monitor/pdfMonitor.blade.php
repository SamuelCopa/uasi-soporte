<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Monitor</title>
    <link rel="stylesheet" href="{{ public_path('estilos/pdf2.css') }}">
</head>
<body>

<header class="header">
    <div class="header-left">
        <img src="{{ public_path('img1/elalto.jpg') }}">
    </div>

    <div class="header-center">
        <h1>UNIDAD DE ADMINISTRACIÓN</h1>
        <h2>DE SISTEMAS DE INFORMACIÓN</h2>
        <span>Área de Soporte Técnico</span>
    </div>

    <div class="header-right">
        <img src="{{ public_path('img1/sello1.jpg') }}">
    </div>
</header>

<section class="titulo">
    HISTORIAL MONITOR - CÓDIGO {{ $query }}
</section>

<main>
    <table class="tabla">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>C.I.</th>
                <th>Celular</th>
                <th>Dependencia</th>
                <th>Técnico</th>
                <th>Falla</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($monitor as $monitor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $monitor->fecha ? date('d-m-Y',strtotime($monitor->fecha)) : '' }}</td>
                <td>{{ $monitor->funcionario?->nombre }} {{ $monitor->funcionario?->paterno }}</td>
                <td>{{ $monitor->funcionario?->ci }}</td>
                <td>{{ $monitor->funcionario?->celular }}</td>
                <td class="small">{{ $monitor->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}</td>
                <td>{{ $monitor->user->name ?? '' }} {{ $monitor->user->paterno ?? '' }} {{ $monitor->user->materno ?? '' }}</td>
                <td class="small">{{ $monitor->falla }}</td>
                <td>
                    @if($monitor->fecha_entrega)
                        {{ $monitor->resultado?->nombre }}<br>
                        {{ date('d-m-Y', strtotime($monitor->fecha_entrega)) }}
                    @else
                        {{ $monitor->estado?->nombre }}
                    @endif	 
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>

<footer class="footer">
    <div>
        FECHA: {{ now()->format('d-m-Y') }} <br>
        {{ Auth::user()->name }} {{ Auth::user()->paterno }} {{ Auth::user()->materno }}
    </div>
</footer>

</body>
</html>
