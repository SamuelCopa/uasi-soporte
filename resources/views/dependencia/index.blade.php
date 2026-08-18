@extends('layouts.app')

@section('template_title')
    Dependencias
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;" class="">

                            <h4 id="card_title" class="cabecera">
                                {{ __('Dependencias') }}
                            </h4>

                             <div class="float-right">
                                <a href="{{ route('dependencias.create') }}" class="btn btn-primary float-right"  data-placement="left" data-toggle="modal" data-target="#crear">
                                <i class="fa fa-fw fa-plus"></i>{{ __('NUEVO') }}
                                </a>
                              </div>
                        </div>
                    </div>
                        <!--Ventana Modal para Crear--->
                        @include('dependencia.modalCrear')

                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                    <th>No</th>
									<th >Dependencias</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dependencias as $dependencia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $dependencia->dependencias }}</td>

                                            <td>
                                                <form action="{{ route('dependencias.destroy', $dependencia->id) }}" method="POST" class="formEliminar">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit{{ $dependencia->id }}"><i class="fa fa-fw fa-edit" ></i> {{ __('EDITAR') }}</button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form> 
                                            </td>
                                        </tr>
                                            <!--Ventana Modal para Actualizar--->
                                            @include('dependencia.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>No</th>
									<th >Dependencias</th>
                                    <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $dependencias->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
