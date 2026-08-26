@section('content')

@php
$modelos = [
    'CPU' => ['modelo' => \App\Models\RegistroCpu::class, 'color' => '#3498db', 'icon' => '💻'],
    'Impresora' => ['modelo' => \App\Models\Impresora::class, 'color' => '#2ecc71', 'icon' => '🖨️'],
    'Monitor' => ['modelo' => \App\Models\Monitor::class, 'color' => '#f1c40f', 'icon' => '🖥️'],
    'Audífono' => ['modelo' => \App\Models\Audifono::class, 'color' => '#9b59b6', 'icon' => '🎧'],
    'Teclado' => ['modelo' => \App\Models\Teclado::class, 'color' => '#e67e22', 'icon' => '⌨️'],
    'Parlante' => ['modelo' => \App\Models\Parlante::class, 'color' => '#1abc9c', 'icon' => '🔊'],
    'Mouse' => ['modelo' => \App\Models\Raton::class, 'color' => '#e74c3c', 'icon' => '🖱️'],
    'UPS' => ['modelo' => \App\Models\Upese::class, 'color' => '#34495e', 'icon' => '🔋'],
    'Estabilizador' => ['modelo' => \App\Models\Estabilizador::class, 'color' => '#16a085', 'icon' => '⚡'],
    'Laptop' => ['modelo' => \App\Models\Laptop::class, 'color' => '#8e44ad', 'icon' => '💻'],
];

$totalSinCod = 0;
$totalSinUser = 0;
$pendientes = [];

foreach ($modelos as $nombre => $info) {
    $modelo = $info['modelo'];
    $color = $info['color'];
    $icon = $info['icon'];

    // Año actual
    $gestion = date('Y');

    // 1. Sin código (gestión actual)
    $sinCod = $modelo::whereNull('cod_registro')
        ->whereYear('created_at', $gestion)
        ->count();

    // 2. Sin usuario (gestión actual)
    $sinUser = $modelo::whereNull('user_id')
        ->whereYear('created_at', $gestion)
        ->count();

    // 3. Lógica de flujo
    if ($sinUser < $sinCod) {
        $sinUser = 0;
    } else {
        $sinUser = $modelo::whereNotNull('cod_registro')
            ->whereNull('user_id')
            ->whereYear('created_at', $gestion)
            ->count();
    }

    if ($sinCod > 0 || $sinUser > 0) {
        $pendientes[] = [
            'nombre' => $nombre,
            'color' => $color,
            'icon' => $icon,
            'sinCod' => $sinCod,
            'sinUser' => $sinUser,
        ];
    }

    $totalSinCod += $sinCod;
    $totalSinUser += $sinUser;
}
@endphp


