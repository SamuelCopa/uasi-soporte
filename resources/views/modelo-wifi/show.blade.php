@extends('layouts.app')

@section('template_title')
    {{ $modeloWifi->name ?? __('Show') . " " . __('Modelo Wifi') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Modelo Wifi</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('modelo-wifis.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Modelo:</strong>
                                    {{ $modeloWifi->modelo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Eliminado:</strong>
                                    {{ $modeloWifi->eliminado }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Eliminacion:</strong>
                                    {{ $modeloWifi->fecha_eliminacion }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
