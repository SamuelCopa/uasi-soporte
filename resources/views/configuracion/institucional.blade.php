
@extends('layouts.app')

@section('title', 'Configuración institucional')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="font-weight-bold">
                <i class="fas fa-cogs text-primary mr-2"></i>
                Configuración del sistema
            </h1>

            <p class="text-muted mb-0">
                Gobierno Autónomo Municipal de El Alto
                <span class="mx-1">|</span>
                Unidad de Administración de Sistemas de Información
            </p>
        </div>

        <span class="badge badge-primary p-2 mt-2">
            SISTEMA SOPORTE
        </span>
    </div>
@stop

@section('content')

    {{-- MENSAJES DE CONFIRMACIÓN --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif


    {{-- ENCABEZADO INSTITUCIONAL --}}
    <div class="card card-primary card-outline institucional-hero">
        <div class="card-body p-4">
            <div class="row align-items-center">

                <div class="col-md-9">
                    <span class="institucional-etiqueta">
                        UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
                    </span>

                    <h3 class="font-weight-bold mt-3 mb-2">
                        Gestión de soporte técnico
                    </h3>

                    <p class="text-muted mb-0">
                        Accede a los reportes, resultados de mantenimiento,
                        estadísticas y requerimientos del sistema.
                        Administra también las notificaciones por correo.
                    </p>
                </div>

                <div class="col-md-3 text-center mt-3 mt-md-0">
                    <i class="fas fa-laptop-medical institucional-icono"></i>
                </div>

            </div>
        </div>
    </div>


    {{-- ACCESOS DIRECTOS DEL SISTEMA --}}
    <div class="card card-outline card-primary accesos-institucionales">

        <div class="card-header">
            <h3 class="card-title font-weight-bold">
                <i class="fas fa-th-large text-primary mr-2"></i>
                Accesos directos y gestión de soporte
            </h3>
        </div>

        <div class="card-body">

            <div class="header-actions">

                {{-- REPORTES DE EQUIPOS ATENDIDOS --}}
                <a href="{{ route('equipos.reporte') }}"
                   class="btn-header">

                    <span class="btn-header-icon">
                        <i class="fas fa-file-pdf"></i>
                    </span>

                    <span class="btn-header-text">
                        <strong>Reportes de equipos atendidos</strong>
                        <small>Consultar e imprimir reportes</small>
                    </span>

                    <i class="fas fa-chevron-right btn-header-arrow"></i>
                </a>


                {{-- RESULTADOS DE MANTENIMIENTO --}}
                <a href="{{ route('resultado') }}"
                   class="btn-header">

                    <span class="btn-header-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </span>

                    <span class="btn-header-text">
                        <strong>Resultados de mantenimiento</strong>
                        <small>Consultar resultados registrados</small>
                    </span>

                    <i class="fas fa-chevron-right btn-header-arrow"></i>
                </a>


                {{-- REPORTE GENERAL DE TÉCNICOS --}}
                <button type="button"
                        class="btn-header"
                        data-toggle="modal"
                        data-target="#modalReporte">

                    <span class="btn-header-icon">
                        <i class="fas fa-file-pdf"></i>
                    </span>

                    <span class="btn-header-text">
                        <strong>Reporte general de técnicos</strong>
                        <small>Generar reportes de atención técnica</small>
                    </span>

                    <i class="fas fa-chevron-right btn-header-arrow"></i>
                </button>


                {{-- ESTADÍSTICA GENERAL --}}
                <a href="{{ route('estadistica') }}"
                   class="btn-header">

                    <span class="btn-header-icon">
                        <i class="fas fa-chart-line"></i>
                    </span>

                    <span class="btn-header-text">
                        <strong>Estadística general</strong>
                        <small>Consultar indicadores del sistema</small>
                    </span>

                    <i class="fas fa-chevron-right btn-header-arrow"></i>
                </a>


                {{-- REQUERIMIENTOS --}}
            </div>
        </div>
    </div>


    {{-- MODAL DE REPORTE GENERAL DE TÉCNICOS --}}
    @include('tecnico.modalReporte')


    {{-- CONFIGURACIÓN DE NOTIFICACIONES POR CORREO --}}
    <div class="row">

        <div class="col-lg-7 col-md-12">
            <div class="card card-outline card-primary correo-card">

                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-envelope mr-2"></i>
                        Notificaciones por correo electrónico
                    </h3>
                </div>

                <div class="card-body">

                    <div class="correo-contenido">

                        <div class="correo-icono
                            {{ $correoHabilitado ? 'correo-activo' : 'correo-inactivo' }}">

                            <i class="fas
                                {{ $correoHabilitado
                                    ? 'fa-envelope-open-text'
                                    : 'fa-envelope' }}">
                            </i>
                        </div>

                        <div class="correo-informacion">

                            <h5 class="font-weight-bold mb-2">
                                Estado del envío de correos
                            </h5>

                            <span class="badge
                                {{ $correoHabilitado
                                    ? 'badge-success'
                                    : 'badge-danger' }} px-3 py-2">

                                {{ $correoHabilitado
                                    ? 'HABILITADO'
                                    : 'DESHABILITADO' }}
                            </span>

                            <p class="text-muted mt-2 mb-0">
                                {{ $correoHabilitado
                                    ? 'El sistema puede encolar nuevas notificaciones por correo.'
                                    : 'El sistema no encolará nuevas notificaciones por correo.' }}
                            </p>

                        </div>
                    </div>

                    <hr>

                    <div class="alert alert-light border">
                        <i class="fas fa-info-circle text-primary mr-1"></i>

                        Este ajuste controla las notificaciones enviadas
                        mediante NotificacionService. Las demás operaciones
                        del sistema continúan funcionando normalmente.
                    </div>

                    <form
                        action="{{ route('configuracion.correo.cambiar') }}"
                        method="POST"
                        onsubmit="return confirm('¿Deseas cambiar el estado del envío de correos?');">

                        @csrf

                        <button type="submit"
                                class="btn btn-block py-2 font-weight-bold
                                {{ $correoHabilitado
                                    ? 'btn-outline-danger'
                                    : 'btn-primary' }}">

                            <i class="fas
                                {{ $correoHabilitado
                                    ? 'fa-toggle-off'
                                    : 'fa-toggle-on' }} mr-2">
                            </i>

                            {{ $correoHabilitado
                                ? 'Deshabilitar envío de correos'
                                : 'Habilitar envío de correos' }}
                        </button>

                    </form>

                </div>
            </div>
        </div>


        {{-- INFORMACIÓN DE FUNCIONAMIENTO --}}
        <div class="col-lg-5 col-md-12">
            <div class="card card-outline card-secondary correo-card">

                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-info-circle mr-2"></i>
                        Información del sistema
                    </h3>
                </div>

                <div class="card-body">

                    <div class="info-sistema-item">
                        <i class="fas fa-landmark"></i>

                        <div>
                            <small>Institución</small>
                            <strong>
                                Gobierno Autónomo Municipal de El Alto
                            </strong>
                        </div>
                    </div>

                    <div class="info-sistema-item">
                        <i class="fas fa-network-wired"></i>

                        <div>
                            <small>Unidad responsable</small>
                            <strong>
                                Administración de Sistemas de Información
                            </strong>
                        </div>
                    </div>

                    <div class="info-sistema-item">
                        <i class="fas fa-tools"></i>

                        <div>
                            <small>Área</small>
                            <strong>Soporte Técnico</strong>
                        </div>
                    </div>

                    <div class="info-sistema-item border-0">
                        <i class="fas fa-desktop"></i>

                        <div>
                            <small>Sistema</small>
                            <strong>Soporte</strong>
                            <p class="text-muted mb-0 mt-1">
                                Control y seguimiento de servicios técnicos.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


    {{-- NOTA INFORMATIVA --}}
    <div class="nota-institucional">
        <i class="fas fa-shield-alt mr-2"></i>
        Los cambios de configuración se guardan en la base de datos.
        Los correos que ya estaban pendientes en la cola podrían enviarse
        aunque se deshabiliten nuevas notificaciones.
    </div>

@stop


@section('css')
<style>
    /* ENCABEZADO INSTITUCIONAL */

    .institucional-hero {
        border-radius: 12px;
        overflow: hidden;
        background: linear-gradient(120deg, #fff 30%, #edf5ff 100%);
        box-shadow: 0 4px 18px rgba(20, 50, 90, .06);
    }

    .institucional-hero .card-body {
        border-left: 5px solid #1769aa;
    }

    .institucional-etiqueta {
        color: #1769aa;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .8px;
    }

    .institucional-icono {
        font-size: 76px;
        color: #1769aa;
        opacity: .8;
    }


    /* ACCESOS DIRECTOS */

    .accesos-institucionales {
        border-radius: 12px;
        border-top: 3px solid #1769aa !important;
        box-shadow: 0 4px 18px rgba(20, 50, 90, .06);
        overflow: hidden;
    }

    .accesos-institucionales .card-header,
    .correo-card .card-header {
        background: #fff;
        padding: 16px 20px;
        border-bottom: 1px solid #edf0f4;
    }

    .accesos-institucionales .card-body {
        padding: 20px;
    }

    .header-actions {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .btn-header {
        display: flex;
        align-items: center;
        gap: 13px;
        width: 100%;
        min-height: 82px;
        padding: 14px;
        color: #29384a !important;
        text-align: left;
        text-decoration: none !important;
        background: #fff;
        border: 1px solid #e2eaf3;
        border-radius: 10px;
        transition: all .2s ease;
        font-family: inherit;
        cursor: pointer;
    }

    .btn-header:hover {
        background: #f5f9ff;
        border-color: #9fc5ee;
        box-shadow: 0 5px 14px rgba(23, 105, 170, .09);
        transform: translateY(-2px);
    }

    .btn-header:focus {
        outline: 2px solid #1769aa;
        outline-offset: 2px;
    }

    .btn-header-icon {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 44px;
        height: 44px;
        color: #1769aa;
        background: #edf5ff;
        border-radius: 10px;
        font-size: 18px;
    }

    .btn-header-text {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 0;
        gap: 5px;
    }

    .btn-header-text strong {
        color: #24364b;
        font-size: 12px;
        font-weight: 700;
        line-height: 1.5;
    }

    .btn-header-text small {
        color: #7b8795;
        font-size: 11px;
        line-height: 1.4;
    }

    .btn-header-arrow {
        flex-shrink: 0;
        color: #9aa9b9;
        font-size: 11px;
    }

    .btn-icon-notificaciones {
        color: #b77912;
        background: #fff4df;
    }

    .badge-notificacion {
        position: absolute;
        top: -7px;
        right: -7px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 19px;
        height: 19px;
        padding: 0 5px;
        color: #fff;
        background: #dc3545;
        border: 2px solid #fff;
        border-radius: 12px;
        font-size: 10px;
        font-weight: 700;
    }


    /* CONFIGURACIÓN DE CORREO */

    .correo-card {
        border-radius: 10px;
        box-shadow: 0 4px 18px rgba(20, 50, 90, .05);
        overflow: hidden;
        height: calc(100% - 20px);
    }

    .correo-card .card-body {
        padding: 20px;
    }

    .correo-contenido {
        display: flex;
        align-items: center;
        gap: 17px;
        padding: 8px 0;
    }

    .correo-icono {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 66px;
        height: 66px;
        border-radius: 50%;
        font-size: 28px;
    }

    .correo-activo {
        color: #218653;
        background: #e6f5ed;
    }

    .correo-inactivo {
        color: #c0392b;
        background: #fff0f0;
    }

    .correo-informacion {
        min-width: 0;
    }

    .correo-informacion h5 {
        font-size: 15px;
    }

    .correo-informacion p {
        font-size: 12px;
        line-height: 1.6;
    }

    .correo-card .btn {
        border-radius: 7px;
        white-space: normal;
    }


    /* INFORMACIÓN DEL SISTEMA */

    .info-sistema-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 14px 0;
        border-bottom: 1px solid #edf0f4;
    }

    .info-sistema-item > i {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 38px;
        height: 38px;
        color: #1769aa;
        background: #edf5ff;
        border-radius: 9px;
    }

    .info-sistema-item div {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-sistema-item small {
        color: #7b8795;
    }

    .info-sistema-item strong {
        color: #29384a;
        font-size: 12px;
        line-height: 1.6;
    }


    /* NOTA FINAL */

    .nota-institucional {
        padding: 14px 17px;
        margin-bottom: 20px;
        color: #536579;
        background: #f2f7fc;
        border: 1px solid #e1ebf5;
        border-radius: 9px;
        font-size: 12px;
        line-height: 1.7;
    }


    /* RESPONSIVE */

    @media (max-width: 991px) {
        .header-actions {
            grid-template-columns: 1fr;
        }

        .institucional-icono {
            font-size: 55px;
        }

        .correo-card {
            height: auto;
        }
    }

    @media (max-width: 575px) {
        .accesos-institucionales .card-body {
            padding: 12px;
        }

        .btn-header {
            min-height: 75px;
            padding: 11px;
            gap: 10px;
        }

        .btn-header-icon {
            width: 39px;
            height: 39px;
            font-size: 16px;
        }

        .btn-header-text strong {
            font-size: 11px;
        }

        .institucional-etiqueta {
            line-height: 1.8;
        }

        .correo-contenido {
            align-items: flex-start;
        }
    }
</style>
@stop


@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tipo = document.getElementById('tipoReporte');
        const contenedorMes = document.getElementById('contenedorMes');

        if (tipo && contenedorMes) {
            function actualizarMes() {
                contenedorMes.style.display =
                    tipo.value === 'mes' ? 'block' : 'none';
            }

            tipo.addEventListener('change', actualizarMes);
            actualizarMes();
        }
    });
</script>
@stop
