@extends('layouts.app')

@section('template_title')
    Responsables
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-header card-header--custom">
                </div>
                    <div class="header-panel">
                        <div class="header-left">
                            <h1 class="header-title">Responsables</h1>
                        </div>
                        <div class="header-actions">
                        <!-- Botón -->
                        <button class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#crear">
                            <i class="fa fa-plus me-1"></i> Nuevo
                        </button>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('responsable.modalCrear')

                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Nombre</th>
									<th >Cargo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($responsables as $responsable)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $responsable->nombre }}</td>
										<td >{{ $responsable->cargo }}</td>

                                            <td>
                                                <form action="{{ route('responsables.destroy', $responsable->id) }}" method="POST" class="formEliminar">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit{{ $responsable->id }}"><i class="fa fa-fw fa-edit" ></i> {{ __('EDITAR') }}</button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                            <!--Ventana Modal para Actualizar--->
                                            @include('responsable.modalEdit')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $responsables->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
