@extends('layouts.app')

@section('template_title')
    Modelo Procesadors
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h4 id="card_title">
                                {{ __('Modelo Procesador') }}
                            </h4>
                            <div class="float-right">
                                <a href="{{ route('modelo-procesadors.create') }}" class="btn btn-primary float-right"  data-placement="left" data-toggle="modal" data-target="#crear">
                                <i class="fa fa-fw fa-plus"></i>{{ __('NUEVO') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('modelo-procesador.modalCrear')
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                    <th>No</th>
									<th >MODELO</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modeloProcesadors as $modeloProcesador)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $modeloProcesador->modelo }}</td>
                                            <td>
                                                <form action="{{ route('modelo-procesadors.destroy', $modeloProcesador->id) }}" method="POST" class="formEliminar">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit{{ $modeloProcesador->id }}"><i class="fa fa-fw fa-edit" ></i> {{ __('EDITAR') }}</button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                            <!--Ventana Modal para Actualizar--->
                                            @include('modelo-procesador.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>No</th>
									<th >MODELO</th>
                                    <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $modeloProcesadors->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
