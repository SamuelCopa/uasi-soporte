{{-- @extends('adminlte::auth.login') --}}

{{-- @extends('adminlte::auth.auth-page', ['auth_type' => 'login']) --}}

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )

@if (config('adminlte.use_route_url', false))
    @php( $login_url = $login_url ? route($login_url) : '' )
    @php( $register_url = $register_url ? route($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@else
    @php( $login_url = $login_url ? url($login_url) : '' )
    @php( $register_url = $register_url ? url($register_url) : '' )
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@endif

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso al Sistema</title>
    <link rel="icon" href="{{ asset('assets/assets/logogamea.ico') }}">
    <link href="{{ asset('estilos/estilos.css') }}" rel="stylesheet" />
    <link href="{{ asset('estilos/estilos2.css') }}" rel="stylesheet" />
    <link href="{{ asset('estilos/estilos3.css') }}" rel="stylesheet" />
    <link href="{{ asset('estilos/botones.css') }}" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="contenedor flex items-center justify-center min-h-screen cover" style="background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.75)), url('assets/assets/img/gamea.jpg'); background-size: cover; background-position: center;">
<div class="laser-bg"></div>
    <main class="w-full max-w-5xl mx-4 grid md:grid-cols-2 bg-white/80 backdrop-blur-xl border border-white/30 rounded-2xl shadow-2xl overflow-hidden animate-fade-slide">

    <!-- PANEL IZQUIERDO -->
        <aside class="hidden md:flex flex-col justify-center items-center bg-sky-700 text-white p-10 animate-slide-left">

        <img src="{{ asset('assets/assets/logosgamea.png') }}"
             alt="Logo del Gobierno Autónomo Municipal de El Alto"
             class="w-32 mb-6">

        <h2 class="text-xl font-bold text-center">
            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
        </h2>

        <p class="text-sm text-center mt-2 text-white">
            Área de Soporte Técnico
        </p>

        <p class="text-xs text-center mt-6 text-gray-200">
            Plataforma de control y seguimiento de equipos computacionales.
        </p>
    </aside>

    <!-- FORMULARIO -->
    <section class="p-6 md:p-10 flex flex-col justify-center">

        <header class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Inicio de Sesión</h1>
            <p class="text-gray-600 text-sm">Ingrese sus credenciales</p>
        </header>

        <form action="{{ $login_url }}" method="POST" class="space-y-5">
            @csrf

            <!-- EMAIL -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    USUARIO
                </label>
                <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required
                class="input-base w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-sky-500">
                <p id="email-msg" class="input-msg text-red-500 hidden"></p>

                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                    CONTRASEÑA
                </label>

                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required
                    class="input-base w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-sky-500">
                    <p id="password-msg" class="input-msg text-red-500 hidden"></p>

                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- BOTONES -->
            <div class="flex flex-col gap-2">
            <button type="submit"
            class="w-full bg-sky-800 hover:bg-sky-900 text-white py-2 rounded-lg shadow 
            transition transform active:scale-95 duration-150">
            INICIAR SESIÓN
            </button>

                <button type="button"
                    onclick="location.href='/'"
                    class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 rounded-lg shadow transition transform active:scale-95 duration-150"">
                    SALIR
                </button>
            </div>

        </form>

        <footer class="mt-6 text-center text-xs text-gray-500">
            GAMEA | {{ date('Y') }} © S@mmy  
        </footer>

    </section>
</main>

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
// Recargar capcha
function recargarCaptcha() {
    const img = document.getElementById('captcha-image');
    img.style.opacity = 0;

    setTimeout(() => {
        img.src = "{{ captcha_src('flat') }}&" + Math.random();
        img.style.opacity = 1;
    }, 200);
}
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.querySelector('form');
    const loader = document.getElementById('login-loader');

    form.addEventListener('submit', function () {
        loader.classList.remove('hidden');
        setTimeout(() => {
            loader.classList.add('show');
        }, 100);

        // Evita múltiples envíos
        form.querySelector('button[type="submit"]').disabled = true;
    });

});
</script>

<!-- ALERTAS -->
@if ($errors->any())
<script>
Swal.fire({
    icon: 'error',
    title: 'Error de validación',
    html: `{!! implode('<br>', $errors->all()) !!}`,
});
</script>
@endif

@if (session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '{{ session('error') }}',
});
</script>
@endif

@if(session('login_success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Acceso concedido',
    text: 'Bienvenido al sistema',
    timer: 2000,
    showConfirmButton: false
}).then(() => {
    window.location.href = "{{ url('/home') }}";
});
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {

    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const captcha = document.getElementById('captcha');

    function validarEmail(valor) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor);
    }

    function setEstado(input, mensaje, valido, texto="") {
        const msg = document.getElementById(input.id + "-msg");

        input.classList.remove('input-valid', 'input-invalid');

        if (valido === true) {
            input.classList.add('input-valid');
            msg.classList.add('hidden');
        } else if (valido === false) {
            input.classList.add('input-invalid');
            msg.textContent = texto;
            msg.classList.remove('hidden');
        }
    }

    /* EMAIL */
    email.addEventListener('input', () => {
        if (email.value === "") {
            setEstado(email, null, null);
        } else if (!validarEmail(email.value)) {
            setEstado(email, null, false, "Correo inválido");
        } else {
            setEstado(email, null, true);
        }
    });

    /* PASSWORD */
    password.addEventListener('input', () => {
        if (password.value.length < 6) {
            setEstado(password, null, false, "Mínimo 6 caracteres");
        } else {
            setEstado(password, null, true);
        }
    });

    /* CAPTCHA */
    captcha.addEventListener('input', () => {
        if (captcha.value.length < 4) {
            setEstado(captcha, null, false, "Código incompleto");
        } else {
            setEstado(captcha, null, true);
        }
    });

});
</script>

</body>
</html>
