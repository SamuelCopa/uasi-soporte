@extends('layouts.app')

@section('template_title')
    Configuracions
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('CONFIGURACIONES') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('configuracions.create') }}" class="btn btn-primary float-right"  data-placement="left" data-toggle="modal" data-target="#crear">
                                <i class="fa fa-fw fa-plus"></i>{{ __('NUEVO') }}
                                </a>
                              </div>
                        </div>
                    </div>
                        <!--Ventana Modal para Crear--->
                        @include('configuracion.modalCrear')

                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                    <th>No</th>
									<th >Clave</th>
									<th >Valor</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($configuracions as $configuracion)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $configuracion->clave }}</td>
										<td >{{ $configuracion->valor }}</td>

                                            <td>
                                                <form action="{{ route('configuracions.destroy', $configuracion->id) }}" method="POST" class="formEliminar">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit{{ $configuracion->id }}"><i class="fa fa-fw fa-edit" ></i> {{ __('EDITAR') }}</button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form> 
                                            </td>
                                        </tr>
                                        <!--Ventana Modal para Actualizar--->
                                        @include('configuracion.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>No</th>
									<th >Clave</th>
									<th >Valor</th>
                                    <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $configuracions->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
