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
        <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('estilos/estilos.css') }}" rel="stylesheet" />
        <link href="{{ asset('estilos/estilos2.css') }}" rel="stylesheet" />
        <link href="{{ asset('estilos/estilos3.css') }}" rel="stylesheet" />
        <link href="{{ asset('estilos/botones.css') }}" rel="stylesheet" />

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
            <!-- MODELO DE CARTA --> 
             <a href="#" class="gamea-link"> 
                <i class="fas fa-file-alt"></i> 
                <span>MODELO DE CARTA</span> 
            </a> 
            <!-- REQUERIMIENTO --> 
             <button type="button" class="gamea-link" data-bs-toggle="modal" data-bs-target="#modalServicio"> 
                <i class="fas fa-tools"></i> 
                <span>REQUERIMIENTO</span> 
            </button> 
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
                <a href="#" class="gamea-mobile-link"> 
                    <i class="fas fa-file-alt"></i> MODELO DE CARTA
                </a> 
                <button type="button" class="gamea-mobile-link" data-bs-toggle="modal" data-bs-target="#modalServicio" onclick="toggleGameaMenu()"> 
                    <i class="fas fa-tools"></i> REQUERIMIENTO DE SERVICIO
                </button> 
                <a href="#" class="gamea-mobile-login" data-bs-toggle="modal" data-bs-target="#login"> 
                    <i class="fas fa-sign-in-alt"></i> ACCEDER 
                </a> 
            </div> 
</nav>
<style>
/* =========================================================
   GAMEA NAVBAR
   ========================================================= */

.gamea-navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 78px;
    background: rgba(255,255,255,.97);
    border-bottom: 1px solid #e5e7eb;
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
    z-index: 99999;
}
/* CONTENEDOR */

.gamea-nav-container {
    width: 100%;
    max-width: 1250px;
    height: 78px;
    margin: 0 auto;
    padding: 0 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* =========================================================
   LOGO
   ========================================================= */

.gamea-brand {
    display: flex !important;
    align-items: center;
    gap: 10px;
    text-decoration: none !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.gamea-logo {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gamea-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.gamea-brand-text {
    display: flex;
    flex-direction: column;
    line-height: 1;
}

.gamea-brand-text strong {
    color: #0052cc;
    font-size: 19px;
    font-weight: 800;
}

.gamea-brand-text span {
    margin-top: 5px;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 2.5px;
}

/* =========================================================
   MENÚ
   ========================================================= */

.gamea-menu {
    display: flex !important;
    align-items: center;
    gap: 5px;
    visibility: visible !important;
    opacity: 1 !important;
}

/* =========================================================
   ENLACES
   ========================================================= */

.gamea-link {
    display: flex !important;
    align-items: center;
    gap: 8px;
    padding: 11px 14px;
    margin: 0;
    color: #1164d7 !important;
    background: transparent !important;
    border: none !important;
    border-radius: 9px;
    font-family: inherit;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none !important;
    cursor: pointer;
    visibility: visible !important;
    opacity: 1 !important;
    transition: all .25s ease;
}

.gamea-link i {
    color: #0052cc;
    font-size: 14px;
}

.gamea-link:hover {
    color: #0052cc !important;
    background: #eef5ff !important;
    transform: translateY(-1px);
}

/* =========================================================
   SEPARADOR
   ========================================================= */

.gamea-divider {
    width: 1px;
    height: 30px;
    margin: 0 10px;
    background: #e2e8f0;
}

/* =========================================================
   ACCEDER
   ========================================================= */

.gamea-login {
    display: flex !important;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 11px 20px;
    color: #fff !important;
    background: linear-gradient(135deg,#0052cc,#2684ff) !important;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none !important;
    box-shadow: 0 5px 15px rgba(0,82,204,.25);
    visibility: visible !important;
    opacity: 1 !important;
    transition: all .25s ease;
}

.gamea-login:hover {
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 22px rgba(0,82,204,.35);
}

/* =========================================================
   BOTÓN MÓVIL
   ========================================================= */

.gamea-mobile-button {
    display: none;
    width: 44px;
    height: 44px;
    border: none;
    border-radius: 9px;
    background: #eef5ff;
    color: #0052cc;
    font-size: 18px;
    cursor: pointer;
}

/* =========================================================
   MENÚ MÓVIL
   ========================================================= */

.gamea-mobile-menu {
    display: none;
    padding: 15px 20px 20px;
    background: #fff;
    border-top: 1px solid #e5e7eb;
    box-shadow: 0 10px 25px rgba(0,0,0,.10);
}

.gamea-mobile-menu.active {
    display: block !important;
}

.gamea-mobile-link {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 13px 15px;
    margin-bottom: 5px;
    color: #146ce8 !important;
    background: transparent;
    border: none;
    border-radius: 9px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none !important;
    text-align: left;
    cursor: pointer;
}

.gamea-mobile-link i {
    width: 25px;
    color: #0052cc;
}

.gamea-mobile-link:hover {
    background: #eef5ff;
    color: #0052cc !important;
}

.gamea-mobile-login {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 13px;
    margin-top: 8px;
    color: #fff !important;
    background: linear-gradient(135deg,#0052cc, #2684ff);
    border-radius: 9px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none !important;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 1000px) {
    .gamea-menu {
        display: none !important;
    }
    .gamea-mobile-button {
        display: flex;
        align-items: center;
        justify-content: center;
    }
}

@media (max-width: 600px) {
    .gamea-nav-container {
        height: 70px;
        padding: 0 15px;
    }
    .gamea-navbar {
        height: 70px;
    }
    .gamea-logo {
        width: 42px;
        height: 42px;
    }
    .gamea-brand-text strong {
        font-size: 16px;
    }

}

body {
    padding-top: 78px;
}

</style>
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
    <h2 class="fw-light text-light">Área de Soporte Técnico</h2>
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

    <!--Ventana Modal Seguimiento-->
    @include('inicio.modalseguimiento')
    <!--Ventana Modal Seguimiento-->
    @include('inicio.modalServicio')
    <!--Ventana Modal para Crear--->
    @include('auth.login')
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
<link rel="stylesheet" href="{{ asset('estilos/registroCpu.css') }}">  

</body>