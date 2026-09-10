{{-- ============================================================
    PANEL DEL TÉCNICO - SISOT
    Sistema de Soporte Tecnológico
    ============================================================ --}}

@php

    /*
    |--------------------------------------------------------------------------
    | TIPOS DE EQUIPO
    |--------------------------------------------------------------------------
    */

   $asignaciones = [

    [
        'titulo'   => 'CPUs',
        'icono'    => 'fas fa-desktop',
        'relacion' => 'registro_cpus',
        'ruta'     => 'asignaciones.cpu'
    ],

    [
        'titulo'   => 'IMPRESORAS',
        'icono'    => 'fas fa-print',
        'relacion' => 'impresoras',
        'ruta'     => 'asignaciones.impresora'
    ],

    [
        'titulo'   => 'MONITORES',
        'icono'    => 'fas fa-tv',
        'relacion' => 'monitor',
        'ruta'     => 'asignaciones.monitor'
    ],

    [
        'titulo'   => 'AUDÍFONOS',
        'icono'    => 'fas fa-headphones',
        'relacion' => 'audifonos',
        'ruta'     => 'asignaciones.audifono'
    ],

    [
        'titulo'   => 'LAPTOPS',
        'icono'    => 'fas fa-laptop',
        'relacion' => 'laptop',
        'ruta'     => 'asignaciones.laptop'
    ],

    [
        'titulo'   => 'TECLADOS',
        'icono'    => 'fas fa-keyboard',
        'relacion' => 'teclados',
        'ruta'     => 'asignaciones.teclado'
    ],

    [
        'titulo'   => 'PARLANTES',
        'icono'    => 'fas fa-volume-up',
        'relacion' => 'parlantes',
        'ruta'     => 'asignaciones.parlante'
    ],

    [
        'titulo'   => 'MOUSE',
        'icono'    => 'fas fa-mouse-pointer',
        'relacion' => 'raton',
        'ruta'     => 'asignaciones.mouse'
    ],

    [
        'titulo'   => 'UPS',
        'icono'    => 'fas fa-battery-full',
        'relacion' => 'upeses',
        'ruta'     => 'asignaciones.ups'
    ],

    [
        'titulo'   => 'ESTABILIZADORES',
        'icono'    => 'fas fa-bolt',
        'relacion' => 'estabilizador',
        'ruta'     => 'asignaciones.estabilizador'
    ],

    [
        'titulo'   => 'OTROS EQUIPOS',
        'icono'    => 'fas fa-cogs',
        'relacion' => 'otrosequipos',
        'ruta'     => 'asignaciones.Equipos'
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
            'color' => '#17a2b8'
        ],

        2 => [
            'label' => 'En proceso',
            'color' => '#ffc107'
        ],

        3 => [
            'label' => 'Apersonarse con el técnico',
            'color' => '#dc3545'
        ],

        4 => [
            'label' => 'Concluido',
            'color' => '#28a745'
        ],

        5 => [
            'label' => 'Entregados',
            'color' => '#007bff'
        ],

    ];


    /*
    |--------------------------------------------------------------------------
    | VARIABLES PARA NOTIFICACIONES
    |--------------------------------------------------------------------------
    */

    $totalPendientes = 0;

    $totalInformesPendientes = 0;

    $detallePendientes = [];

    $detalleInformes = [];


    /*
    |--------------------------------------------------------------------------
    | RECORRER CADA TIPO DE EQUIPO
    |--------------------------------------------------------------------------
    */

    foreach ($asignaciones as $item) {

        $relacion = $item['relacion'];

        /*
        |--------------------------------------------------------------------------
        | CONSULTA BASE DEL TÉCNICO
        |--------------------------------------------------------------------------
        */

        $consulta = $user->$relacion()
            ->whereYear('fecha_asignacion', now()->year);


        /*
        |--------------------------------------------------------------------------
        | TRABAJOS PENDIENTES
        |
        | Estados:
        | 1 = Recepcionado
        | 2 = En proceso
        | 3 = Apersonarse con técnico
        | 4 = Concluido
        |--------------------------------------------------------------------------
        */

        $pendientes = $user->$relacion()
            ->whereYear('fecha_asignacion', now()->year)
            ->whereIn('estado_id', [1, 2, 3, 4])
            ->count();


        if ($pendientes > 0) {

            $totalPendientes += $pendientes;

            $detallePendientes[] = [
                'titulo' => $item['titulo'],
                'cantidad' => $pendientes,
                'ruta' => route($item['ruta'])
            ];

        }


        /*
        |--------------------------------------------------------------------------
        | INFORME PENDIENTE
        |
        | Estado 1
        | Sin resultado
        | 3 días o más
        |--------------------------------------------------------------------------
        */

        $informes = $user->$relacion()
            ->whereYear('fecha_asignacion', now()->year)
            ->where('estado_id', 1)
            ->whereNull('resultado_id')
            ->where('fecha_asignacion', '<=', now()->subDays(3))
            ->count();


        if ($informes > 0) {

            $totalInformesPendientes += $informes;

            $detalleInformes[] = [
                'titulo' => $item['titulo'],
                'cantidad' => $informes,
                'ruta' => route($item['ruta'])
            ];

        }

    }


    /*
    |--------------------------------------------------------------------------
    | TOTAL DE NOTIFICACIONES
    |--------------------------------------------------------------------------
    */

    $totalNotificaciones =
        $totalPendientes +
        $totalInformesPendientes;

