@extends('layouts.app')

@section('template_title')
    Modelo Wifis
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Modelo Wifi') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('modelo-wifis.create') }}" class="btn btn-primary float-right"  data-placement="left">
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
                                    @foreach ($modeloWifis as $modeloWifi)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $modeloWifi->modelo }}</td>

                                            <td>
                                                <form action="{{ route('modelo-wifis.destroy', $modeloWifi->id) }}" method="POST" class="formEliminar">
                                                    <a class="btn btn-sm btn-success" href="{{ route('modelo-wifis.edit', $modeloWifi->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>
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
                {!! $modeloWifis->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
