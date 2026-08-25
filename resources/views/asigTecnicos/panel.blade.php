@extends('layouts.app')
@section('content')


@php
    $asignaciones = [
        ['nombre' => 'CPUs', 'relacion' => 'registro_cpus', 'icon' => '💻', 'color' => '#0d6efd'],
        ['nombre' => 'IMPRESORAS', 'relacion' => 'impresoras', 'icon' => '🖨️', 'color' => '#198754'],
        ['nombre' => 'MONITORES', 'relacion' => 'monitor', 'icon' => '🖥️', 'color' => '#ffc107'],
        ['nombre' => 'AUDÍFONOS', 'relacion' => 'audifonos', 'icon' => '🎧', 'color' => '#dc3545'],
        ['nombre' => 'TECLADOS', 'relacion' => 'teclados', 'icon' => '⌨️', 'color' => '#6f42c1'],
        ['nombre' => 'MOUSE', 'relacion' => 'raton', 'icon' => '🖱️', 'color' => '#0d6efd'],
        ['nombre' => 'LAPTOPS', 'relacion' => 'laptop', 'icon' => '💻', 'color' => '#198754'],
        ['nombre' => 'PARLANTES', 'relacion' => 'parlantes', 'icon' => '🔊', 'color' => '#ffc107'],
        ['nombre' => 'UPS', 'relacion' => 'upeses', 'icon' => '⚡', 'color' => '#0d6efd'],
        ['nombre' => 'ESTABILIZADORES', 'relacion' => 'estabilizador', 'icon' => '🔌', 'color' => '#198754'],
    ];

    $pendientes = [];

    foreach ($asignaciones as $item) {
        $rel = $item['relacion'];
        if ($user->$rel()->whereIn('estado_id', [1,2,3,4])->exists()) {
            $pendientes[] = [
                'nombre' => $item['nombre'],
                'icon' => $item['icon'],
                'color' => $item['color']
            ];
        }
    }
@endphp

@if(count($pendientes) > 0)
<script>
document.addEventListener('DOMContentLoaded', () => {

    @if(count($pendientes) > 0)

        let html = `
            <div class="swal-grid">
                @foreach($pendientes as $item)
                    <div class="swal-card">
                        <span class="swal-icon">{{ $item['icon'] }}</span>
                        <span>{{ $item['nombre'] }}</span>
                    </div>
                @endforeach
            </div>
            <div class="swal-msg">
                Existen asignaciones pendientes en proceso.
            </div>
        `;

        Swal.fire({
            title: 'Notificación de pendientes',
            html: html,
            icon: 'info',
            confirmButtonText: 'Aceptar',
            width: '520px',
            customClass: {
                popup: 'swal-institucional'
            }
        });

    @else

        Swal.fire({
            title: 'Estado del sistema',
            text: 'No existen pendientes registrados.',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            width: '450px',
            customClass: {
                popup: 'swal-institucional'
            }
        });

    @endif

});
</script>
@else
<script>
document.addEventListener('DOMContentLoaded', () => {
    Swal.fire({
        title: '🎉 ¡BUEN TRABAJO!',
        text: 'No tiene trabajos pendientes.',
        icon: 'success',
        color: '#1b5e20',
        confirmButtonColor: '#28a745',
        confirmButtonText: 'Continuar',
        width: '500px',
        customClass: {
            popup: 'rounded-3xl shadow-xl border border-green-300',
            confirmButton: 'bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded'
        }
    });
});
</script>
@endif

@section('content_header')
    <div class="header-panel">
    <div class="header-left">
        <h3 class="header-title">
            Técnico: 
            <strong>{{ $user->name }} {{ $user->paterno }} {{ $user->materno }}</strong>
        </h3>
    </div>
    <div class="header-actions">

            <a href="{{ route('admin.TecnicoEstadistica', $user->id) }}" class="btn-header">
                <i class="fas fa-chart-line"></i>
                Estadística del Técnico
            </a>
            <button type="button" class="btn-header"" data-toggle="modal" data-target="#modalReporte">
            <i class="fas fa-file-pdf"></i>Reporte PDF
            </button>
            <a href="{{ route('tecnicos.index') }}" class="btn-header">
                <i class="fas fa-arrow-left"></i>
                Volver
            </a>

    </div>
</div>

    <style>
    .icono {
    display: inline-block;
    transition: transform 0.3s ease;
    }
    a:hover .icono {
    transform: translateX(-4px);
    }
    </style>
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
<!--Ventana Modal para Reporte--->
@include('asigTecnicos.modalReporte')
@stop

