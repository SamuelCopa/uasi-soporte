@extends('adminlte::page')

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle') | @yield('subtitle') @endif
@stop
@push('css')
<style type="text/css">


</style>

<style>
    .dropdown-item i {
    margin-right: 5px;
}
</style>
<!-- Opcional: Bootstrap Icons (para íconos como bi-person-gear) -->
<!-- Bootstrap Icons (deja SOLO una versión) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

<!-- Ionicons -->
<link rel="stylesheet" href="plugins/Ionicons/css/ionicons.min.css">
 <!-- <link rel="stylesheet" href="{{ asset('estilos/usermenu.css') }}?v={{ time() }}"> -->

<!-- Tus estilos personalizados (al final SIEMPRE) -->
<link rel="stylesheet" href="{{ asset('estilos/estilos.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/estilos2.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/dark.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/tabla.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/main.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/botones.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/headfijo.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/header.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

@endpush

@section('content_header')
    @hasSection('content_header_title')

        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop


{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right footer-version">
        Version: {{ config('app.version', '1.0.0 - S@mmy - ') }}{{date('Y');}}
    </div>
    <strong>
        <a href="{{ config('app.company_url', '#') }}" class="link-institucional">
            {{ config('app.company_name', 'GAMEA - UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN - ÁREA DE SOPORTE TÉCNICO ') }}
        </a>
    </strong>
@stop

{{-- Add common Javascript/Jquery code --}}

@push('js')
<script src="{{ asset('js/dark.js') }}"></script>
<script src="{{ asset('js/editar.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tituloOriginal = document.title;
    let intervaloParpadeo = null;
    /*
    |--------------------------------------------------------------------------
    | ROL DEL USUARIO
    |--------------------------------------------------------------------------
    */
    const esAdministrador = @json(
        auth()->check() &&
        auth()->user()->hasAnyRole([
            'Administrador',
            'SuperAdministrador'
        ])
    );
    const esTecnico = @json(
        auth()->check() &&
        auth()->user()->hasRole('Tecnico')
    );
    /*
    |--------------------------------------------------------------------------
    | IDENTIFICADORES GUARDADOS
    |--------------------------------------------------------------------------
    */
    let ultimoAvisado = esAdministrador
        ? localStorage.getItem('ultimoServicioAvisadoAdmin')
        : localStorage.getItem('ultimaAsignacionAvisadaTecnico');
    /*
    |--------------------------------------------------------------------------
    | PRIMERA CONSULTA
    |--------------------------------------------------------------------------
    |
    | Evita que al abrir/reload el Home hable de una notificación
    | que ya existía anteriormente.
    |
    */
    let primeraConsulta = true;
    /*
    |--------------------------------------------------------------------------
    | PARPADEO
    |--------------------------------------------------------------------------
    */
    function iniciarParpadeo() {
        if (intervaloParpadeo) return;
        intervaloParpadeo = setInterval(() => {
            document.title =
                document.title === tituloOriginal
                    ? '🔴 ¡Nueva notificación!'
                    : tituloOriginal;
        }, 1000);
    }
    function detenerParpadeo() {
        if (!intervaloParpadeo) return;
        clearInterval(intervaloParpadeo);
        intervaloParpadeo = null;
        document.title = tituloOriginal;
    }
    /*
    |--------------------------------------------------------------------------
    | VOZ
    |--------------------------------------------------------------------------
    */
    function hablar(mensaje) {
        if (!('speechSynthesis' in window)) {
            console.log(
                'El navegador no soporta síntesis de voz.'
            );
            return;
        }
        window.speechSynthesis.cancel();
        const voz = new SpeechSynthesisUtterance(mensaje);
        voz.lang = 'es-ES';
        voz.rate = 0.9;
        voz.pitch = 1;
        voz.volume = 1;
        window.speechSynthesis.speak(voz);
    }
    /*
    |--------------------------------------------------------------------------
    | VERIFICAR NOTIFICACIONES
    |--------------------------------------------------------------------------
    */
    function verificarNotificaciones() {
        fetch('/hay-pendientes', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            /*
            |--------------------------------------------------------------------------
            | ADMINISTRADOR
            |--------------------------------------------------------------------------
            */
            if (
                esAdministrador &&
                data.tipo === 'nuevo_requerimiento'
            ) {
                if (data.hayPendientes) {
                    iniciarParpadeo();
                    /*
                    |----------------------------------------------------------
                    | PRIMERA CONSULTA
                    |----------------------------------------------------------
                    */
                    if (primeraConsulta) {
                        if (data.id) {
                            ultimoAvisado = data.id;

                            localStorage.setItem(
                                'ultimoServicioAvisadoAdmin',
                                data.id
                            );
                        }
                    }
                    /*
                    |----------------------------------------------------------
                    | NUEVO REQUERIMIENTO
                    |----------------------------------------------------------
                    */
                    else if (
                        data.id &&
                        String(data.id) !==
                        String(ultimoAvisado)
                    ) {
                        hablar(
                            'Atención. Se ha recibido un nuevo requerimiento de servicio.'
                        );
                        ultimoAvisado = data.id;
                        localStorage.setItem(
                            'ultimoServicioAvisadoAdmin',
                            data.id
                        );
                    }
                } else {
                    detenerParpadeo();
                }
            }
            /*
            |--------------------------------------------------------------------------
            | TÉCNICO
            |--------------------------------------------------------------------------
            */
            if (
                esTecnico &&
                data.tipo === 'asignacion'
            ) {
                if (data.hayPendientes) {
                    iniciarParpadeo();
                    /*
                    |----------------------------------------------------------
                    | PRIMERA CONSULTA
                    |----------------------------------------------------------
                    */

                    if (primeraConsulta) {
                        if (data.id) {
                            ultimoAvisado = data.id;
                            localStorage.setItem(
                                'ultimaAsignacionAvisadaTecnico',
                                data.id
                            );
                        }
                    }
                    /*
                    |----------------------------------------------------------
                    | NUEVA ASIGNACIÓN
                    |----------------------------------------------------------
                    */
                    else if (
                        data.id &&
                        String(data.id) !==
                        String(ultimoAvisado)
                    ) {
                        hablar(
                            'Atención. Se le ha asignado un nuevo requerimiento de servicio.'
                        );
                        ultimoAvisado = data.id;
                        localStorage.setItem(
                            'ultimaAsignacionAvisadaTecnico',
                            data.id
                        );
                    }
                } else {
                    detenerParpadeo();
                }
            }
            /*
            |--------------------------------------------------------------------------
            | YA SE REALIZÓ LA PRIMERA CONSULTA
            |--------------------------------------------------------------------------
            */
            primeraConsulta = false;
        })
        .catch(error => {
            console.error(
                'Error al verificar notificaciones:',
                error
            );
        });
    }
    /*
    |--------------------------------------------------------------------------
    | INICIAR
    |--------------------------------------------------------------------------
    */
    verificarNotificaciones();
    /*
    |--------------------------------------------------------------------------
    | COMPROBAR CADA 10 SEGUNDOS
    |--------------------------------------------------------------------------
    */

    setInterval(
        verificarNotificaciones,
        10000
    );
});
</script>

