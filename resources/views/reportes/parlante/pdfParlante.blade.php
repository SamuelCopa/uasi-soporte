<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Parlante</title>
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
    HISTORIAL PARLANTE - CÓDIGO {{ $query }}
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
        @foreach ($parlante as $parlante)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $parlante->fecha ? date('d-m-Y',strtotime($parlante->fecha)) : '' }}</td>
                <td>{{ $parlante->funcionario?->nombre }} {{ $parlante->funcionario?->paterno }}</td>
                <td>{{ $parlante->funcionario?->ci }}</td>
                <td>{{ $parlante->funcionario?->celular }}</td>
                <td class="small">{{ $parlante->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}</td>
                <td>{{ $parlante->user->name ?? '' }} {{ $parlante->user->paterno ?? '' }} {{ $parlante->user->materno ?? '' }}</td>
                <td class="small">{{ $parlante->falla }}</td>
                <td>
                @if($parlante->fecha_entrega)
                    {{ $parlante->resultado?->nombre }}<br>
                    {{ date('d-m-Y', strtotime($parlante->fecha_entrega)) }}
                @else
                    {{ $parlante->estado?->nombre }}
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
