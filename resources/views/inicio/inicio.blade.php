<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>GAMEA-U.A.S.I.</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/assets/logogamea.ico') }}" />

        <!-- Core theme CSS (includes Bootstrap)-->
             <link rel="icon" href="{{ asset('assets/assets/logogamea.ico') }}">
        <!-- 1. Bootstrap CSS (FALTANTE en tu código) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- 2. Tailwind -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- 3. Tus estilos personalizados -->
         <link rel="stylesheet" href="{{ asset('estilos/inicio.css') }}">  
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('estilos/estilos.css') }}" rel="stylesheet" />
        <link href="{{ asset('estilos/estilos2.css') }}" rel="stylesheet" />
        <link href="{{ asset('estilos/estilos3.css') }}" rel="stylesheet" />
        <link href="{{ asset('estilos/botones.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">

        <!-- 4. JS (Bootstrap + SweetAlert) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>
    <body>

        <!-- NAVBAR -->
<nav class="gamea-navbar" id="mainNav"> 
    <div class="gamea-nav-container"> 
        <!-- LOGO --> 
         <a href="/" class="gamea-brand"> 
            <div class="gamea-logo"> 
                <img src="{{ asset('assets/assets/img/gamea.png') }}" alt="Logo GAMEA"> 
            </div> 
            <div class="gamea-brand-text"> 
                <strong>GAMEA</strong> <span>U.A.S.I.</span> 
            </div> 
        </a> 
        <!-- BOTONES --> 
         <div class="gamea-menu"> 
            <!-- SEGUIMIENTO --> 
             <button type="button" class="gamea-link" data-bs-toggle="modal" data-bs-target="#modalSeguimiento"> 
                <i class="fas fa-search"></i> 
                <span>SEGUIMIENTO</span> 
            </button> 
            <!-- SEGUIMIENTO --> 

            <!-- MODELO DE CARTA --> 
            <a href="#"
            class="gamea-link"
            data-bs-toggle="modal"
            data-bs-target="#modalDocumentos">
                <i class="fas fa-file-alt"></i>
                <span>MODELO DE CARTAS</span>
            </a>

            <!-- REQUERIMIENTO --> 
             <button type="button" class="gamea-link" data-bs-toggle="modal" data-bs-target="#modalServicio"> 
                <i class="fas fa-tools"></i> 
                <span>REQUERIMIENTO DE ASISTENCIA TÉCNICA</span> 
            </button> 
            <a href="{{ route('evaluacion.buscar') }}"
            class="gamea-link"">
                <i class="fas fa-star"></i>
                EVALUAR ATENCION
            </a>
            <!-- SEPARADOR --> 
             <div class="gamea-divider"></div> 
             <!-- ACCEDER --> 
              <a href="#" class="gamea-login" data-bs-toggle="modal" data-bs-target="#login"> 
                <i class="fas fa-sign-in-alt"></i> 
                <span>ACCEDER</span> </a> 
            </div> 
            
            <!-- BOTÓN MÓVIL --> 
             <button type="button" class="gamea-mobile-button" onclick="toggleGameaMenu()"> 
                <i class="fas fa-bars"></i> 
            </button> </div> 
            <!-- MENÚ MÓVIL --> 
             <div class="gamea-mobile-menu" id="gameaMobileMenu"> 
                <button type="button" class="gamea-mobile-link" data-bs-toggle="modal" data-bs-target="#modalSeguimiento" onclick="toggleGameaMenu()"> 
                    <i class="fas fa-search"></i> SEGUIMIENTO 
                </button> 
                    <a href="#"
                    class="gamea-mobile-link""
                    data-bs-toggle="modal"
                    data-bs-target="#modalDocumentos">
                        <i class="fas fa-file-alt"></i>
                        <span>MODELO DE CARTAS</span>
                    </a>
                <button type="button" class="gamea-mobile-link" data-bs-toggle="modal" data-bs-target="#modalServicio" onclick="toggleGameaMenu()"> 
                    <i class="fas fa-tools"></i> REQUERIMIENTO DE SERVICIO
                </button> 
                <a href="{{ route('evaluacion.buscar') }}"
                class="gamea-mobile-link"">
                    <i class="fas fa-star"></i>
                    EVALUAR ATENCION
                </a>
                <a href="#" class="gamea-mobile-login" data-bs-toggle="modal" data-bs-target="#login"> 
                    <i class="fas fa-sign-in-alt"></i> ACCEDER 
                </a> 
            </div> 
