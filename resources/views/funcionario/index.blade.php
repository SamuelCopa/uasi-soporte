@extends('layouts.app')

@section('template_title')
    Funcionarios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Funcionarios') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('funcionarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left" data-toggle="modal" data-target="#crearf">
                                <i class="fa fa-fw fa-plus"></i>{{ __('NUEVO') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    <!--Ventana Modal para Crear--->
                    @include('funcionario.modalCrear')

                    <div class="card">
                        <div class="table-responsive">
                            <table id="mitabla" class="table-modern table-striped table-hover table-bordered">
                                <thead class="thead">
                                    <tr align="center">
                                    <th>No</th>
									<th >GRADO ACADEMICO</th>
									<th >PATERNO</th>
									<th >MATERNO</th>
									<th >APELLIDO DE CASADA</th>
									<th >NOMBRE</th>
									<th >C.I.</th>
									<th >CELULAR</th>
									<th >CORREO ELECTRÓNICO</th>
									<th >CARGO</th>
									<th >DEPENDENCIA</th>
                                    <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($funcionarios as $funcionario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ strtoupper($funcionario->grado_academico) }}</td>
										<td >{{ $funcionario->paterno }}</td>
										<td >{{ $funcionario->materno }}</td>
										<td >{{ $funcionario->ap_casada }}</td>
										<td >{{ $funcionario->nombre }}</td>
										<td >{{ $funcionario->ci }} {{ $funcionario->expedido }}</td>
										<td >{{ $funcionario->celular }}</td>
										<td >{{ $funcionario->email }}</td>
										<td >{{ $funcionario->cargo }}</td>
                                        <td >{{ $funcionario->Dependencia?->dependencias }}</td>
                                        <td>
                                            <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" class="formEliminar">
                                                {{-- <a class="btn btn-sm btn-primary " href="{{ route('funcionarios.show', $funcionario->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('VER') }}</a> --}}
                                                {{-- <a class="btn btn-sm btn-success" href="{{ route('funcionarios.edit', $funcionario->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a> --}}
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#editarf{{ $funcionario->id }}"><i class="fa fa-fw fa-edit" ></i> {{ __('EDITAR') }}</button>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" ><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                            </form>
                                        </td>
                                        </tr>
                                            <!--Ventana Modal para Actualizar--->
                                            @include('funcionario.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr align="center">
                                    <th>No</th>
									<th >GRADO ACADEMICO</th>
									<th >PATERNO</th>
									<th >MATERNO</th>
									<th >APELLIDO DE CASADA</th>
									<th >NOMBRE</th>
									<th >C.I.</th>
									<th >CELULAR</th>
									<th >CORREO ELECTRÓNICO</th>
									<th >CARGO</th>
                                    <th >DEPENDENCIA</th>
                                    <th>OPCIONES</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $funcionarios->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
