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
                                {{ __('RESULTADOS U.P.S.') }}
                            </h4>

                            <div class="float-right">
                                <a href="{{ route('reportes') }}" class="btn btn-primary" data-placement="left">
                                <i class="fa fa-fw  fa-reply"></i> {{ __('VOLVER') }}
                                </a>
                                <a class="btn btn-danger" href="{{ route('pdf.Ups',['query' => $query])}}" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a>
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
                                    @foreach ($ups as $ups)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y',strtotime($ups->fecha))}}<br><br></td>
                                            <td >{{ $ups->funcionario?->nombre }} {{ $ups->funcionario?->paterno }} {{ $ups->funcionario?->materno }}</td>
                                            <td >{{ $ups->funcionario?->ci }} {{ $ups->funcionario?->expedido }}</td>
                                            <td >{{ $ups->funcionario?->celular }}</td>
                                            <td >{{ $ups->cargo }}</td>
                                            <td >{{ $ups->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}}</td>
                                            <td >{{$ups->cod_registro }}</td> 
                                            <td >{{ $ups->user->name ?? ''}} {{ $ups->user->paterno ?? ''}} {{ $ups->user->materno ?? ''}}</td>
                                            <td>
                                            @if($ups->fecha_inicio)
                                            {{ date('d-m-Y',strtotime($ups->fecha_inicio ))}}
                                            @elseif(! $ups->fecha_inicio)	
                                            {{ $ups->fecha_inicio ?? ''}}
                                            @endif								
                                            </td>									
                                            <td>{{ $ups->falla}}</td>
                                            <td>
                                                @if($ups->fecha_entrega)
                                                    {{ $ups->resultado?->nombre }}<br>
                                                    {{ date('d-m-Y', strtotime($ups->fecha_entrega)) }}
                                                @else
                                                    {{ $ups->estado?->nombre }}
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