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
                <p>REGISTROS LAPTOP</p> 
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
            @foreach ($laptop as $laptop)
                <tr class="fila-dividida10">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if($laptop->fecha)
                        {{ date('d-m-Y',strtotime($laptop->fecha))}}<br><br>
                        @elseif(! $laptop->fecha)	
                        {{ $laptop->fecha ?? ''}}
                        @endif	 
                    </td>
                    <td >{{ $laptop->funcionario?->nombre }} {{ $laptop->funcionario?->paterno }} {{ $laptop->funcionario?->materno }}</td>
                    <td >{{ $laptop->funcionario?->ci }} {{ $laptop->funcionario?->expedido}}</td>
                    <td >{{ $laptop->funcionario?->celular }}</td>
                    <td style="font-size: 8px">{{ $laptop->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                    <td >{{ $laptop->cod_gamea }}</td>										
                    <td >{{ $laptop->user->name ?? ''}} {{ $laptop->user->paterno ?? ''}} {{ $laptop->user->materno ?? ''}}</td>
                    <td style="font-size: 8px">{{ $laptop->falla}}</td>
                    <td>
                        @if($laptop->fecha_entrega)
                            {{ $laptop->resultado?->nombre }}<br>
                            {{ date('d-m-Y', strtotime($laptop->fecha_entrega)) }}
                        @else
                            {{ $laptop->estado?->nombre }}
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