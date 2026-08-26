<div class="modal fade" id="modalSeguimiento" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down custom-modal-width">

        <div class="modal-content overflow-hidden border-0 rounded-2xl shadow-2xl">

            <!-- CONTENEDOR HORIZONTAL -->
            <div class="flex flex-col md:flex-row min-h-[500px]">

                <!-- PANEL IZQUIERDO INSTITUCIONAL -->

                    <div class="w-full md:w-1/2  bg-gradient-to-br
              from-violet-700
              via-purple-800
              to-indigo-900
              text-white p-10 text-white p-8 flex flex-col justify-between">

                    <aside class="hidden md:flex flex-col justify-center items-center  bg-gradient-to-br
              from-violet-700
              via-purple-800
              to-indigo-900
              text-white p-10 text-white p-10 animate-slide-left">
                        <img src="assets/assets/img/gamea.png" alt="Logo Gobierno Autonomo Municipal de El Alto" class="w-32 mb-6" style="height: 250px;">

                        <h2 class="text-xl font-bold text-center">
                            UNIDAD DE ADMINISTRACIÓN DE SISTEMAS DE INFORMACIÓN
                        </h2>

                        <p class="text-sm text-center mt-2 text-white">
                            Área de Soporte Técnico
                        </p>

                        <p class="text-xs text-center mt-6 text-gray-200">
                            Plataforma de seguimiento de equipos computacionales.
                    </p>
                    <div class="flex gap-3 mt-6">

                    <div class="bg-white/10 p-3 rounded-lg">
                    <p class="text-2xl font-bold">{{ $totalEquipos }}</p>
                      <p class="text-xs">Total de equipos</p>
                    </div>

                        <div class="bg-white/10 p-3 rounded-lg">
                            <p class="text-2xl font-bold">{{ $totalEquipos2}}</p>
                            <p class="text-xs">En proceso</p>
                        </div>

                        <div class="bg-white/10 p-3 rounded-lg">
                            <p class="text-2xl font-bold">{{ $totalEquipos4}}</p>
                            <p class="text-xs">Concluidos</p>
                        </div>

                        <!-- <div class="bg-white/10 p-3 rounded-lg">
                            <p class="text-xl font-bold">95%</p>
                            <p class="text-xs">Eficiencia</p>
                        </div> -->
                    </div>
                    </aside>

                        <!-- ICONOS -->


                </div>

                <div class="w-full md:w-1/2 bg-white p-8 flex flex-col justify-center">

                    <!-- TITULO -->
            <header class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">CONSULTA DE SEGUIMIENTO</h1>
                <p class="text-gray-600 text-sm">Ingrese los datos para consultar el estado del equipo</p>
            </header>

                    <!-- FORM -->
           <form action="{{ route('seguimiento.buscar') }}" method="GET" class="space-y-5">
            

                <!-- SELECT -->
                <!-- <div>
                    <label for="tipo" class="block text-sm font-semibold text-gray-700 mb-2">
                        TIPO DE EQUIPO
                    </label>

                    <select id="tipo" name="tipo"  class="w-full pl-12 pr-10 py-3 rounded-xl border border-gray-300 bg-white
                       focus:border-violet-600 focus:ring-4 focus:ring-violet-200 transition appearance-none">
                        <option value="">Seleccione una opción</option>
                        <option value="cpu">C.P.U.</option>
                        <option value="impresora">Impresora</option>
                        <option value="teclado">Teclado</option>
                        <option value="monitor">Monitor</option>
                        <option value="audifono">Audífono</option>
                        <option value="mouse">Mouse</option>
                        <option value="estabilizador">Estabilizador</option>
                        <option value="ups">U.P.S.</option>
                        <option value="parlante">Parlantes</option>
                        <option value="laptop">Laptop</option>
                        <option value="laptop">Laptop</option>
                    </select>
                </div> -->

                <!-- INPUT -->
    <!-- NÚMERO -->
    <div>

        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Número de recepción
        </label>

        <div class="relative">

            <i class="bi bi-hash absolute left-4 top-1/2 -translate-y-1/2 text-violet-500"></i>

            <input type="text" name="codigo" id="input-imagen" required placeholder="Ej.: 001/{{ date('Y') }}" class="w-full pl-12 pr-4 py-3
                    rounded-xl border border-gray-300 focus:border-violet-600 focus:ring-4 focus:ring-violet-200 transition">
        </div>

        <!-- Popover -->

        <div id="popover-ejemplo" class="hidden absolute left-0 bottom-full mb-3 w-72 bg-white rounded-xl
                   shadow-xl border p-3">
            <p class="text-xs text-gray-600 text-center mb-2">
                Ejemplo del número de recepción
            </p>

            <img
                src="{{ asset('assets/assets/NRegistro.jpg') }}"
                class="rounded-lg">
        </div>

        <p class="text-xs text-gray-500 mt-2 flex items-center">

            <i class="bi bi-info-circle me-2 text-violet-500"></i>

             Ingrese el número asignado al momento de registrar el equipo.

        </p>

    </div>

                <!-- BOTÓN -->
                <!-- CONSULTAR -->
                <button type="submit" class="w-full bg-gradient-to-r from-violet-700 to-purple-800 hover:from-violet-800 hover:to-purple-900
                        text-white py-3 rounded-lg font-semibold tracking-wide shadow-lg hover:shadow-2xl transition-all duration-300">
                    <i class="bi bi-search me-2"></i>CONSULTAR SEGUIMIENTO
                </button>

                <!-- CERRAR -->
                <button type="button" data-bs-dismiss="modal" class="w-full mt-3 bg-white border border-gray-300 hover:bg-gray-100
                        text-gray-700 py-3 rounded-lg font-semibold shadow-md transition-all duration-300">
                    <i class="bi bi-box-arrow-left me-2"></i>CERRAR
                </button>

            </form>

                    <!-- FOOTER -->
                    <div class="mt-6 text-center text-xs text-gray-500 border-t pt-4">
                        GAMEA | {{ date('Y') }} © S@mmy  
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>


<style>
.custom-modal-width {
    max-width: 1050px;
    width: 95%;
}


#modalLogin .modal-content {
    min-height: 550px;
    max-height: 90vh;
    overflow: hidden;
    border-radius: 16px;
}

#modalLogin .modal-body {
    padding: 0;
}


.imagen-titulo {
    text-align: center;
}

.imagen-titulo img {
    width: 60px;
    max-width: 100%;
    height: auto;
    opacity: 0.9;
    transition: all 0.2s ease;
}

.imagen-titulo img:hover {
    transform: scale(1.05);
}

select,
input{

    font-size:.95rem;

}

select:focus,
input:focus{

    box-shadow:0 0 0 .25rem rgba(124,58,237,.15);

}

button{

    letter-spacing:.3px;

}
</style>

<script>
const input = document.getElementById('input-imagen');
const popover = document.getElementById('popover-ejemplo');

// Mostrar al enfocar
input.addEventListener('focus', () => {
    popover.classList.remove('hidden');
});

// Ocultar al salir (con pequeño delay para UX)
input.addEventListener('blur', () => {
    setTimeout(() => {
        popover.classList.add('hidden');
    }, 200);
});
</script>