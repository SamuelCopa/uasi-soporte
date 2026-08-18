@extends('adminlte::page') 

@section('template_title')
    Modelo Tvideos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Modelo Tarjeta de video') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('modelo-tvideos.create') }}" class="btn btn-primary float-right"  data-placement="left">
                                <i class="fa fa-fw fa-plus"></i>{{ __('NUEVO') }}
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
                                        
									<th >Modelo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modeloTvideos as $modeloTvideo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $modeloTvideo->modelo }}</td>

                                            <td>
                                                <form action="{{ route('modelo-tvideos.destroy', $modeloTvideo->id) }}" method="POST" class="formEliminar">
                                                    <a class="btn btn-sm btn-success" href="{{ route('modelo-tvideos.edit', $modeloTvideo->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>
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
                {!! $modeloTvideos->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
