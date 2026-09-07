<div class="modal-password-body">

    {{-- =========================================================
         DATOS DEL SOLICITANTE
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-user"></i>
            DATOS DEL SOLICITANTE
        </div>


        {{-- TIPO DE FUNCIONARIO --}}
        <div class="row">

            <div class="col-md-4">

                <div class="registro-field">

                    <label for="funcionario_activo">
                        <i class="fas fa-user-check"></i>
                        TIPO DE FUNCIONARIO
                        <span class="required">*</span>
                    </label>

                    <select name="funcionario_activo"
                            id="funcionario_activo"
                            class="form-control @error('funcionario_activo') is-invalid @enderror">

                        <option value=""
                                disabled
                                {{ old('funcionario_activo', $teclado->funcionario_activo) === null ? 'selected' : '' }}>
                            SELECCIONE UNA OPCIÓN
                        </option>

                        <option value="1"
                            {{ old('funcionario_activo', $teclado->funcionario_activo) == 1 ? 'selected' : '' }}>
                            FUNCIONARIO ACTIVO
                        </option>

                        <option value="0"
                            {{ old('funcionario_activo', $teclado->funcionario_activo) == 0 ? 'selected' : '' }}>
                            EX FUNCIONARIO
                        </option>

                    </select>

                    {!! $errors->first(
                        'funcionario_activo',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>

        </div>


        {{-- =====================================================
             DATOS PERSONALES
             ====================================================== --}}

        <div class="row">

            {{-- PATERNO --}}
            <div class="col-md-4">

                <div class="registro-field">

                    <label for="paterno">
                        <i class="fas fa-user"></i>
                        APELLIDO PATERNO
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="paterno"
                           id="paterno"
                           class="form-control @error('paterno') is-invalid @enderror"
                           value="{{ old('paterno', $teclado->funcionario?->paterno) }}"
                           placeholder="Apellido paterno"
                           oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                    {!! $errors->first(
                        'paterno',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            {{-- MATERNO --}}
            <div class="col-md-4">

                <div class="registro-field">

                    <label for="materno">
                        <i class="fas fa-user"></i>
                        APELLIDO MATERNO
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="materno"
                           id="materno"
                           class="form-control @error('materno') is-invalid @enderror"
                           value="{{ old('materno', $teclado->funcionario?->materno) }}"
                           placeholder="Apellido materno"
                           oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                    {!! $errors->first(
                        'materno',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            {{-- NOMBRE --}}
            <div class="col-md-4">

                <div class="registro-field">

                    <label for="nombre">
                        <i class="fas fa-id-card"></i>
                        NOMBRE(S)
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="nombre"
                           id="nombre"
                           class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre', $teclado->funcionario?->nombre) }}"
                           placeholder="Nombre(s)"
                           oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                    {!! $errors->first(
                        'nombre',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>

        </div>


        {{-- =====================================================
             CI / EXPEDIDO / CELULAR
             ====================================================== --}}

        <div class="row">

            {{-- CI --}}
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
                           value="{{ old('ci', $teclado->funcionario?->ci) }}"
                           placeholder="Ingrese C.I.">

                    {!! $errors->first(
                        'ci',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            {{-- EXPEDIDO --}}
            <div class="col-md-4">

                <div class="registro-field">

                    <label for="expedido">
                        <i class="fas fa-map-marker-alt"></i>
                        EXPEDIDO
                        <span class="required">*</span>
                    </label>

                    <select name="expedido"
                            id="expedido"
                            class="form-control @error('expedido') is-invalid @enderror">

                        <option value="" disabled>
                            SELECCIONE UNA OPCIÓN
                        </option>

                        <option value="LP"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'LP' ? 'selected' : '' }}>
                            LA PAZ
                        </option>

                        <option value="CB"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'CB' ? 'selected' : '' }}>
                            COCHABAMBA
                        </option>

                        <option value="SC"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'SC' ? 'selected' : '' }}>
                            SANTA CRUZ
                        </option>

                        <option value="OR"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'OR' ? 'selected' : '' }}>
                            ORURO
                        </option>

                        <option value="CH"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'CH' ? 'selected' : '' }}>
                            CHUQUISACA
                        </option>

                        <option value="PO"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'PO' ? 'selected' : '' }}>
                            POTOSÍ
                        </option>

                        <option value="T"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'T' ? 'selected' : '' }}>
                            TARIJA
                        </option>

                        <option value="B"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'B' ? 'selected' : '' }}>
                            BENI
                        </option>

                        <option value="P"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'P' ? 'selected' : '' }}>
                            PANDO
                        </option>

                        <option value="QR"
                            {{ old('expedido', $teclado->funcionario?->expedido) == 'QR' ? 'selected' : '' }}>
                            QR
                        </option>

                    </select>

                    {!! $errors->first(
                        'expedido',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            {{-- CELULAR --}}
            <div class="col-md-4">

                <div class="registro-field">

                    <label for="celular">
                        <i class="fas fa-mobile-alt"></i>
                        CELULAR
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="celular"
                           id="celular"
                           class="form-control @error('celular') is-invalid @enderror"
                           value="{{ old('celular', $teclado->funcionario?->celular) }}"
                           placeholder="Número de celular">

                    {!! $errors->first(
                        'celular',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>

        </div>


        {{-- =====================================================
             CARGO / CORREO
             ====================================================== --}}

        <div class="row">

            {{-- CARGO --}}
            <div class="col-md-6">

                <div class="registro-field">

                    <label for="cargo">
                        <i class="fas fa-briefcase"></i>
                        CARGO
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="cargo"
                           id="cargo"
                           class="form-control @error('cargo') is-invalid @enderror"
                           value="{{ old('cargo', $teclado->funcionario?->cargo) }}"
                           placeholder="Cargo">

                    {!! $errors->first(
                        'cargo',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            {{-- CORREO --}}
            <div class="col-md-6">

                <div class="registro-field">

                    <label for="email">
                        <i class="fas fa-envelope"></i>
                        CORREO ELECTRÓNICO
                        <span class="required">*</span>
                    </label>

                    <input type="email"
                           name="email"
                           id="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $teclado->funcionario?->email) }}"
                           placeholder="correo@ejemplo.com">

                    {!! $errors->first(
                        'email',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>

        </div>


        {{-- =====================================================
             FECHA DE RECEPCIÓN
             ====================================================== --}}

        <div class="row">

            <div class="col-md-6">

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
                           value="{{ old('fecha', $teclado?->fecha ? date('Y-m-d\TH:i', strtotime($teclado->fecha)) : date('Y-m-d\TH:i')) }}"
                           readonly>

                    {!! $errors->first(
                        'fecha',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            {{-- DEPENDENCIA --}}
            <div class="col-md-6">

                <div class="registro-field">

                    <label for="dependencia_id">
                        <i class="fas fa-building"></i>
                        DEPENDENCIA
                        <span class="required">*</span>
                    </label>

                    <select name="dependencia_id"
                            id="dependencia_id"
                            class="form-control @error('dependencia_id') is-invalid @enderror">

                        <option value="" disabled
                            {{ old('dependencia_id', $teclado?->dependencia_id) ? '' : 'selected' }}>
                            SELECCIONE UNA DEPENDENCIA
                        </option>

                        @foreach ($dependencia as $item)

                            <option value="{{ $item->id }}"
                                {{ old('dependencia_id', $teclado?->dependencia_id) == $item->id ? 'selected' : '' }}>

                                {{ $item->dependencias }}

                            </option>

                        @endforeach

                    </select>

                    {!! $errors->first(
                        'dependencia_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>

        </div>


        {{-- =====================================================
             TÉCNICO Y FECHAS
             ====================================================== --}}

        <div class="row">

            {{-- TÉCNICO --}}
            <div class="col-md-4">

                <div class="registro-field">

                    <label for="user_id">
                        <i class="fas fa-user-cog"></i>
                        TÉCNICO A CARGO
                    </label>

                    <select name="user_id"
                            id="user_id"
                            class="form-control mi-select">

                        <option value="">
                            SIN ASIGNAR
                        </option>

                        @foreach($users as $user)

                            <option value="{{ $user->id }}"
                                {{ old('user_id', $teclado?->user_id) == $user->id ? 'selected' : '' }}>

                                {{ $user->name }}
                                {{ $user->paterno }}
                                {{ $user->materno }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            {{-- FECHA ASIGNACIÓN --}}
            <div class="col-md-4">

                <div class="registro-field">

                    <label for="fecha_asignacion">
                        <i class="fas fa-calendar-check"></i>
                        FECHA DE ASIGNACIÓN
                    </label>

                    <input type="datetime-local"
                           name="fecha_asignacion"
                           id="fecha_asignacion"
                           class="form-control @error('fecha_asignacion') is-invalid @enderror"
                           value="{{ old('fecha_asignacion', $teclado?->fecha_asignacion ? date('Y-m-d\TH:i', strtotime($teclado->fecha_asignacion)) : '') }}">

                </div>

            </div>


            {{-- FECHA INICIO --}}
            <div class="col-md-4">

                <div class="registro-field">

                    <label for="fecha_inicio">
                        <i class="fas fa-play-circle"></i>
                        FECHA DE INICIO
                    </label>

                    <input type="datetime-local"
                           name="fecha_inicio"
                           id="fecha_inicio"
                           class="form-control @error('fecha_inicio') is-invalid @enderror"
                           value="{{ old('fecha_inicio', $teclado?->fecha_inicio ? date('Y-m-d\TH:i', strtotime($teclado->fecha_inicio)) : '') }}">

                </div>

            </div>

        </div>


        {{-- ID DEL FUNCIONARIO --}}
        <input type="hidden"
               name="funcionario_id"
               value="{{ old('funcionario_id', $teclado?->funcionario_id) }}"
               id="funcionario_id">

    </div>


    {{-- =========================================================
         DATOS DEL TECLADO
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-keyboard"></i>
            DATOS DEL TECLADO
        </div>


        {{-- CÓDIGOS --}}
        <div class="row">

            <div class="col-md-6">

                <div class="registro-field">

                    <label for="cod_gamea">
                        <i class="fas fa-barcode"></i>
                        CÓDIGO GAMEA
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="cod_gamea"
                           id="cod_gamea"
                           class="form-control @error('cod_gamea') is-invalid @enderror"
                           value="{{ old('cod_gamea', $teclado?->cod_gamea) }}"
                           placeholder="Código GAMEA">

                    {!! $errors->first(
                        'cod_gamea',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            @if($teclado->id)

                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="cod_registro">
                            <i class="fas fa-hashtag"></i>
                            NÚMERO DE RECEPCIÓN
                        </label>

                        <input type="text"
                               name="cod_registro"
                               id="cod_registro"
                               class="form-control @error('cod_registro') is-invalid @enderror"
                               value="{{ old('cod_registro', $teclado?->cod_registro) }}"
                               placeholder="Número de recepción">

                        {!! $errors->first(
                            'cod_registro',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>

            @endif

        </div>


        {{-- MARCA / MODELO --}}
        <div class="row">

            <div class="col-md-6">

                <div class="registro-field">

                    <label for="marca">
                        <i class="fas fa-tag"></i>
                        MARCA
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="marca"
                           id="marca"
                           class="form-control @error('marca') is-invalid @enderror"
                           value="{{ old('marca', $teclado?->marca) }}"
                           placeholder="Marca">

                    {!! $errors->first(
                        'marca',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            <div class="col-md-6">

                <div class="registro-field">

                    <label for="modelo">
                        <i class="fas fa-keyboard"></i>
                        MODELO
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="modelo"
                           id="modelo"
                           class="form-control @error('modelo') is-invalid @enderror"
                           value="{{ old('modelo', $teclado?->modelo) }}"
                           placeholder="Modelo">

                    {!! $errors->first(
                        'modelo',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>

        </div>


        {{-- FALLA / OBSERVACIONES --}}
        <div class="row">

            <div class="col-md-6">

                <div class="registro-field">

                    <label for="falla">
                        <i class="fas fa-exclamation-triangle"></i>
                        FALLA
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="falla"
                           id="falla"
                           class="form-control @error('falla') is-invalid @enderror"
                           value="{{ old('falla', $teclado?->falla) }}"
                           placeholder="Describa la falla">

                    {!! $errors->first(
                        'falla',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>


            <div class="col-md-6">

                <div class="registro-field">

                    <label for="observaciones">
                        <i class="fas fa-comment-alt"></i>
                        OBSERVACIONES
                    </label>

                    <input type="text"
                           name="observaciones"
                           id="observaciones"
                           class="form-control @error('observaciones') is-invalid @enderror"
                           value="{{ old('observaciones', $teclado?->observaciones) }}"
                           placeholder="Observaciones">

                    {!! $errors->first(
                        'observaciones',
                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                    ) !!}

                </div>

            </div>

        </div>


        {{-- =====================================================
             ESTADO
             ====================================================== --}}

        @if($teclado->id)

            <div class="row">

                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="estado_id">
                            <i class="fas fa-tasks"></i>
                            ESTADO
                            <span class="required">*</span>
                        </label>

                        <select name="estado_id"
                                id="estado_id"
                                class="form-control @error('estado_id') is-invalid @enderror">

                            <option value="" disabled
                                {{ old('estado_id', $teclado?->estado_id) ? '' : 'selected' }}>
                                SELECCIONE UN ESTADO
                            </option>

                            @foreach ($estado as $estados)

                                <option value="{{ $estados->id }}"
                                    {{ old('estado_id', $teclado?->estado_id) == $estados->id ? 'selected' : '' }}>

                                    {{ $estados->nombre }}

                                </option>

                            @endforeach

                        </select>

                        {!! $errors->first(
                            'estado_id',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>

            </div>

        @else

            <input type="hidden"
                   name="estado_id"
                   value="{{ $estado?->first()->id }}">

        @endif


        {{-- INFORMACIÓN --}}
        <div class="registro-required">

            <i class="fas fa-info-circle"></i>

            Los campos marcados con
            <span class="required">*</span>
            son obligatorios.

        </div>

    </div>

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 