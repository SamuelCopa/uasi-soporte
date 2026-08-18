@extends('adminlte::page') 

@section('template_title')
    {{ $marcaRam->name ?? __('Show') . " " . __('Marca Ram') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Marca Ram</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('marca-rams.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Marca:</strong>
                                    {{ $marcaRam->marca }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