</nav>

<script>
function toggleGameaMenu() {

    const menu = document.getElementById('gameaMobileMenu');

    menu.classList.toggle('active');

}
</script>

<!-- HEADER -->
<header class="masthead text-center text-white position-relative" 
  style="background-image: linear-gradient(rgba(0, 0, 0, 0.55), rgba(0, 0, 0, 0.55)), url('assets/assets/img/jachauta.jpg');
         background-size: cover; background-position: center; padding-top: 9rem; padding-bottom: 6rem;">

  <div class="container position-relative px-4 px-lg-5 d-flex flex-column align-items-center text-center">
    <img src="assets/assets/img/gamea.png" alt="Logo Gobierno Autonomo Municipal de El Alto" class="mb-4" style="height: 100px;">
    <h1 class="fw-bold display-5 text-uppercase mb-2" id="texto-escritura">Soporte Técnico</h1>
    <h2 class="fw-light text-light">Soporte Técnico</h2>
  </div>

  <!-- efecto de sombra inferior -->
  <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 60px; background: linear-gradient(transparent, rgba(0,0,0,0.5));"></div>
</header>



<!-- btn requerimineto de servicio -->
<script>
const btn = document.getElementById('btnRequerimiento');
const menu = document.getElementById('menuRequerimiento');

btn.addEventListener('click', function (e) {
    e.stopPropagation();
    menu.classList.toggle('mostrar');
});

document.addEventListener('click', function () {
    menu.classList.remove('mostrar');
});
</script>
<!-- ------------------------------------------- -->
<script>
const select = document.getElementById('tipo-equipo');
const form = document.getElementById('form-seguimiento');

// Cambiar action dinámicamente
select.addEventListener('change', function () {
    if (this.value) {
        form.action = this.value;
    }
});

// Validación extra (opcional pero recomendable)
form.addEventListener('submit', function (e) {
    if (!select.value) {
        e.preventDefault();
        alert('Debe seleccionar un tipo de equipo');
    }
});
</script>
<footer class="footer text-center text-light py-4 mt-1 position-relative" 
        style="background: linear-gradient(rgba(33,37,41,0.95), rgba(33,37,41,0.95)), url('assets/assets/img/tec8.jpg');
               background-size: cover; background-position: center;">
  <div class="container px-4 px-lg-5">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        <p class="mb-3 fw-semibold text-uppercase tracking-wide" style="letter-spacing: 2px;">
          UASI - Soporte Técnico
        </p>

        <hr class="border-light opacity-25 my-3" style="max-width: 500px; margin: 0 auto;">

        <p class="text-muted small fst-italic mb-0">
          Unidad de Administración de Sistemas de Información | {{ date('Y') }}©S@mmy   
        </p>
      </div>
    </div>
  </div>

  <!-- sombreado superior -->
  <div style="position: absolute; top: 0; left: 0; right: 0; height: 6px; background: linear-gradient(to bottom, rgba(0,0,0,0.5), transparent);"></div>
</footer>
<!-- modal ejemplo -->


<!-- ALERTAS -->
@if (session()->has('success'))
<script>
Swal.fire({
    icon: '{{ session("icono") }}',
    title: '{{ session("success") }}',
    text: '{{ session("text") }}',
    timer: 5000,
    showConfirmButton: false
});
</script>
@endif

<style>
.cursor {
    font-weight: bold;
    animation: parpadear 1s infinite;
}

