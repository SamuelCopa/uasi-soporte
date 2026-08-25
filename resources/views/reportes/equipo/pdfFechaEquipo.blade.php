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
                <p>REGISTROS</p> 
                <p class="fecha">Del {{date('d-m-Y',strtotime($start_date))}} al {{ date('d-m-Y',strtotime($end_date))}}</p>   
            </td>
        </tr>
    </table>    
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
            @foreach ($equipos as $equipo)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if($equipo->fecha)
                        {{ date('d-m-Y',strtotime($equipo->fecha))}}<br><br>
                        @elseif(! $equipo->fecha)	
                        {{ $equipo->fecha ?? ''}}
                        @endif	 
                    </td>
                    <td >{{ $equipo->funcionario?->nombre }} {{ $equipo->funcionario?->paterno }} {{ $equipo->funcionario?->materno }}</td>
                    <td >{{ $equipo->funcionario?->ci }} {{ $equipo->funcionario?->expedido}}</td>
                    <td >{{ $equipo->funcionario?->celular }}</td>
                    <td style="font-size: 8px">{{ $equipo->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                    <td >{{ $equipo->cod_gamea }}</td>										
                    <td >{{ $equipo->user->name ?? ''}} {{ $equipo->user->paterno ?? ''}} {{ $equipo->user->materno ?? ''}}</td>
                    <td style="font-size: 8px">{{ $equipo->falla}}</td>
                    <td>
                    @if($equipo->fecha_entrega)
                        {{ $equipo->resultado?->nombre }}<br>
                        {{ date('d-m-Y', strtotime($equipo->fecha_entrega)) }}
                    @else
                        {{ $equipo->estado?->nombre }}
                    @endif	
                    </td>
                </tr>
            @endforeach
    </table>
    <footer class="footer">
        <div>
            FECHA: {{ now()->format('d-m-Y') }} <br>
            {{ Auth::user()->name }} {{ Auth::user()->paterno }} {{ Auth::user()->materno }}
        </div>
    </footer>
</body>
</html>