@extends('layouts.app')

@section('template_title')
    Permissions
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 id="">
                                {{ __('PERMISOS') }}
                            </h3>

                             <div class="float-right">
                                <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left" data-placement="left" data-placement="left" data-toggle="modal" data-target="#crear">
                                  {{ __('NUEVO') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >NOMBRE</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $permission->name }}</td>
                                            <td>
                                                <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="formEliminar">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('permissions.show', $permission->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('VER') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('permissions.edit', $permission->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $permissions->withQueryString()->links() !!}
            </div>
        </div>
    </div>
<!--Ventana Modal para Crear--->
@include('permission.modalCrear')
@endsection