@keyframes parpadear {
    0% {
        opacity: 1;
    }
    50% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const campoCodigo = document.getElementById('cod_gamea');
    const resultado = document.getElementById('resultadoActivo');

    const activoEncontrado = document.getElementById('activo_encontrado');
    const tipoActivo = document.getElementById('tipo_activo');
    const activoId = document.getElementById('activo_id');
    const equipo = document.getElementById('equipo');

    let timeoutActivo = null;

    if (!campoCodigo) {
        console.error('No se encontró #cod_gamea');
        return;
    }

    campoCodigo.addEventListener('input', function () {

        clearTimeout(timeoutActivo);

        const codigo = this.value.trim();

        // Limpiar resultados anteriores
        resultado.innerHTML = '';

        activoEncontrado.value = '0';
        tipoActivo.value = '';
        activoId.value = '';
        equipo.value = '';

        // No consultar códigos muy cortos
        if (codigo.length < 3) {
            return;
        }

        // Esperar 500 ms después de escribir
        timeoutActivo = setTimeout(function () {

            resultado.innerHTML =
                '<span class="text-primary">' +
                '<i class="fas fa-spinner fa-spin"></i> ' +
                'Buscando activo...' +
                '</span>';

            fetch(
                "{{ route('servicios.buscarActivo') }}" +
                "?cod_gamea=" +
                encodeURIComponent(codigo),
                {
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            )
            .then(function (response) {

                if (!response.ok) {
                    throw new Error('HTTP ' + response.status);
                }

                return response.json();
            })
            .then(function (data) {

                console.log('Respuesta:', data);

if (data.encontrado) {

    let detalleEquipo = '';

    if (data.nombre_equipo) {
        detalleEquipo =
            '<br>' +
            '<small>' +
                'Equipo: <strong>' +
                data.nombre_equipo +
                '</strong>' +
            '</small>';
    }

    resultado.innerHTML =
        '<div class="alert alert-success py-2 mt-2 mb-0">' +
            '<i class="fas fa-check-circle me-1"></i>' +
            '<strong>ACTIVO ENCONTRADO</strong><br>' +

            '<small>' +
                'Tipo: <strong>' +
                data.tipo +
                '</strong>' +
            '</small>' +

            detalleEquipo +

        '</div>';

    activoEncontrado.value = '1';
    tipoActivo.value = data.tipo;
    activoId.value = data.id;
    equipo.value = data.equipo;
} else {

                    resultado.innerHTML =
                        '<div class="alert alert-danger py-2 mt-2 mb-0">' +
                            '<i class="fas fa-times-circle me-1"></i>' +
                            '<strong>ACTIVO NO ENCONTRADO</strong><br>' +
                            '<small>' +
                                'Verifique el código del activo ingresado.' +
                            '</small>' +
                        '</div>';

                    activoEncontrado.value = '0';
                    tipoActivo.value = '';
                    activoId.value = '';
                    equipo.value = '';
                }
            })
            .catch(function (error) {

                console.error('Error:', error);

                resultado.innerHTML =
                    '<div class="alert alert-danger py-2 mt-2 mb-0">' +
                        '<i class="fas fa-exclamation-triangle me-1"></i>' +
                        '<strong>ERROR DE CONSULTA</strong><br>' +
                        '<small>No fue posible consultar el activo.</small>' +
                    '</div>';

                activoEncontrado.value = '0';
                tipoActivo.value = '';
                activoId.value = '';
                equipo.value = '';
            });

        }, 500);
    });

});
</script>

<script>
const tituloOriginal = document.title;
const tituloAlerta = "🔴 ¡Nuevo requerimiento de servicio!";

let intervalo = null;

function iniciarParpadeo() {
    if (intervalo) return;

    intervalo = setInterval(() => {
        document.title = document.title === tituloOriginal
            ? tituloAlerta
            : tituloOriginal;
    }, 1000);
}

function detenerParpadeo() {
    if (!intervalo) return;

    clearInterval(intervalo);
    intervalo = null;
    document.title = tituloOriginal;
}

function verificarPendientes() {
    fetch('/hay-pendientes')
        .then(response => response.json())
        .then(data => {
            if (data.hayPendientes) {
                iniciarParpadeo();
            } else {
                detenerParpadeo();
            }
        })
        .catch(error => console.error(error));
}

// Verificar al cargar la página
verificarPendientes();

// Verificar cada 10 segundos
setInterval(verificarPendientes, 10000);
</script>

<script>
const texto = "UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN";
const velocidad = 90; // velocidad de escritura en milisegundos
const velocidadBorrado = 55; // velocidad de borrado en milisegundos
const retrasoAntesDeBorrar = 3000; // retraso antes de borrar en milisegundos (2 segundos)
const elemento = document.getElementById("texto-escritura");
let indice = 0;
let estado = "escribiendo"; // estado actual (escribiendo o borrando)

function escribir() {
    if (estado === "escribiendo") {
        if (indice < texto.length) {
            elemento.innerHTML = texto.substring(0, indice + 1) + "<span class='cursor'>|</span>";
            indice++;
            setTimeout(escribir, velocidad);
        } else {
            elemento.innerHTML = texto + "<span class='cursor'>|</span>";
            estado = "esperando";
            setTimeout(borrarTexto, retrasoAntesDeBorrar);
        }
    }
}

function borrarTexto() {
    estado = "borrando";
    indice = texto.length - 1;
    elemento.innerHTML = texto.substring(0, indice + 1) + "<span class='cursor'>|</span>";
    borrar();
}

