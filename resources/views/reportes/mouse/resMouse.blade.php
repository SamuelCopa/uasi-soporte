@extends('layouts.app')

@section('template_title')
    Audifonos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h4>
                                {{ __('RESULTADOS MOUSE') }}
                            </h4>
                            <div class="float-right">
                                <a href="{{ route('reportes') }}" class="btn btn-primary" data-placement="left">
                                    <i class="fa fa-fw  fa-reply"></i> {{ __('VOLVER') }}
                                </a>
                                <a class="btn btn-danger" href="{{ route('pdf.Mouse',['query' => $query])}}" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead">
                                    <tr align="center">
                                        <td colspan="12" class="color2"><h4>HISTORIAL CODIGO {{ $query }}</h4></td>
                                    </tr>
                                    
                                    <tr align="center">
                                        <th>No</th>
                                        <th >FECHA DE RECEPCIÓN</th>
                                        <th >NOMBRE</th>
                                        <th >C.I.</th>
                                        <th >CELULAR</th>
                                        <th >CARGO</th>
                                        <th >DEPENDENCIA</th>
                                        <th >NUMERO DE RECEPCIÓN</th>
                                        <th >TECNICO A CARGO</th>									
                                        <th >FECHA DE INICIO</th>						
                                        <th >FALLA</th>
                                        <th >ESTADO</th>						
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mouse as $mouse)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y',strtotime($mouse->fecha))}}<br><br></td>
                                            <td >{{ $mouse->funcionario?->nombre }} {{ $mouse->funcionario?->paterno }} {{ $mouse->funcionario?->materno }}</td>
                                            <td >{{ $mouse->funcionario?->ci }} {{ $mouse->funcionario?->expedido }}</td>
                                            <td >{{ $mouse->funcionario?->celular }}</td>
                                            <td >{{ $mouse->cargo }}</td>
                                            <td >{{ $mouse->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}}</td>
                                            <td >{{$mouse->cod_registro }}</td> 
                                            <td >{{ $mouse->user->name ?? ''}} {{ $mouse->user->paterno ?? ''}} {{ $mouse->user->materno ?? ''}}</td>
                                            <td>
                                            @if($mouse->fecha_inicio)
                                            {{ date('d-m-Y',strtotime($mouse->fecha_inicio ))}}
                                            @elseif(! $mouse->fecha_inicio)	
                                            {{ $mouse->fecha_inicio ?? ''}}
                                            @endif								
                                            </td>									
                                            <td>{{ $mouse->falla}}</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection







