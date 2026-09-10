@extends('layouts.app')

@section('content')

@php
/*
|--------------------------------------------------------------------------
| TIPOS DE EQUIPO ASIGNADOS AL TÉCNICO
|--------------------------------------------------------------------------
*/

$asignaciones = [

    [
        'nombre' => 'CPUs',
        'titulo' => 'CPUs ASIGNADOS',
        'relacion' => 'registro_cpus',
        'icon' => 'fas fa-desktop',
        'ruta' => 'admin.asigCpu'
    ],

    [
        'nombre' => 'Impresoras',
        'titulo' => 'IMPRESORAS ASIGNADAS',
        'relacion' => 'impresoras',
        'icon' => 'fas fa-print',
        'ruta' => 'admin.asigImpresora'
    ],

    [
        'nombre' => 'Monitores',
        'titulo' => 'MONITORES ASIGNADOS',
        'relacion' => 'monitor',
        'icon' => 'fas fa-tv',
        'ruta' => 'admin.asigMonitor'
    ],

    [
        'nombre' => 'Audífonos',
        'titulo' => 'AUDÍFONOS ASIGNADOS',
        'relacion' => 'audifonos',
        'icon' => 'fas fa-headphones',
        'ruta' => 'admin.asigAudifono'
    ],

    [
        'nombre' => 'Laptops',
        'titulo' => 'LAPTOPS ASIGNADOS',
        'relacion' => 'laptop',
        'icon' => 'fas fa-laptop',
        'ruta' => 'admin.asigLaptop'
    ],

    [
        'nombre' => 'Teclados',
        'titulo' => 'TECLADOS ASIGNADOS',
        'relacion' => 'teclados',
        'icon' => 'fas fa-keyboard',
        'ruta' => 'admin.asigTeclado'
    ],

    [
        'nombre' => 'Parlantes',
        'titulo' => 'PARLANTES ASIGNADOS',
        'relacion' => 'parlantes',
        'icon' => 'fas fa-volume-up',
        'ruta' => 'admin.asigParlante'
    ],

    [
        'nombre' => 'Mouse',
        'titulo' => 'MOUSE ASIGNADOS',
        'relacion' => 'raton',
        'icon' => 'fas fa-mouse',
        'ruta' => 'admin.asigMouse'
    ],

    [
        'nombre' => 'UPS',
        'titulo' => 'UPS ASIGNADOS',
        'relacion' => 'upeses',
        'icon' => 'fas fa-battery-full',
        'ruta' => 'admin.asigUps'
    ],

    [
        'nombre' => 'Estabilizadores',
        'titulo' => 'ESTABILIZADORES ASIGNADOS',
        'relacion' => 'estabilizador',
        'icon' => 'fas fa-plug',
        'ruta' => 'admin.asigEstabilizador'
    ],

];

/*
|--------------------------------------------------------------------------
| ESTADOS
|--------------------------------------------------------------------------
*/

$estados = [
    1 => [
        'label' => 'Recepcionados',
        'icon' => 'fas fa-inbox',
        'color' => '#17a2b8',
        'clase' => 'estado-info'
    ],

    2 => [
        'label' => 'En proceso',
        'icon' => 'fas fa-tools',
        'color' => '#ffc107',
        'clase' => 'estado-warning'
    ],

    3 => [
        'label' => 'Apersonarse con el técnico',
        'icon' => 'fas fa-user-clock',
        'color' => '#dc3545',
        'clase' => 'estado-danger'
    ],

    4 => [
        'label' => 'Concluido',
        'icon' => 'fas fa-check-circle',
        'color' => '#28a745',
        'clase' => 'estado-success'
    ],

    5 => [
        'label' => 'Entregados',
        'icon' => 'fas fa-hand-holding',
        'color' => '#007bff',
        'clase' => 'estado-primary'
    ],
];

/*
|--------------------------------------------------------------------------
| PENDIENTES DEL TÉCNICO
|--------------------------------------------------------------------------
*/

$pendientes = [];
$totalPendientes = 0;
$totalAsignados = 0;

foreach ($asignaciones as $item) {

    $rel = $item['relacion'];

    $cantidadPendiente = $user->$rel()
        ->whereIn('estado_id', [1, 2, 3, 4])
        ->whereYear('fecha_asignacion', date('Y'))
        ->count();

    $cantidadTotal = $user->$rel()
        ->whereYear('fecha_asignacion', date('Y'))
        ->count();

    $totalPendientes += $cantidadPendiente;
    $totalAsignados += $cantidadTotal;

    if ($cantidadPendiente > 0) {
        $pendientes[] = [
            'nombre' => $item['nombre'],
            'icon' => $item['icon'],
            'cantidad' => $cantidadPendiente
        ];
    }
}

@endphp

{{-- =========================================================
ENCABEZADO DEL PANEL
========================================================= --}}

@section('content_header')

<div class="header-panel">
<div class="header-left">
    <div class="header-user-icon">
        <i class="fas fa-user-cog"></i>
    </div>

    <div>

        <span class="header-section">
            SEGUIMIENTO DE TÉCNICO
        </span>

        <h3 class="header-title">

            {{ $user->name }}
            {{ $user->paterno }}
            {{ $user->materno }}

        </h3>

    </div>

</div>


<div class="header-actions">

    <a
        href="{{ route('admin.TecnicoEstadistica', $user->id) }}"
        class="btn-header"
    >
        <i class="fas fa-chart-line"></i>
        <span>Estadística</span>
    </a>


    <button
        type="button"
        class="btn-header"
        data-toggle="modal"
        data-target="#modalReporte"
    >
        <i class="fas fa-file-pdf"></i>
        <span>Reporte PDF</span>
    </button>


    <a
        href="{{ route('tecnicos.index') }}"
        class="btn-header"
    >
        <i class="fas fa-arrow-left icono"></i>
        <span>Volver</span>
    </a>

</div>

</div>

{{-- Modal de reporte --}}

@include('asigTecnicos.modalReporte')

@stop

{{-- =========================================================
NOTIFICACIONES
========================================================= --}}

<div class="tecnico-dashboard-toolbar">

<div class="dashboard-summary">

    <div class="summary-item">

        <div class="summary-icon">
            <i class="fas fa-laptop"></i>
        </div>

        <div>

            <span class="summary-label">
                Equipos asignados
            </span>

            <strong class="summary-number">
                {{ $totalAsignados }}
            </strong>

        </div>

    </div>


    <div class="summary-item">

        <div class="summary-icon summary-warning">
            <i class="fas fa-clock"></i>
        </div>

        <div>

            <span class="summary-label">
                Trabajos pendientes
            </span>

            <strong class="summary-number">
                {{ $totalPendientes }}
            </strong>

        </div>

    </div>

</div>


{{-- CAMPANA --}}

<div class="dropdown">

    <button
        type="button"
        class="btn-notificaciones-tecnico position-relative"
        id="btnNotificacionesTecnico"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        title="Notificaciones"
    >

        <i class="fas fa-bell"></i>

        @if($totalPendientes > 0)

            <span class="badge-notificacion">
                {{ $totalPendientes }}
            </span>

        @endif

    </button>


    <div
        class="dropdown-menu dropdown-menu-right notification-panel-tecnico"
        aria-labelledby="btnNotificacionesTecnico"
    >

        <div class="notification-header-tecnico">

            <div>

                <i class="fas fa-bell mr-2"></i>
                NOTIFICACIONES

            </div>

            <small>
                Seguimiento de actividades
            </small>

        </div>


        @if($totalPendientes == 0)

            <div class="notification-empty">

                <i class="fas fa-check-circle"></i>

                <strong>
                    Todo está al día
                </strong>

                <small>
                    El técnico no tiene trabajos pendientes.
                </small>

            </div>

        @else

            <div class="notification-title">

                <i class="fas fa-exclamation-circle"></i>

                Trabajos pendientes

                <span>
                    {{ $totalPendientes }}
                </span>

            </div>


            @foreach($pendientes as $item)

                <div class="notification-item">

                    <div class="notification-item-icon">
                        <i class="{{ $item['icon'] }}"></i>
                    </div>

                    <div class="notification-item-info">

                        <strong>
                            {{ $item['nombre'] }}
                        </strong>

                        <small>
                            Pendientes de atención
                        </small>

                    </div>

                    <span class="notification-count">
                        {{ $item['cantidad'] }}
                    </span>

                </div>

            @endforeach

        @endif


        <div class="notification-footer">

            <small>
                Gestión {{ date('Y') }}
            </small>

        </div>

    </div>

</div>

</div>

{{-- =========================================================
SWEET ALERT
========================================================= --}}

@if(count($pendientes) > 0)

<script>

document.addEventListener('DOMContentLoaded', function () {

    let html = `
        <div class="swal-grid">

            @foreach($pendientes as $item)

                <div class="swal-card">

                    <div class="swal-card-title">

                        <span class="swal-icon">
                         <i class="ion {{ $item['icon'] }}"></i>
                        </span>

                        <span>
                            {{ $item['nombre'] }}
                        </span>

                    </div>

                    <div class="swal-card-body">

                        <div class="swal-item">

                            <span class="label">
                                Trabajos pendientes
                            </span>

                            <span class="value">
                                {{ $item['cantidad'] }}
                            </span>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="swal-msg">

            Existen asignaciones pendientes
            que requieren seguimiento.

        </div>
    `;


    Swal.fire({

        title: 'Seguimiento del técnico',

        html: html,

        icon: 'info',

        confirmButtonText: 'Aceptar',

        width: '520px',

        customClass: {
            popup: 'swal-institucional'
        }

    });

});

