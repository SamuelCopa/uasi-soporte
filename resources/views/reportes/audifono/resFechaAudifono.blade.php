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
                                {{ __('RESULTADOS AUDIFONOS') }}
                            </h4>
                            <div class="float-right">
                                <a href="{{ route('reportes') }}" class="btn btn-primary" data-placement="left">
                                    <i class="fa fa-fw  fa-reply"></i> {{ __('VOLVER') }}
                                </a>
                                <a class="btn btn-danger" href="{{ route('pdf.fechaaudifono', ['start_date' => $start_date, 'end_date' => $end_date]) }}" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table-modern table-striped table-hover table-bordered">
                                <thead class="thead">
                                    <tr align="center">
                                        <td colspan="13" class="color2"><h4>REGISTROS</h4><br>
                                            <h5>Del {{date('d-m-Y',strtotime($start_date))}} al {{ date('d-m-Y',strtotime($end_date))}}</h5>
                                        </td>
                                    </tr>
                                    
                                    <tr align="center">
                                        <th >No</th>
                                        <th >FECHA DE RECEPCIÓN</th>
                                        <th >NOMBRE</th>
                                        <th >C.I.</th>
                                        <th >CELULAR</th>
                                        <th >CARGO</th>
                                        <th >DEPENDENCIA</th>
                                        <th >CODIGO GAMEA</th>									
                                        <th >NÚMERO DE RECEPCIÓN</th>
                                        <th >TECNICO A CARGO</th>									
                                        <th >FECHA DE INICIO</th>						
                                        <th >FALLA</th>
                                        <th >ESTADO</th>	
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($audifonos as $audifono)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y',strtotime($audifono->fecha))}}<br><br></td>
                                            <td >{{ $audifono->funcionario?->nombre }} {{ $audifono->funcionario?->paterno }} {{ $audifono->funcionario?->materno }}</td>
                                            <td >{{ $audifono->funcionario?->ci }} {{ $audifono->funcionario?->expedido }}</td>
                                            <td >{{ $audifono->funcionario?->celular }}</td>
                                            <td >{{ $audifono->cargo }}</td>
                                            <td >{{ $audifono->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                                            <td >{{ $audifono->cod_gamea }}</td>										
                                            <td >{{$audifono->cod_registro }}</td> 
                                            <td >{{ $audifono->user->name ?? ''}} {{ $audifono->user->paterno ?? ''}} {{ $audifono->user->materno ?? ''}}</td>
                                            <td>
                                            @if($audifono->fecha_inicio)
                                            {{ date('d-m-Y',strtotime($audifono->fecha_inicio ))}}
                                            @elseif(! $audifono->fecha_inicio)	
                                            {{ $audifono->fecha_inicio ?? ''}}
                                            @endif								
                                            </td>									
                                            <td>{{ $audifono->falla}}</td>
                                            <td>
                                            @if($audifono->fecha_entrega)
                                                {{ $audifono->resultado?->nombre }}<br>
                                                {{ date('d-m-Y', strtotime($audifono->fecha_entrega)) }}
                                            @else
                                                {{ $audifono->estado?->nombre }}
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





