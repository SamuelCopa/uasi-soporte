@extends('layouts.app')

@section('template_title')
    {{ $otrosEquipo->name ?? __('Show') . " " . __('Otros Equipo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Otros Equipo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('otros-equipos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Tipo Equipo Id:</strong>
                                    {{ $otrosEquipo->tipo_equipo_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cargo:</strong>
                                    {{ $otrosEquipo->cargo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cod Gamea:</strong>
                                    {{ $otrosEquipo->cod_gamea }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cod Registro:</strong>
                                    {{ $otrosEquipo->cod_registro }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha:</strong>
                                    {{ $otrosEquipo->fecha }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Asignacion:</strong>
                                    {{ $otrosEquipo->fecha_asignacion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Marca:</strong>
                                    {{ $otrosEquipo->marca }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Modelo:</strong>
                                    {{ $otrosEquipo->modelo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Falla:</strong>
                                    {{ $otrosEquipo->falla }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Otro:</strong>
                                    {{ $otrosEquipo->otro }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Observaciones:</strong>
                                    {{ $otrosEquipo->observaciones }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Inicio:</strong>
                                    {{ $otrosEquipo->fecha_inicio }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Fecha Entrega:</strong>
                                    {{ $otrosEquipo->fecha_entrega }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Dependencia Id:</strong>
                                    {{ $otrosEquipo->dependencia_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Estado Id:</strong>
                                    {{ $otrosEquipo->estado_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Responsable Id:</strong>
                                    {{ $otrosEquipo->responsable_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Funcionario Id:</strong>
                                    {{ $otrosEquipo->funcionario_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Resultado Id:</strong>
                                    {{ $otrosEquipo->resultado_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>User Id:</strong>
                                    {{ $otrosEquipo->user_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Reguser Id:</strong>
                                    {{ $otrosEquipo->reguser_id }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Boton Oculto:</strong>
                                    {{ $otrosEquipo->boton_oculto }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Funcionario Activo:</strong>
                                    {{ $otrosEquipo->funcionario_activo }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