@endphp


{{-- ============================================================
    CONTENEDOR PRINCIPAL
    ============================================================ --}}

<div class="container-fluid">


    {{-- ========================================================
        CABECERA DEL PANEL
        ======================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

        </div>


        {{-- ====================================================
            CAMPANA DE NOTIFICACIONES
            ==================================================== --}}

        <div class="dropdown">

                <button
                    type="button"
                    class="btn-notificacion-dropdown"
                    id="btnNotificaciones"
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


            {{-- =================================================
                DROPDOWN
                ================================================= --}}

            <div
                class="dropdown-menu dropdown-menu-right shadow-lg p-0"
                aria-labelledby="btnNotificaciones"
                style="
                    width: 360px;
                    max-width: 90vw;
                    border: 1px solid #dee2e6;
                    border-radius: 12px;
                    overflow: hidden;
                "
            >


                {{-- =============================================
                    CABECERA
                    ============================================= --}}

                <div
                    style="
                        background: #1e2a38;
                        color: white;
                        padding: 14px 18px;
                    "
                >

                    <div class="d-flex align-items-center">

                        <i class="fas fa-bell mr-2"></i>

                        <strong>
                            NOTIFICACIONES
                        </strong>

                    </div>

                    <small class="d-block mt-1" style="opacity: .8;">
                        Seguimiento de trabajos asignados
                    </small>

                </div>


                {{-- =============================================
                    SI NO EXISTEN NOTIFICACIONES
                    ============================================= --}}

                @if($totalNotificaciones == 0)

                    <div class="text-center p-4">

                        <i
                            class="fas fa-check-circle mb-3"
                            style="
                                font-size: 38px;
                                color: #28a745;
                            "
                        ></i>

                        <div class="font-weight-bold">
                            Todo está al día
                        </div>

                        <small class="text-muted">
                            No tienes notificaciones pendientes.
                        </small>

                    </div>

                @else


                    {{-- =========================================
                        TRABAJOS PENDIENTES
                        ========================================= --}}

                    @if($totalPendientes > 0)

                        <div class="notification-section">

                            <button
                                type="button"
                                class="btn btn-link btn-block text-left text-decoration-none px-3 py-3"
                                data-toggle="collapse"
                                data-target="#detalleTrabajosPendientes"
                                aria-expanded="false"
                            >

                                <div class="d-flex align-items-center">

                                    <div
                                        class="mr-3"
                                        style="
                                            width: 38px;
                                            height: 38px;
                                            border-radius: 50%;
                                            background: #fff3cd;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                        "
                                    >

                                        <i
                                            class="fas fa-exclamation-triangle"
                                            style="color:#856404;"
                                        ></i>

                                    </div>


                                    <div class="flex-grow-1">

                                        <div
                                            class="font-weight-bold"
                                            style="color:#343a40;"
                                        >
                                            Trabajos pendientes
                                        </div>

                                        <small class="text-muted">
                                            Tienes
                                            <strong>
                                                {{ $totalPendientes }}
                                            </strong>
                                            trabajo(s) por atender.
                                        </small>

                                    </div>


                                    <span
                                        class="badge badge-warning"
                                        style="
                                            font-size: 12px;
                                            padding: 6px 9px;
                                        "
                                    >
                                        {{ $totalPendientes }}
                                    </span>

                                </div>

                            </button>


                            {{-- DETALLE --}}

                            <div
                                id="detalleTrabajosPendientes"
                                class="collapse"
                            >

                                <div
                                    class="px-3 pb-3"
                                    style="
                                        border-top: 1px solid #f0f0f0;
                                    "
                                >

                                    @foreach($detallePendientes as $detalle)

                                        <a
                                            href="{{ $detalle['ruta'] }}"
                                            class="d-flex justify-content-between align-items-center py-2 text-decoration-none"
                                            style="color:#495057;"
                                        >

                                            <span>
                                                <i
                                                    class="fas fa-tools mr-2"
                                                    style="color:#0052cc;"
                                                ></i>

                                                {{ $detalle['titulo'] }}
                                            </span>

                                            <span class="badge badge-light">
                                                {{ $detalle['cantidad'] }}
                                            </span>

                                        </a>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- =========================================
                        INFORME PENDIENTE
                        ========================================= --}}

                    @if($totalInformesPendientes > 0)

                        <div class="notification-section border-top">

                            <button
                                type="button"
                                class="btn btn-link btn-block text-left text-decoration-none px-3 py-3"
                                data-toggle="collapse"
                                data-target="#detalleInformesPendientes"
                                aria-expanded="false"
                            >

                                <div class="d-flex align-items-center">

                                    <div
                                        class="mr-3"
                                        style="
                                            width: 38px;
                                            height: 38px;
                                            border-radius: 50%;
                                            background: #f8d7da;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
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

                                            <strong>
                                                {{ $totalInformesPendientes }}
                                            </strong>

                                            equipo(s) requieren informe.

                                        </small>

                                    </div>


                                    <span
                                        class="badge badge-danger"
                                        style="
                                            font-size: 12px;
                                            padding: 6px 9px;
                                        "
                                    >
                                        {{ $totalInformesPendientes }}
                                    </span>

                                </div>

                            </button>


                            {{-- DETALLE --}}

                            <div
                                id="detalleInformesPendientes"
                                class="collapse"
                            >

                                <div
                                    class="px-3 pb-3"
                                    style="
                                        border-top: 1px solid #f0f0f0;
                                    "
                                >

                                    @foreach($detalleInformes as $detalle)

                                        <a
                                            href="{{ $detalle['ruta'] }}"
                                            class="d-flex justify-content-between align-items-center py-2 text-decoration-none"
                                            style="color:#495057;"
                                        >

                                            <span>

                                                <i
                                                    class="fas fa-file-alt mr-2"
                                                    style="color:#dc3545;"
                                                ></i>

                                                {{ $detalle['titulo'] }}

                                            </span>

                                            <span class="badge badge-light">
                                                {{ $detalle['cantidad'] }}
                                            </span>

                                        </a>

                                    @endforeach

                                </div>

                            </div>

                        </div>

                    @endif

                @endif


                {{-- =============================================
                    PIE
                    ============================================= --}}

                <div
                    class="text-center"
                    style="
                        background:#f8f9fa;
                        border-top:1px solid #dee2e6;
                        padding:8px;
                    "
                >

                    <small class="text-muted">
                        Actualizado al cargar el panel
                    </small>

                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================
        TARJETAS DE EQUIPOS
        ======================================================== --}}

    <div class="row">

        @foreach($asignaciones as $item)

            @php

                $relacion = $item['relacion'];

                /*
                |--------------------------------------------------------------------------
                | TOTAL DEL AÑO
                |--------------------------------------------------------------------------
                */

                $consulta = $user->$relacion()
                    ->whereYear('fecha_asignacion', now()->year);

                $totalReal = $consulta->count();

                /*
                |--------------------------------------------------------------------------
                | EVITAR DIVISIÓN ENTRE CERO
                |--------------------------------------------------------------------------
                */

                $total = $totalReal ?: 1;


                /*
                |--------------------------------------------------------------------------
                | DETERMINAR SI LA TARJETA DEBE PARPADEAR
                |--------------------------------------------------------------------------
                */

                $parpadea = $user->$relacion()
                    ->whereYear('fecha_asignacion', now()->year)
                    ->whereIn('estado_id', [1, 2, 3, 4])
                    ->exists();

            @endphp


            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">

                <div
                    class="card shadow-sm h-100
                    {{ $parpadea ? 'card-pendiente' : '' }}"
                    style="
                        border:1px solid #dee2e6;
                        border-radius:12px;
                        overflow:hidden;
                    "
                >

                    {{-- =========================================
                        CABECERA
                        ========================================= --}}

                        <div
                            class="card-header d-flex align-items-center"
                            style="
                                background:#1e2a38;
                                color:white;
                                border:0;
                                padding:15px;
                            "
                        >
                            <i
                                class="{{ $item['icono'] }} mr-2"
                                style="font-size:22px;"
                            ></i>

                            <strong>{{ $item['titulo'] }}</strong>
                        </div>


                    {{-- =========================================
                        CUERPO
                        ========================================= --}}

                    <div class="card-body text-center">

                        <div
                            style="
                                font-size:34px;
                                font-weight:700;
                                color:#1e2a38;
                            "
                        >
                            {{ $totalReal }}
                        </div>

                        <small class="text-muted">
                            EQUIPOS ASIGNADOS - {{ now()->year }}
                        </small>


                        {{-- =====================================
                            ESTADOS
                            ===================================== --}}

                        <div class="mt-3">

                            @foreach($estados as $estadoId => $estado)

                                @php

                                    $cantidadEstado = $user->$relacion()
                                        ->whereYear(
                                            'fecha_asignacion',
                                            now()->year
                                        )
                                        ->where(
                                            'estado_id',
                                            $estadoId
                                        )
                                        ->count();

                                @endphp


                                <div
                                    class="d-flex justify-content-between align-items-center py-1"
                                >

                                    <span
                                        class="small text-left"
                                    >
                                        {{ $estado['label'] }}
                                    </span>

                                    <span
                                        class="badge"
                                        style="
                                            background:{{ $estado['color'] }};
                                            color:
                                            {{ $estadoId == 2
                                                ? '#212529'
                                                : '#fff'
                                            }};
                                        "
                                    >
                                        {{ $cantidadEstado }}
                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- =========================================
                        PIE DE TARJETA
                        ========================================= --}}

                    <div
                        class="card-footer text-center"
                        style="
                            background:#f8f9fa;
                            border-top:1px solid #dee2e6;
                        "
                    >

                        <a
                            href="{{ route($item['ruta']) }}"
                            class="btn btn-sm btn-primary"
                        >

                            <i class="fas fa-eye mr-1"></i>

                            Ver asignaciones

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>


