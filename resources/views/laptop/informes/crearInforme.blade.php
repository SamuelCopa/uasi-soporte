@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} 
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <h4>{{ __('INFORME') }} LAPTOP</h4>
                        @role('Administrador')
                        <div class="float-right">
                            <a class="btn btn-primary boton movnav" href="{{ route('laptops.index') }}"> {{ __('VOLVER') }}</a>
                        </div>
                        @endrole
                        @role('Tecnico')
                        <div class="float-right">
                            <a class="btn btn-primary boton movnav" href="{{  route('asignaciones.laptop') }}"> {{ __('VOLVER A ASIGNACIONES') }}</a>
                        </div>
                        @endrole
                    </div>
                    <div class="card">
                        <form class="formInforme" method="POST" action="{{ route('informe.descargar', $laptop->id) }}"  role="form" enctype="multipart/form-data" target="_blank" autocomplete="off">
                            @csrf

                            @include('laptop.informes.informe1')
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script src="{{ asset('js/informes.js') }}"></script>
<script src="{{ asset('js/mov.js') }}"></script>
<script src="{{ asset('js/buscar.js') }}"></script>

<script>
    $('.formInforme').submit(function(e){
        e.preventDefault();

        Swal.fire({
        title: "Generar informe?",
        text: "El informe se descargara!!!",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, generar y descargar!",
        cancelButtonText: "Cancelar",
        }).then((result) => {
        if (result.isConfirmed) {    
            this.submit();
        }
        });
    })
</script>
<script>
  var quill = new Quill('.editor3', {
    theme: 'snow',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
      ]
    }
  });
</script>
<script>
  var quill = new Quill('.editor2', {
    theme: 'snow',
    modules: {
      toolbar: [
        ['bold', 'italic', 'underline'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
      ]
    }
  });
</script>
<link rel="stylesheet" href="{{ asset('estilos/informe.css') }}">
@endpush



