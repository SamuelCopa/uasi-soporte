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

            @role('Administrador')
                <a href="{{ route('estadistica') }}" class="btn-header">
                    <i class="fas fa-chart-line"></i>
                    Estadística general
                </a>
            @endrole

            @role('Tecnico')
                <a href="{{ route('estadistica.tecnico') }}" class="btn-header">
                    <i class="fas fa-chart-line"></i>
                    Mis estadisticas
                </a>
            @endrole
        </div>
        <div>
<a href="{{ route('servicios.index') }}" class="nav-link">

@if($nuevasSolicitudes > 0)

<h1 class="badge bg-danger fs-6">
    🔔 {{ $nuevasSolicitudes }} NUEVAS
</h1>

@endif

</a>


        </div>
    </div>

@stop

@section('content')
    @role('Administrador')
    @include('panel.panel')
    @endrole

    @role('Tecnico')
    @include('panelTecnico.panel')
    @endrole
@stop


@section('css')

<style>

 .badge-notificacion {
    position: absolute;
    top: -8px;
    right: -10px;

    min-width: 25px;
    height: 25px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #dc3545;
    color: white;

    font-size: 14px;
    font-weight: bold;

    border-radius: 50%;

    animation: alerta 1s infinite;
}


@keyframes alerta {

    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(1.3);
    }

    100% {
        transform: scale(1);
    }

}

/* Contenedor principal */
.header-panel {
    display: flex;
    justify-content: space-between;
    align-items: center;

    border: 1px solid #dee2e6;
    padding: 14px 18px;
    border-radius: 6px;

    margin-bottom: 16px;

    /* Fondo institucional sobrio */

}
.header-left {
    display: flex;
    flex-direction: column;
}
.header-title {
    margin: 0;
    font-size: 15px;
    font-weight: 700;

    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.header-subtitle {
    font-size: 13px;
    margin-top: 2px;
}
.header-meta {
    font-size: 12px;
    color: #6c757d;
}
.header-actions {
    display: flex;
    gap: 8px;
}
.btn-header {
    display: inline-flex;
    align-items: center;
    gap: 6px;

    padding: 6px 12px;
    font-size: 13px;
    font-weight: 600;

    border: 1px solid #0d6efd;
    background: #ffffff;
    color: #0d6efd;

    border-radius: 5px;
    text-decoration: none;

    transition: all 0.2s ease;
}

.btn-header:hover {
    background: #0d6efd;
    color: #ffffff;
    transform: translateY(-1px);
}
@media (max-width: 768px) {
    .header-panel {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .header-actions {
        width: 100%;
    }

    .btn-header {
        flex: 1;
        justify-content: center;
    }
}
</style>
<style>
.campana-parpadeo {
    animation: parpadear 1s infinite;
}

@keyframes parpadear {
    0%, 100% {
        opacity: 1;
    }

    50% {
        opacity: 0.2;
    }
}
</style>
@stop

@section('js')

@stop