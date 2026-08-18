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
        ['nombre' => 'ESTABILIZADOR', 'relacion' => 'estabilizador', 'icon' => '🔌', 'color' => '#198754'],
    ];

    $pendientes = [];

    foreach ($asignaciones as $item) {
        $rel = $item['relacion'];
        $sinCod = $user->$rel()->whereNull('cod_registro')->count();
        $sinUser = $user->$rel()->whereNull('user_id')->count();
        if ($user->$rel()->whereIn('estado_id', [1,2,3,4])->exists()) {
            $pendientes[] = [
                'nombre' => $item['nombre'],
                'icon' => $item['icon'],
                'color' => $item['color'],
                'sinCod' => $sinCod,
                'sinUser' => $sinUser
            ];
        }
    }
@endphp

@if(count($pendientes) > 0)
<script>
document.addEventListener('DOMContentLoaded', () => {

    let cardsHtml = `
        <div class="swal-grid">
            @foreach($pendientes as $item)
                <div class="swal-card">
                    <div class="swal-card-title">
                        <span class="icon">{{ $item['icon'] }}</span>
                        <span>{{ $item['nombre'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
        <p class="swal-msg">
            Debe presentar informe en un plazo máximo de tres días.
        </p>
    `;

    Swal.fire({
        title: 'Trabajos pendientes',
        html: cardsHtml,
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
document.addEventListener('DOMContentLoaded', () => {
    Swal.fire({
        title: '✅ Buen trabajo!',
        text: 'No tienes pendientes.',
        icon: 'success',
        showConfirmButton: true,
        confirmButtonText: 'Entendido',
        color: '#1f2937',
        customClass: {
            popup: 'rounded-2xl shadow-xl p-4 text-center',
            confirmButton: 'bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-3'
        }
    });
});
</script>
@endif


@php
    $asignaciones = [
        [ 'titulo' => 'CPUs', 'color' => 'bg-gradient-info', 'icono' => 'ion-ios-cog', 'relacion' => 'registro_cpus', 'ruta' => 'asignaciones.cpu', ],
        [ 'titulo' => 'IMPRESORAS', 'color' => 'bg-gradient-success', 'icono' => 'ion-printer', 'relacion' => 'impresoras', 'ruta' => 'asignaciones.impresora', ],
        [ 'titulo' => 'MONITORES', 'color' => 'bg-gradient-warning','icono' => 'ion-monitor','relacion' => 'monitor','ruta' => 'asignaciones.monitor',],
        [ 'titulo' => 'AUDÍFONOS','color' => 'bg-gradient-purple','icono' => 'ion-headphone','relacion' => 'audifonos','ruta' => 'asignaciones.audifono',],
        [ 'titulo' => 'LAPTOPS','color' => 'bg-gradient-info','icono' => 'ion-laptop','relacion' => 'laptop','ruta' => 'asignaciones.laptop',],
        [ 'titulo' => 'TECLADOS','color' => 'bg-gradient-success','icono' => 'ion-stop','relacion' => 'teclados','ruta' => 'asignaciones.teclado',],
        [ 'titulo' => 'PARLANTES','color' => 'bg-gradient-warning','icono' => 'ion-volume-high','relacion' => 'parlantes','ruta' => 'asignaciones.parlante',],
        [ 'titulo' => 'MOUSE','color' => 'bg-gradient-purple','icono' => 'ion-mouse','relacion' => 'raton','ruta' => 'asignaciones.mouse',],
        [ 'titulo' => 'UPS','color' => 'bg-gradient-info','icono' => 'ion-stop','relacion' => 'upeses','ruta' => 'asignaciones.ups',],
        [ 'titulo' => 'ESTABILIZADORES','color' => 'bg-gradient-success','icono' => 'ion-outlet','relacion' => 'estabilizador','ruta' => 'asignaciones.estabilizador',],
    ];

    $estados = [
        1 => ['label' => 'Recepcionados', 'color' => '#17a2b8'],
        2 => ['label' => 'En proceso', 'color' => '#ffc107'],
        3 => ['label' => 'Apersonarse con el técnico', 'color' => '#dc3545'],
        4 => ['label' => 'Concluido', 'color' => '#28a745'],
        5 => ['label' => 'Entregados', 'color' => '#007bff'],
    ];
@endphp


<div class="row">
@foreach ($asignaciones as $item)
    @php
        $rel = $item['relacion'];

        // Registros del año actual
        $consulta = $user->$rel()->whereYear('fecha_asignacion', date('Y'));

        $totalReal = $consulta->count();
        $total = $totalReal ?: 1;

        // Parpadea solo si:
        // 1. La fecha de asignación es del año actual
        // 2. Tiene alguno de los estados indicados
        $parpadea = collect([1, 2, 3, 4])->contains(
            fn($e) => $user->$rel()
                ->whereYear('fecha_asignacion', date('Y'))
                ->where('estado_id', $e)
                ->exists()
        );
    @endphp

<div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card dashboard-card-prof {{ $parpadea ? 'card-alert' : '' }}">

        <div class="card-body">

            <!-- Header -->
            <div class="card-header-custom">
                <span class="card-title">{{ $item['titulo'] }}</span>
                <i class="ion {{ $item['icono'] }}"></i>
            </div>

            <!-- Estados -->
            @foreach ($estados as $id => $estado)
                @php
                    $valor = $user->$rel()->where('estado_id', $id)
                        ->whereYear('fecha_asignacion', date('Y'))->count();

                    $porcentaje = $total > 0 ? round(($valor / $total) * 100) : 0;
                @endphp

                <div class="stat-row">
                    <span class="label">{{ $estado['label'] }}</span>
                    <span class="value">{{ $valor }}</span>
                </div>

                <div class="progress progress-custom">
                    <div class="progress-bar"
                         style="width: {{ $porcentaje }}%; background: {{ $estado['color'] }}">
                    </div>
                </div>
            @endforeach

            <!-- Total -->
            <div class="card-total">
                Total: <strong>{{ $totalReal }}</strong>
            </div>

        </div>

        <!-- Footer -->
        <a href="{{ route($item['ruta']) }}" class="card-footer-custom">
            Ver detalle
        </a>
    </div>
</div>
    @endforeach
</div>
<link rel="stylesheet" href="{{ asset('estilos/panelTec.css') }}">
