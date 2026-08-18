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
    ['title' => 'CPU', 'icon' => 'ion-ios-cog', 'color' => 'bg-gradient-info', 'modal' => '#modalCPU'],
    ['title' => 'IMPRESORAS', 'icon' => 'ion-printer', 'color' => 'bg-gradient-success', 'modal' => '#modalImpresora'],
    ['title' => 'MONITORES', 'icon' => 'ion-monitor', 'color' => 'bg-gradient-warning', 'modal' => '#modalMonitor'],
    ['title' => 'AUDIFONOS', 'icon' => 'ion-headphone', 'color' => 'bg-gradient-purple', 'modal' => '#modalAudifono'],
    ['title' => 'TECLADOS', 'icon' => 'ion-stop', 'color' => 'bg-gradient-info', 'modal' => '#modalTeclado'],
    ['title' => 'PARLANTES', 'icon' => 'ion-volume-high', 'color' => 'bg-gradient-success', 'modal' => '#modalParlante'],
    ['title' => 'MOUSE', 'icon' => 'ion-mouse', 'color' => 'bg-gradient-warning', 'modal' => '#modalRaton'],
    ['title' => 'U.P.S.', 'icon' => 'ion-stop', 'color' => 'bg-gradient-purple', 'modal' => '#modalUPS'],
    ['title' => 'ESTABILIZADORES', 'icon' => 'ion-outlet', 'color' => 'bg-gradient-info', 'modal' => '#modalEstabilizador'],
    ['title' => 'LAPTOPS', 'icon' => 'ion-laptop', 'color' => 'bg-gradient-success', 'modal' => '#modalLaptop'],
];
@endphp



<div class="row g-4">
    @foreach($boxes as $box)
        <div class="col-md-4 col-lg-3 col-sm-6">
            
            <div class="card card-dashboard h-100">

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
<link rel="stylesheet" href="{{ asset('estilos/header.css') }}">  
<link rel="stylesheet" href="{{ asset('estilos/registroCpu.css') }}">  
<link rel="stylesheet" href="{{ asset('estilos/modalReporte.css') }}">  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@endpush