</script>

@else

<script>

document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({

        title: '¡BUEN TRABAJO!',

        text: 'El técnico no tiene trabajos pendientes.',

        icon: 'success',

        confirmButtonText: 'Continuar',

        width: '450px',

        customClass: {
            popup: 'swal-institucional'
        }

    });

});

</script>

@endif

{{-- =========================================================
TARJETAS DE EQUIPOS
========================================================= --}}

<div class="row">

@foreach($asignaciones as $item)

    @php

        $rel = $item['relacion'];

        $totalReal = $user->$rel()
            ->whereYear('fecha_asignacion', date('Y'))
            ->count();

        $total = $totalReal ?: 1;

        $pendienteEquipo = $user->$rel()
            ->whereIn('estado_id', [1,2,3,4])
            ->whereYear('fecha_asignacion', date('Y'))
            ->count();

    @endphp


    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">

        <div
            class="
                dashboard-card-prof
                {{ $pendienteEquipo > 0 ? 'card-alert' : '' }}
            "
        >

            {{-- HEADER --}}

            <div class="card-body">

                <div class="card-header-custom">

                    <div class="card-title-wrapper">

                        <div class="card-icon-wrapper">

                            <i class="ion {{ $item['icon'] }}"></i>

                        </div>

                        <div>

                            <span class="card-title">

                                {{ $item['nombre'] }}

                            </span>

                            <small class="card-subtitle">

                                Seguimiento · Gestión {{ date('Y') }}

                            </small>

                        </div>

                    </div>

                </div>


                {{-- TOTAL --}}

                <div class="card-main-total">

                    <span class="total-number">

                        {{ $totalReal }}

                    </span>

                    <span class="total-label">

                        Equipos asignados

                    </span>

                </div>


                {{-- ESTADOS --}}

                <div class="card-stats">

                    @foreach($estados as $id => $estado)

                        @php

                            $valor = $user->$rel()
                                ->where('estado_id', $id)
                                ->whereYear(
                                    'fecha_asignacion',
                                    date('Y')
                                )
                                ->count();

                            $porcentaje = $total > 0
                                ? ($valor / $total) * 100
                                : 0;

                        @endphp


                        <div class="stat-row">

                            <span class="stat-label">

                                <i
                                    class="{{ $estado['icon'] }} stat-icon"
                                    style="color: {{ $estado['color'] }};"
                                ></i>

                                {{ $estado['label'] }}

                            </span>


                            <span class="stat-value">

                                {{ $valor }}

                            </span>

                        </div>


                        <div class="progress-custom">

                            <div
                                class="mini-bar-fill"
                                style="
                                    width: {{ min($porcentaje, 100) }}%;
                                    background-color: {{ $estado['color'] }};
                                "
                            ></div>

                        </div>

                    @endforeach

                </div>


                {{-- ESTADO DEL TÉCNICO --}}

                <div
                    class="
                        technician-status
                        {{ $pendienteEquipo > 0
                            ? 'technician-pending'
                            : 'technician-ok' }}
                    "
                >

                    <div class="technician-icon">

                        <i class="fas fa-user-cog"></i>

                    </div>


                    <div class="technician-info">

                        <span>

                            {{ $pendienteEquipo > 0
                                ? 'Seguimiento pendiente'
                                : 'Sin pendientes' }}

                        </span>

                        <strong>

                            {{ $pendienteEquipo }}

                        </strong>

                    </div>


                    @if($pendienteEquipo > 0)

                        <i
                            class="
                                fas
                                fa-exclamation-circle
                                technician-alert
                            "
                        ></i>

                    @else

                        <i
                            class="
                                fas
                                fa-check-circle
                                technician-check
                            "
                        ></i>

                    @endif

                </div>

            </div>


            {{-- FOOTER --}}

            <a
                href="{{ route($item['ruta'], $user->id) }}"
                class="card-footer-custom"
            >

                <span>
                    Ver seguimiento
                </span>

                <i class="fas fa-arrow-right"></i>

            </a>

        </div>

    </div>

@endforeach

</div>

<link
    rel="stylesheet"
    href="{{ asset('estilos/panelAsig.css') }}"
>

@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endsection
