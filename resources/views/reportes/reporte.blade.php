@extends('layouts.app')

@section('content')
@section('content_header')
    <div class="header-panel">

        <div class="header-left">
            <h1 class="header-title">Panel de Reportes</h1>

            <div class="header-subtitle">
                Usuario: 
                <strong>{{ $user->name }} {{ $user->paterno }} {{ $user->materno }}</strong>
            </div>
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
@stop

<div class="row">
@php
$boxes = [
    ['title' => 'CPU', 'icon' => 'ion-ios-cog', 'modal' => '#modalCPU'],
    ['title' => 'IMPRESORAS', 'icon' => 'ion-printer', 'modal' => '#modalImpresora'],
    ['title' => 'MONITORES', 'icon' => 'ion-monitor', 'modal' => '#modalMonitor'],
    ['title' => 'AUDIFONOS', 'icon' => 'ion-headphone', 'modal' => '#modalAudifono'],
    ['title' => 'TECLADOS', 'icon' => 'ion-stop', 'modal' => '#modalTeclado'],
    ['title' => 'PARLANTES', 'icon' => 'ion-volume-high', 'modal' => '#modalParlante'],
    ['title' => 'MOUSE', 'icon' => 'ion-mouse', 'modal' => '#modalRaton'],
    ['title' => 'U.P.S.', 'icon' => 'ion-stop', 'modal' => '#modalUPS'],
    ['title' => 'ESTABILIZADORES', 'icon' => 'ion-outlet', 'modal' => '#modalEstabilizador'],
    ['title' => 'LAPTOPS', 'icon' => 'ion-laptop', 'modal' => '#modalLaptop'],
    ['title' => 'OTROS EQUIPOS', 'icon' => 'ion-laptop', 'modal' => '#modalotros'],
];
@endphp



<div class="row g-4">
    @foreach($boxes as $box)
        <div class="col-md-4 col-lg-3 col-sm-6">
            
            <div class="card dashboard-card-prof  h-100">

                <div class="card-body d-flex flex-column justify-content-between">

                    <!-- ICONO -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="icon-box">
                            <i class="{{ $box['icon'] }}"></i>
                        </div>
                    </div>

                    <!-- TITULO -->
                    <div class="mb-3">
                        <h6 class="titulo-box">{{ $box['title'] }}</h6>
                    </div>

                    <!-- ACCION -->
                    <button 
                        class="btn btn-institucional w-100 mt-auto"
                        data-toggle="modal" 
                        data-target="{{ $box['modal'] }}"
                    >
                        <i class="fas fa-chart-bar me-1"></i>
                        Ver reportes
                    </button>

                </div>
            </div>

        </div>
    @endforeach
</div>
<style>
    /* =========================================================
   CARDS DEL DASHBOARD
   ========================================================= */

.dashboard-card-prof {
    position: relative;

    background: #ffffff;

    border: 1px solid #cbd5e1;
    border-radius: 18px;

    overflow: hidden;

    box-shadow:
        0 3px 10px rgba(0, 0, 0, 0.05);

    transition:
        transform .30s ease,
        box-shadow .30s ease,
        border-color .30s ease;
}


/* =========================================================
   BORDE SUPERIOR DEGRADADO
   ========================================================= */

.dashboard-card-prof::before {
    content: "";

    position: absolute;

    top: 0;
    left: 0;

    width: 100%;
    height: 5px;

    background: var(--degradado-principal);
}


/* =========================================================
   CONTENIDO
   ========================================================= */

.dashboard-card-prof .card-body {
    padding: 24px;

    min-height: 220px;
}


/* =========================================================
   ICONO
   ========================================================= */

.dashboard-card-prof .icon-box {

    width: 58px;
    height: 58px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 14px;

    background: linear-gradient(
        135deg,
        rgba(0, 82, 204, 0.10),
        rgba(38, 132, 255, 0.18)
    );

    border: 1px solid rgba(0, 82, 204, 0.25);

    color: #0052cc;

    font-size: 24px;

    transition: all .30s ease;
}


/* =========================================================
   TITULO
   ========================================================= */

.dashboard-card-prof .titulo-box {

    margin: 0;

    color: #1e293b;

    font-size: 15px;
    font-weight: 600;

    line-height: 1.4;
}


/* =========================================================
   BOTON
   ========================================================= */

.dashboard-card-prof .btn-institucional {

    border-radius: 91px;

    padding: 9px 14px;

    font-size: 13px;
    font-weight: 600;

    transition: all .25s ease;
}


/* =========================================================
   EFECTO HOVER
   ========================================================= */

.dashboard-card-prof:hover {

    transform: translateY(-6px);

    border-color: #2684ff;

    box-shadow:
        0 12px 30px rgba(0, 82, 204, 0.14);
}


/* Icono al pasar el mouse */

.dashboard-card-prof:hover .icon-box {

    transform: scale(1.06);

    background: var(--degradado-principal);

    border-color: #2684ff;
}


/* =========================================================
   EFECTO DEL BORDE
   ========================================================= */

.dashboard-card-prof:hover::before {

    height: 6px;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 767px) {

    .dashboard-card-prof .card-body {
        padding: 20px;
        min-height: 200px;
    }

    .dashboard-card-prof .icon-box {
        width: 52px;
        height: 52px;
        font-size: 21px;
    }

}
</style>

</div>

<!--Ventana Modal para Reporte--->
@include('reportes.audifono.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.cpu.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.estabilizador.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.impresora.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.laptop.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.monitor.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.mouse.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.parlante.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.teclado.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.ups.modalReporte')
<!--Ventana Modal para Reporte--->
@include('reportes.equipo.modalReporte')

@endsection

@push('js')
<script src="{{ asset('js/funcion.js') }}"></script>
<script src="{{ asset('js/mov.js') }}"></script>
<script src="{{ asset('js/buscar.js') }}"></script>
<script src="{{ asset('js/registroCpu.js') }}"></script>

<script>
Swal.fire({
    title: '<strong>¡BIENVENIDO!</strong>',
    html: 'Bienvenido al <b>sistema de reportes</b> 📊',
    icon: 'success',
    showConfirmButton: true,
    // timer: 6000,
    // timerProgressBar: true,
});

</script>
@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('estilos/modalReporte.css') }}">  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endpush
