<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial CPU</title>
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
    HISTORIAL CPU - CÓDIGO {{ $query }}
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
        @foreach ($cpu as $cpu)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $cpu->fecha ? date('d-m-Y',strtotime($cpu->fecha)) : '' }}</td>
                <td>{{ $cpu->funcionario?->nombre }} {{ $cpu->funcionario?->paterno }}</td>
                <td>{{ $cpu->funcionario?->ci }}</td>
                <td>{{ $cpu->funcionario?->celular }}</td>
                <td class="small">{{ $cpu->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}</td>
                <td>{{ $cpu->user->name ?? '' }} {{ $cpu->user->paterno ?? '' }} {{ $cpu->user->materno ?? '' }}</td>
                <td class="small">{{ $cpu->falla }}</td>
                <td>
                    {{ $cpu->resultado?->nombre ?? '' }}
                    <br>
                    <span class="fecha-entrega">
                        @if($cpu->fecha_entrega)
                            {{ $cpu->resultado?->nombre }}<br>
                            {{ date('d-m-Y', strtotime($cpu->fecha_entrega)) }}
                        @else
                            {{ $cpu->estado?->nombre }}
                        @endif	
                    </span>
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
