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

<div class="modal fade" id="login" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down custom-modal-width">

        <div class="modal-content overflow-hidden border-0 rounded-2xl shadow-2xl">

    <main class="w-full max-w-5xl mx-4 grid md:grid-cols-2  rounded-2xl shadow-2xl overflow-hidden animate-fade-slide">

                <!-- PANEL IZQUIERDO -->
            <aside class="hidden md:flex flex-col justify-center items-center
                        bg-gradient-to-br from-slate-900 via-violet-800 to-purple-700
                        text-white p-10 relative overflow-hidden">

                <!-- Decoración -->
                <div class="absolute -top-20 -right-20 w-64 h-64 rounded-full bg-white/10 blur-3xl"></div>
                <div class="absolute -bottom-16 -left-16 w-52 h-52 rounded-full bg-violet-300/10 blur-2xl"></div>

                <img src="assets/assets/img/gamea.png" alt="Logo Gobierno Autonomo Municipal de El Alto" class="w-32 mb-6" style="height: 250px;">

                <h2 class="text-xl font-bold uppercase text-center relative z-10">
                    UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
                </h2>

                <p class="text-sm text-violet-100 text-center mt-2 relative z-10">
                    Área de Soporte Técnico
                </p>

                <div class="w-16 h-1 bg-white/40 rounded-full my-5 relative z-10"></div>

                <p class="text-xs text-center text-white/80 leading-6 relative z-10">
                    Plataforma de control y seguimiento de equipos computacionales.
                </p>

            </aside>

                <!-- FORMULARIO -->
            <section class="bg-white p-6 md:p-10 flex flex-col justify-center">

                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-slate-800">
                        Inicio de Sesión
                    </h1>

                    <p class="text-gray-500 text-sm mt-1">
                        Ingrese sus credenciales para acceder al sistema.
                    </p>
                </div>

                    <form action="{{ $login_url }}" method="POST" class="space-y-5">
                        @csrf

            <div class="mb-4">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Usuario
                </label>

                <div class="relative">

                    <i class="bi bi-person-fill absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input type="email" name="email" placeholder="Correo electrónico" required
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 focus:border-violet-600
                            focus:ring-4 focus:ring-violet-200 outline-none transition">
                            <p id="email-msg" class="input-msg text-red-500 hidden"></p>
                </div>

                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Contraseña
                </label>

                <div class="relative">

                    <i class="bi bi-lock-fill absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                    <input type="password" id="password" name="password" placeholder="Contraseña" required
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 focus:border-violet-600 focus:ring-4
                            focus:ring-violet-200 outline-none transition">
                            
                </div>
                <p id="password-msg" class="input-msg text-red-500 hidden"></p>

                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="space-y-3">

                <button
                    type="submit"

                    class="w-full py-3 rounded-xl
                        bg-gradient-to-r
                        from-violet-700
                        to-purple-800

                        hover:from-violet-800
                        hover:to-purple-900

                        text-white
                        font-semibold
                        tracking-wide

                        shadow-lg
                        hover:shadow-xl

                        transition-all
                        duration-300">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Iniciar sesión

                </button>

                <button
                    type="button"

                    data-bs-dismiss="modal"

                    class="w-full py-3 rounded-xl
                        border border-gray-300
                        bg-white
                        hover:bg-gray-100
                        text-gray-700
                        font-medium
                        transition">

                    <i class="bi bi-x-circle me-2"></i>

                    Cerrar

                </button>

            </div>

        </form>
<footer class="mt-8 border-t pt-4 text-center">

    <p class="text-sm text-gray-500">
        Gobierno Autónomo Municipal de El Alto
    </p>

    <p class="text-xs text-gray-400 mt-1">
        GAMEA © {{ date('Y') }} © S@mmy  
    </p>

</footer>


    </section>
</main>

        </div>
    </div>
</div>

<style>
    .custom-modal-width{
    max-width:900px;
}

.modal-content{
    border-radius:22px;
    overflow:hidden;
    animation:loginShow .35s ease;
}

@keyframes loginShow{
    from{
        opacity:0;
        transform:translateY(20px) scale(.98);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}
</style>


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


});
</script>
