```blade
@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | MODELOS DE EQUIPOS
    |--------------------------------------------------------------------------
    */

    $modelos = [

        'CPU' => [
            'modelo' => \App\Models\RegistroCpu::class,
            'color' => '#3498db',
            'icon' => '💻'
        ],

        'Impresora' => [
            'modelo' => \App\Models\Impresora::class,
            'color' => '#2ecc71',
            'icon' => '🖨️'
        ],

        'Monitor' => [
            'modelo' => \App\Models\Monitor::class,
            'color' => '#f1c40f',
            'icon' => '🖥️'
        ],

        'Audífono' => [
            'modelo' => \App\Models\Audifono::class,
            'color' => '#9b59b6',
            'icon' => '🎧'
        ],

        'Teclado' => [
            'modelo' => \App\Models\Teclado::class,
            'color' => '#e67e22',
            'icon' => '⌨️'
        ],

        'Parlante' => [
            'modelo' => \App\Models\Parlante::class,
            'color' => '#1abc9c',
            'icon' => '🔊'
        ],

        'Mouse' => [
            'modelo' => \App\Models\Raton::class,
            'color' => '#e74c3c',
            'icon' => '🖱️'
        ],

        'UPS' => [
            'modelo' => \App\Models\Upese::class,
            'color' => '#34495e',
            'icon' => '🔋'
        ],

        'Estabilizador' => [
            'modelo' => \App\Models\Estabilizador::class,
            'color' => '#16a085',
            'icon' => '⚡'
        ],

        'Laptop' => [
            'modelo' => \App\Models\Laptop::class,
            'color' => '#8e44ad',
            'icon' => '💻'
        ],
        'Otros equipos' => [
            'modelo' => \App\Models\OtrosEquipo::class,
            'color' => '#8e44ad',
            'icon' => '💻'
        ],

    ];


    /*
    |--------------------------------------------------------------------------
    | VARIABLES DE NOTIFICACIONES
    |--------------------------------------------------------------------------
    */

    $totalSinCod = 0;
    $totalSinUser = 0;

    $pendientes = [];
    $pendientesInforme = [];

    $gestion = date('Y');


    /*
    |--------------------------------------------------------------------------
    | RECORRER LOS MODELOS
    |--------------------------------------------------------------------------
    */

    foreach ($modelos as $nombre => $info) {

        $modelo = $info['modelo'];
        $color = $info['color'];
        $icon = $info['icon'];


        /*
        |--------------------------------------------------------------------------
        | EQUIPOS SIN CÓDIGO
        |--------------------------------------------------------------------------
        */

        $sinCod = $modelo::whereNull('cod_registro')
            ->whereYear('created_at', $gestion)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | EQUIPOS SIN TÉCNICO
        |--------------------------------------------------------------------------
        */

        $sinUser = $modelo::whereNull('user_id')
            ->whereYear('created_at', $gestion)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | SOLO CONTAR COMO PENDIENTE DE ASIGNACIÓN
        | LOS EQUIPOS QUE YA TIENEN CÓDIGO
        |--------------------------------------------------------------------------
        */

        if ($sinUser < $sinCod) {

            $sinUser = 0;

        } else {

            $sinUser = $modelo::whereNotNull('cod_registro')
                ->whereNull('user_id')
                ->whereYear('created_at', $gestion)
                ->count();

        }


        /*
        |--------------------------------------------------------------------------
        | GUARDAR PENDIENTES
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | INFORMES PENDIENTES
        |
        | estado_id = 1
        | RECEPCIONADO
        |
        | resultado_id NULL
        | SIN INFORME / RESULTADO
        |
        | created_at <= 3 días
        |--------------------------------------------------------------------------
        */

        $informePendiente = $modelo::where('estado_id', 1)
            ->whereNull('resultado_id')
            ->where('created_at', '<=', now()->subDays(3))
            ->whereYear('created_at', $gestion)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | GUARDAR INFORMES PENDIENTES
        |--------------------------------------------------------------------------
        */

        if ($informePendiente > 0) {

            $pendientesInforme[] = [

                'nombre' => $nombre,
                'color' => $color,
                'icon' => $icon,
                'cantidad' => $informePendiente,

            ];

        }

    }

@endphp


{{-- ============================================================
     CAMPANA DE NOTIFICACIONES
     ============================================================ --}}

@php

    $totalPendientesAsignacion = collect($pendientes)
        ->sum('sinUser');

    $totalPendientesInforme = collect($pendientesInforme)
        ->sum('cantidad');

    $totalNotificaciones =
        $totalPendientesAsignacion +
        $totalPendientesInforme;

@endphp


{{-- ============================================================
     CABECERA DEL PANEL
     ============================================================ --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        {{-- Espacio reservado para título del panel --}}
    </div>


    {{-- ========================================================
         CAMPANA
         ======================================================== --}}

    <div class="dropdown">

<button
    type="button"
    class="btn-notificacion-dropdown"
    id="btnNotificacionesAdmin"
    data-toggle="dropdown"
    aria-haspopup="true"
    aria-expanded="false"
    title="Notificaciones"
>
    <span class="icono-campana-dropdown">
        <i class="fas fa-bell"></i>

        @if($totalNotificaciones > 0)
            <span class="badge-notificacion">
                {{ $totalNotificaciones }}
            </span>
        @endif
    </span>

    <span class="texto-notificaciones">
        Notificaciones
    </span>
</button>


            @if($totalNotificaciones > 0)

            @endif

        </button>


        {{-- ====================================================
             DROPDOWN DE NOTIFICACIONES
             ==================================================== --}}

        <div
            class="dropdown-menu dropdown-menu-right shadow-lg p-0"
            aria-labelledby="btnNotificacionesAdmin"
            style="
                width:360px;
                max-width:90vw;
                border:1px solid #dee2e6;
                border-radius:12px;
                overflow:hidden;
            "
        >


            {{-- =================================================
                 CABECERA
                 ================================================= --}}

            <div
                style="
                    background:#1e2a38;
                    color:white;
                    padding:14px 18px;
                "
            >

                <div class="d-flex align-items-center">

                    <i class="fas fa-bell mr-2"></i>

                    <strong>
                        NOTIFICACIONES
                    </strong>

                </div>

                <small
                    class="d-block mt-1"
                    style="opacity:.8;"
                >
                    Control y seguimiento de equipos
                </small>

            </div>


            {{-- =================================================
                 SIN NOTIFICACIONES
                 ================================================= --}}

            @if($totalNotificaciones == 0)

                <div class="text-center p-4">

                    <i
                        class="fas fa-check-circle mb-3"
                        style="
                            font-size:38px;
                            color:#28a745;
                        "
                    ></i>

                    <div class="font-weight-bold">
                        Todo está al día
                    </div>

                    <small class="text-muted">
                        No existen notificaciones pendientes.
                    </small>

                </div>


            @else


                {{-- =================================================
                     TÉCNICOS POR ASIGNAR
                     ================================================= --}}

                @if($totalPendientesAsignacion > 0)

                    <div>

                        <button
                            type="button"
                            class="btn btn-link btn-block text-left text-decoration-none px-3 py-3"
                            data-toggle="collapse"
                            data-target="#detalleAsignacionAdmin"
                            aria-expanded="false"
                            aria-controls="detalleAsignacionAdmin"
                        >

                            <div class="d-flex align-items-center">

                                <div
                                    class="mr-3"
                                    style="
                                        width:38px;
                                        height:38px;
                                        border-radius:50%;
                                        background:#fff3cd;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >

                                    <i
                                        class="fas fa-user-clock"
                                        style="color:#856404;"
                                    ></i>

                                </div>


                                <div class="flex-grow-1">

                                    <div
                                        class="font-weight-bold"
                                        style="color:#343a40;"
                                    >
                                        Técnicos por asignar
                                    </div>

                                    <small class="text-muted">
                                        Equipos pendientes de asignación
                                    </small>

                                </div>


                                <span class="badge badge-warning">
                                    {{ $totalPendientesAsignacion }}
                                </span>

                            </div>

                        </button>


                        {{-- DETALLE --}}

                        <div
                            id="detalleAsignacionAdmin"
                            class="collapse"
                        >

                            <div
                                class="px-3 pb-3"
                                style="
                                    border-top:1px solid #f0f0f0;
                                "
                            >

                                @foreach($pendientes as $item)

                                    @if($item['sinUser'] > 0)

                                        <div
                                            class="d-flex justify-content-between align-items-center py-2"
                                        >

                                            <span>

                                                <span
                                                    style="
                                                        font-size:18px;
                                                        margin-right:7px;
                                                    "
                                                >
                                                    {{ $item['icon'] }}
                                                </span>

                                                {{ $item['nombre'] }}

                                            </span>


                                            <span class="badge badge-light">
                                                {{ $item['sinUser'] }}
                                            </span>

                                        </div>

                                    @endif

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                     INFORMES PENDIENTES
                     ================================================= --}}

                @if($totalPendientesInforme > 0)

                    <div
                        style="
                            border-top:1px solid #dee2e6;
                        "
                    >

                        <button
                            type="button"
                            class="btn btn-link btn-block text-left text-decoration-none px-3 py-3"
                            data-toggle="collapse"
                            data-target="#detalleInformeAdmin"
                            aria-expanded="false"
                            aria-controls="detalleInformeAdmin"
                        >

                            <div class="d-flex align-items-center">

                                <div
                                    class="mr-3"
                                    style="
                                        width:38px;
                                        height:38px;
                                        border-radius:50%;
                                        background:#f8d7da;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >

                                    <i
                                        class="fas fa-clock"
                                        style="color:#721c24;"
                                    ></i>

                                </div>


                                <div class="flex-grow-1">

                                    <div
                                        class="font-weight-bold"
                                        style="color:#343a40;"
                                    >
                                        Informe pendiente
                                    </div>

                                    <small class="text-muted">
                                        Recepcionados hace 3 días o más
                                    </small>

                                </div>


                                <span class="badge badge-danger">
                                    {{ $totalPendientesInforme }}
                                </span>

                            </div>

                        </button>


                        {{-- DETALLE --}}

                        <div
                            id="detalleInformeAdmin"
                            class="collapse"
                        >

                            <div
                                class="px-3 pb-3"
                                style="
                                    border-top:1px solid #f0f0f0;
                                "
                            >

                                @foreach($pendientesInforme as $item)

                                    <div
                                        class="d-flex justify-content-between align-items-center py-2"
                                    >

                                        <span>

                                            <span
                                                style="
                                                    font-size:18px;
                                                    margin-right:7px;
                                                "
                                            >
                                                {{ $item['icon'] }}
                                            </span>

                                            {{ $item['nombre'] }}

                                        </span>


                                        <span class="badge badge-light">
                                            {{ $item['cantidad'] }}
                                        </span>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif

            @endif


            {{-- =================================================
                 PIE DEL DROPDOWN
                 ================================================= --}}

            <div
                class="text-center"
                style="
                    background:#f8f9fa;
                    border-top:1px solid #dee2e6;
                    padding:8px;
                "
            >

                <small class="text-muted">
                    Notificaciones del sistema
                </small>

            </div>

        </div>

    </div>

</div>



{{-- ============================================================
     SWEETALERTS
     ============================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | DATOS DE NOTIFICACIONES
    |--------------------------------------------------------------------------
    */

    const pendientesAsignacion = @json($pendientes);

    const pendientesInforme = @json($pendientesInforme);


    /*
    |--------------------------------------------------------------------------
    | PRIMERA ALERTA:
    | INFORMES PENDIENTES
    |--------------------------------------------------------------------------
    */

    if (pendientesInforme.length > 0) {

        let htmlInforme = `

            <div class="swal-grid">

                ${pendientesInforme.map(item => `

                    <div class="swal-card">

                        <div class="swal-card-title">

                            <span class="swal-icon">
                                ${item.icon}
                            </span>

                            <span>
                                ${item.nombre}
                            </span>

                        </div>


                        <div class="swal-card-body">

                            <div class="swal-item">

                                <span class="label">
                                    Informes pendientes
                                </span>

                                <span class="value">
                                    ${item.cantidad}
                                </span>

                            </div>

                        </div>

                    </div>

                `).join('')}

            </div>


            <div class="swal-msg">

                Existen equipos en estado
                <strong>RECEPCIONADO</strong>
                durante 3 días o más sin informe registrado.

            </div>

        `;


        Swal.fire({

            title: 'Actualización pendiente',

            html: htmlInforme,

            icon: 'warning',

            confirmButtonText: 'Aceptar',

            width: '520px',

            customClass: {

                popup: 'swal-institucional'

            }

        }).then(function () {

            /*
            |--------------------------------------------------------------------------
            | AL CERRAR INFORMES,
            | MOSTRAR ASIGNACIONES
            |--------------------------------------------------------------------------
            */

            mostrarPendientesAsignacion();

        });


    } else {

        /*
        |--------------------------------------------------------------------------
        | SI NO HAY INFORMES,
        | MOSTRAR ASIGNACIONES
        |--------------------------------------------------------------------------
        */

        mostrarPendientesAsignacion();

    }


    /*
    |--------------------------------------------------------------------------
    | SEGUNDA ALERTA:
    | TÉCNICOS POR ASIGNAR
    |--------------------------------------------------------------------------
    */

    function mostrarPendientesAsignacion() {

        /*
        |--------------------------------------------------------------------------
        | IMPORTANTE:
        | SOLO MOSTRAR LA ALERTA SI REALMENTE EXISTEN EQUIPOS
        | SIN TÉCNICO.
        |--------------------------------------------------------------------------
        */

        const existenAsignaciones = pendientesAsignacion.some(function (item) {

            return item.sinUser > 0;

        });


        if (!existenAsignaciones) {

            return;

        }


        let htmlDashboard = `

            <div class="swal-grid">

                ${pendientesAsignacion

                    .filter(item => item.sinUser > 0)

                    .map(item => `

                        <div class="swal-card">

                            <div class="swal-card-title">

                                <span class="swal-icon">
                                    ${item.icon}
                                </span>

                                <span>
                                    ${item.nombre}
                                </span>

                            </div>


                            <div class="swal-card-body">

                                <div class="swal-item">

                                    <span class="label">
                                        Técnicos por asignar
                                    </span>

                                    <span class="value">
                                        ${item.sinUser}
                                    </span>

                                </div>

                            </div>

                        </div>

                    `).join('')}

            </div>


            <div class="swal-msg">

                Existen asignaciones pendientes en el sistema.

            </div>

        `;


        Swal.fire({

            title: 'Notificación de asignaciones pendientes',

            html: htmlDashboard,

            icon: 'info',

            confirmButtonText: 'Aceptar',

            width: '520px',

            customClass: {

                popup: 'swal-institucional'

            }

        });

    }

});

</script>



{{-- ============================================================
     TARJETAS DE EQUIPOS
     ============================================================ --}}

<div class="row">

    @php

        $equipos = [

            [
                'nombre' => 'CPUs',
                'modelo' => \App\Models\RegistroCpu::class,
                'icon' => 'ion-ios-cog',
                'ruta' => '/registro-cpus'
            ],

            [
                'nombre' => 'IMPRESORAS',
                'modelo' => \App\Models\Impresora::class,
                'icon' => 'ion-printer',
                'ruta' => '/impresoras'
            ],

            [
                'nombre' => 'MONITORES',
                'modelo' => \App\Models\Monitor::class,
                'icon' => 'ion-monitor',
                'ruta' => '/monitors'
            ],

            [
                'nombre' => 'AUDIFONOS',
                'modelo' => \App\Models\Audifono::class,
                'icon' => 'ion-headphone',
                'ruta' => '/audifonos'
            ],

            [
                'nombre' => 'LAPTOPS',
                'modelo' => \App\Models\Laptop::class,
                'icon' => 'ion-laptop',
                'ruta' => '/laptops'
            ],

            [
                'nombre' => 'TECLADOS',
                'modelo' => \App\Models\Teclado::class,
                'icon' => 'ion-stop',
                'ruta' => '/teclados'
            ],

            [
                'nombre' => 'PARLANTES',
                'modelo' => \App\Models\Parlante::class,
                'icon' => 'ion-volume-high',
                'ruta' => '/parlantes'
            ],

            [
                'nombre' => 'MOUSE',
                'modelo' => \App\Models\Raton::class,
                'icon' => 'ion-mouse',
                'ruta' => '/ratons'
            ],

            [
                'nombre' => 'UPS',
                'modelo' => \App\Models\Upese::class,
                'icon' => 'ion-stop',
                'ruta' => '/upeses'
            ],

            [
                'nombre' => 'ESTABILIZADOR',
                'modelo' => \App\Models\Estabilizador::class,
                'icon' => 'ion-outlet',
                'ruta' => '/estabilizadors'
            ],

            [
                'nombre' => 'OTROS EQUIPOS',
                'modelo' => \App\Models\OtrosEquipo::class,
                'icon' => 'ion-outlet',
                'ruta' => '/otros-equipos'
            ],

        ];

    @endphp


    @foreach($equipos as $equipo)

        @php

            /*
            |--------------------------------------------------------------------------
            | DATOS DE CADA EQUIPO
            |--------------------------------------------------------------------------
            */

            $dataEquipo = [

                /*
                |--------------------------------------------------------------------------
                | RECEPCIONADOS
                |--------------------------------------------------------------------------
                */

                'recepcionados' => $equipo['modelo']::where('estado_id', 1)
                    ->whereYear('created_at', date('Y'))
                    ->count(),


                /*
                |--------------------------------------------------------------------------
                | EN PROCESO
                |--------------------------------------------------------------------------
                */

                'en_proceso' => $equipo['modelo']::where('estado_id', 2)
                    ->whereYear('created_at', date('Y'))
                    ->count(),


                /*
                |--------------------------------------------------------------------------
                | APERSONARSE
                |--------------------------------------------------------------------------
                */

                'apersonarse' => $equipo['modelo']::where('estado_id', 3)
                    ->whereYear('created_at', date('Y'))
                    ->count(),


                /*
                |--------------------------------------------------------------------------
                | CONCLUIDO
                |--------------------------------------------------------------------------
                */

                'concluido' => $equipo['modelo']::where('estado_id', 4)
                    ->whereYear('created_at', date('Y'))
                    ->count(),


                /*
                |--------------------------------------------------------------------------
                | ENTREGADOS
                |--------------------------------------------------------------------------
                */

                'entregados' => $equipo['modelo']::where('estado_id', 5)
                    ->whereYear('created_at', date('Y'))
                    ->count(),


                /*
                |--------------------------------------------------------------------------
                | TOTAL
                |--------------------------------------------------------------------------
                */

                'total' => $equipo['modelo']::where('estado_id', '!=', 6)
                    ->whereYear('created_at', date('Y'))
                    ->count(),


                /*
                |--------------------------------------------------------------------------
                | TOTAL REAL
                |--------------------------------------------------------------------------
                */

                'totalReal' => $equipo['modelo']::where('estado_id', '!=', 6)
                    ->whereYear('created_at', date('Y'))
                    ->count(),


                /*
                |--------------------------------------------------------------------------
                | SIN CÓDIGO
                |--------------------------------------------------------------------------
                */

                'sin_cod' => $equipo['modelo']::whereNull('cod_registro')
                    ->whereYear('created_at', $gestion)
                    ->count(),


                /*
                |--------------------------------------------------------------------------
                | SIN TÉCNICO
                |--------------------------------------------------------------------------
                */

                'sin_user' => $equipo['modelo']::whereNotNull('cod_registro')
                    ->whereNull('user_id')
                    ->whereYear('created_at', $gestion)
                    ->count(),

            ];


            /*
            |--------------------------------------------------------------------------
            | EVITAR DIVISIÓN POR CERO
            |--------------------------------------------------------------------------
            */

            $total = $dataEquipo['total'] ?: 1;

            $totalReal = $dataEquipo['totalReal'];

        @endphp


        {{-- =====================================================
             TARJETA
             ===================================================== --}}

        <div class="col-lg-3 col-md-6 col-sm-12 mb-4">

            <div
                class="dashboard-card-prof
                {{ $dataEquipo['sin_user'] > 0 ? 'card-alert' : '' }}"
            >

                <div class="card-body">


                    {{-- =================================================
                         ENCABEZADO
                         ================================================= --}}

                    <div class="card-header-custom">

                        <div class="card-title-wrapper">

                            <div class="card-icon-wrapper">

                                <i class="ion {{ $equipo['icon'] }}"></i>

                            </div>


                            <div>

                                <span class="card-title">
                                    {{ $equipo['nombre'] }}
                                </span>

                                <small class="card-subtitle">
                                    Gestión {{ $gestion }}
                                </small>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         TOTAL PRINCIPAL
                         ================================================= --}}

                    <div class="card-main-total">

                        <span class="total-number">
                            {{ $dataEquipo['totalReal'] }}
                        </span>

                        <span class="total-label">
                            Equipos registrados
                        </span>

                    </div>


                    {{-- =================================================
                         ESTADOS
                         ================================================= --}}

                    <div class="card-stats">

                        @foreach([
                            'recepcionados',
                            'en_proceso',
                            'apersonarse',
                            'concluido',
                            'entregados'
                        ] as $estado)

                            @php

                                $porcentaje =
                                    $total > 0
                                    ? ($dataEquipo[$estado] / $total) * 100
                                    : 0;

                            @endphp


                            <div class="stat-row">

                                <span class="stat-label">

                                    @switch($estado)

                                        @case('recepcionados')

                                            <i
                                                class="fas fa-inbox stat-icon text-info"
                                            ></i>

                                            Recepcionados

                                        @break


                                        @case('en_proceso')

                                            <i
                                                class="fas fa-tools stat-icon text-warning"
                                            ></i>

                                            En proceso

                                        @break


                                        @case('apersonarse')

                                            <i
                                                class="fas fa-user-clock stat-icon text-danger"
                                            ></i>

                                            Apersonarse

                                        @break


                                        @case('concluido')

                                            <i
                                                class="fas fa-check-circle stat-icon text-success"
                                            ></i>

                                            Concluido

                                        @break


                                        @case('entregados')

                                            <i
                                                class="fas fa-hand-holding-box stat-icon text-primary"
                                            ></i>

                                            Entregados

                                        @break

                                    @endswitch

                                </span>


                                <span class="stat-value">

                                    {{ $dataEquipo[$estado] }}

                                </span>

                            </div>


                            {{-- BARRA DE PROGRESO --}}

                            <div class="progress-custom">

                                <div
                                    class="progress-bar

                                        @switch($estado)

                                            @case('recepcionados')
                                                bg-info
                                            @break

                                            @case('en_proceso')
                                                bg-warning
                                            @break

                                            @case('apersonarse')
                                                bg-danger
                                            @break

                                            @case('concluido')
                                                bg-success
                                            @break

                                            @case('entregados')
                                                bg-primary
                                            @break

                                        @endswitch
                                    "
                                    role="progressbar"
                                    style="width: {{ min($porcentaje, 100) }}%;"
                                ></div>

                            </div>

                        @endforeach

                    </div>


                    {{-- =================================================
                         INDICADOR DE TÉCNICO
                         ================================================= --}}

                    <div
                        class="
                            technician-status
                            {{ $dataEquipo['sin_user'] > 0
                                ? 'technician-pending'
                                : 'technician-ok' }}
                        "
                    >

                        <div class="technician-icon">

                            <i class="fas fa-user-cog"></i>

                        </div>


                        <div class="technician-info">

                            <span>
                                Técnico por asignar
                            </span>

                            <strong>
                                {{ $dataEquipo['sin_user'] }}
                            </strong>

                        </div>


                        @if($dataEquipo['sin_user'] > 0)

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


                {{-- =================================================
                     FOOTER
                     ================================================= --}}

                <a
                    href="{{ $equipo['ruta'] }}"
                    class="card-footer-custom"
                >

                    <span>
                        Ver detalle
                    </span>

                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>

        </div>

    @endforeach

</div>



{{-- ============================================================
     HOJA DE ESTILOS
     ============================================================ --}}

<link
    rel="stylesheet"
    href="{{ asset('estilos/panelAdmi.css') }}"
>


@stop



{{-- ============================================================
     JAVASCRIPT
     ============================================================ --}}

@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@stop