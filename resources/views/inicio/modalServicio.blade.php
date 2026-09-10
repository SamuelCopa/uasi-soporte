<div class="modal fade" id="modalServicio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-md-down custom-modal-width">
        <div class="modal-content overflow-hidden border-0 rounded-2xl shadow-2xl">

        <!-- CONTENEDOR HORIZONTAL -->
            <div class="flex flex-col md:flex-row min-h-[500px]">

                <!-- PANEL IZQUIERDO INSTITUCIONAL -->

                    <div class="w-full md:w-1/2 bg-gradient-to-br from-slate-800 via-sky-800 to-blue-900 text-white p-8 flex flex-col justify-between">

                    <aside class="hidden md:flex flex-col justify-center items-center bg-gradient-to-br from-slate-800 via-sky-800 to-blue-900
                            text-white p-10 animate-slide-left">
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
                    <p class="text-2xl font-bold">{{ $totalServiciosAtendidos }}</p>
                      <p class="text-xs">Total de equipos atendidos </p>
                    </div>


                    </div>
                    </aside>
                </div>

                <div class="w-full md:w-1/2 bg-white p-8 flex flex-col justify-center">

                    <!-- TITULO -->
            <header class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">REQUERIMIENTO DE SERVICIO</h1>
                <p class="text-gray-600 text-sm">Ingrese los detalles</p>
            </header>

                    <!-- FORM -->
            <form method="POST" action="{{ route('servicios.store') }}"  role="form" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <input type="hidden" id="funcionario_id" name="funcionario_id">
                      <div class="div title">
                        <label for="ci" class="form-label">{{ __('C.I.') }}<span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card text-primary"></i></span>
                            <input type="number" name="ci" class="form-control @error('ci') is-invalid @enderror" id="ci" placeholder="Ci">
                            {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                        </div>
                      </div>
                <div>
                      <div>


                          <div class="div title">
                              <label for="nombre" class="form-label">{{ __('NOMBRE DEL FUNCIONARIO')}}<span class="required">*</span></label>
                              <div class="input-group">
                                  <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                                  <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
                              </div>
                              {!! $errors->first('nombre', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                          </div>
                        </div>
                    <div class="div title">
                        <label for="search-input" class="form-label">
                            DEPENDENCIA <span class="required">*</span>
                        </label>
                        <input type="text" id="search-input" list="options" placeholder="Buscar dependencia ..." class="form-control" autocomplete="off" required >
                        <datalist id="options">
                            @foreach ($dependencia as $item)
                                <option
                                    value="{{ $item->dependencias }}"
                                    data-id="{{ $item->id }}">
                                </option>
                            @endforeach
                        </datalist>
                        <input type="hidden" id="id-selected" name="dependencia_id" >
                    </div>
                </div>
                <div class="div title">
                    <label for="equipo" class="block text-sm font-medium text-gray-700 mb-1">
                        TIPO DE EQUIPO
                    </label>

                    <select id="equipo" name="equipo" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-600 focus:outline-none text-sm">
                        
                        <option value="">Seleccione una opción</option>
                        <option value="cpu">C.P.U.</option>
                        <option value="impresora">Impresora</option>
                        <option value="teclado">Teclado</option>
                        <option value="monitor">Monitor</option>
                        <option value="estabilizador">Estabilizador</option>
                        <option value="internet">Internet</option>
                    </select>
                </div>

                <!-- INPUT -->
                <div class="div title">
                    <label for="falla" class="block text-sm font-medium text-gray-700 mb-1">
                        Breve detalle de la falla
                    </label>
                    <textarea name="falla" id="falla" placeholder="Ingrese la falla del equipo" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-600 focus:outline-none text-sm"></textarea>
                </div>

                <!-- BOTÓN -->
                <button type="submit" class="w-full bg-gradient-to-r from-sky-700 to-blue-800 hover:from-sky-800 hover:to-blue-900 text-white py-3 rounded-lg
                        font-semibold tracking-wide shadow-lg hover:shadow-2xl transition-all duration-300"> 
                    <i class="bi bi-search me-2"></i>ENVIAR REQUERIMIENTO
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/servicio.js') }}"></script>
