@extends('layouts.app')

@section('title', 'PANEL')

@section('content_header')
    <div class="header-panel">

        <div class="header-left">
            <h1 class="header-title">Panel de control</h1>

            <div class="header-subtitle">
                Usuario: 
                <strong>{{ $user->name }} {{ $user->paterno }} {{ $user->materno }}</strong>
            </div>
        </div>

        <div class="header-actions">


        @if(auth()->check() && auth()->user()->hasAnyRole([
            'Administrador',
            'SuperAdministrador'
        ]))
        <div class="header-actions">
                <a href="{{ route('equipos.reporte') }}" class="btn-header">
                    <i class="fas fa-file-pdf"></i>
                    REPORTES DE EQUIPOS ATENDIDOS
                </a>
                <a href="{{ route('resultado') }}" class="btn-header">
                    <i class="fas fa-file-pdf"></i>
                    RESULTADOS DE MANTENIMIENTO
                </a>
                <button type="button" class="btn-header" data-toggle="modal" data-target="#modalReporte">
                        <i class="fas fa-file-pdf"></i>REPORTE GENERAL TÉCNICOS
                </button>
                    <!--Ventana Modal para Reporte--->
                    @include('tecnico.modalReporte')  

                 <script>
                document.addEventListener('DOMContentLoaded', function () {

                    const tipo = document.getElementById('tipoReporte');
                    const contenedorMes = document.getElementById('contenedorMes');

                    tipo.addEventListener('change', function () {

                        if (this.value === 'mes') {
                            contenedorMes.style.display = 'block';
                        } else {
                            contenedorMes.style.display = 'none';
                        }

                    });

                });
                </script>
        </div>
            <a href="{{ route('estadistica') }}" class="btn-header">
                <i class="fas fa-chart-line"></i>
                ESTADISTICA GENERAL
            </a>

                <div class="notificacion-servicios">

                    <a href="{{ route('servicios.index') }}"
                    class="btn-notificacion-servicios"
                    title="Servicios de soporte pendientes de atención">

                        <span class="icono-campana">
                            <i class="fas fa-bell"></i>

                            @if($nuevasSolicitudes > 0)
                                <span class="badge-notificacion">
                                    {{ $nuevasSolicitudes }}
                                </span>
                            @endif
                        </span>

                        <span class="texto-notificacion">
                            <span class="titulo-notificacion">
                                Requerimientos
                            </span>

                            <span class="subtitulo-notificacion">
                                @if($nuevasSolicitudes > 0)
                                    {{ $nuevasSolicitudes }} nueva{{ $nuevasSolicitudes > 1 ? 's' : '' }} solicitud{{ $nuevasSolicitudes > 1 ? 'es' : '' }}
                                @else
                                    Sin nuevas solicitudes
                                @endif
                            </span>
                        </span>

                    </a>

                </div>

        @endif


            @role('Tecnico')
                <a href="{{ route('estadistica.tecnico') }}" class="btn-header">
                    <i class="fas fa-chart-line"></i>
                    Mis estadisticas
                </a>
                <div class="notificacion-servicios">

                    <a href="{{ route('asignaciones.asistencia') }}"
                    class="btn-notificacion-servicios"
                    title="Servicios asignados pendientes de atención">

                        <span class="icono-campana">
                            <i class="fas fa-bell"></i>

                            @if($nuevasSolicitudesTecnico > 0)
                                <span class="badge-notificacion">
                                    {{ $nuevasSolicitudesTecnico }}
                                </span>
                            @endif
                        </span>

                        <span class="texto-notificacion">

                            <span class="titulo-notificacion">
                                Mis servicios
                            </span>

                            <span class="subtitulo-notificacion">
                                @if($nuevasSolicitudesTecnico > 0)
                                    {{ $nuevasSolicitudesTecnico }}
                                    nueva{{ $nuevasSolicitudesTecnico > 1 ? 's' : '' }}
                                    solicitud{{ $nuevasSolicitudesTecnico > 1 ? 'es' : '' }}
                                @else
                                    Sin nuevas solicitudes
                                @endif
                            </span>

                        </span>

                    </a>

                </div>
            @endrole
        </div>

    </div>

@stop

@section('content')
        @if(auth()->check() && auth()->user()->hasAnyRole([
            'Administrador',
            'SuperAdministrador'
        ]))

     @include('panel.panel')

        @endif

    @role('Tecnico')
    @include('panelTecnico.panel')
    @endrole
@stop


@section('css')
<style>
    /* =========================================
   NOTIFICACIÓN DE SERVICIOS
   ========================================= */
.notificacion-servicios {
    display: flex;
    align-items: center;
}

.btn-notificacion-servicios {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 210px;
    padding: 9px 14px;
    background: #ffffff;
    color: #1e2a38 !important;
    border: 1px solid #dce3ea;
    border-radius: 10px;
    text-decoration: none !important;
    transition: all 0.25s ease;
    box-shadow: 0 2px 7px rgba(0, 0, 0, 0.06);
}

.btn-notificacion-servicios:hover {
    background: #f7f9fb;
    border-color: #b9c6d3;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.09);
    transform: translateY(-1px);
}

/* Campana */

.icono-campana {
    position: relative;
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #eef4fa;
    color: #1e5f94;
    border-radius: 9px;
    flex-shrink: 0;
}

.icono-campana i {
    font-size: 18px;
}

/* Contador */

.badge-notificacion {
    position: absolute;
    top: -5px;
    right: -5px;

    min-width: 19px;
    height: 19px;
    padding: 0 5px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #dc3545;
    color: #ffffff;

    border: 2px solid #ffffff;
    border-radius: 50px;

    font-size: 10px;
    font-weight: 700;
    line-height: 1;
}

/* Texto */

.texto-notificacion {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
    text-align: left;
}

.titulo-notificacion {
    font-size: 13px;
    font-weight: 700;
    color: #1e2a38;
}

.subtitulo-notificacion {
    margin-top: 3px;
    font-size: 11px;
    color: #7b8794;
}

/* Cuando existen nuevas solicitudes */

.btn-notificacion-servicios:has(.badge-notificacion) .icono-campana {
    color: #c0392b;
    background: #fff1f1;
}

.btn-notificacion-servicios:has(.badge-notificacion) .icono-campana i {
    animation: campanaNotificacion 1.8s ease-in-out infinite;
}
@keyframes campanaNotificacion {
    0%,
    100% {
        transform: rotate(0deg);
    }
    10% {
        transform: rotate(10deg);
    }
    20% {
        transform: rotate(-10deg);
    }
    30% {
        transform: rotate(7deg);
    }
    40% {
        transform: rotate(-7deg);
    }
    50% {
        transform: rotate(0deg);
    }
}

/* Responsive */

@media (max-width: 768px) {
    .btn-notificacion-servicios {
        min-width: auto;
        padding: 8px 10px;
    }
    .texto-notificacion {
        display: none;
    }
    .icono-campana {
        width: 36px;
        height: 36px;
    }
}
</style>
@stop
@section('js')

@stop