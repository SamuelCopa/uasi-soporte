@extends('layouts.app')

@section('template_title')
    Registros
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Registros') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('registros.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Fecha</th>
									<th >Fecha Asignacion</th>
									<th >Fecha Inicio</th>
									<th >Fecha Entrega</th>
									<th >Cod Registro</th>
									<th >Falla</th>
									<th >Respaldo</th>
									<th >Observaciones</th>
									<th >Otro</th>
									<th >Cpu Id</th>
									<th >Impresora Id</th>
									<th >Raton Id</th>
									<th >Parlante Id</th>
									<th >Teclado Id</th>
									<th >Laptop Id</th>
									<th >Monitor Id</th>
									<th >Audifono Id</th>
									<th >Estabilizador Id</th>
									<th >Ups Id</th>
									<th >User Id</th>
									<th >Resultado Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $registro)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $registro->fecha }}</td>
										<td >{{ $registro->fecha_asignacion }}</td>
										<td >{{ $registro->fecha_inicio }}</td>
										<td >{{ $registro->fecha_entrega }}</td>
										<td >{{ $registro->cod_registro }}</td>
										<td >{{ $registro->falla }}</td>
										<td >{{ $registro->respaldo }}</td>
										<td >{{ $registro->observaciones }}</td>
										<td >{{ $registro->otro }}</td>
										<td >{{ $registro->cpu_id }}</td>
										<td >{{ $registro->impresora?->id}}</td>
										<td >{{ $registro->raton_id }}</td>
										<td >{{ $registro->parlante_id }}</td>
										<td >{{ $registro->teclado_id }}</td>
										<td >{{ $registro->laptop_id }}</td>
										<td >{{ $registro->monitor_id }}</td>
										<td >{{ $registro->audifono_id }}</td>
										<td >{{ $registro->estabilizador_id }}</td>
										<td >{{ $registro->ups_id }}</td>
										<td >{{ $registro->user_id }}</td>
										<td >{{ $registro->resultado_id }}</td>

                                            <td>
                                                <form action="{{ route('registros.destroy', $registro->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('registros.show', $registro->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('registros.edit', $registro->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $registros->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
