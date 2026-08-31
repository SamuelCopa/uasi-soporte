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
                <a href="{{ route('equipos.reporte') }}" class="btn-header">
                    <i class="fas fa-chart-line"></i>
                    Reportes
                </a>

        @if(auth()->check() && auth()->user()->hasAnyRole([
            'Administrador',
            'SuperAdministrador'
        ]))
        <div class="header-actions">
                <a href="{{ route('resultado') }}" class="btn-header">
                    <i class="fas fa-chart-line"></i>
                    Ver Resultados del mantenimiento
                </a>
        </div>
            <a href="{{ route('estadistica') }}" class="btn-header">
                <i class="fas fa-chart-line"></i>
                Estadística general
            </a>

            <div>
                <a href="{{ route('servicios.index') }}" class="btn-header">

                    @if($nuevasSolicitudes > 0)
                        <h4>🔔 {{ $nuevasSolicitudes }} NUEVAS</h4>
                    @endif

                </a>
            </div>

        @endif


            @role('Tecnico')
                <a href="{{ route('estadistica.tecnico') }}" class="btn-header">
                    <i class="fas fa-chart-line"></i>
                    Mis estadisticas
                </a>
        <div>
            <a href="{{ route('asignaciones.asistencia') }}" class="btn-header">
            @if($nuevasSolicitudesTecnico > 0)
            <h4>🔔 {{ $nuevasSolicitudesTecnico }} NUEVAS</h4>
            @endif
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


@stop

@section('js')

@stop