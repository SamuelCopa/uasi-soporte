@extends('layouts.app')

@section('template_title')
    Color Cases
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Color Cases') }}
                            </span>
                            <div class="float-right">
                                <a href="{{ route('color-cases.create') }}" class="btn btn-primary"  data-placement="left" data-toggle="modal" data-target="#crear">
                                <i class="fa fa-fw fa-plus"></i>{{ __('NUEVO') }}
                                </a>
                            </div>
                        </div>
                    </div>                  
                        <!--Ventana Modal para Crear--->
                        @include('color-case.modalCrear')
                    <div class="card">
                        <div class="table-responsive table-hover">
                            <table class="table table-striped ">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Color</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colorCases as $colorCase)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $colorCase->color }}</td>

                                            <td>
                                                <form action="{{ route('color-cases.destroy', $colorCase->id) }}" method="POST" class="formEliminar">
                                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit{{ $colorCase->id }}"><i class="fa fa-fw fa-edit" ></i> {{ __('EDITAR') }}</button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form>                                            
                                            </td>
                                        </tr>
                                            <!--Ventana Modal para Actualizar--->
                                            @include('color-case.modalEdit')
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <th>No</th>
									<th >Color</th>
                                    <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div>
                    </div>
                </div>
                {!! $colorCases->withQueryString()->links() !!}
            </div>
        </div>
    </div>
      </div>
    </div>
  </div>
</div>

@endsection














