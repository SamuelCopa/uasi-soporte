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
            <p>ESTABILIZADOR</p>  
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
            @foreach ($estabilizador as $estabilizador)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if($estabilizador->fecha)
                        {{ date('d-m-Y',strtotime($estabilizador->fecha))}}
                        @elseif(! $estabilizador->fecha)	
                        {{ $estabilizador->fecha ?? ''}}
                        @endif	 
                    </td>
                    <td >{{ $estabilizador->funcionario?->nombre }} {{ $estabilizador->funcionario?->paterno }} {{ $estabilizador->funcionario?->materno }}</td>
                    <td >{{ $estabilizador->funcionario?->ci }} {{ $estabilizador->funcionario?->expedido}}</td>
                    <td >{{ $estabilizador->funcionario?->celular }}</td>
                    <td style="font-size: 8px">{{ $estabilizador->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                    <td >{{ $estabilizador->cod_gamea }}</td>
                    <td >{{ $estabilizador->user->name ?? ''}} {{ $estabilizador->user->paterno ?? ''}} {{ $estabilizador->user->materno ?? ''}}</td>
                    <td style="font-size: 8px">{{ $estabilizador->falla}}</td>
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