{{-- ============================================================
    ESTILOS
    ============================================================ --}}

<link
    rel="stylesheet"
    href="{{ asset('estilos/panelTec.css') }}"
>


<style>

    /*
    |--------------------------------------------------------------------------
    | CAMPANA
    |--------------------------------------------------------------------------
    */

    #btnNotificaciones {
        transition: all .2s ease;
    }

    #btnNotificaciones:hover {
        background: #f1f4f7;
        transform: translateY(-1px);
    }


    /*
    |--------------------------------------------------------------------------
    | NOTIFICACIONES
    |--------------------------------------------------------------------------
    */

    .notification-section button {
        color: inherit;
    }

    .notification-section button:hover {
        background: #f8f9fa;
        text-decoration: none;
    }

    .notification-section a:hover {
        background: #f8f9fa;
        color: #0052cc !important;
    }


    /*
    |--------------------------------------------------------------------------
    | TARJETAS CON PENDIENTES
    |--------------------------------------------------------------------------
    */

    .card-pendiente {
        animation: alertaTarjeta 1.8s infinite;
    }

    @keyframes alertaTarjeta {

        0% {
            box-shadow: 0 0 0 rgba(220, 53, 69, 0);
        }

        50% {
            box-shadow: 0 0 10px rgba(220, 53, 69, .30);
        }

        100% {
            box-shadow: 0 0 0 rgba(220, 53, 69, 0);
        }

    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 576px) {

        .dropdown-menu {
            width: 320px !important;
            max-width: calc(100vw - 30px) !important;
        }

    }

