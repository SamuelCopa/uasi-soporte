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
<form method="POST" action="{{ route('servicios.store') }}" role="form" enctype="multipart/form-data" class="space-y-5">
    @csrf
    {{-- =========================================================
         ID DEL FUNCIONARIO
         Lo utiliza el JavaScript cuando encuentra el C.I.
         ========================================================= --}}
    <input type="hidden" id="funcionario_id" name="funcionario_id">
    {{-- =========================================================
         C.I.
         ========================================================= --}}
    <div class="div title">
        <label for="ci" class="form-label">
            {{ __('C.I.') }}
            <span class="required">*</span>
        </label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-id-card text-primary"></i>
            </span>
            <input type="number"name="ci" id="ci" class="form-control @error('ci') is-invalid @enderror" placeholder="Ingrese el C.I." value="{{ old('ci') }}"  required>
            {!! $errors->first('ci', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    {{-- =========================================================
         DATOS DEL FUNCIONARIO EXISTENTE
         ========================================================= --}}
    <div id="funcionario-existente" style="display: none;">
        <div class="div title">
            <label for="nombre-existente" class="form-label">
                FUNCIONARIO
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user-tie text-primary"></i>
                </span>
                <input type="text"
                       id="nombre-existente"
                       class="form-control"
                       readonly>
            </div>
        </div>
    </div>
    {{-- =========================================================
         DATOS PARA FUNCIONARIO NUEVO
         Inicialmente están ocultos.
         Se muestran solamente cuando el C.I. NO existe.
         ========================================================= --}}
    <div id="funcionario-nuevo" style="display: none;">
        {{-- NOMBRES --}}
        <div class="div title">
            <label for="nombre" class="form-label">
                NOMBRES
                <span class="required">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text"
                       name="nombre"
                       id="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       placeholder="Ingrese los nombres"
                       value="{{ old('nombre') }}"
                       oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
            </div>
            {!! $errors->first('nombre','<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- APELLIDO PATERNO --}}
        <div class="div title">
            <label for="paterno" class="form-label">
                APELLIDO PATERNO
                <span class="required">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text"
                       name="paterno"
                       id="paterno"
                       class="form-control @error('paterno') is-invalid @enderror"
                       placeholder="Ingrese el apellido paterno"
                       value="{{ old('paterno') }}"
                       oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
            </div>
            {!! $errors->first('paterno','<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        {{-- APELLIDO MATERNO --}}
        <div class="div title">
            <label for="materno" class="form-label">
                APELLIDO MATERNO
                <span class="required">*</span>
            </label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text"name="materno" id="materno" class="form-control @error('materno') is-invalid @enderror" placeholder="Ingrese el apellido materno"
                       value="{{ old('materno') }}" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">
            </div>
            {!! $errors->first('materno','<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    {{-- =========================================================
         DEPENDENCIA
         ========================================================= --}}
    <div class="div title">
        <label for="search-input" class="form-label">
            DEPENDENCIA
            <span class="required">*</span>
        </label>
        <input type="text" id="search-input" list="options" placeholder="Buscar dependencia ..." class="form-control" autocomplete="off" required>
        <datalist id="options">
            @foreach ($dependencia as $item)
                <option
                    value="{{ $item->dependencias }}"
                    data-id="{{ $item->id }}">
                </option>
            @endforeach
        </datalist>
        {{-- ID REAL QUE SE ENVÍA AL CONTROLADOR --}}
        <input type="hidden" id="id-selected" name="dependencia_id">
    </div>
{{-- =========================================================
     CÓDIGO DEL ACTIVO
     ========================================================= --}}
<div class="div title">

    <label for="cod_gamea" class="form-label">
        CÓDIGO DEL ACTIVO
        <span class="required">*</span>
    </label>

    <div class="input-group">

        <span class="input-group-text">
            <i class="fas fa-barcode text-primary"></i>
        </span>
        <input type="text" name="cod_gamea" id="cod_gamea" class="form-control" placeholder="Ingrese el código del activo" autocomplete="off" required>
    </div>

<div id="resultadoActivo" class="mt-2"></div>
    <input type="hidden" name="equipo" id="equipo">
    <input type="hidden" id="activo_encontrado" value="0">
    <input type="hidden" id="tipo_activo" name="tipo_activo">
    <input type="hidden" id="activo_id"  name="activo_id">

</div>

    {{-- =========================================================
         DETALLE DE LA FALLA
         ========================================================= --}}
    <div class="div title">

        <label for="falla"
               class="block text-sm font-medium text-gray-700 mb-1">

            BREVE DETALLE DE LA FALLA
            <span class="required">*</span>

        </label>

        <textarea name="falla"
                  id="falla"
                  placeholder="Ingrese la falla del equipo"
                  required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg
                         focus:ring-2 focus:ring-sky-600 focus:outline-none text-sm">{{ old('falla') }}</textarea>

        @error('falla')
            <div class="text-danger small mt-1">
                <strong>{{ $message }}</strong>
            </div>
        @enderror

    </div>


    {{-- =========================================================
         BOTÓN ENVIAR
         ========================================================= --}}
    <button type="submit"
            class="w-full bg-gradient-to-r from-sky-700 to-blue-800
                   hover:from-sky-800 hover:to-blue-900
                   text-white py-3 rounded-lg
                   font-semibold tracking-wide shadow-lg
                   hover:shadow-2xl transition-all duration-300">

        <i class="bi bi-search me-2"></i>
        ENVIAR REQUERIMIENTO

    </button>


    {{-- =========================================================
         BOTÓN CERRAR
         ========================================================= --}}
    <button type="button"
            data-bs-dismiss="modal"
            class="w-full mt-3 bg-white border border-gray-300
                   hover:bg-gray-100 text-gray-700 py-3 rounded-lg
                   font-semibold shadow-md transition-all duration-300">

        <i class="bi bi-box-arrow-left me-2"></i>
        CERRAR

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

<!-- <script>
$(document).ready(function () {

    let timeoutActivo = null;

    $('#cod_gamea').on('keyup', function () {

        clearTimeout(timeoutActivo);

        let codigo = $(this).val().trim();

        // Limpiar resultados anteriores
        $('#resultadoActivo').html('');
        $('#activo_encontrado').val('0');
        $('#tipo_activo').val('');
        $('#activo_id').val('');
        $('#equipo').val('');

        // No buscar códigos demasiado cortos
        if (codigo.length < 3) {
            return;
        }

        timeoutActivo = setTimeout(function () {

            $.ajax({

                url: "{{ route('servicios.buscarActivo') }}",

                type: "GET",

                data: {
                    cod_gamea: codigo
                },

                beforeSend: function () {

                    $('#resultadoActivo').html(
                        '<span class="text-primary">' +
                            '<i class="fas fa-spinner fa-spin"></i> ' +
                            'Buscando activo...' +
                        '</span>'
                    );

                },

                success: function (data) {

                    if (data.encontrado) {

                        // Mostrar resultado
                        $('#resultadoActivo').html(
                            '<div class="alert alert-success py-2 mt-2 mb-0">' +
                                '<i class="fas fa-check-circle me-1"></i>' +
                                '<strong>ACTIVO ENCONTRADO</strong><br>' +
                                '<small>' +
                                    'Tipo de equipo: <strong>' +
                                    data.tipo +
                                    '</strong>' +
                                '</small>' +
                            '</div>'
                        );

                        // Guardar información del activo
                        $('#activo_encontrado').val('1');

                        $('#tipo_activo').val(data.tipo);

                        $('#activo_id').val(data.id);

                        // Guardar automáticamente el tipo
                        // que utilizará servicios.equipo
                        $('#equipo').val(data.equipo);

                    } else {

                        $('#resultadoActivo').html(
                            '<div class="alert alert-danger py-2 mt-2 mb-0">' +
                                '<i class="fas fa-times-circle me-1"></i>' +
                                '<strong>ACTIVO NO ENCONTRADO</strong><br>' +
                                '<small>' +
                                    'Verifique el código del activo ingresado.' +
                                '</small>' +
                            '</div>'
                        );

                        $('#activo_encontrado').val('0');

                        $('#tipo_activo').val('');

                        $('#activo_id').val('');

                        $('#equipo').val('');
                    }

                },

                error: function () {

                    $('#resultadoActivo').html(
                        '<div class="alert alert-danger py-2 mt-2 mb-0">' +
                            '<i class="fas fa-exclamation-triangle me-1"></i>' +
                            '<strong>ERROR DE CONSULTA</strong><br>' +
                            '<small>' +
                                'No fue posible consultar el activo.' +
                            '</small>' +
                        '</div>'
                    );

                    $('#activo_encontrado').val('0');

                    $('#tipo_activo').val('');

                    $('#activo_id').val('');

                    $('#equipo').val('');
                }

            });

        }, 500);

    });

});
</script> -->



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/servicio.js') }}"></script>
