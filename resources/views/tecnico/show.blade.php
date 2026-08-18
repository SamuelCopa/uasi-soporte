@extends('layouts.app')

@section('template_title')
    {{ $user->name ?? __('Show') . " " . __('User') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">

                        <div class="float-left">
                            @if (auth()->user()->hasRole('Administrador')) 
                            <h3 class="">{{ __('ADMINISTRADOR') }}</h3>
                            @else
                            <h3 class="">{{ __('ASIGNACIONES') }} TECNICO</h3>
                            @endif
                        </div>

                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $user?->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Email:</strong>
                                    {{ $user->email }}
                                </div>
                                @role('Tecnico')
                                <p>Impresoras registradas: {{ $user->impresoras_count }}</p>

                                <div class="card-body bg-white">
                                    <div class="table-responsive">
                                        <table id="mitabla" class="table table-striped table-hover table-bordered">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>
                                                    
                                                <th >FECHA DE RECEPCIÓN</th>
                                                <th >CODIGO GAMEA</th>
                                                <th >FALLA</th>
                                                <th >FECHA DE ASIGNACION</th>
                                                <th >ESTADO</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($impresoras as $impresora)
                                                    <tr>

                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($impresora->fecha))}}</td>	
                                                        <td>{{ $impresora->cod_gamea }}</td>
                                                        <td>{{ $impresora->falla }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($impresora->fecha_inicio ))}}</td>	
                                                        <td>{{ $impresora->estado->nombre }}</td>

            
                                                        <td>
                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="formEliminar">
                                                                {{-- <a class="btn btn-sm btn-primary " href="{{ route('users.show', $user->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                                {{-- <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a> --}}
                                                                @csrf
                                                                @method('DELETE')
                                                                {{-- <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button> --}}
                                                            </form>
                                                            {{-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Password{{ $user->id }}">{{ __( 'CAMBIAR CONTRASEÑA' ) }}</button> --}}
                                                        </td>
                                                    </tr>
                                                    <!--Ventana Modal Password --->
                                                    @include('user.modalPassword')
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    
                                                <th >FECHA DE RECEPCIÓN</th>
                                                <th >CODIGO GAMEA</th>
                                                <th >FALLA</th>
                                                <th >FECHA DE ASIGNACION</th>
                                                <th >ESTADO</th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                @endrole
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