</style>


{{-- ============================================================
    SWEETALERT
    ============================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | DATOS DE NOTIFICACIONES
    |--------------------------------------------------------------------------
    */

    const totalPendientes =
        {{ $totalPendientes }};

    const totalInformesPendientes =
        {{ $totalInformesPendientes }};


    /*
    |--------------------------------------------------------------------------
    | MOSTRAR INFORME PENDIENTE
    |--------------------------------------------------------------------------
    */

    function mostrarInformePendiente() {

        if (totalInformesPendientes <= 0) {
            return;
        }

        Swal.fire({

            icon: 'warning',

            title: 'Informe pendiente',

            html:
                'Tienes <strong>' +
                totalInformesPendientes +
                '</strong> equipo(s) con informe pendiente ' +
                'desde hace 3 días o más.',

            confirmButtonText: 'Aceptar',

            confirmButtonColor: '#0052cc',

            allowOutsideClick: false,

            allowEscapeKey: true

        });

    }


    /*
    |--------------------------------------------------------------------------
    | MOSTRAR BUEN TRABAJO
    |--------------------------------------------------------------------------
    */

    function mostrarBuenTrabajo() {

        Swal.fire({

            icon: 'success',

            title: '¡Buen trabajo!',

            text: 'No tienes trabajos pendientes.',

            confirmButtonText: 'Aceptar',

            confirmButtonColor: '#0052cc',

            allowOutsideClick: false

        });

    }


    /*
    |--------------------------------------------------------------------------
    | MOSTRAR TRABAJOS PENDIENTES
    |--------------------------------------------------------------------------
    */

    function mostrarTrabajosPendientes() {

        Swal.fire({

            icon: 'warning',

            title: 'Trabajos pendientes',

            html:
                'Tienes <strong>' +
                totalPendientes +
                '</strong> trabajo(s) pendiente(s) ' +
                'por atender.',

            confirmButtonText: 'Aceptar',

            confirmButtonColor: '#0052cc',

            allowOutsideClick: false,

            allowEscapeKey: true

        }).then(function () {

            /*
            |--------------------------------------------------------------------------
            | DESPUÉS DEL PRIMER ALERTA
            |--------------------------------------------------------------------------
            */

            if (totalInformesPendientes > 0) {

                mostrarInformePendiente();

            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | ALERTA PRINCIPAL
    |--------------------------------------------------------------------------
    */

    setTimeout(function () {

        if (totalPendientes > 0) {

            mostrarTrabajosPendientes();

        } else if (totalInformesPendientes > 0) {

            mostrarInformePendiente();

        } else {

            mostrarBuenTrabajo();

        }

    }, 700);

});

</script>