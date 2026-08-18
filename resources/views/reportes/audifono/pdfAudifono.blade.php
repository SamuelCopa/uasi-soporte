<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial Audífono</title>
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
    HISTORIAL AUDÍFONO - CÓDIGO {{ $query }}
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
        @foreach ($audifonos as $audifono)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $audifono->fecha ? date('d-m-Y',strtotime($audifono->fecha)) : '' }}</td>
                <td>{{ $audifono->funcionario?->nombre }} {{ $audifono->funcionario?->paterno }}</td>
                <td>{{ $audifono->funcionario?->ci }}</td>
                <td>{{ $audifono->funcionario?->celular }}</td>
                <td class="small">{{ $audifono->Dependencia?->dependencias ?? 'SIN DEPENDENCIA' }}</td>
                <td>{{ $audifono->user->name ?? '' }} {{ $audifono->user->paterno ?? '' }} {{ $audifono->user->materno ?? '' }}</td>
                <td class="small">{{ $audifono->falla }}</td>
                <td>
                @if($audifono->fecha_entrega)
                    {{ $audifono->resultado?->nombre }}<br>
                    {{ date('d-m-Y', strtotime($audifono->fecha_entrega)) }}
                @else
                    {{ $audifono->estado?->nombre }}
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