function borrar() {
    if (estado === "borrando") {
        if (indice >= 0) {
            elemento.innerHTML = texto.substring(0, indice) + "<span class='cursor'>|</span>";
            indice--;
            setTimeout(borrar, velocidadBorrado);
        } else {
            estado = "escribiendo";
            indice = 0;
            elemento.innerHTML = "<span class='cursor'>|</span>";
            setTimeout(escribir, velocidad);
        }
    }
}
escribir();
</script>

    <!--Ventana Modal Documentos-->
    @include('documentos.modal')
    <!--Ventana Modal Seguimiento-->
    @include('inicio.modalseguimiento')
    <!--Ventana Modal Seguimiento-->
    @include('inicio.modalServicio')
    <!--Ventana Modal para Crear--->
    @include('auth.modallogin')
    <!-- LOADER -->
<div id="login-loader" class="hidden fixed inset-0 bg-black/60 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-xl shadow-lg text-center">
        <img src="{{ asset('assets/assets/logogamea.ico') }}"  id="spinnerImg" 
             class="spinner-img" 
             alt="Cargando...">
        <p class="text-gray-700 text-sm">Validando credenciales...</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const inputDependencia = document.getElementById('search-input');
    const datalist = document.getElementById('options');
    const inputId = document.getElementById('id-selected');

    inputDependencia.addEventListener('input', function () {

        const valor = this.value.trim();

        inputId.value = '';

        const opciones = datalist.querySelectorAll('option');

        opciones.forEach(function (opcion) {

            if (opcion.value.trim() === valor) {
                inputId.value = opcion.dataset.id;
            }

        });

        console.log('Dependencia:', valor);
        console.log('dependencia_id:', inputId.value);
    });

});
</script>

<style>
/* =========================================================
   MODAL SEGUIMIENTO
   ========================================================= */

.custom-modal-width {
    width: 95%;
    max-width: 1050px;
}


/* =========================================================
   CELULAR / TABLET
   ========================================================= */

@media screen and (max-width: 767px) {

    /*
     * EL MODAL NO DEBE SER FULLSCREEN
     */

    #modalSeguimiento .modal-dialog {
        width: calc(100% - 20px) !important;
        max-width: none !important;

        margin: 10px auto !important;

        height: auto !important;
        min-height: 0 !important;
    }


    /*
     * CONTENIDO DEL MODAL
     */

    #modalSeguimiento .modal-content {
        width: 100% !important;

        height: auto !important;
        min-height: 0 !important;

        max-height: calc(100dvh - 20px) !important;

        border-radius: 16px !important;

        overflow-y: auto !important;
        overflow-x: hidden !important;
    }


    /*
     * CONTENEDOR HORIZONTAL
     */

    #modalSeguimiento .modal-content > .flex {
        display: block !important;

        width: 100% !important;

        min-height: 0 !important;
        height: auto !important;
    }


    /*
     * OCULTAR PANEL INSTITUCIONAL
     */

    #modalSeguimiento .panel-institucional {
        display: none !important;
    }


    /*
     * FORMULARIO
     *
     * Es el segundo panel
     */

    #modalSeguimiento .modal-content > .flex > div:last-child {
        display: flex !important;

        width: 100% !important;

        min-height: 0 !important;

        padding: 25px 20px !important;

        box-sizing: border-box;
    }


    /*
     * FORMULARIO OCUPA TODO EL ANCHO
     */

    #modalSeguimiento form {
        width: 100% !important;
    }


    /*
     * TÍTULO
     */

    #modalSeguimiento h1 {
        font-size: 1.35rem !important;
        line-height: 1.3 !important;
    }


    #modalSeguimiento header p {
        font-size: .85rem !important;
    }


    /*
     * INPUT
     */

    #modalSeguimiento input {
        width: 100% !important;
        box-sizing: border-box !important;
    }


    /*
     * BOTONES
     */

    #modalSeguimiento button {
        width: 100% !important;
    }


    /*
     * FOOTER
     */

    #modalSeguimiento .modal-content > .flex > div:last-child > .mt-6 {
        margin-top: 20px !important;
    }
}

@media screen and (max-width: 767px) {
    #modalSeguimiento .panel-institucional {
        display: none !important;
        visibility: hidden !important;
        width: 0 !important;
        max-width: 0 !important;
        min-width: 0 !important;
        padding: 0 !important;
        margin: 0 !important;
        overflow: hidden !important;
    }
}
</style>
</body>