<script>
$(document).ready(function () {
    $('#mitabla').DataTable({
        responsive: true,

        // Scroll
        scrollY: '900px',
        scrollX: true,
        scrollCollapse: true,

        // Paginación
        pageLength: 25,
        lengthMenu: [5, 10, 25, 50, 100],

        // Idioma
        language: {
            emptyTable: "No hay información",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            lengthMenu: "Mostrar _MENU_ registros",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "No se encontraron resultados",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        }
    });
});
</script>

@if (session()->has('success'))
<script>
    Swal.fire({
        icon: '{{ session()->get('icono') }}',
        title: '{{ session()->get('success') }}',
        text: '{{ session()->get('text') }}',
        showConfirmButton: true,
        // timer: 3000
    });
</script>
@endif

<script>
    $('.formEliminar').submit(function(e){
        e.preventDefault();

        Swal.fire({
        title: "Esta seguro de eliminar..?",
        text: "Los datos se eliminaran permanentemente!!!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "Cancelar",
        }).then((result) => {
        if (result.isConfirmed) {    
            this.submit();
        }
        });
    })
</script>

<!-- <script>
    $('.actualizarFecha').submit(function(e){
        e.preventDefault();

        Swal.fire({
        title: "¿Actualizar Fecha?",
        text: "Se actualizara a la fecha actual!!!",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, actualizar!",
        cancelButtonText: "Cancelar",
        }).then((result) => {
        if (result.isConfirmed) {    
            this.submit();
        }
        });
    })
</script> -->
<script>

function toggleDarkMode() {

    const body = document.body;
    const boton = document.getElementById('dark-mode-toggle');
    const icon = boton?.querySelector('i');

    body.classList.toggle('dark-mode');

    const isDark = body.classList.contains('dark-mode');

    // Guardar estado
    localStorage.setItem('darkMode', isDark);


    // Cambiar icono
    if (icon) {

        if (isDark) {

            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');

        } else {

            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');

        }

    }

}


document.addEventListener('DOMContentLoaded', function () {

    const boton = document.getElementById('dark-mode-toggle');

    const isDark =
        localStorage.getItem('darkMode') === 'true';


    // Restaurar modo
    if (isDark) {

        document.body.classList.add('dark-mode');

    }


    // Restaurar icono
    if (boton) {

        const icon = boton.querySelector('i');

        if (icon) {

            if (isDark) {

                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');

            } else {

                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');

            }

        }


        // Evento click
        boton.addEventListener('click', function (e) {

            e.preventDefault();

            toggleDarkMode();

        });

    }

});

</script>


<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>



@endpush

{{-- Add common CSS customizations --}}