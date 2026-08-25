@extends('layouts.app')

@section('template_title')
    equipos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h4>
                                {{ __('RESULTADOS ') }}
                            </h4>

                            <div class="float-right">
                                <a href="{{ route('reportes') }}" class="btn btn-primary" data-placement="left">
                                    <i class="fa fa-fw  fa-reply"></i> {{ __('VOLVER') }}
                                </a>

                                <a class="btn btn-danger" href="{{ route('pdf.Yearequipo',['query' => $query])}}" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a>

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
                                    @foreach ($equipos as $equipo)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d-m-Y',strtotime($equipo->fecha))}}<br><br></td>
                                            <td >{{ $equipo->funcionario?->nombre }} {{ $equipo->funcionario?->paterno }} {{ $equipo->funcionario?->materno }}</td>
                                            <td >{{ $equipo->funcionario?->ci }} {{ $equipo->funcionario?->expedido }}</td>
                                            <td >{{ $equipo->funcionario?->celular }}</td>
                                            <td >{{ $equipo->cargo }}</td>
                                            <td >{{ $equipo->Dependencia?->dependencias ?? 'SIN DEPENDENCIA'}}</td>
                                            <td >{{ $equipo->cod_gamea }}</td>
                                            <td >{{$equipo->cod_registro }}</td> 
                                            <td >{{ $equipo->user->name ?? ''}} {{ $equipo->user->paterno ?? ''}} {{ $equipo->user->materno ?? ''}}</td>
                                            <td>{{ $equipo->falla}}</td>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection







