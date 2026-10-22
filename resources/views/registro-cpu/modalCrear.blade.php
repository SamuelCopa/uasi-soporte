<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">

<!-- =========================================================
     MODAL REGISTRAR CPU
     ========================================================= -->

<div class="modal fade" id="crearc" tabindex="-1" role="dialog" aria-labelledby="crearCpuLabel" aria-hidden="true">
<div class="modal-dialog modal-xxl" role="document">
    <div class="modal-content modal-password">
        <!-- =================================================
             HEADER
             ================================================= -->
        <div class="modal-header modal-password-header">
            <div class="modal-title-container">
                <div class="modal-password-icon">
                    <i class="fas fa-desktop"></i>
                </div>

                <div>
                    <h5 class="modal-title" id="crearCpuLabel">
                        REGISTRAR CPU
                    </h5>

                    <small>
                        Registro de los datos del equipo y funcionario
                    </small>
                </div>

            </div>

            <button type="button"
                    class="close modal-password-close"
                    data-dismiss="modal"
                    aria-label="Cerrar">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>


        <!-- =================================================
             FORMULARIO
             ================================================= -->
        <form method="POST" autocomplete="off" action="{{ route('registro-cpus.store') }}">
            @csrf
            <!-- =================================================
                 BODY
                 ================================================= -->
            <div class="modal-body modal-password-body">
                <!-- =================================================
                     DATOS DEL SOLICITANTE
                     ================================================= -->
                <div class="registro-section">
                    <div class="registro-section-title">
                        <i class="fas fa-user"></i>
                        DATOS DEL SOLICITANTE
                    </div>
                    <!-- TIPO DE FUNCIONARIO -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="registro-field">
                                    <label for="miSelect">
                                        <i class="fas fa-user-check"></i>
                                        TIPO DE FUNCIONARIO
                                        <span class="required">*</span>
                                    </label>
                                    <select name="funcionario_activo"
                                            id="miSelect"
                                            class="form-control"
                                            required>

                                        <option value="" disabled selected>
                                            SELECCIONE UNA OPCIÓN
                                        </option>

                                        <option value="1">
                                            FUNCIONARIO ACTIVO
                                        </option>

                                        <option value="0">
                                            EX FUNCIONARIO
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <!-- =================================================
                         FORMULARIO FUNCIONARIO
                         ================================================= -->
                    <div id="formularioc">
                        <!-- C.I. / EXPEDIDO / CELULAR -->
                        <div class="row">
                            <!-- C.I. -->
                            <div class="col-md-4">
                                <div class="registro-field">
                                    <label for="ci">
                                        <i class="fas fa-id-card"></i>
                                        C.I.
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text"
                                           name="ci"
                                           id="ci"
                                           class="form-control @error('ci') is-invalid @enderror"
                                           placeholder="Carnet de identidad"
                                           value="{{ old('ci') }}"
                                           required>
                                    {!! $errors->first(
                                        'ci',
                                        '<div class="invalid-feedback" role="alert">
                                            <strong>:message</strong>
                                        </div>'
                                    ) !!}
                                </div>
                            </div>


                            <!-- EXPEDIDO -->
                            <div class="col-md-4">
                                <div class="registro-field">
                                    <label for="expedido">
                                        <i class="fas fa-map-marker-alt"></i>
                                        EXPEDIDO
                                        <span class="required">*</span>
                                    </label>
                                    <select name="expedido" id="expedido" class="form-control @error('expedido') is-invalid @enderror" required>

                                        <option value="" disabled {{ old('expedido') ? '' : 'selected' }}>
                                            SELECCIONE UNA OPCIÓN
                                        </option>

                                        <option value="QR" {{ old('expedido') == 'QR' ? 'selected' : '' }}>
                                            QR
                                        </option>

                                        <option value="LP" {{ old('expedido') == 'LP' ? 'selected' : '' }}>
                                            LA PAZ
                                        </option>

                                        <option value="CB" {{ old('expedido') == 'CB' ? 'selected' : '' }}>
                                            COCHABAMBA
                                        </option>

                                        <option value="SC" {{ old('expedido') == 'SC' ? 'selected' : '' }}>
                                            SANTA CRUZ
                                        </option>

                                        <option value="OR" {{ old('expedido') == 'OR' ? 'selected' : '' }}>
                                            ORURO
                                        </option>

                                        <option value="CH" {{ old('expedido') == 'CH' ? 'selected' : '' }}>
                                            CHUQUISACA
                                        </option>

                                        <option value="PO" {{ old('expedido') == 'PO' ? 'selected' : '' }}>
                                            POTOSI
                                        </option>

                                        <option value="T" {{ old('expedido') == 'T' ? 'selected' : '' }}>
                                            TARIJA
                                        </option>

                                        <option value="B" {{ old('expedido') == 'B' ? 'selected' : '' }}>
                                            BENI
                                        </option>

                                        <option value="P" {{ old('expedido') == 'P' ? 'selected' : '' }}>
                                            PANDO
                                        </option>

                                    </select>

                                    {!! $errors->first(
                                        'expedido',
                                        '<div class="invalid-feedback" role="alert">
                                            <strong>:message</strong>
                                        </div>'
                                    ) !!}

                                </div>

                            </div>


                            <!-- CELULAR -->
                            <div class="col-md-4">

                                <div class="registro-field">

                                    <label for="celular">

                                        <i class="fas fa-phone-alt"></i>

                                        CELULAR

                                        <span class="required">*</span>

                                    </label>

                                    <input type="number"
                                           name="celular"
                                           id="celular"
                                           class="form-control @error('celular') is-invalid @enderror"
                                           placeholder="Número de celular"
                                           value="{{ old('celular') }}"
                                           required>

                                    {!! $errors->first(
                                        'celular',
                                        '<div class="invalid-feedback" role="alert">
                                            <strong>:message</strong>
                                        </div>'
                                    ) !!}

                                </div>

                            </div>

                        </div>


                        <!-- APELLIDOS / NOMBRE -->
                        <div class="row">
                            <!-- PATERNO -->
                            <div class="col-md-4">
                                <div class="registro-field">
                                    <label for="paterno">
                                        <i class="fas fa-user"></i>
                                        APELLIDO PATERNO
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="paterno" id="paterno" class="form-control @error('paterno') is-invalid @enderror" placeholder="Apellido paterno"
                                           value="{{ old('paterno') }}" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" required>
                                    {!! $errors->first('paterno','<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                            <!-- MATERNO -->
                            <div class="col-md-4">
                                <div class="registro-field">
                                    <label for="materno">
                                        <i class="fas fa-user"></i>
                                        APELLIDO MATERNO
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="materno" id="materno" class="form-control @error('materno') is-invalid @enderror" placeholder="Apellido materno"
                                           value="{{ old('materno') }}" oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" required>
                                    {!! $errors->first('materno','<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                            <!-- NOMBRE -->
                            <div class="col-md-4">
                                <div class="registro-field">
                                    <label for="nombre">
                                        <i class="fas fa-user-tie"></i>
                                        NOMBRE(S)
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Nombre(s)" value="{{ old('nombre') }}"
                                           oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')" required>
                                    {!! $errors->first('nombre','<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
                                </div>
                            </div>
                        </div>
                        <!-- CARGO / CORREO -->
                        <div class="row">
                            <!-- CARGO -->
                            <div class="col-md-6">
                                <div class="registro-field" id="cargoA">
                                    <label for="cargo">
                                        <i class="fas fa-briefcase"></i>
                                        CARGO
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text"
                                           name="cargo"
                                           id="cargo"
                                           class="form-control @error('cargo') is-invalid @enderror"
                                           placeholder="Cargo"
                                           value="{{ old('cargo') }}"
                                           oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                           required>
                                    {!! $errors->first(
                                        'cargo',
                                        '<div class="invalid-feedback" role="alert">
                                            <strong>:message</strong>
                                        </div>'
                                    ) !!}
                                </div>
                            </div>
                            <!-- CORREO -->
                            <div class="col-md-6">
                                <div class="registro-field" id="emailC">
                                    <label for="email">
                                        <i class="fas fa-envelope"></i>
                                        CORREO ELECTRÓNICO
                                        <span class="required">*</span>
                                    </label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="correo@ejemplo.com"
                                           value="{{ old('email') }}"
                                           required>
                                    {!! $errors->first(
                                        'email',
                                        '<div class="invalid-feedback" role="alert">
                                            <strong>:message</strong>
                                        </div>'
                                    ) !!}
                                </div>
                            </div>
                        </div>
                        <!-- DEPENDENCIA / FECHA -->
                        <div class="row">
                            <!-- DEPENDENCIA -->
<div class="col-md-7">
    <div class="registro-field" id="search-inputCC">

        <label for="search-inputC">
            <i class="fas fa-building"></i>
            DEPENDENCIA
        </label>

        <input type="text"
               id="search-inputC"
               list="optionsC"
               placeholder="Buscar dependencia..."
               class="form-control"
               autocomplete="off"
               value="{{ old('dependencia_nombre') }}">

        <datalist id="optionsC">
            @foreach ($dependencia as $item)
                <option value="{{ $item->dependencias }}"
                        data-id="{{ $item->id }}">
                </option>
            @endforeach
        </datalist>

        <input type="hidden"
               id="id-selectedC"
               name="dependencia_id"
               value="{{ old('dependencia_id') }}">

    </div>
</div>
                            <!-- FECHA -->
                            <div class="col-md-5">

                                <div class="registro-field">

                                    <label for="fecha">

                                        <i class="fas fa-calendar-alt"></i>

                                        FECHA DE RECEPCIÓN

                                        <span class="required">*</span>

                                    </label>

                                    <input type="datetime-local"
                                           name="fecha"
                                           id="fecha"
                                           class="form-control @error('fecha') is-invalid @enderror"
                                           value="{{ old('fecha', date('Y-m-d\TH:i:s')) }}"
                                           readonly
                                           required>

                                    {!! $errors->first(
                                        'fecha',
                                        '<div class="invalid-feedback" role="alert">
                                            <strong>:message</strong>
                                        </div>'
                                    ) !!}

                                </div>

                            </div>

                        </div>
     

                <!-- =================================================
                     DATOS DEL EQUIPO
                     ================================================= -->
                <div class="registro-section">
                    <div class="registro-section-title">
                        <i class="fas fa-desktop"></i>
                        DATOS DEL CPU
                    </div>
                            <!-- =================================================
                             DATOS DEL CPU
                             ================================================= -->
                        <div id="formularioc2">
                                <!-- USUARIO / CONTRASEÑA -->
                                <div class="fila-1">

                                    <!-- USUARIO -->
                                    <div class="div title">

                                        <label for="usuario" class="form-label">
                                            {{ __('USUARIO :') }}
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>

                                            <input type="text"
                                                   name="usuario"
                                                   class="form-control @error('usuario') is-invalid @enderror"
                                                   id="usuario"
                                                   placeholder="Usuario">

                                        </div>

                                        {!! $errors->first(
                                            'usuario',
                                            '<div class="invalid-feedback" role="alert">
                                                <strong>:message</strong>
                                            </div>'
                                        ) !!}

                                    </div>


                                    <!-- CONTRASEÑA -->
                                    <div class="div title">

                                        <label for="contrasena" class="form-label">
                                            {{ __('CONTRASEÑA :') }}
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="fas fa-key"></i>
                                            </span>

                                            <input type="text"
                                                   name="contrasena"
                                                   class="form-control @error('contrasena') is-invalid @enderror"
                                                   id="contrasena"
                                                   placeholder="Contraseña">

                                        </div>

                                        {!! $errors->first(
                                            'contrasena',
                                            '<div class="invalid-feedback" role="alert">
                                                <strong>:message</strong>
                                            </div>'
                                        ) !!}

                                    </div>

                                </div>


                                <!-- =================================================
                                     CÓDIGO GAMEA
                                     ================================================= -->
                                <div class="fila-1">

                                    <div class="div title">

                                        <label for="cod_gamea" class="form-label">
                                            {{ __('CÓDIGO GAMEA :') }}
                                            <span class="required">*</span>
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="fas fa-barcode"></i>
                                            </span>

                                            <input type="number"
                                                   name="cod_gamea"
                                                   class="form-control @error('cod_gamea') is-invalid @enderror"
                                                   id="cod_gamea"
                                                   placeholder="Código GAMEA"
                                                   required>

                                        </div>

                                        {!! $errors->first(
                                            'cod_gamea',
                                            '<div class="invalid-feedback" role="alert">
                                                <strong>:message</strong>
                                            </div>'
                                        ) !!}

                                    </div>

                                </div>
                        </div>

                    <div class="fila-5">
                        <!-- =================================================
                             CASE / MARCA / COLOR
                             ================================================= -->
                        <div class="div title">

                            <div class="case-selector">

                                <!-- ÍCONO DE DESPLIEGUE -->
                                <span class="mif-chevron-left mif-3x boton"></span>

                                <nav id="case">

                                    <ul id="menu_principal" class="ul">

                                        <li>
                                            <label for="drop-2" class="text-center principales">

                                                <i class="fas fa-desktop mr-2"></i>
                                                {{ __('CASE') }}
                                            </label>
                                            <input type="checkbox" id="drop-2">
                                            <!-- ============================
                                                 MARCAS
                                                 ============================ -->
                                            <ul class="ul">

                                                <label for="marcacase_id"
                                                       class="form-label">

                                                    {{ __('MARCA :') }}

                                                </label>


                                                @foreach ($marcacase as $marca)

                                                    <li>

                                                        <a href="#"
                                                           class="nivel-2"
                                                           data-id="{{ $marca->id }}">

                                                            <i class="fas fa-tag mr-1"></i>
                                                            {{ $marca->marca }}

                                                        </a>


                                                        <!-- ====================
                                                             COLORES
                                                             ==================== -->
                                                        <ul id="submenu-color"
                                                            class="ul nivel-3"
                                                            style="display: none;">

                                                            <label for="colorcase_id"
                                                                   class="form-label">

                                                                {{ __('COLOR :') }}

                                                            </label>


                                                            @foreach ($colorcase as $color)

                                                                <li>

                                                                    <a href="#"
                                                                       class="nivel-4"
                                                                       data-id="{{ $color->id }}">

                                                                        <i class="fas fa-palette mr-1"></i>
                                                                        {{ $color->color }}

                                                                    </a>

                                                                </li>

                                                            @endforeach


                                                            <!-- OTRO COLOR -->
                                                            <li>

                                                                <a href="#"
                                                                   class="nivel-4"
                                                                   data-id="otroColorcase">

                                                                    <i class="fas fa-plus-circle mr-1"></i>
                                                                    Otro...

                                                                </a>

                                                            </li>

                                                        </ul>

                                                    </li>

                                                @endforeach


                                                <!-- OTRA MARCA -->
                                                <li>

                                                    <a href="#"
                                                       class="nivel-2"
                                                       data-id="otroMarcacase">

                                                        <i class="fas fa-plus-circle mr-1"></i>
                                                        Otro...

                                                    </a>

                                                </li>

                                            </ul>

                                        </li>

                                    </ul>

                                </nav>


                                <!-- ==============================
                                     VALORES SELECCIONADOS
                                     ============================== -->

                                <input type="hidden"
                                       id="marcacase_id"
                                       name="marcacase_id">

                                <input type="hidden"
                                       id="colorcase_id"
                                       name="colorcase_id">


                                <!-- ==============================
                                     OTRA MARCA / OTRO COLOR
                                     ============================== -->

                                <input type="text"
                                       name="otra_marca"
                                       class="otra_marca form-control mt-2"
                                       placeholder="Especificar otra"
                                       style="display:none;">

                                <input type="text"
                                       name="otro_color"
                                       class="otro_color form-control mt-2"
                                       placeholder="Especificar otro"
                                       style="display:none;">


                                <!-- ==============================
                                     SELECCIONES REALIZADAS
                                     ============================== -->

                                <ul id="selecciones" class="ul">

                                    @if(old('marcacase_id') && old('colorcase_id'))

                                        <li id="marcacase">

                                            <i class="fas fa-tag mr-1"></i>
                                            MARCA:
                                            {{ $marcacase->find(old('marcacase_id'))->marca }}

                                        </li>

                                        <li id="colorcase">

                                            <i class="fas fa-palette mr-1"></i>
                                            COLOR:
                                            {{ $colorcase->find(old('colorcase_id'))->color }}

                                        </li>

                                    @else

                                        <li id="marcacase"></li>
                                        <li id="colorcase"></li>

                                    @endif
                                </ul>
                            </div>
                        </div>
                        {{-- =========================================================
                        PROCESADOR
                        ========================================================= --}}
                        <div class="div title">
                        <nav id="procesadores">
                            <ul id="menu_principal" class="ul">
                                <li>
                                    <label for="drop-procesadores" class="text-center principales">
                                        <i class="fas fa-microchip mr-2"></i>
                                        {{ __('PROCESADOR') }}
                                    </label>
                                    <input type="checkbox" id="drop-procesadores">
                                    <ul class="ul">
                                        <label for="marcaprocesador_id" class="form-label">
                                            <i class="fas fa-tag mr-1"></i>
                                            {{ __('MARCA :') }}
                                        </label>
                                        @foreach ($marcaprocesador as $marca)
                                        <li>
                                            <a href="#" class="nivel-5" data-id="{{ $marca->id }}">
                                                <i class="fas fa-industry mr-2"></i>
                                                {{ $marca->marca }}
                                            </a>
                                            <ul id="submenu-modelo" class="ul nivel-6" style="display: none;">
                                                <label for="modeloprocesador_id" class="form-label">
                                                    <i class="fas fa-microchip mr-1"></i>
                                                    {{ __('MODELO :') }}
                                                </label>
                                                @php
                                                    $modelos_filtrados = $marca->marca == 'INTEL'
                                                        ? $modprocesador->filter(fn($m) => strpos($m->modelo, 'C') === 0)
                                                        : ($marca->marca == 'AMD'
                                                            ? $modprocesador->filter(fn($m) => strpos($m->modelo, 'R') === 0)
                                                            : collect());
                                                @endphp
                                                @foreach ($modelos_filtrados as $modelo)
                                                <li>
                                                    <a href="#" class="nivel-7" data-id="{{ $modelo->id }}">
                                                        <i class="fas fa-cog mr-2"></i>
                                                        {{ $modelo->modelo }}
                                                    </a>
                                                    <ul id="submenu-generacion" class="ul nivel-8" style="display: none;">
                                                        <label for="genprocesador_id" class="form-label">
                                                            <i class="fas fa-layer-group mr-1"></i>
                                                            {{ __('GENERACION :') }}
                                                        </label>
                                                        @foreach ($genprocesador as $procesador)
                                                        <li>
                                                            <a href="#" class="nivel-9" data-id="{{ $procesador->id }}">
                                                                <i class="fas fa-angle-right mr-2"></i>
                                                                {{ $procesador->generacion }}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                        {{-- Opción "Otro" generación --}}
                                                        <li>
                                                            <a href="#" class="nivel-9" data-id="otroGenpro">
                                                                <i class="fas fa-plus-circle mr-2"></i>
                                                                Otro...
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @endforeach

                                                {{-- Opción "Otro" modelo --}}
                                                <li>
                                                    <a href="#" class="nivel-7" data-id="otroModpro">
                                                        <i class="fas fa-plus-circle mr-2"></i>
                                                        Otro...
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        @endforeach
                                        {{-- Opción "Otro" marca --}}
                                        <li>
                                            <a href="#" class="nivel-5" data-id="otroMarcapro">
                                                <i class="fas fa-plus-circle mr-2"></i>
                                                Otro...
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        {{-- =====================================================
                            CAMPOS OCULTOS
                            ===================================================== --}}
                        <input type="hidden"
                            id="marcaprocesador_id"
                            name="marcaprocesador_id">
                        <input type="hidden"
                            id="modeloprocesador_id"
                            name="modeloprocesador_id">
                        <input type="hidden"
                            id="genprocesador_id"
                            name="genprocesador_id">
                        <input type="text"
                            name="otra_marca_procesador"
                            class="otra_marca_procesador form-control mt-2"
                            placeholder="Especificar otro"
                            style="display:none;">
                        <input type="text"
                            name="otro_modelo_procesador"
                            class="otro_modelo_procesador form-control mt-2"
                            placeholder="Especificar otro"
                            style="display:none;">
                        <input type="text"
                            name="otra_generacion"
                            class="otra_generacion form-control mt-2"
                            placeholder="Especificar otro"
                            style="display:none;">
                        {{-- =====================================================
                            SELECCIONES REALIZADAS
                            ===================================================== --}}
                        <ul id="seleccionesp" class="ul">
                            @if(old('marcaprocesador_id') &&
                                old('modeloprocesador_id') &&
                                old('genprocesador_id'))
                                <li>
                                    <i class="fas fa-tag mr-2"></i>
                                    MARCA:
                                    {{ $marcaprocesador->find(old('marcaprocesador_id'))->marca }}
                                </li>
                                <li>
                                    <i class="fas fa-cog mr-2"></i>
                                    MODELO:
                                    {{ $modprocesador->find(old('modeloprocesador_id'))->modelo }}
                                </li>
                                <li>
                                    <i class="fas fa-layer-group mr-2"></i>
                                    GENERACIÓN:
                                    {{ $genprocesador->find(old('genprocesador_id'))->generacion }}
                                </li>
                            @else
                                <li id="marcaprocesador"></li>
                                <li id="modeloprocesador"></li>
                                <li id="genprocesador"></li>
                            @endif
                        </ul>
                        </div>
                        {{-- =========================================================
                        DISCO DURO
                        ========================================================= --}}
                        <div class="div title">
                        <nav id="disco1">
                            <ul id="menu_principal" class="ul">
                                <li>
                                    <label for="drop-disco1" class="text-center principales">
                                        <i class="fas fa-hdd mr-2"></i>
                                        {{ __('DISCO DURO') }}
                                    </label>
                                    <input type="checkbox" id="drop-disco1">
                                    <ul class="ul">
                                        <label for="marcadisco_id" class="form-label">
                                            <i class="fas fa-tag mr-1"></i>
                                            {{ __('MARCA :') }}
                                        </label>
                                        @foreach ($marcadisco as $marca)
                                        <li>
                                            <a href="#" class="nivel-13" data-id="{{ $marca->id }}">
                                                <i class="fas fa-industry mr-2"></i>
                                                {{ $marca->marca }}
                                            </a>
                                            <ul id="submenu-cdisco"
                                                class="ul nivel-14"
                                                style="display: none;">
                                                <label for="capacdisco_id" class="form-label">
                                                    <i class="fas fa-database mr-1"></i>
                                                    {{ __('CAPACIDAD :') }}
                                                </label>
                                                @foreach ($capdisco as $capacidad)
                                                <li>
                                                    <a href="#"
                                                    class="nivel-15"
                                                    data-id="{{ $capacidad->id }}">
                                                        <i class="fas fa-hdd mr-2"></i>
                                                        {{ $capacidad->capacidad }}
                                                    </a>
                                                    <ul id="submenu-tdisco"
                                                        class="ul nivel-16"
                                                        style="display: none;">

                                                        <label for="tipodisco_id" class="form-label">
                                                            <i class="fas fa-layer-group mr-1"></i>
                                                            {{ __('TIPO :') }}
                                                        </label>
                                                        @foreach ($tipodisco as $tipo)
                                                        <li>
                                                            <a href="#"
                                                            class="nivel-17 a"
                                                            data-id="{{ $tipo->id }}">
                                                                <i class="fas fa-cog mr-2"></i>
                                                                {{ $tipo->tipo }}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                        {{-- Opción "Otro" tipo --}}
                                                        <li>
                                                            <a href="#" class="nivel-17" data-id="otroTipodisco">
                                                                <i class="fas fa-plus-circle mr-2"></i>
                                                                Otro...
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @endforeach

                                                {{-- Opción "Otro" capacidad --}}
                                                <li>
                                                    <a href="#"
                                                    class="nivel-15"
                                                    data-id="otroCapdisco">
                                                        <i class="fas fa-plus-circle mr-2"></i>
                                                        Otro...
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        @endforeach
                                        {{-- Opción "Otro" marca --}}
                                        <li>
                                            <a href="#"
                                            class="nivel-13"
                                            data-id="otroMarcadisco">
                                                <i class="fas fa-plus-circle mr-2"></i>
                                                Otro...
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        {{-- =====================================================
                            CAMPOS OCULTOS
                            ===================================================== --}}
                        <input type="hidden" id="marcadisco_id" name="marcadisco_id"><input type="hidden" id="capacdisco_id" name="capacdisco_id">
                        <input type="hidden" id="tipodisco_id" name="tipodisco_id">
                        <input type="text" name="otra_marca_disco" class="otra_marca_disco form-control mt-2" placeholder="Especificar otro" style="display:none;">
                        <input type="text" name="otra_capacidad_disco" class="otra_capacidad_disco form-control mt-2" placeholder="Especificar otro" style="display:none;">
                        <input type="text" name="otro_tipo_disco" class="otro_tipo_disco form-control mt-2" placeholder="Especificar otro" style="display:none;">
                        {{-- =====================================================
                            SELECCIONES REALIZADAS
                            ===================================================== --}}
                        <ul id="seleccionesdd" class="ul">
                            @if(old('marcadisco_id') && old('capacdisco_id') && old('tipodisco_id'))
                                <li>
                                    <i class="fas fa-tag mr-2"></i>
                                    MARCA:
                                    {{ $marcadisco->find(old('marcadisco_id'))->marca }}
                                </li>
                                <li>
                                    <i class="fas fa-database mr-2"></i>
                                    CAPACIDAD:
                                    {{ $capdisco->find(old('capacdisco_id'))->capacidad }}
                                </li>
                                <li>
                                    <i class="fas fa-layer-group mr-2"></i>
                                    TIPO:
                                    {{ $tipodisco->find(old('tipodisco_id'))->tipo }}
                                </li>
                            @else
                                <li id="marcadisco"></li>
                                <li id="capdisco"></li>
                                <li id="tipodisco"></li>
                            @endif
                        </ul>
                        </div>

                        {{-- =========================================================
                        DISCO DURO 2
                        ========================================================= --}}
                        <div class="div title">
                        <nav id="disco2">
                            <ul id="menu_principal1" class="ul">
                                <li>
                                    <label for="drop-disco2" class="text-center principales"><i class="fas fa-hdd mr-2"></i>
                                        {{ __('DISCO DURO 2') }}
                                    </label>
                                    <input type="checkbox" id="drop-disco2">
                                    <ul class="ul">
                                        <label for="marcadisco2_id" class="form-label"><i class="fas fa-tag mr-1"></i>
                                            {{ __('MARCA :') }}
                                        </label>
                                        @foreach ($marcadisco as $marca)
                                        <li>
                                            <a href="#" class="nivel-82" data-id="{{ $marca->id }}">
                                                <i class="fas fa-industry mr-2"></i>
                                                {{ $marca->marca }}
                                            </a>
                                            <ul id="submenu-cdisco"
                                                class="ul nivel-83"
                                                style="display: none;">
                                                <label for="capacdisco2_id" class="form-label">
                                                    <i class="fas fa-database mr-1"></i>
                                                    {{ __('CAPACIDAD :') }}
                                                </label>
                                                @foreach ($capdisco as $capacidad)
                                                <li>
                                                    <a href="#"
                                                    class="nivel-84"
                                                    data-id="{{ $capacidad->id }}">
                                                        <i class="fas fa-hdd mr-2"></i>
                                                        {{ $capacidad->capacidad }}
                                                    </a>
                                                    <ul id="submenu-tdisco"
                                                        class="ul nivel-85"
                                                        style="display: none;">

                                                        <label for="tipodisco2_id" class="form-label">
                                                            <i class="fas fa-layer-group mr-1"></i>
                                                            {{ __('TIPO :') }}
                                                        </label>
                                                        @foreach ($tipodisco as $tipo)
                                                        <li>
                                                            <a href="#" class="nivel-86" data-id="{{ $tipo->id }}">
                                                                <i class="fas fa-cog mr-2"></i>
                                                                {{ $tipo->tipo }}
                                                            </a>
                                                        </li>
                                                        @endforeach
                                                        {{-- Opción "Otro" tipo --}}
                                                        <li>
                                                            <a href="#" class="nivel-86" data-id="otroTipodisco2">
                                                                <i class="fas fa-plus-circle mr-2"></i>
                                                                Otro...
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @endforeach

                                                {{-- Opción "Otro" capacidad --}}
                                                <li>
                                                    <a href="#" class="nivel-84" data-id="otroCapdisco2">
                                                        <i class="fas fa-plus-circle mr-2"></i>
                                                        Otro...
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        @endforeach
                                        {{-- Opción "Otro" marca --}}
                                        <li>
                                            <a href="#" class="nivel-82" data-id="otroMarcadisco2">
                                                <i class="fas fa-plus-circle mr-2"></i>
                                                Otro...
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        {{-- =====================================================
                            CAMPOS OCULTOS
                            ===================================================== --}}
                        <input type="hidden" id="marcadisco2_id" name="marcadisco2_id">
                        <input type="hidden" id="capacdisco2_id" name="capacdisco_id">
                        <input type="hidden" id="tipodisco2_id" name="tipodisco2_id">
                        <input type="text" name="otra_marca_disco2" class="otra_marca_disco2 form-control mt-2" placeholder="Especificar otro" style="display:none;">
                        <input type="text" name="otra_capacidad_disco2" class="otra_capacidad_disco2 form-control mt-2" placeholder="Especificar otro" style="display:none;">
                        <input type="text" name="otro_tipo_disco2" class="otro_tipo_disco2 form-control mt-2" placeholder="Especificar otro" style="display:none;">
                        {{-- =====================================================
                            SELECCIONES REALIZADAS
                            ===================================================== --}}
                        <ul id="seleccionesdd2" class="ul">
                            @if(old('marcadisco2_id') && old('capacdisco2_id') && old('tipodisco2_id'))
                                <li>
                                    <i class="fas fa-tag mr-2"></i>
                                    MARCA:
                                    {{ $marcadisco->find(old('marcadisco2_id'))->marca }}
                                </li>
                                <li>
                                    <i class="fas fa-database mr-2"></i>
                                    CAPACIDAD:
                                    {{ $capdisco->find(old('capacdisco2_id'))->capacidad }}
                                </li>
                                <li>
                                    <i class="fas fa-layer-group mr-2"></i>
                                    TIPO:
                                    {{ $tipodisco->find(old('tipodisco2_id'))->tipo }}
                                </li>
                            @else
                                <li id="marcadisco"></li>
                                <li id="capdisco"></li>
                                <li id="tipodisco"></li>
                            @endif
                        </ul>
                        </div>

                </div>


                <div class="fila-5">
                        {{-- =========================================================
                        TARJETA MADRE
                        ========================================================= --}}
                        <div class="div title">
                        <nav id="tm">
                            <ul id="menu_principal" class="ul">
                                <li>
                                    <label for="drop-tm" class="text-center principales">
                                        <i class="fas fa-server mr-2"></i>
                                        {{ __('TARJETA MADRE') }}
                                    </label>
                                    <input type="checkbox" id="drop-tm">
                                    <ul class="ul">
                                        <label for="marcatmadre_id" class="form-label">
                                            <i class="fas fa-tag mr-1"></i>
                                            {{ __('MARCA :') }}
                                        </label>
                                        @foreach ($marcatmadre as $marca)
                                        <li>
                                            <a href="#" class="nivel-10" data-id="{{ $marca->id }}">
                                                <i class="fas fa-industry mr-2"></i>
                                                {{ $marca->marca }}
                                            </a>
                                            <ul id="submenu-mtmadre"
                                                class="ul nivel-11"
                                                style="display: none;">
                                                <label for="modtmadre_id" class="form-label">
                                                    <i class="fas fa-microchip mr-1"></i>
                                                    {{ __('MODELO :') }}
                                                </label>

                                                @foreach ($modelotmadre as $modelo)

                                                <li>
                                                    <a href="#"
                                                    class="nivel-12"
                                                    data-id="{{ $modelo->id }}">
                                                        <i class="fas fa-cog mr-2"></i>
                                                        {{ $modelo->modelo }}
                                                    </a>
                                                </li>

                                                @endforeach

                                                {{-- Opción "Otro" modelo --}}
                                                <li>
                                                    <a href="#"
                                                    class="nivel-12"
                                                    data-id="otroModtm">
                                                        <i class="fas fa-plus-circle mr-2"></i>
                                                        Otro...
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>

                                        @endforeach

                                        {{-- Opción "Otro" marca --}}
                                        <li>
                                            <a href="#"
                                            class="nivel-10"
                                            data-id="otroMarcatm">
                                                <i class="fas fa-plus-circle mr-2"></i>
                                                Otro...
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            </ul>

                        </nav>

                        {{-- =====================================================
                            CAMPOS OCULTOS
                            ===================================================== --}}

                        <input type="hidden"
                            id="marcatmadre_id"
                            name="marcatmadre_id">

                        <input type="hidden"
                            id="modtmadre_id"
                            name="modtmadre_id">

                        <input type="text"
                            name="otra_marcatm"
                            class="otra_marcatm form-control mt-2"
                            placeholder="Especificar otro"
                            style="display:none;">

                        <input type="text"
                            name="otro_modtm"
                            class="otro_modtm form-control mt-2"
                            placeholder="Especificar otro modelo"
                            style="display:none;">

                        {{-- =====================================================
                            SELECCIONES REALIZADAS
                            ===================================================== --}}

                        <ul id="seleccionestm" class="ul">

                            @if(old('marcatmadre_id') && old('modtmadre_id'))

                                <li>
                                    <i class="fas fa-tag mr-2"></i>
                                    MARCA:
                                    {{ $marcatmadre->find(old('marcatmadre_id'))->marca }}
                                </li>

                                <li>
                                    <i class="fas fa-cog mr-2"></i>
                                    MODELO:
                                    {{ $modelotmadre->find(old('modtmadre_id'))->modelo }}
                                </li>

                            @else

                                <li id="marcatmadre"></li>
                                <li id="modtmadre"></li>

                            @endif

                        </ul>
                    </div>



                    {{-- =========================================================
                    TARJETA DE VIDEO
                    ========================================================= --}}

                    <div class="div title">
                    <nav id="tv">

                        <ul id="menu_principal" class="ul">
                            <li>

                                <label for="drop-tv" class="text-center principales">
                                    <i class="fas fa-video mr-2"></i>
                                    {{ __('TARJETA DE VIDEO') }}
                                </label>

                                <input type="checkbox" id="drop-tv">

                                <ul class="ul">

                                    {{-- MARCA --}}
                                    <label for="marcatvideo_id" class="form-label">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ __('MARCA :') }}
                                    </label>

                                    @foreach ($marcatvideo as $marca)

                                    <li>
                                        <a href="#" class="nivel-27" data-id="{{ $marca->id }}">
                                            <i class="fas fa-industry mr-2"></i>
                                            {{ $marca->marca }}
                                        </a>

                                        {{-- CAPACIDAD --}}
                                        <ul class="ul nivel-28" style="display: none;">

                                            <label for="capactvideo_id" class="form-label">
                                                <i class="fas fa-database mr-1"></i>
                                                {{ __('CAPACIDAD :') }}
                                            </label>

                                            @foreach ($captvideo as $capacidad)

                                            <li>
                                                <a href="#"
                                                class="nivel-29"
                                                data-id="{{ $capacidad->id }}">
                                                    <i class="fas fa-memory mr-2"></i>
                                                    {{ $capacidad->capacidad }}
                                                </a>

                                                {{-- TIPO --}}
                                                <ul class="ul nivel-30"
                                                    style="display: none;">

                                                    <label for="tipotvideo_id" class="form-label">
                                                        <i class="fas fa-layer-group mr-1"></i>
                                                        {{ __('TIPO :') }}
                                                    </label>

                                                    @foreach ($tipotvideo as $tipo)

                                                    <li>
                                                        <a href="#"
                                                        class="nivel-31"
                                                        data-id="{{ $tipo->id }}">
                                                            <i class="fas fa-cog mr-2"></i>
                                                            {{ $tipo->tipo }}
                                                        </a>
                                                    </li>

                                                    @endforeach

                                                </ul>
                                            </li>

                                            @endforeach

                                            {{-- Otra capacidad --}}
                                            <li>
                                                <a href="#"
                                                class="nivel-29"
                                                data-id="otroCaptv">
                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                    Otro...
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    @endforeach

                                    {{-- Otra marca --}}
                                    <li>
                                        <a href="#"
                                        class="nivel-27"
                                        data-id="otroMarcatv">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Otro...
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>

                    </nav>

                    {{-- =====================================================
                        CAMPOS OCULTOS
                        ===================================================== --}}

                    <input type="hidden"
                        id="marcatvideo_id"
                        name="marcatvideo_id">

                    <input type="hidden"
                        id="capactvideo_id"
                        name="capactvideo_id">

                    <input type="hidden"
                        id="tipotvideo_id"
                        name="tipotvideo_id">

                    <input type="text"
                        name="otra_marca_tvideo"
                        class="otra_marca_tvideo form-control mt-2"
                        placeholder="Especificar otro"
                        style="display:none;">

                    <input type="text"
                        name="otra_capacidad_tvideo"
                        class="otra_capacidad_tvideo form-control mt-2"
                        placeholder="Especificar otro"
                        style="display:none;">

                    {{-- =====================================================
                        SELECCIONES REALIZADAS
                        ===================================================== --}}

                    <ul id="seleccionestvideo" class="ul">

                        @if(old('marcatvideo_id') &&
                            old('capactvideo_id') &&
                            old('tipotvideo_id'))

                            <li>
                                <i class="fas fa-tag mr-2"></i>
                                MARCA:
                                {{ $marcatvideo->find(old('marcatvideo_id'))->marca }}
                            </li>

                            <li>
                                <i class="fas fa-database mr-2"></i>
                                CAPACIDAD:
                                {{ $captvideo->find(old('capactvideo_id'))->capacidad }}
                            </li>

                            <li>
                                <i class="fas fa-layer-group mr-2"></i>
                                TIPO:
                                {{ $tipotvideo->find(old('tipotvideo_id'))->tipo }}
                            </li>

                        @else

                            <li id="marcatvideo"></li>
                            <li id="capacidadtvideo"></li>
                            <li id="tipotvideo"></li>

                        @endif

                    </ul>

                    </div>

                    {{-- =========================================================
                    TARJETA DE RED
                    ========================================================= --}}

                    <div class="div title">

                    <nav id="tr">

                        <ul id="menu_principal" class="ul">
                            <li>

                                <label for="drop-tr" class="text-center principales">
                                    <i class="fas fa-network-wired mr-2"></i>
                                    {{ __('TARJETA DE RED') }}
                                </label>

                                <input type="checkbox" id="drop-tr">

                                <ul class="ul">

                                    {{-- MARCA --}}
                                    <label for="marcatred_id" class="form-label">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ __('MARCA :') }}
                                    </label>

                                    @foreach ($marcatred as $marca)

                                    <li>
                                        <a href="#" class="nivel-40" data-id="{{ $marca->id }}">
                                            <i class="fas fa-industry mr-2"></i>
                                            {{ $marca->marca }}
                                        </a>

                                        {{-- MODELO --}}
                                        <ul class="ul nivel-41"
                                            style="display: none;">

                                            <label for="modtred_id" class="form-label">
                                                <i class="fas fa-microchip mr-1"></i>
                                                {{ __('MODELO :') }}
                                            </label>

                                            @foreach ($modelotred as $modelo)

                                            <li>
                                                <a href="#"
                                                class="nivel-42"
                                                data-id="{{ $modelo->id }}">
                                                    <i class="fas fa-cog mr-2"></i>
                                                    {{ $modelo->modelo }}
                                                </a>
                                            </li>

                                            @endforeach

                                            {{-- Otro modelo --}}
                                            <li>
                                                <a href="#"
                                                class="nivel-42"
                                                data-id="otroModtred">
                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                    Otro...
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    @endforeach

                                    {{-- Otra marca --}}
                                    <li>
                                        <a href="#"
                                        class="nivel-40"
                                        data-id="otroMarcatred">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Otro...
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>

                    </nav>

                    {{-- =====================================================
                        CAMPOS OCULTOS
                        ===================================================== --}}

                    <input type="hidden"
                        id="marcatred_id"
                        name="marcatred_id">

                    <input type="hidden"
                        id="modtred_id"
                        name="modtred_id">

                    <input type="text"
                        id=""
                        name="otra_marca_tred"
                        class="otra_marca_tred form-control mt-2"
                        placeholder="Especificar otro"
                        style="display:none;">

                    <input type="text"
                        id=""
                        name="otro_modelo_tred"
                        class="otro_modelo_tred form-control mt-2"
                        placeholder="Especificar otro"
                        style="display:none;">

                    {{-- =====================================================
                        SELECCIONES REALIZADAS
                        ===================================================== --}}

                    <ul id="seleccionestred" class="ul">

                        @if(old('marcatred_id') && old('modtred_id'))

                            <li>
                                <i class="fas fa-tag mr-2"></i>
                                MARCA:
                                {{ $marcatred->find(old('marcatred_id'))->marca }}
                            </li>

                            <li>
                                <i class="fas fa-cog mr-2"></i>
                                MODELO:
                                {{ $modelotred->find(old('modtred_id'))->modelo }}
                            </li>

                        @else

                            <li id="marcatred"></li>
                            <li id="modelotred"></li>

                        @endif

                    </ul>
        
                    </div>

                    {{-- =========================================================
                    TARJETA WIFI
                    ========================================================= --}}

                    <div class="div title">
                    <nav id="tw">

                        <ul id="menu_principal1" class="ul">
                            <li>

                                <label for="drop-tw" class="text-center principales">
                                    <i class="fas fa-wifi mr-2"></i>
                                    {{ __('TARJETA WIFI') }}
                                </label>

                                <input type="checkbox" id="drop-tw">

                                <ul class="ul">

                                    {{-- MARCA --}}
                                    <label for="marcawifi_id" class="form-label">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ __('MARCA :') }}
                                    </label>

                                    @foreach ($marcatwifi as $marca)

                                    <li>
                                        <a href="#"
                                        class="nivel-43"
                                        data-id="{{ $marca->id }}">
                                            <i class="fas fa-industry mr-2"></i>
                                            {{ $marca->marca }}
                                        </a>

                                        {{-- MODELO --}}
                                        <ul class="ul nivel-44"
                                            style="display: none;">

                                            <label for="modcawifi_id" class="form-label">
                                                <i class="fas fa-microchip mr-1"></i>
                                                {{ __('MODELO :') }}
                                            </label>

                                            @foreach ($modelowifi as $modelo)

                                            <li>
                                                <a href="#"
                                                class="nivel-45"
                                                data-id="{{ $modelo->id }}">
                                                    <i class="fas fa-cog mr-2"></i>
                                                    {{ $modelo->modelo }}
                                                </a>

                                                {{-- ANTENA --}}
                                                <ul class="ul nivel-80"
                                                    style="display: none;">

                                                    <label for="antena_id" class="form-label">
                                                        <i class="fas fa-broadcast-tower mr-1"></i>
                                                        {{ __('ANTENA :') }}
                                                    </label>

                                                    @foreach ($disipadorram as $antena)

                                                    <li>
                                                        <a href="#"
                                                        class="nivel-81"
                                                        data-id="{{ $antena->id }}">
                                                            <i class="fas fa-signal mr-2"></i>
                                                            {{ $antena->opcion }}
                                                        </a>
                                                    </li>

                                                    @endforeach

                                                </ul>
                                            </li>

                                            @endforeach

                                            {{-- Otro modelo --}}
                                            <li>
                                                <a href="#"
                                                class="nivel-45"
                                                data-id="otroModwifi">
                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                    Otro...
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    @endforeach

                                    {{-- Otra marca --}}
                                    <li>
                                        <a href="#"
                                        class="nivel-43"
                                        data-id="otroMarcawifi">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Otro...
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>

                    </nav>

                    {{-- =====================================================
                        CAMPOS OCULTOS
                        ===================================================== --}}

                    <input type="hidden"
                        id="marcawifi_id"
                        name="marcawifi_id">

                    <input type="hidden"
                        id="modcawifi_id"
                        name="modcawifi_id">

                    <input type="hidden"
                        id="antena_id"
                        name="antena_id">

                    <input type="text"
                        id=""
                        name="otra_marca_wifi"
                        class="otra_marca_wifi form-control mt-2"
                        placeholder="Especificar otro"
                        style="display:none;">

                    <input type="text"
                        id=""
                        name="otra_modelo_wifi"
                        class="otra_modelo_wifi form-control mt-2"
                        placeholder="Especificar otro"
                        style="display:none;">

                    {{-- =====================================================
                        SELECCIONES REALIZADAS
                        ===================================================== --}}

                    <ul id="seleccioneswifi" class="ul">

                        @if(old('marcawifi_id') &&
                            old('modcawifi_id') &&
                            old('antena_id'))

                            <li>
                                <i class="fas fa-tag mr-2"></i>
                                MARCA:
                                {{ $marcaTwifi->find(old('marcawifi_id'))->marca }}
                            </li>

                            <li>
                                <i class="fas fa-cog mr-2"></i>
                                MODELO:
                                {{ $modeloWifi->find(old('modcawifi_id'))->modelo }}
                            </li>

                            <li>
                                <i class="fas fa-broadcast-tower mr-2"></i>
                                ANTENA:
                                {{ $antena->find(old('antena_id'))->antena }}
                            </li>

                        @else

                            <li id="marcaTwifi"></li>
                            <li id="modeloWifi"></li>
                            <li id="antena"></li>

                        @endif

                    </ul>


                    </div>
        </div>
                            

        <div class="fila-5">
                    {{-- =========================================================
                    MEMORIA RAM
                    ========================================================= --}}
                    <div class="div title">

                    <nav id="ram">

                        <ul id="menu_principal" class="ul">
                            <li>

                                <label for="drop-ram" class="text-center principales">
                                    <i class="fas fa-memory mr-2"></i>
                                    {{ __('MEMORIA RAM') }}
                                </label>

                                <input type="checkbox" id="drop-ram">

                                <ul class="ul">

                                    {{-- DISIPADOR --}}
                                    <label for="disipador_id" class="form-label">
                                        <i class="fas fa-fan mr-1"></i>
                                        {{ __('DISIPADOR :') }}
                                    </label>

                                    @foreach ($disipadorram as $disipador)

                                    <li>
                                        <a href="#" class="nivel-18" data-id="{{ $disipador->id }}">
                                            <i class="fas fa-wind mr-2"></i>
                                            {{ $disipador->opcion }}
                                        </a>

                                        {{-- MARCA --}}
                                        <ul id="submenu-marcaram"
                                            class="ul nivel-19"
                                            style="display: none;">

                                            <label for="marcaram_id" class="form-label">
                                                <i class="fas fa-tag mr-1"></i>
                                                {{ __('MARCA :') }}
                                            </label>

                                            @foreach ($marcaram as $marca)

                                            <li>
                                                <a href="#"
                                                class="nivel-20"
                                                data-id="{{ $marca->id }}">
                                                    <i class="fas fa-industry mr-2"></i>
                                                    {{ $marca->marca }}
                                                </a>

                                                {{-- CAPACIDAD --}}
                                                <ul id="submenu-capacidadram"
                                                    class="ul nivel-21"
                                                    style="display: none;">

                                                    <label for="capacram_id" class="form-label">
                                                        <i class="fas fa-database mr-1"></i>
                                                        {{ __('CAPACIDAD:') }}
                                                    </label>

                                                    @foreach ($capram as $capacidad)

                                                    <li>
                                                        <a href="#"
                                                        class="nivel-22"
                                                        data-id="{{ $capacidad->id }}">
                                                            <i class="fas fa-memory mr-2"></i>
                                                            {{ $capacidad->capacidad }}
                                                        </a>

                                                        {{-- TIPO DE CONEXIÓN --}}
                                                        <ul id="submenu-tiporam"
                                                            class="ul nivel-23"
                                                            style="display: none;">

                                                            <label for="tiporam_id" class="form-label">
                                                                <i class="fas fa-plug mr-1"></i>
                                                                {{ __('TIPO DE CONEXION :') }}
                                                            </label>

                                                            @foreach ($tiporam as $tipo)

                                                            <li>
                                                                <a href="#"
                                                                class="nivel-24"
                                                                data-id="{{ $tipo->id }}">
                                                                    <i class="fas fa-microchip mr-2"></i>
                                                                    {{ $tipo->tipo }}
                                                                </a>

                                                                {{-- CANTIDAD --}}
                                                                <ul id="submenu-cantidadram"
                                                                    class="ul nivel-25"
                                                                    style="display: none;">

                                                                    <label for="cantidad_id" class="form-label">
                                                                        <i class="fas fa-layer-group mr-1"></i>
                                                                        {{ __('CANTIDAD :') }}
                                                                    </label>

                                                                    @foreach ($cantidadram as $cantidad)

                                                                    <li>
                                                                        <a href="#"
                                                                        class="nivel-26"
                                                                        data-id="{{ $cantidad->id }}">
                                                                            <i class="fas fa-cubes mr-2"></i>
                                                                            {{ $cantidad->cantidad }}
                                                                        </a>
                                                                    </li>

                                                                    @endforeach

                                                                </ul>
                                                            </li>

                                                            @endforeach

                                                            {{-- Otro tipo --}}
                                                            <li>
                                                                <a href="#"
                                                                class="nivel-24"
                                                                data-id="otroTiporam">
                                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                                    Otro...
                                                                </a>
                                                            </li>

                                                        </ul>
                                                    </li>

                                                    @endforeach

                                                    {{-- Otra capacidad --}}
                                                    <li>
                                                        <a href="#"
                                                        class="nivel-22"
                                                        data-id="otroCapram">
                                                            <i class="fas fa-plus-circle mr-2"></i>
                                                            Otro...
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>

                                            @endforeach

                                            {{-- Otra marca --}}
                                            <li>
                                                <a href="#"
                                                class="nivel-20"
                                                data-id="otroMarcaram">
                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                    Otro...
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    @endforeach

                                </ul>
                            </li>
                        </ul>

                    </nav>

                    {{-- =====================================================
                        CAMPOS OCULTOS
                        ===================================================== --}}

                    <input type="hidden" id="disipador_id" name="disipador_id">

                    <input type="hidden" id="marcaram_id" name="marcaram_id"> 
                    <input type="hidden" id="capacram_id" name="capacram_id">

                    <input type="hidden" id="tiporam_id" name="tiporam_id">

                    <input type="hidden" id="cantidad_id" name="cantidad_id">

                    <input type="text" name="otra_marca_ram" class="otra_marca_ram form-control mt-2" placeholder="Especificar otra"
                        style="display:none;">

                    <input type="text" name="otra_capacidad_ram" class="otra_capacidad_ram form-control mt-2" placeholder="Especificar otra"
                        style="display:none;">

                    <input type="text" name="otra_tipo_ram" class="otra_tipo_ram form-control mt-2" placeholder="Especificar otro"
                        style="display:none;">

                    {{-- =====================================================
                        SELECCIONES REALIZADAS
                        ===================================================== --}}

                    <ul id="seleccionesram" class="ul">

                        @if(old('disipador_id') &&
                            old('marcaram_id') &&
                            old('capacram_id') &&
                            old('tiporam_id') &&
                            old('cantidad_id'))

                            <li>
                                <i class="fas fa-fan mr-2"></i>
                                DISIPADOR:
                                {{ $disipadorram->find(old('disipador_id'))->opcion }}
                            </li>

                            <li>
                                <i class="fas fa-tag mr-2"></i>
                                MARCA:
                                {{ $marcaram->find(old('marcaram_id'))->marca }}
                            </li>

                            <li>
                                <i class="fas fa-database mr-2"></i>
                                CAPACIDAD:
                                {{ $capram->find(old('capacram_id'))->capacidad }}
                            </li>

                            <li>
                                <i class="fas fa-plug mr-2"></i>
                                TIPO:
                                {{ $tiporam->find(old('tiporam_id'))->tipo }}
                            </li>

                            <li>
                                <i class="fas fa-cubes mr-2"></i>
                                CANTIDAD:
                                {{ $cantidadram->find(old('cantidad_id'))->cantidad }}
                            </li>

                        @else

                            <li id="disipadorram"></li>
                            <li id="marcaram"></li>
                            <li id="capacidadram"></li>
                            <li id="tiporam"></li>
                            <li id="cantidad"></li>

                        @endif

                    </ul>

                </div>
            {{-- =========================================================
            MEMORIA RAM 2DO SLOT
            ========================================================= --}}
            <div class="div title">
            <nav id="ram2">

                <ul id="menu_principal" class="ul">
                    <li>

                        <label for="drop-ram2" class="text-center principales">
                            <i class="fas fa-memory mr-2"></i>
                            {{ __('MEMORIA RAM 2') }}
                        </label>

                        <input type="checkbox" id="drop-ram2">

                        <ul class="ul">

                            {{-- DISIPADOR --}}
                            <label for="disipador2_id" class="form-label">
                                <i class="fas fa-fan mr-1"></i>
                                {{ __('DISIPADOR :') }}
                            </label>

                            @foreach ($disipadorram as $disipador)

                            <li>
                                <a href="#"
                                class="nivel-51"
                                data-id="{{ $disipador->id }}">
                                    <i class="fas fa-wind mr-2"></i>
                                    {{ $disipador->opcion }}
                                </a>

                                {{-- MARCA --}}
                                <ul id="submenu-marcaram2"
                                    class="ul nivel-52"
                                    style="display: none;">

                                    <label for="marcaram2_id" class="form-label">
                                        <i class="fas fa-tag mr-1"></i>
                                        {{ __('MARCA :') }}
                                    </label>

                                    @foreach ($marcaram as $marca)

                                    <li>
                                        <a href="#"
                                        class="nivel-53"
                                        data-id="{{ $marca->id }}">
                                            <i class="fas fa-industry mr-2"></i>
                                            {{ $marca->marca }}
                                        </a>

                                        {{-- CAPACIDAD --}}
                                        <ul id="submenu-capacidadram2"
                                            class="ul nivel-54"
                                            style="display: none;">

                                            <label for="capacram2_id" class="form-label">
                                                <i class="fas fa-database mr-1"></i>
                                                {{ __('CAPACIDAD:') }}
                                            </label>

                                            @foreach ($capram as $capacidad)

                                            <li>
                                                <a href="#"
                                                class="nivel-55"
                                                data-id="{{ $capacidad->id }}">
                                                    <i class="fas fa-memory mr-2"></i>
                                                    {{ $capacidad->capacidad }}
                                                </a>

                                                {{-- TIPO DE CONEXIÓN --}}
                                                <ul id="submenu-tiporam2"
                                                    class="ul nivel-56"
                                                    style="display: none;">

                                                    <label for="tiporam2_id" class="form-label">
                                                        <i class="fas fa-plug mr-1"></i>
                                                        {{ __('TIPO DE CONEXION :') }}
                                                    </label>

                                                    @foreach ($tiporam as $tipo)

                                                    <li>
                                                        <a href="#"
                                                        class="nivel-57"
                                                        data-id="{{ $tipo->id }}">
                                                            <i class="fas fa-microchip mr-2"></i>
                                                            {{ $tipo->tipo }}
                                                        </a>

                                                        {{-- CANTIDAD --}}
                                                        <ul id="submenu-cantidadram2"
                                                            class="ul nivel-58"
                                                            style="display: none;">

                                                            <label for="cantidad2_id" class="form-label">
                                                                <i class="fas fa-layer-group mr-1"></i>
                                                                {{ __('CANTIDAD :') }}
                                                            </label>

                                                            @foreach ($cantidadram as $cantidad)

                                                            <li>
                                                                <a href="#"
                                                                class="nivel-59"
                                                                data-id="{{ $cantidad->id }}">
                                                                    <i class="fas fa-cubes mr-2"></i>
                                                                    {{ $cantidad->cantidad }}
                                                                </a>
                                                            </li>

                                                            @endforeach

                                                        </ul>
                                                    </li>

                                                    @endforeach

                                                    {{-- Otro tipo --}}
                                                    <li>
                                                        <a href="#"
                                                        class="nivel-57"
                                                        data-id="otroTiporam2">
                                                            <i class="fas fa-plus-circle mr-2"></i>
                                                            Otro...
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>

                                            @endforeach

                                            {{-- Otra capacidad --}}
                                            <li>
                                                <a href="#"
                                                class="nivel-55"
                                                data-id="otroCapram2">
                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                    Otro...
                                                </a>
                                            </li>

                                        </ul>
                                    </li>

                                    @endforeach

                                    {{-- Otra marca --}}
                                    <li>
                                        <a href="#"
                                        class="nivel-53"
                                        data-id="otroMarcaram2">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Otro...
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            @endforeach

                        </ul>
                    </li>
                </ul>

            </nav>

            {{-- =====================================================
                CAMPOS OCULTOS
                ===================================================== --}}

            <input type="hidden"
                id="disipador2_id"
                name="disipador2_id">

            <input type="hidden"
                id="marcaram2_id"
                name="marcaram2_id">

            <input type="hidden"
                id="capacram2_id"
                name="capacram2_id">

            <input type="hidden"
                id="tiporam2_id"
                name="tiporam2_id">

            <input type="hidden"
                id="cantidad2_id"
                name="cantidad2_id">

            <input type="text"
                id=""
                name="otra_marca_ram2"
                class="otra_marca_ram2 form-control mt-2"
                placeholder="Especificar otro"
                style="display:none;">

            <input type="text"
                id=""
                name="otra_capacidad_ram2"
                class="otra_capacidad_ram2 form-control mt-2"
                placeholder="Especificar otro"
                style="display:none;">

            <input type="text"
                id=""
                name="otra_tipo_ram2"
                class="otra_tipo_ram2 form-control mt-2"
                placeholder="Especificar otro"
                style="display:none;">

            {{-- =====================================================
                SELECCIONES REALIZADAS
                ===================================================== --}}

            <ul id="seleccionesram2" class="ul">

                @if(old('disipador2_id') &&
                    old('marcaram2_id') &&
                    old('capacram2_id') &&
                    old('tiporam2_id') &&
                    old('cantidad2_id'))

                    <li>
                        <i class="fas fa-fan mr-2"></i>
                        DISIPADOR:
                        {{ $disipadorram2->find(old('disipador2_id'))->opcion }}
                    </li>

                    <li>
                        <i class="fas fa-tag mr-2"></i>
                        MARCA:
                        {{ $marcaram2->find(old('marcaram2_id'))->marca }}
                    </li>

                    <li>
                        <i class="fas fa-database mr-2"></i>
                        CAPACIDAD:
                        {{ $capacidadram2->find(old('capacram2_id'))->capacidad }}
                    </li>

                    <li>
                        <i class="fas fa-plug mr-2"></i>
                        TIPO:
                        {{ $tiporam2->find(old('tiporam2_id'))->tipo }}
                    </li>

                    <li>
                        <i class="fas fa-cubes mr-2"></i>
                        CANTIDAD:
                        {{ $cantidad2->find(old('cantidad2_id'))->cantidad }}
                    </li>

                @else

                    <li id="disipadorram2"></li>
                    <li id="marcaram2"></li>
                    <li id="capacidadram2"></li>
                    <li id="tiporam2"></li>
                    <li id="cantidad2"></li>

                @endif

            </ul>
            </div>

            {{-- =========================================================
            MEMORIA RAM 3ER SLOT
            ========================================================= --}}

            <div class="div title">
                <nav id="ram3">

                <ul id="menu_principal1" class="ul">

                    <li>

                        <!-- TÍTULO -->
                        <label for="drop-ram3" class="text-center principales">
                            <i class="fas fa-memory mr-2"></i>
                            {{ __('MEMORIA RAM 3') }}
                        </label>

                        <input type="checkbox" id="drop-ram3">

                        <ul class="ul">

                            <!-- =================================================
                                DISIPADOR
                                ================================================= -->
                            <label for="disipador3_id" class="form-label">
                                <i class="fas fa-fan mr-2"></i>
                                {{ __('DISIPADOR :') }}
                            </label>

                            @foreach ($disipadorram as $disipador)

                                <li>
                                    <a href="#"
                                    class="nivel-60"
                                    data-id="{{ $disipador->id }}">
                                        <i class="fas fa-wind mr-2"></i>
                                        {{ $disipador->opcion }}
                                    </a>

                                    <!-- =================================================
                                        MARCA
                                        ================================================= -->
                                    <ul id="submenu-marcaram3"
                                        class="ul nivel-61"
                                        style="display: none;">

                                        <label for="marcaram3_id" class="form-label">
                                            <i class="fas fa-tag mr-2"></i>
                                            {{ __('MARCA :') }}
                                        </label>

                                        @foreach ($marcaram as $marca)

                                            <li>
                                                <a href="#"
                                                class="nivel-62"
                                                data-id="{{ $marca->id }}">
                                                    <i class="fas fa-industry mr-2"></i>
                                                    {{ $marca->marca }}
                                                </a>

                                                <!-- =================================================
                                                    CAPACIDAD
                                                    ================================================= -->
                                                <ul id="submenu-capacidadram3"
                                                    class="ul nivel-63"
                                                    style="display: none;">

                                                    <label for="capacram3_id" class="form-label">
                                                        <i class="fas fa-database mr-2"></i>
                                                        {{ __('CAPACIDAD:') }}
                                                    </label>

                                                    @foreach ($capram as $capacidad)

                                                        <li>
                                                            <a href="#"
                                                            class="nivel-64"
                                                            data-id="{{ $capacidad->id }}">
                                                                <i class="fas fa-memory mr-2"></i>
                                                                {{ $capacidad->capacidad }}
                                                            </a>

                                                            <!-- =================================================
                                                                TIPO DE CONEXIÓN
                                                                ================================================= -->
                                                            <ul id="submenu-tiporam3"
                                                                class="ul nivel-65"
                                                                style="display: none;">

                                                                <label for="tiporam3_id" class="form-label">
                                                                    <i class="fas fa-plug mr-2"></i>
                                                                    {{ __('TIPO DE CONEXION :') }}
                                                                </label>

                                                                @foreach ($tiporam as $tipo)

                                                                    <li>
                                                                        <a href="#"
                                                                        class="nivel-66"
                                                                        data-id="{{ $tipo->id }}">
                                                                            <i class="fas fa-microchip mr-2"></i>
                                                                            {{ $tipo->tipo }}
                                                                        </a>

                                                                        <!-- =================================================
                                                                            CANTIDAD
                                                                            ================================================= -->
                                                                        <ul id="submenu-cantidadram3"
                                                                            class="ul nivel-67"
                                                                            style="display: none;">

                                                                            <label for="cantidad3_id" class="form-label">
                                                                                <i class="fas fa-layer-group mr-2"></i>
                                                                                {{ __('CANTIDAD :') }}
                                                                            </label>

                                                                            @foreach ($cantidadram as $cantidad)

                                                                                <li>
                                                                                    <a href="#"
                                                                                    class="nivel-68"
                                                                                    data-id="{{ $cantidad->id }}">
                                                                                        <i class="fas fa-cubes mr-2"></i>
                                                                                        {{ $cantidad->cantidad }}
                                                                                    </a>
                                                                                </li>

                                                                            @endforeach

                                                                        </ul>
                                                                    </li>

                                                                @endforeach

                                                                <!-- OTRO TIPO -->
                                                                <li>
                                                                    <a href="#"
                                                                    class="nivel-66"
                                                                    data-id="otroTiporam3">
                                                                        <i class="fas fa-plus-circle mr-2"></i>
                                                                        Otro...
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </li>

                                                    @endforeach

                                                    <!-- OTRA CAPACIDAD -->
                                                    <li>
                                                        <a href="#"
                                                        class="nivel-64"
                                                        data-id="otroCapram3">
                                                            <i class="fas fa-plus-circle mr-2"></i>
                                                            Otro...
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>

                                        @endforeach

                                        <!-- OTRA MARCA -->
                                        <li>
                                            <a href="#"
                                            class="nivel-62"
                                            data-id="otroMarcaram3">
                                                <i class="fas fa-plus-circle mr-2"></i>
                                                Otro...
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                            @endforeach

                        </ul>
                    </li>

                </ul>

            </nav>

            <!-- =========================================================
                CAMPOS OCULTOS
                ========================================================= -->
            <input type="hidden"
                id="disipador3_id"
                name="disipador3_id">

            <input type="hidden"
                id="marcaram3_id"
                name="marcaram3_id">

            <input type="hidden"
                id="capacram3_id"
                name="capacram3_id">

            <input type="hidden"
                id="tiporam3_id"
                name="tiporam3_id">

            <input type="hidden"
                id="cantidad3_id"
                name="cantidad3_id">


            <!-- =========================================================
                CAMPOS PARA OPCIONES "OTRO"
                ========================================================= -->
            <input type="text"
                id=""
                name="otra_marca_ram3"
                class="otra_marca_ram3 form-control"
                placeholder="Especificar otro"
                style="display:none;">

            <input type="text"
                id=""
                name="otra_capacidad_ram3"
                class="otra_capacidad_ram3 form-control"
                placeholder="Especificar otro"
                style="display:none;">

            <input type="text"
                id=""
                name="otra_tipo_ram3"
                class="otra_tipo_ram3 form-control"
                placeholder="Especificar otro"
                style="display:none;">


            <!-- =========================================================
                RESUMEN DE SELECCIONES
                ========================================================= -->
            <ul id="seleccionesram3" class="ul">

                @if(old('disipador3_id') &&
                    old('marcaram3_id') &&
                    old('capacram3_id') &&
                    old('tiporam3_id') &&
                    old('cantidad3_id'))

                    <li id="disipadorram3">
                        <i class="fas fa-fan mr-2"></i>
                        DISIPADOR:
                        {{ $disipadorram3->find(old('disipador3_id'))->opcion }}
                    </li>

                    <li id="marcaram3">
                        <i class="fas fa-industry mr-2"></i>
                        MARCA:
                        {{ $marcaram3->find(old('marcaram3_id'))->marca }}
                    </li>

                    <li id="capacidadram3">
                        <i class="fas fa-database mr-2"></i>
                        CAPACIDAD:
                        {{ $capacidadram3->find(old('capacram3_id'))->capacidad }}
                    </li>

                    <li id="tiporam3">
                        <i class="fas fa-plug mr-2"></i>
                        TIPO:
                        {{ $tiporam3->find(old('tiporam3_id'))->tipo }}
                    </li>

                    <li id="cantidad3">
                        <i class="fas fa-cubes mr-2"></i>
                        CANTIDAD:
                        {{ $cantidad3->find(old('cantidad3_id'))->cantidad }}
                    </li>

                @else

                    <li id="disipadorram3"></li>
                    <li id="marcaram3"></li>
                    <li id="capacidadram3"></li>
                    <li id="tiporam3"></li>
                    <li id="cantidad3"></li>

                @endif

            </ul>
            </div>

            {{-- =========================================================
            MEMORIA RAM 4TO SLOT
            ========================================================= --}}

            <div class="div title">
            <nav id="ram4">

                <ul id="menu_principal1" class="ul">

                    <li>

                        <!-- TÍTULO -->
                        <label for="drop-ram4" class="text-center principales">
                            <i class="fas fa-memory mr-2"></i>
                            {{ __('MEMORIA RAM 4') }}
                        </label>

                        <input type="checkbox" id="drop-ram4">

                        <ul class="ul">

                            <!-- =================================================
                                DISIPADOR
                                ================================================= -->
                            <label for="disipador4_id" class="form-label">
                                <i class="fas fa-fan mr-2"></i>
                                {{ __('DISIPADOR :') }}
                            </label>

                            @foreach ($disipadorram as $disipador)

                                <li>
                                    <a href="#"
                                    class="nivel-69"
                                    data-id="{{ $disipador->id }}">
                                        <i class="fas fa-wind mr-2"></i>
                                        {{ $disipador->opcion }}
                                    </a>

                                    <!-- =================================================
                                        MARCA
                                        ================================================= -->
                                    <ul class="ul nivel-70"
                                        style="display: none;">

                                        <label for="marcaram4_id" class="form-label">
                                            <i class="fas fa-tag mr-2"></i>
                                            {{ __('MARCA :') }}
                                        </label>

                                        @foreach ($marcaram as $marca)

                                            <li>
                                                <a href="#"
                                                class="nivel-71"
                                                data-id="{{ $marca->id }}">
                                                    <i class="fas fa-industry mr-2"></i>
                                                    {{ $marca->marca }}
                                                </a>

                                                <!-- =================================================
                                                    CAPACIDAD
                                                    ================================================= -->
                                                <ul class="ul nivel-72"
                                                    style="display: none;">

                                                    <label for="capacram4_id" class="form-label">
                                                        <i class="fas fa-database mr-2"></i>
                                                        {{ __('CAPACIDAD:') }}
                                                    </label>

                                                    @foreach ($capram as $capacidad)

                                                        <li>
                                                            <a href="#"
                                                            class="nivel-73"
                                                            data-id="{{ $capacidad->id }}">
                                                                <i class="fas fa-memory mr-2"></i>
                                                                {{ $capacidad->capacidad }}
                                                            </a>

                                                            <!-- =================================================
                                                                TIPO DE CONEXIÓN
                                                                ================================================= -->
                                                            <ul class="ul nivel-74"
                                                                style="display: none;">

                                                                <label for="tiporam4_id" class="form-label">
                                                                    <i class="fas fa-plug mr-2"></i>
                                                                    {{ __('TIPO DE CONEXION :') }}
                                                                </label>

                                                                @foreach ($tiporam as $tipo)

                                                                    <li>
                                                                        <a href="#"
                                                                        class="nivel-75"
                                                                        data-id="{{ $tipo->id }}">
                                                                            <i class="fas fa-microchip mr-2"></i>
                                                                            {{ $tipo->tipo }}
                                                                        </a>

                                                                        <!-- =================================================
                                                                            CANTIDAD
                                                                            ================================================= -->
                                                                        <ul class="ul nivel-76"
                                                                            style="display: none;">

                                                                            <label for="cantidad4_id" class="form-label">
                                                                                <i class="fas fa-layer-group mr-2"></i>
                                                                                {{ __('CANTIDAD :') }}
                                                                            </label>

                                                                            @foreach ($cantidadram as $cantidad)

                                                                                <li>
                                                                                    <a href="#"
                                                                                    class="nivel-77"
                                                                                    data-id="{{ $cantidad->id }}">
                                                                                        <i class="fas fa-cubes mr-2"></i>
                                                                                        {{ $cantidad->cantidad }}
                                                                                    </a>
                                                                                </li>

                                                                            @endforeach

                                                                        </ul>
                                                                    </li>

                                                                @endforeach

                                                                <!-- OTRO TIPO -->
                                                                <li>
                                                                    <a href="#"
                                                                    class="nivel-75"
                                                                    data-id="otroTiporam4">
                                                                        <i class="fas fa-plus-circle mr-2"></i>
                                                                        Otro...
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                        </li>

                                                    @endforeach

                                                    <!-- OTRA CAPACIDAD -->
                                                    <li>
                                                        <a href="#"
                                                        class="nivel-73"
                                                        data-id="otroCapram4">
                                                            <i class="fas fa-plus-circle mr-2"></i>
                                                            Otro...
                                                        </a>
                                                    </li>

                                                </ul>
                                            </li>

                                        @endforeach

                                        <!-- OTRA MARCA -->
                                        <li>
                                            <a href="#"
                                            class="nivel-71"
                                            data-id="otroMarcaram4">
                                                <i class="fas fa-plus-circle mr-2"></i>
                                                Otro...
                                            </a>
                                        </li>

                                    </ul>
                                </li>

                            @endforeach

                        </ul>
                    </li>

                </ul>

            </nav>


            <!-- =========================================================
                CAMPOS OCULTOS
                ========================================================= -->
            <input type="hidden"
                id="disipador4_id"
                name="disipador4_id">

            <input type="hidden"
                id="marcaram4_id"
                name="marcaram4_id">

            <input type="hidden"
                id="capacram4_id"
                name="capacram4_id">

            <input type="hidden"
                id="tiporam4_id"
                name="tiporam4_id">

            <input type="hidden"
                id="cantidad4_id"
                name="cantidad4_id">


            <!-- =========================================================
                CAMPOS PARA OPCIONES "OTRO"
                ========================================================= -->
            <input type="text"
                id=""
                name="otra_marca_ram4"
                class="otra_marca_ram4 form-control"
                placeholder="Especificar otro"
                style="display:none;">

            <input type="text"
                id=""
                name="otra_capacidad_ram4"
                class="otra_capacidad_ram4 form-control"
                placeholder="Especificar otro"
                style="display:none;">

            <input type="text"
                id=""
                name="otra_tipo_ram4"
                class="otra_tipo_ram4 form-control"
                placeholder="Especificar otro"
                style="display:none;">


            <!-- =========================================================
                RESUMEN DE SELECCIONES
                ========================================================= -->
            <ul id="seleccionesram4" class="ul">

                @if(old('disipador4_id') &&
                    old('marcaram4_id') &&
                    old('capacram4_id') &&
                    old('tiporam4_id') &&
                    old('cantidad4_id'))

                    <li id="disipadorram4">
                        <i class="fas fa-fan mr-2"></i>
                        DISIPADOR:
                        {{ $disipadorram4->find(old('disipador4_id'))->opcion }}
                    </li>

                    <li id="marcaram4">
                        <i class="fas fa-industry mr-2"></i>
                        MARCA:
                        {{ $marcaram4->find(old('marcaram4_id'))->marca }}
                    </li>

                    <li id="capacidadram4">
                        <i class="fas fa-database mr-2"></i>
                        CAPACIDAD:
                        {{ $capacidadram4->find(old('capacram4_id'))->capacidad }}
                    </li>

                    <li id="tiporam4">
                        <i class="fas fa-plug mr-2"></i>
                        TIPO:
                        {{ $tiporam4->find(old('tiporam4_id'))->tipo }}
                    </li>

                    <li id="cantidad4">
                        <i class="fas fa-cubes mr-2"></i>
                        CANTIDAD:
                        {{ $cantidad4->find(old('cantidad4_id'))->cantidad }}
                    </li>

                @else

                    <li id="disipadorram4"></li>
                    <li id="marcaram4"></li>
                    <li id="capacidadram4"></li>
                    <li id="tiporam4"></li>
                    <li id="cantidad4"></li>

                @endif

            </ul>

            </div>

        </div>

        <div class="fila-5">


                {{-- =========================================================
                    FUENTE DE PODER
                    ========================================================= --}}
                <div class="div title">

                    <nav id="fuente">

                        <ul id="menu_principal" class="ul">

                            <li>

                                <!-- TÍTULO -->
                                <label for="drop-fuente" class="text-center principales">
                                    <i class="fas fa-plug mr-2"></i>
                                    {{ __('FUENTE DE PODER') }}
                                </label>

                                <input type="checkbox" id="drop-fuente">

                                <ul class="ul">

                                    <!-- =================================================
                                        MARCA
                                        ================================================= -->
                                    <label for="marcafuente_id" class="form-label">
                                        <i class="fas fa-tag mr-2"></i>
                                        {{ __('MARCA :') }}
                                    </label>

                                    @foreach ($marcafuente as $marca)

                                        <li>

                                            <a href="#"
                                            class="nivel-46"
                                            data-id="{{ $marca->id }}">
                                                <i class="fas fa-industry mr-2"></i>
                                                {{ $marca->marca }}
                                            </a>

                                            <!-- =================================================
                                                POTENCIA
                                                ================================================= -->
                                            <ul class="ul nivel-47"
                                                style="display: none;">

                                                <label for="potfuente_id" class="form-label">
                                                    <i class="fas fa-bolt mr-2"></i>
                                                    {{ __('POTENCIA :') }}
                                                </label>

                                                @foreach ($potenciafuente as $potencia)

                                                    <li>

                                                        <a href="#"
                                                        class="nivel-48"
                                                        data-id="{{ $potencia->id }}">
                                                            <i class="fas fa-battery-three-quarters mr-2"></i>
                                                            {{ $potencia->potencia }}
                                                        </a>

                                                        <!-- =================================================
                                                            CABLE DE PODER
                                                            ================================================= -->
                                                        <ul class="ul nivel-78"
                                                            style="display: none;">

                                                            <label for="cable_id" class="form-label">
                                                                <i class="fas fa-cable-car mr-2"></i>
                                                                {{ __('CABLE DE PODER :') }}
                                                            </label>

                                                            @foreach ($disipadorram as $cable)

                                                                <li>

                                                                    <a href="#"
                                                                    class="nivel-79"
                                                                    data-id="{{ $cable->id }}">
                                                                        <i class="fas fa-plug mr-2"></i>
                                                                        {{ $cable->opcion }}
                                                                    </a>

                                                                </li>

                                                            @endforeach

                                                        </ul>

                                                    </li>

                                                @endforeach

                                                <!-- OTRA POTENCIA -->
                                                <li>
                                                    <a href="#"
                                                    class="nivel-48"
                                                    data-id="otroPotenciafuente">
                                                        <i class="fas fa-plus-circle mr-2"></i>
                                                        Otro...
                                                    </a>
                                                </li>

                                            </ul>

                                        </li>

                                    @endforeach

                                    <!-- OTRA MARCA -->
                                    <li>
                                        <a href="#"
                                        class="nivel-46"
                                        data-id="otroMarcafuente">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Otro...
                                        </a>
                                    </li>

                                </ul>

                            </li>

                        </ul>

                    </nav>


                    <!-- =========================================================
                        CAMPOS OCULTOS
                        ========================================================= -->
                    <input type="hidden"
                        id="marcafuente_id"
                        name="marcafuente_id">

                    <input type="hidden"
                        id="potfuente_id"
                        name="potfuente_id">

                    <input type="hidden"
                        id="cable_id"
                        name="cable_id">


                    <!-- =========================================================
                        CAMPOS PARA OPCIONES "OTRO"
                        ========================================================= -->
                    <input type="text"
                        id=""
                        name="otra_marca_fuente"
                        class="otra_marca_fuente form-control"
                        placeholder="Especificar otro"
                        style="display:none;">

                    <input type="text"
                        id=""
                        name="otra_potencia_fuente"
                        class="otra_potencia_fuente form-control"
                        placeholder="Especificar otro"
                        style="display:none;">


                    <!-- =========================================================
                        RESUMEN DE SELECCIONES
                        ========================================================= -->
                    <ul id="seleccionesfuente" class="ul">

                        @if(old('marcafuente_id') &&
                            old('potfuente_id') &&
                            old('cable_id'))

                            <li id="marcafuente">
                                <i class="fas fa-industry mr-2"></i>
                                MARCA:
                                {{ $marcafuente->find(old('marcafuente_id'))->marca }}
                            </li>

                            <li id="potenciafuente">
                                <i class="fas fa-bolt mr-2"></i>
                                POTENCIA:
                                {{ $potenciafuente->find(old('potfuente_id'))->potencia }}
                            </li>

                            <li id="cable">
                                <i class="fas fa-plug mr-2"></i>
                                CABLE:
                                {{ $cable->find(old('cable_id'))->opcion }}
                            </li>

                        @else

                            <li id="marcafuente"></li>
                            <li id="potenciafuente"></li>
                            <li id="cable"></li>

                        @endif

                    </ul>

                </div>


                {{-- =========================================================
                LECTOR CD/DVD
                ========================================================= --}}

                <div class="div title">
                <nav id="cd">

                    <ul id="menu_principal" class="ul">

                        <li>
                            <!-- TÍTULO -->
                            <label for="drop-cd" class="text-center principales">
                                <i class="fas fa-compact-disc mr-2"></i>
                                {{ __('LECTOR CD/DVD') }}
                            </label>
                            <input type="checkbox" id="drop-cd">
                            <ul class="ul">
                                <!-- MARCA -->
                                <label for="marcacd_id" class="form-label">
                                    <i class="fas fa-tag mr-2"></i>
                                    {{ __('MARCA :') }}
                                </label>
                                @foreach ($marcalectorcd as $marca)
                                    <li>
                                        <a href="#"
                                        class="nivel-49"
                                        data-id="{{ $marca->id }}">
                                            <i class="fas fa-industry mr-2"></i>
                                            {{ $marca->nombre }}
                                        </a>
                                    </li>
                                @endforeach
                                <!-- OTRA MARCA -->
                                <li>
                                    <a href="#"
                                    class="nivel-49"
                                    data-id="otroMarcacd">
                                        <i class="fas fa-plus-circle mr-2"></i>
                                        Otro...
                                    </a>
                                </li>

                            </ul>

                        </li>

                    </ul>

                </nav>


                <!-- CAMPO OCULTO -->
                <input type="hidden"
                    id="marcacd_id"
                    name="marcacd_id">


                <!-- OTRO -->
                <input type="text"
                    id=""
                    name="otro_marca_cd"
                    class="otro_marca_cd form-control"
                    placeholder="Especificar otra marca"
                    style="display:none;">


                <!-- RESUMEN -->
                <ul id="seleccionescd" class="ul">

                    @if(old('marcacd_id'))

                        <li id="marcalectorcd">
                            <i class="fas fa-industry mr-2"></i>
                            MARCA:
                            {{ $marcalectorcd->find(old('marcacd_id'))->nombre }}
                        </li>
                    @else
                        <li id="marcalectorcd"></li>
                    @endif
                </ul>
                </div>

                {{-- =========================================================
                ESPACIOS DE SEPARACIÓN
                ========================================================= --}}

                <div class="div title"></div>
                <div class="div title"></div>

            </div>


            </div>
                <!-- =================================================
                     DATOS DE LA FALLA
                     ================================================= -->
                <div class="registro-section">

                    <div class="registro-section-title">

                        <i class="fas fa-exclamation-triangle"></i>

                        DATOS DE LA FALLA

                    </div>


                    <!-- TIPO DE FALLA / RESPALDO -->
                    <div class="row">

                        <!-- TIPO DE FALLA -->
                        <div class="col-md-6">

                            <div class="registro-field">

                                <label for="falla">

                                    <i class="fas fa-exclamation-circle"></i>

                                    TIPO DE FALLA

                                    <span class="required">*</span>

                                </label>

                                <input type="text"
                                       name="falla"
                                       id="falla"
                                       class="form-control @error('falla') is-invalid @enderror"
                                       placeholder="Tipo de falla"
                                       value="{{ old('falla') }}"
                                       required>

                                {!! $errors->first(
                                    'falla',
                                    '<div class="invalid-feedback" role="alert">
                                        <strong>:message</strong>
                                    </div>'
                                ) !!}

                            </div>

                        </div>


                        <!-- RESPALDO -->
                        <div class="col-md-6">

                            <div class="registro-field">

                                <label for="respaldo">

                                    <i class="fas fa-database"></i>

                                    REQUIERE RESPALDO DE LA INFORMACIÓN?

                                    <span class="required">*</span>

                                </label>

                                <select name="respaldo"
                                        id="respaldo"
                                        class="form-control @error('respaldo') is-invalid @enderror"
                                        required>

                                    <option value=""
                                            disabled
                                            {{ old('respaldo') ? '' : 'selected' }}>
                                        SELECCIONE UNA OPCIÓN
                                    </option>

                                    <option value="SI"
                                        {{ old('respaldo') == 'SI' ? 'selected' : '' }}>
                                        SI
                                    </option>

                                    <option value="NO"
                                        {{ old('respaldo') == 'NO' ? 'selected' : '' }}>
                                        NO
                                    </option>

                                </select>

                                {!! $errors->first(
                                    'respaldo',
                                    '<div class="invalid-feedback" role="alert">
                                        <strong>:message</strong>
                                    </div>'
                                ) !!}

                            </div>

                        </div>

                    </div>
                    <!-- OTROS / OBSERVACIONES -->
                    <div class="row">

                        <!-- OTROS -->
                        <div class="col-md-6">

                            <div class="registro-field">

                                <label for="otro">

                                    <i class="fas fa-list"></i>

                                    OTROS

                                </label>

                                <input type="text"
                                       name="otro"
                                       id="otro"
                                       class="form-control @error('otro') is-invalid @enderror"
                                       placeholder="Otros"
                                       value="{{ old('otro') }}">

                                {!! $errors->first(
                                    'otro',
                                    '<div class="invalid-feedback" role="alert">
                                        <strong>:message</strong>
                                    </div>'
                                ) !!}

                            </div>

                        </div>


                        <!-- OBSERVACIONES -->
                        <div class="col-md-6">

                            <div class="registro-field">

                                <label for="observaciones">

                                    <i class="fas fa-comment-alt"></i>

                                    OBSERVACIONES

                                </label>

                                <textarea name="observaciones"
                                          id="observaciones"
                                          class="form-control @error('observaciones') is-invalid @enderror"
                                          rows="2"
                                          placeholder="Observaciones">{{ old('observaciones') }}</textarea>

                                {!! $errors->first(
                                    'observaciones',
                                    '<div class="invalid-feedback" role="alert">
                                        <strong>:message</strong>
                                    </div>'
                                ) !!}

                            </div>

                        </div>

                    </div>

                </div>

                    <!-- TÉRMINOS Y CONDICIONES -->
                    <div class="row">

                        <div class="col-md-12">

                            <div class="registro-field">

                                <label for="terminos_text">

                                    <i class="fas fa-file-contract"></i>

                                    TÉRMINOS Y CONDICIONES

                                </label>

                                <div id="terminos_text" class="condiciones">

                                    {!! nl2br(e($termino->contenido ?? '')) !!}

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- CHECKBOX -->
                    <div class="row">

                        <div class="col-md-12">

                            <label class="checkbox-bounce">

                                <input type="checkbox"
                                       name="condiciones"
                                       value="1"
                                       required>

                                <span></span>

                                He leído y acepto los Términos y Condiciones

                            </label>

                        </div>

                    </div>


                    <!-- ESTADO -->
                    <input type="hidden"
                           name="estado_id"
                           value="{{ $estado?->first()->id }}">


                    <!-- AVISO -->
                    <div class="registro-required">

                        <i class="fas fa-info-circle"></i>

                        Los campos marcados con
                        <span class="required">*</span>
                        son obligatorios.

                    </div>

                </div>


            <!-- =================================================
                 FOOTER
                 ================================================= -->
            <div class="modal-footer modal-password-footer">

                <button type="button"
                        class="btn btn-password-close"
                        data-dismiss="modal">

                    <i class="fas fa-times"></i>

                    CANCELAR

                </button>

                <button type="submit"
                        class="btn btn-password-save">

                    <i class="fas fa-save"></i>

                    GUARDAR

                </button>

            </div>

        </form>

    </div>

    </div>
    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.checkbox-bounce input').forEach(function (checkbox) {

        checkbox.addEventListener('change', function () {

            if (this.checked) {

                // Buscar el menú/submenú relacionado
                const contenedor = this.closest('li');

                if (!contenedor) return;

                // Buscar el último enlace del submenú
                const ultimoElemento = contenedor.querySelector('.ul li:last-child a');

                if (!ultimoElemento) return;

                ultimoElemento.addEventListener('click', function () {

                    // Cerrar el menú
                    checkbox.checked = false;

                }, { once: true });

            }

        });

    });

});
</script>
