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
                        <h4>{{ __('INFORME') }} ESTABILIZADOR</h4>
                        @role('Administrador')
                        <div class="float-right">
                            <a class="btn btn-primary boton movnav" href="{{ route('estabilizadors.index') }}"> {{ __('VOLVER') }}</a>
                        </div>
                        @endrole
                        @role('Tecnico')
                        <div class="float-right">
                            <a class="btn btn-primary boton movnav" href="{{  route('asignaciones.estabilizador') }}"> {{ __('VOLVER A ASIGNACIONES') }}</a>
                        </div>
                        @endrole
                    </div>
                    <div class="card">
                        <form class="formInforme" method="POST" action="{{ route('informe.descargar',$estabilizador->id) }}"  role="form" enctype="multipart/form-data" target="_blank" autocomplete="off">
                            @csrf

                            @include('estabilizador.informes.informe1')
                            
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
<script>
    document.getElementById('enviar').addEventListener('click', function() {
        var formData1 = new FormData(document.getElementById('form1'));
        fetch('ruta1', {
            method: 'POST',
            body: formData1
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error));

        var formData2 = new FormData(document.getElementById('form2'));
        fetch('ruta2', {
            method: 'GET',
            body: formData2
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error));
    });
</script>
<link rel="stylesheet" href="{{ asset('estilos/informe.css') }}">
@endpush



