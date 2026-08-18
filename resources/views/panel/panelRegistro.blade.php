@extends('layouts.app')
@section('content')

  <script>
    Swal.fire({
    title: "BIENVENIDO !",
    text: "Realice el registro del equipo",
      icon: "success",
      showConfirmButton: false,
      timer: 3500
    });
  </script>
<div class="row">
  <div class="col-lg-12 col-xs-6">
      <!-- small box -->
      <div class="small-box">
        <div class="card-header">
          <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">

      </div>
  </div>
</div>
<div class="row">
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>CPU<inf style="font-size: 20px">S</inf></h3>
      </div>
      <div class="icon">
        <i class="ion ion-stop"></i>
      </div>
      <a href="{{ route('registro-cpus.create') }}" class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#crear"><h4>REGISTRAR</h4></a>
    </div>
  </div>
<!--Ventana Modal para Crear--->

  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green ">
      <div class="inner">
        <h3>IMPRESORAS</h3>

        <h3>{{ App\Models\Impresora::where('estado_id', '!=', 6)->count() }}</h3> 
      </div>
      <div class="icon">
        <i class="ion ion-printer"></i>
      </div>
      <a href="{{ route('impresoras.create') }}" class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#creari"><h4>REGISTRAR</h4></a>
    </div>
  </div>
 
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow ">
      <div class="inner">
        <h3>MONITORES</h3>

        <h3>{{ App\Models\Monitor::where('estado_id', '!=', 6)->count() }}</h3> 
      </div>
      <div class="icon">
        <i class="ion ion-monitor"></i>
      </div>
      <a href="{{ route('monitors.create') }}" class="small-box-footer boton movnav"  data-placement="left" data-toggle="modal" data-target="#crearm"><h4>REGISTRAR</h4></a>
    </div>
  </div>
 
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>AUDIFONOS</h3>

        <h3>{{ App\Models\Audifono::where('estado_id', '!=', 6)->count() }}</h3> 

      </div>
      <div class="icon">
        <i class="ion ion-headphone"></i>
      </div>
      <a href="{{ route('audifonos.create') }}" class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#creara"><h4>REGISTRAR</h4></a>
    </div>
  </div>

  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
     <div class="small-box bg-info">
      <div class="inner">
        <h3>TECLADOS</h3>

        <h3>{{ App\Models\Teclado::where('estado_id', '!=', 6)->count() }}</h3>                              
      </div>
      <div class="icon">
        <i class="ion ion-stop"></i>
      </div>
      <a href="{{ route('teclados.create') }}" class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#creart"><h4>REGISTRAR</h4></a>
    </div>
  </div>

  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3>PARLANTES</h3>

        <h3>{{ App\Models\Parlante::where('estado_id', '!=', 6)->count() }}</h3>                              
      </div>
      <div class="icon">
        <i class="ion ion-volume-high"></i>
      </div>
      <a href="{{ route('parlantes.create') }}"  class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#crearp"><h4>REGISTRAR</h4></a>
    </div>
  </div>

  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3>MOUSE</h3>

        <h3>{{ App\Models\Raton::where('estado_id', '!=', 6)->count() }}</h3>                              
      </div>
      <div class="icon">
        <i class="ion ion-mouse"></i>
      </div>
      <a href="{{ route('ratons.create') }}"  class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#crearr"><h4>REGISTRAR</h4></a>
    </div>
  </div>

  <!-- ./col -->
  <!-- ./col -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>U.P.S.</h3>

        <h3>{{ App\Models\Upese::where('estado_id', '!=', 6)->count() }}</h3>                              
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="{{ route('upeses.create') }}" class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#crearu"><h4>REGISTRAR</h4></a>
    </div>
  </div>
  <!-- ./col estabilizador -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
   <div class="small-box bg-info">
      <div class="inner">
        <h3>ESTABILIZADORES</h3>

        <h3>{{ App\Models\Estabilizador::where('estado_id', '!=', 6)->count() }}</h3>  
      </div>
      <div class="icon">
        <i class="ion ion-outlet"></i>
      </div>
      <a href="{{ route('estabilizadors.create') }}" class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#creare"><h4>REGISTRAR</h4></a>
    </div>
  </div>
  <!-- ./col estabilizador -->
  <div class="col-lg-3 col-xs-6">
    <!-- small box -->
   <div class="small-box bg-success">
      <div class="inner">
        <h3>LAPTOPS</h3>

        <h3>{{ App\Models\Laptop::where('estado_id', '!=', 6)->count() }}</h3>  
      </div>
      <div class="icon">
        <i class="ion ion-outlet"></i>
      </div>
      <a href="{{ route('laptops.create') }}" class="small-box-footer boton movnav" data-placement="left" data-toggle="modal" data-target="#crearl"><h4>REGISTRAR</h4></a>
    </div>
  </div>

</div>
@include('registro-cpu.modalCrear')
@include('impresora.modalCrear')
@include('audifono.modalCrear')
@include('monitor.modalCrear')
@include('teclado.modalCrear')
@include('parlante.modalCrear')
@include('raton.modalCrear')
@include('upese.modalCrear')
@include('estabilizador.modalCrear')
@include('laptop.modalCrear')
@endsection
@push('js')
<script src="{{ asset('js/funcion.js') }}"></script>
<script src="{{ asset('js/mov.js') }}"></script>
<script src="{{ asset('js/buscar.js') }}"></script>
<script src="{{ asset('js/registroCpu.js') }}"></script>

@endpush

@push('css')
<link rel="stylesheet" href="{{ asset('estilos/registroCpu.css') }}">  
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
{{-- <link rel="stylesheet" href="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/css/metro-icons.min.css"> --}}
@endpush