@extends('layouts.app')

@section('template_title')
    Disipador Rams
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Disipador Rams') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('disipador-rams.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                <i class="fa fa-fw fa-plus"></i>{{ __('NUEVO') }}
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
                                        
									<th >Opcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($disipadorRams as $disipadorRam)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $disipadorRam->opcion }}</td>

                                            <td>
                                                <form action="{{ route('disipador-rams.destroy', $disipadorRam->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('disipador-rams.show', $disipadorRam->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('VER') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('disipador-rams.edit', $disipadorRam->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('EDITAR') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('ELIMINAR') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $disipadorRams->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
