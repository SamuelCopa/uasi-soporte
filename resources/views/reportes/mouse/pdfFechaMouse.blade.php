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
                <p>REGISTROS MOUSE</p> 
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
            @foreach ($mouse as $mouse)
                <tr class="fila-dividida10">
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        @if($mouse->fecha)
                        {{ date('d-m-Y',strtotime($mouse->fecha))}}<br><br>
                        @elseif(! $mouse->fecha)	
                        {{ $mouse->fecha ?? ''}}
                        @endif	 
                    </td>
                    <td >{{ $mouse->funcionario?->nombre }} {{ $mouse->funcionario?->paterno }} {{ $mouse->funcionario?->materno }}</td>
                    <td >{{ $mouse->funcionario?->ci }} {{ $mouse->funcionario?->expedido}}</td>
                    <td >{{ $mouse->funcionario?->celular }}</td>
                    <td style="font-size: 8px">{{ $mouse->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                    <td >{{ $mouse->cod_gamea }}</td>										
                    <td >{{ $mouse->user->name ?? ''}} {{ $mouse->user->paterno ?? ''}} {{ $mouse->user->materno ?? ''}}</td>
                    <td style="font-size: 8px">{{ $mouse->falla}}</td>
                    <td>
                    @if($mouse->fecha_entrega)
                        {{ $mouse->resultado?->nombre }}<br>
                        {{ date('d-m-Y', strtotime($mouse->fecha_entrega)) }}
                    @else
                        {{ $mouse->estado?->nombre }}
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