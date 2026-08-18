@extends('layouts.app')

@section('template_title')
    {{ $registro->name ?? __('Show') . " " . __('Registro') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Registro</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('registros.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha:</strong>
                                    {{ $registro->fecha }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Asignacion:</strong>
                                    {{ $registro->fecha_asignacion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Inicio:</strong>
                                    {{ $registro->fecha_inicio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Entrega:</strong>
                                    {{ $registro->fecha_entrega }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cod Registro:</strong>
                                    {{ $registro->cod_registro }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Falla:</strong>
                                    {{ $registro->falla }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Respaldo:</strong>
                                    {{ $registro->respaldo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Observaciones:</strong>
                                    {{ $registro->observaciones }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Otro:</strong>
                                    {{ $registro->otro }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cpu Id:</strong>
                                    {{ $registro->cpu_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Impresora Id:</strong>
                                    {{ $registro->impresora_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Raton Id:</strong>
                                    {{ $registro->raton_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Parlante Id:</strong>
                                    {{ $registro->parlante_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Teclado Id:</strong>
                                    {{ $registro->teclado_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Laptop Id:</strong>
                                    {{ $registro->laptop_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Monitor Id:</strong>
                                    {{ $registro->monitor_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Audifono Id:</strong>
                                    {{ $registro->audifono_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estabilizador Id:</strong>
                                    {{ $registro->estabilizador_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Ups Id:</strong>
                                    {{ $registro->ups_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>User Id:</strong>
                                    {{ $registro->user_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Resultado Id:</strong>
                                    {{ $registro->resultado_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
