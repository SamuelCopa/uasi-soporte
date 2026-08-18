<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Estabilizador</title>
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
    HISTORIAL ESTABILIZADOR - CÓDIGO {{ $query }}
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
        @foreach ($estabilizador as $estabilizador)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $estabilizador->fecha ? date('d-m-Y',strtotime($estabilizador->fecha)) : '' }}</td>
                <td>{{ $estabilizador->funcionario?->nombre }} {{ $estabilizador->funcionario?->paterno }}</td>
                <td>{{ $estabilizador->funcionario?->ci }}</td>
                <td>{{ $estabilizador->funcionario?->celular }}</td>
                <td class="small">{{ $estabilizador->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}</td>
                <td>{{ $estabilizador->user->name ?? '' }} {{ $estabilizador->user->paterno ?? '' }} {{ $estabilizador->user->materno ?? '' }}</td>
                <td class="small">{{ $estabilizador->falla }}</td>
                <td>
                    @if($estabilizador->fecha_entrega)
                        {{ $estabilizador->resultado?->nombre }}<br>
                        {{ date('d-m-Y', strtotime($estabilizador->fecha_entrega)) }}
                    @else
                        {{ $estabilizador->estado?->nombre }}
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