@php
    $asignaciones = [
        ['titulo' => 'CPUs ASIGNADOS', 'relacion' => 'registro_cpus', 'color' => 'bg-gradient-info', 'icono' => 'ion-stop', 'ruta' => 'admin.asigCpu'],
        ['titulo' => 'IMPRESORAS ASIGNADAS', 'relacion' => 'impresoras', 'color' => 'bg-gradient-success', 'icono' => 'ion-printer', 'ruta' => 'admin.asigImpresora'],
        ['titulo' => 'MONITORES ASIGNADOS', 'relacion' => 'monitor', 'color' => 'bg-gradient-warning', 'icono' => 'ion-monitor', 'ruta' => 'admin.asigMonitor'],
        ['titulo' => 'AUDIFONOS ASIGNADOS', 'relacion' => 'audifonos', 'color' => 'bg-gradient-purple', 'icono' => 'ion-headphone', 'ruta' => 'admin.asigAudifono'],
        [ 'titulo' => 'LAPTOPS ASIGNADOS','relacion' => 'laptop','color' => 'bg-gradient-info','icono' => 'ion-laptop','ruta' => 'admin.asigLaptop'],
        [ 'titulo' => 'TECLADOS ASIGNADOS','relacion' => 'teclados','color' => 'bg-gradient-success','icono' => 'ion-stop','ruta' => 'admin.asigTeclado'],
        [ 'titulo' => 'PARLANTES ASIGNADOS','relacion' => 'parlantes','color' => 'bg-gradient-warning','icono' => 'ion-volume-high','ruta' => 'admin.asigParlante'],
        [ 'titulo' => 'MOUSE ASIGNADOS','relacion' => 'raton','color' => 'bg-gradient-purple','icono' => 'ion-mouse','ruta' => 'admin.asigMouse'],
        [ 'titulo' => 'UPS ASIGNADOS','relacion' => 'upeses','color' => 'bg-gradient-info','icono' => 'ion-stop','ruta' => 'admin.asigUps'],
        [ 'titulo' => 'ESTABILIZADORES ASIGNADOS','relacion' => 'estabilizador','color' => 'bg-gradient-success','icono' => 'ion-outlet','ruta' => 'admin.asigEstabilizador'],
    ];

    $estados = [
        1 => ['label' => 'Recepcionados', 'color' => '#17a2b8'],
        2 => ['label' => 'En proceso', 'color' => '#ffc107'],
        3 => ['label' => 'Apersonarse con el técnico', 'color' => '#dc3545'],
        4 => ['label' => 'Concluido', 'color' => '#28a745'],
        5 => ['label' => 'Entregados', 'color' => '#007bff'],
    ];
@endphp
    <div class="card" style="display: flex; justify-content: space-between; align-items: center;">
<div class="row">
    @foreach($asignaciones as $item)
        @php
            $rel = $item['relacion'];
            // Total del año actual
            $queryBase = $user->$rel()->whereYear('fecha_asignacion', date('Y'));
            $totalReal = $queryBase->count();
            $total = $totalReal ?: 1;
            // Detectar alerta
            $parpadea = collect([1,2,3,4])->contains(
                fn($e) => $user->$rel()->whereYear('fecha_asignacion', date('Y'))->where('estado_id', $e)->exists()
            );
        @endphp

        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
            <div class="dashboard-card-prof {{ $parpadea ? 'card-alert' : '' }}">

                <div class="card-body p-3">

                    <!-- HEADER -->
                    <div class="card-header-custom">
                        <span class="card-title">{{ $item['titulo'] }}</span>
                        <i class="ion {{ $item['icono'] }}"></i>
                    </div>

                    <!-- ESTADOS -->
                    @foreach($estados as $id => $estado)
                        @php
                            $valor = $user->$rel()
                                ->where('estado_id', $id)
                                ->whereYear('fecha_asignacion', date('Y'))
                                ->count();

                            $porcentaje = $total > 0 ? round(($valor / $total) * 100) : 0;
                        @endphp

                        <div class="mb-2">

                            <!-- TEXTO -->
                            <div class="stat-row">
                                <span class="label">{{ $estado['label'] }}</span>
                                <span class="value">{{ $valor }}</span>
                            </div>

                            <!-- BARRA PERSONALIZADA -->
                            <div class="progress-custom">
                                <div class="mini-bar-fill"
                                     style="width: {{ $porcentaje }}%; background-color: {{ $estado['color'] }};">
                                </div>
                            </div>

                        </div>
                    @endforeach

                    <!-- TOTAL -->
                    <div class="card-total">
                        Total: <strong>{{ $totalReal }}</strong>
                    </div>

                </div>

                <!-- FOOTER -->
                <a href="{{ route($item['ruta'], $user->id) }}" class="card-footer-custom">
                    Ver detalle
                </a>

            </div>
        </div>
    @endforeach
</div>
</div>
<link rel="stylesheet" href="{{ asset('estilos/panelAsig.css') }}">
@endsection

