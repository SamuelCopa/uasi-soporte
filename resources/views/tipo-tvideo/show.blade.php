@extends('adminlte::page') 

@section('template_title')
    {{ $tipoTvideo->name ?? __('Show') . " " . __('Tipo Tvideo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Tipo Tvideo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('tipo-tvideos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipo:</strong>
                                    {{ $tipoTvideo->tipo }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
