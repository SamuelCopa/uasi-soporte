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
            <p>MONITOR</p>  
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
            @foreach ($monitor as $monitor)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if($monitor->fecha)
                        {{ date('d-m-Y',strtotime($monitor->fecha))}}
                        @elseif(! $monitor->fecha)	
                        {{ $monitor->fecha ?? ''}}
                        @endif	 
                    </td>
                    <td >{{ $monitor->funcionario?->nombre }} {{ $monitor->funcionario?->paterno }} {{ $monitor->funcionario?->materno }}</td>
                    <td >{{ $monitor->funcionario?->ci }} {{ $monitor->funcionario?->expedido}}</td>
                    <td >{{ $monitor->funcionario?->celular }}</td>
                    <td style="font-size: 8px">{{ $monitor->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                    <td >{{ $monitor->cod_gamea }}</td>
                    <td >{{ $monitor->user->name ?? ''}} {{ $monitor->user->paterno ?? ''}} {{ $monitor->user->materno ?? ''}}</td>
                    <td style="font-size: 8px">{{ $monitor->falla}}</td>
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