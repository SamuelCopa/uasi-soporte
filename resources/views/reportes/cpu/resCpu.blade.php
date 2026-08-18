@extends('layouts.app')

@section('template_title')
    cpus
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h4>
                                {{ __('RESULTADOS C.P.U.') }}
                            </h4>

                            <div class="float-right">
                                <a href="{{ route('reportes') }}" class="btn btn-primary" data-placement="left">
                                    <i class="fa fa-fw  fa-reply"></i> {{ __('VOLVER') }}
                                </a>
                                <a class="btn btn-danger" href="{{ route('pdf.Cpu',['query' => $query])}}" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a>
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
                                    @foreach ($cpu as $cpu)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y',strtotime($cpu->fecha))}}<br><br></td>
                                            <td >{{ $cpu->funcionario?->nombre }} {{ $cpu->funcionario?->paterno }} {{ $cpu->funcionario?->materno }}</td>
                                            <td >{{ $cpu->funcionario?->ci }} {{ $cpu->funcionario?->expedido }}</td>
                                            <td >{{ $cpu->funcionario?->celular }}</td>
                                            <td >{{ $cpu->cargo }}</td>
                                            <td >{{ $cpu->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                                            <td >{{$cpu->cod_registro }}</td> 
                                            <td >{{ $cpu->user->name ?? ''}} {{ $cpu->user->paterno ?? ''}} {{ $cpu->user->materno ?? ''}}</td>
                                            <td>
                                            @if($cpu->fecha_inicio)
                                            {{ date('d-m-Y',strtotime($cpu->fecha_inicio ))}}
                                            @elseif(! $cpu->fecha_inicio)	
                                            {{ $cpu->fecha_inicio ?? ''}}
                                            @endif								
                                            </td>									
                                            <td>{{ $cpu->falla}}</td>
                                            <td>                                     
                                            @if($cpu->fecha_entrega)
                                                {{ $cpu->resultado?->nombre }}<br>
                                                {{ date('d-m-Y', strtotime($cpu->fecha_entrega)) }}
                                            @else
                                                {{ $cpu->estado?->nombre }}
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