<script>
document.addEventListener('DOMContentLoaded', () => {

@if(count($pendientes) > 0)

    let htmlDashboard = `
        <div class="swal-grid">
            @foreach($pendientes as $item)
                <div class="swal-card">

                    <div class="swal-card-title">
                        <span class="swal-icon">{{ $item['icon'] }}</span>
                        <span>{{ $item['nombre'] }}</span>
                    </div>

                    <div class="swal-card-body">
                        <div class="swal-item"> 
                            <span class="label">Núm. de recepción</span>
                            <span class="value">{{ $item['sinCod'] }}</span>
                        </div>

                        <div class="swal-item">
                            <span class="label">Técnicos por asignar</span>
                            <span class="value">{{ $item['sinUser'] }}</span>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <div class="swal-msg">
            Existen asignaciones pendientes en el sistema.
        </div>
    `;

    Swal.fire({
        title: 'Notificación de pendientes',
        html: htmlDashboard,
        icon: 'info',
        confirmButtonText: 'Aceptar',
        width: '520px',
        customClass: {
            popup: 'swal-institucional'
        }
    });

@else

    Swal.fire({
        title: 'Buen trabajo !!!',
        text: 'No existen asignaciones pendientes.',
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

<div class="row">
    @php
        $equipos = [
            ['nombre' => 'CPUs', 'modelo' => \App\Models\RegistroCpu::class, 'icon' => 'ion-ios-cog', 'ruta' => '/registro-cpus'],
            ['nombre' => 'IMPRESORAS', 'modelo' => \App\Models\Impresora::class, 'icon' => 'ion-printer', 'ruta' => '/impresoras'],
            ['nombre' => 'MONITORES', 'modelo' => \App\Models\Monitor::class, 'icon' => 'ion-monitor', 'ruta' => '/monitors'],
            ['nombre' => 'AUDIFONOS', 'modelo' => \App\Models\Audifono::class, 'icon' => 'ion-headphone', 'ruta' => '/audifonos'],
            ['nombre' => 'LAPTOPS', 'modelo' => \App\Models\Laptop::class, 'icon' => 'ion-laptop', 'ruta' => '/laptops'],
            ['nombre' => 'TECLADOS', 'modelo' => \App\Models\Teclado::class, 'icon' => 'ion-stop', 'ruta' => '/teclados'],
            ['nombre' => 'PARLANTES', 'modelo' => \App\Models\Parlante::class, 'icon' => 'ion-volume-high', 'ruta' => '/parlantes'],
            ['nombre' => 'MOUSE', 'modelo' => \App\Models\Raton::class,'icon' => 'ion-mouse', 'ruta' => '/ratons'],
            ['nombre' => 'UPS', 'modelo' => \App\Models\Upese::class, 'icon' => 'ion-stop', 'ruta' => '/upeses'],
            ['nombre' => 'ESTABILIZADOR', 'modelo' => \App\Models\Estabilizador::class,'icon' => 'ion-outlet', 'ruta' => '/estabilizadors'],
            ['nombre' => 'OTROS EQUIPOS', 'modelo' => \App\Models\OtrosEquipo::class, 'icon' => 'ion-outlet', 'ruta' => '/otros-equipos'],
        ];
    @endphp

    @foreach($equipos as $equipo)

        @php
    $dataEquipo = [
        'recepcionados' => $equipo['modelo']::where('estado_id', 1)
            ->whereYear('created_at', date('Y'))->count(),

        'en_proceso' => $equipo['modelo']::where('estado_id', 2)
            ->whereYear('created_at', date('Y'))->count(),

        'apersonarse' => $equipo['modelo']::where('estado_id', 3)
            ->whereYear('created_at', date('Y'))->count(),

        'concluido' => $equipo['modelo']::where('estado_id', 4)
            ->whereYear('created_at', date('Y'))->count(),

        'entregados' => $equipo['modelo']::where('estado_id', 5)
            ->whereYear('created_at', date('Y'))->count(),

        // total (sin los eliminados, por ejemplo estado_id = 6)
        'total' => $equipo['modelo']::where('estado_id', '!=', 6)
            ->whereYear('created_at', date('Y'))->count(),

        'totalReal' => $equipo['modelo']::where('estado_id', '!=', 6)
            ->whereYear('created_at', date('Y'))->count(),

        // flujo dinámico:
        // sin_cod -> sin número de recepción todavía
        'sin_cod' => $equipo['modelo']::whereNull('cod_registro')->whereYear('created_at', $gestion)->count(),

        // sin_user -> ya tienen código, pero aún sin técnico asignado
        'sin_user' => $equipo['modelo']::whereNotNull('cod_registro')
            ->whereNull('user_id')->whereYear('created_at', $gestion)->count(),
        ];
                $total = $dataEquipo['total'] ?: 1;
            $totalReal = $dataEquipo['totalReal'];
    @endphp

<div class="col-lg-3 col-md-6 col-sm-12 mb-4">
    <div class="card dashboard-card-prof {{ ($dataEquipo['sin_cod'] > 0 || $dataEquipo['sin_user'] > 0)}}">

        <div class="card-body">

            <!-- Header -->
            <div class="card-header-custom">
                <span class="card-title">{{ $equipo['nombre'] }}</span>
                <i class="ion {{ $equipo['icon'] }}"></i>
            </div>

            <!-- Estados -->
            <div class="card-stats">
                @foreach(['recepcionados','en_proceso','apersonarse','concluido','entregados'] as $estado)
                    <div class="stat-row">
                        <span class="label">{{ ucfirst(str_replace('_',' ', $estado)) }}</span>
                        <span class="value">{{ $dataEquipo[$estado] }}</span>
                    </div>

                    <div class="progress progress-custom">
                        <div class="progress-bar 
                            @switch($estado)
                                @case('recepcionados') bg-info @break
                                @case('en_proceso') bg-warning @break
                                @case('apersonarse') bg-danger @break
                                @case('concluido') bg-success @break
                                @case('entregados') bg-primary @break
                            @endswitch
                        " style="width: {{ ($dataEquipo[$estado]/$total)*100 }}%">
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="card-total">
                Total: <strong>{{ $dataEquipo['totalReal'] }}</strong>
            </div>

            <!-- Indicadores -->
            <div class="card-actions">
                <!-- <div class="action-item {{ $dataEquipo['sin_cod'] > 0 ? 'text-danger' : 'text-muted' }}">
                    Sin número de recepción: {{ $dataEquipo['sin_cod'] }}
                </div> -->
                <div class="action-item {{ $dataEquipo['sin_user'] > 0 ? 'text-danger' : 'text-muted' }}">
                    Asignar técnico: {{ $dataEquipo['sin_user'] }}
                </div>
            </div>

        </div>

        <a href="{{ $equipo['ruta'] }}" class="card-footer-custom">
            Ver detalle
        </a>

    </div>
</div>
    @endforeach
</div>

<link rel="stylesheet" href="{{ asset('estilos/panelAdmi.css') }}">
@stop


@section('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
{{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet"> --}}
@stop
