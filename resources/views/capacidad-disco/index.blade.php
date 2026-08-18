@extends('layouts.app')

@section('template_title')
    Capacidad Discos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h4 id="card_title">
                                {{ __('Capacidad Discos') }}
                            </h4>

                            <div class="float-right">
                                <a href="{{ route('capacidad-discos.create') }}" class="btn btn-primary float-right"  data-placement="left" data-toggle="modal" data-target="#crear">
                                <i class="fa fa-fw fa-plus"></i>{{ __('NUEVO') }}
                                </a>
                            </div>
                        </div>
                    </div>
                        <!--Ventana Modal para Crear--->
                        @include('capacidad-disco.modalCrear')
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                    <th>No</th>
									<th >Capacidad</th>
                                    <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($capacidadDiscos as $capacidadDisco)
                                        <tr>
                                        <td>{{ ++$i }}</td>
										<td >{{ $capacidadDisco->capacidad }}</td>
                                        <td>
                                                <form action="{{ route('capacidad-discos.destroy', $capacidadDisco->id) }}" method="POST" class="formEliminar">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit{{ $capacidadDisco->id }}"><i class="fa fa-fw fa-edit" ></i> {{ __('EDITAR') }}</button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                            <!--Ventana Modal para Actualizar--->
                                            @include('capacidad-disco.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>No</th>
									<th >Capacidad</th>
                                    <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $capacidadDiscos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
