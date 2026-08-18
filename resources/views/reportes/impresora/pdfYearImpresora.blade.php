<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ public_path('estilos/pdf2.css') }}">  
    <title>Doc. {{now()->format('d/m/Y') }}</title>
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
    <table class="table12">
        <tr>
            <td colspan="10">   
            <p>GESTIÓN {{ $query }}</p>  
            <p>IMPRESORA</p>  
            </td>
        </tr>
    </table>   
    <main>
    <table class="tabla">
        <thead>
        <tr>
            <th>#</th>
            <th >FECHA DE RECEPCIÓN</th>
            <th >NOMBRE</th>
            <th >C.I.</th>
            <th >CELULAR</th>
            <th >DEPENDENCIA</th>
            <th >CODIGO GAMEA</th>
            <th >TECNICO A CARGO</th>									
            <th >FALLA</th>
            <th >ESTADO</th>
        </tr>
        </thead>
            @foreach ($impresora as $impresora)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if($impresora->fecha)
                        {{ date('d-m-Y',strtotime($impresora->fecha))}}
                        @elseif(! $impresora->fecha)	
                        {{ $impresora->fecha ?? ''}}
                        @endif	 
                    </td>
                    <td >{{ $impresora->funcionario?->nombre }} {{ $impresora->funcionario?->paterno }} {{ $impresora->funcionario?->materno }}</td>
                    <td >{{ $impresora->funcionario?->ci }} {{ $impresora->funcionario?->expedido}}</td>
                    <td >{{ $impresora->funcionario?->celular }}</td>
                    <td style="font-size: 8px">{{ $impresora->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                    <td >{{ $impresora->cod_gamea }}</td>
                    <td >{{ $impresora->user->name ?? ''}} {{ $impresora->user->paterno ?? ''}} {{ $impresora->user->materno ?? ''}}</td>
                    <td style="font-size: 8px">{{ $impresora->falla}}</td>
                    <td>
                    @if($impresora->fecha_entrega)
                        {{ $impresora->resultado?->nombre }}<br>
                        {{ date('d-m-Y', strtotime($impresora->fecha_entrega)) }}
                    @else
                        {{ $impresora->estado?->nombre }}
                    @endif	 
                    </td>
                </tr>
            @endforeach
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