@extends('layouts.app')

@section('template_title')
    Monitors
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h4>
                                {{ __('RESULTADOS MONITOR') }}
                            </h4>
                            <div class="float-right">
                                <a href="{{ route('reportes') }}" class="btn btn-primary" data-placement="left">
                                    <i class="fa fa-fw  fa-reply"></i> {{ __('VOLVER') }}
                                </a>
                                <a class="btn btn-danger" href="{{ route('pdf.YearMonitor',['query' => $query])}}" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="thead">
                                    <tr align="center">
                                        <td colspan="12" class="color2"><h4>GESTIÓN {{ $query }}</h4></td>
                                    </tr>
                                    
                                    <tr align="center">
                                        <th>No</th>
                                        <th >FECHA DE RECEPCIÓN</th>
                                        <th >NOMBRE</th>
                                        <th >C.I.</th>
                                        <th >CELULAR</th>
                                        <th >CARGO</th>
                                        <th >DEPENDENCIA</th>
                                        <th >CODIGO GAMEA</th>
                                        <th >NUMERO DE RECEPCIÓN</th>
                                        <th >TECNICO A CARGO</th>									
                                        <th >FALLA</th>
                                        <th >ESTADO</th>						
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monitor as $monitor)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y',strtotime($monitor->fecha))}}<br><br></td>
                                            <td >{{ $monitor->funcionario?->nombre }} {{ $monitor->funcionario?->paterno }} {{ $monitor->funcionario?->materno }}</td>
                                            <td >{{ $monitor->funcionario?->ci }} {{ $monitor->funcionario?->expedido }}</td>
                                            <td >{{ $monitor->funcionario?->celular }}</td>
                                            <td >{{ $monitor->cargo }}</td>
                                            <td >{{ $monitor->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                                            <td >{{$monitor->cod_gamea }}</td> 
                                            <td >{{$monitor->cod_registro }}</td> 
                                            <td >{{ $monitor->user->name ?? ''}} {{ $monitor->user->paterno ?? ''}} {{ $monitor->user->materno ?? ''}}</td>
                                            <td>{{ $monitor->falla}}</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection







