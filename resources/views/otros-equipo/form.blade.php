<!-- =========================================================
     FORMULARIO EQUIPO
     ========================================================= -->

<!-- =========================================================
     DATOS DEL SOLICITANTE
     ========================================================= -->
<div class="registro-section">

    <div class="registro-section-title">
        <i class="fas fa-user"></i>
        DATOS DEL SOLICITANTE
    </div>

    <!-- Tipo de funcionario -->
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
                        class="form-control @error('funcionario_activo') is-invalid @enderror"
                        required>

                    <option value=""
                            disabled
                            {{ old('funcionario_activo', $equipo->funcionario_activo) === null ? 'selected' : '' }}>
                        SELECCIONE UNA OPCIÓN
                    </option>

                    <option value="1"
                        {{ old('funcionario_activo', $equipo->funcionario_activo) == 1 ? 'selected' : '' }}>
                        FUNCIONARIO ACTIVO
                    </option>

                    <option value="0"
                        {{ old('funcionario_activo', $equipo->funcionario_activo) == 0 ? 'selected' : '' }}>
                        EX FUNCIONARIO
                    </option>

                </select>

                @error('funcionario_activo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>

    </div>


    <!-- =====================================================
         NOMBRES
         ===================================================== -->
    <div class="row">

        <!-- Paterno -->
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
                       value="{{ old('paterno', $equipo->funcionario?->paterno) }}"
                       placeholder="Apellido paterno"
                       required>

                @error('paterno')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>


        <!-- Materno -->
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
                       value="{{ old('materno', $equipo->funcionario?->materno) }}"
                       placeholder="Apellido materno"
                       required>

                @error('materno')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>


        <!-- Nombre -->
        <div class="col-md-4">
            <div class="registro-field">

                <label for="nombre">
                    <i class="fas fa-user"></i>
                    NOMBRE(S)
                    <span class="required">*</span>
                </label>

                <input type="text"
                       name="nombre"
                       id="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $equipo->funcionario?->nombre) }}"
                       placeholder="Nombre(s)"
                       required>

                @error('nombre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>

    </div>


    <!-- =====================================================
         CI / EXPEDIDO / CELULAR
         ===================================================== -->
    <div class="row">

        <!-- CI -->
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
                       value="{{ old('ci', $equipo->funcionario?->ci) }}"
                       placeholder="Número de C.I."
                       required>

                @error('ci')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>


        <!-- Expedido -->
        <div class="col-md-4">
            <div class="registro-field">

                <label for="expedido">
                    <i class="fas fa-map-marker-alt"></i>
                    EXPEDIDO
                    <span class="required">*</span>
                </label>

                <select name="expedido"
                        id="expedido"
                        class="form-control @error('expedido') is-invalid @enderror"
                        required>

                    <option value="" disabled
                        {{ old('expedido', $equipo->funcionario?->expedido) ? '' : 'selected' }}>
                        SELECCIONE UNA OPCIÓN
                    </option>

                    <option value="QR"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'QR' ? 'selected' : '' }}>
                        QR
                    </option>

                    <option value="LP"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'LP' ? 'selected' : '' }}>
                        LA PAZ
                    </option>

                    <option value="CB"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'CB' ? 'selected' : '' }}>
                        COCHABAMBA
                    </option>

                    <option value="SC"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'SC' ? 'selected' : '' }}>
                        SANTA CRUZ
                    </option>

                    <option value="OR"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'OR' ? 'selected' : '' }}>
                        ORURO
                    </option>

                    <option value="CH"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'CH' ? 'selected' : '' }}>
                        CHUQUISACA
                    </option>

                    <option value="PO"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'PO' ? 'selected' : '' }}>
                        POTOSÍ
                    </option>

                    <option value="T"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'T' ? 'selected' : '' }}>
                        TARIJA
                    </option>

                    <option value="B"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'B' ? 'selected' : '' }}>
                        BENI
                    </option>

                    <option value="P"
                        {{ old('expedido', $equipo->funcionario?->expedido) == 'P' ? 'selected' : '' }}>
                        PANDO
                    </option>

                </select>

                @error('expedido')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>


        <!-- Celular -->
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
                       value="{{ old('celular', $equipo->funcionario?->celular) }}"
                       placeholder="Número de celular"
                       required>

                @error('celular')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>

    </div>


    <!-- =====================================================
         CARGO / CORREO
         ===================================================== -->
    <div class="row">

        <!-- Cargo -->
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
                       value="{{ old('cargo', $equipo->funcionario?->cargo) }}"
                       placeholder="Cargo del funcionario"
                       required>

                @error('cargo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>


        <!-- Correo -->
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
                       value="{{ old('email', $equipo->funcionario?->email) }}"
                       placeholder="correo@ejemplo.com"
                       required>

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>
        </div>

    </div>


    <!-- ID FUNCIONARIO -->
    <input type="hidden"
           name="funcionario_id"
           value="{{ old('funcionario_id', $equipo?->funcionario_id) }}"
           id="funcionario_id">


    <!-- =====================================================
         FECHA DE RECEPCIÓN
         ===================================================== -->
    <div class="row">

        <div class="col-md-4">

            <div class="registro-field">

                <label for="fecha">
                    <i class="fas fa-calendar-alt"></i>
                    FECHA DE RECEPCIÓN
                </label>

                <input type="datetime-local"
                       name="fecha"
                       id="fecha"
                       class="form-control @error('fecha') is-invalid @enderror"
                       value="{{ old('fecha', $equipo?->fecha ? date('Y-m-d\TH:i', strtotime($equipo->fecha)) : '') }}"
                       placeholder="Fecha de recepción">

                @error('fecha')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     ASIGNACIÓN Y SEGUIMIENTO
     ========================================================= -->
<div class="registro-section">

    <div class="registro-section-title">
        <i class="fas fa-user-cog"></i>
        ASIGNACIÓN Y SEGUIMIENTO
    </div>

    <div class="row">

        <!-- Técnico -->
        <div class="col-md-4">

            <div class="registro-field">

                <label for="user_id">
                    <i class="fas fa-user-tie"></i>
                    TÉCNICO A CARGO
                </label>

                <select name="user_id"
                        id="user_id"
                        class="form-control mi-select @error('user_id') is-invalid @enderror">

                    <option value=""
                        {{ old('user_id', $equipo?->user_id) ? '' : 'selected' }}>
                        SELECCIONAR TÉCNICO
                    </option>

                    @foreach($users as $user)

                        <option value="{{ $user->id }}"
                            {{ old('user_id', $equipo?->user_id) == $user->id ? 'selected' : '' }}>

                            {{ $user->name }}
                            {{ $user->paterno }}
                            {{ $user->materno }}

                        </option>

                    @endforeach

                    <option value="">
                        QUITAR TÉCNICO
                    </option>

                </select>

                @error('user_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        <!-- Fecha asignación -->
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
                       value="{{ old('fecha_asignacion', $equipo?->fecha_asignacion ? date('Y-m-d\TH:i', strtotime($equipo->fecha_asignacion)) : '') }}">

                @error('fecha_asignacion')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        <!-- Fecha inicio -->
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
                       value="{{ old('fecha_inicio', $equipo?->fecha_inicio ? date('Y-m-d\TH:i', strtotime($equipo->fecha_inicio)) : '') }}">

                @error('fecha_inicio')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>


    <!-- Dependencia -->
    <div class="row">

        <div class="col-md-6">

            <div class="registro-field">

                <label for="dependencia_id">
                    <i class="fas fa-building"></i>
                    DEPENDENCIA
                </label>

                <select name="dependencia_id"
                        id="dependencia_id"
                        class="form-control @error('dependencia_id') is-invalid @enderror">

                    <option value=""
                        {{ old('dependencia_id', $equipo?->dependencia_id) ? '' : 'selected' }}>
                        SELECCIONAR DEPENDENCIA
                    </option>

                    @foreach($dependencia as $item)

                        <option value="{{ $item->id }}"
                            {{ old('dependencia_id', $equipo?->dependencia_id) == $item->id ? 'selected' : '' }}>

                            {{ $item->dependencias }}

                        </option>

                    @endforeach

                </select>

                @error('dependencia_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     DATOS DEL ACTIVO
     ========================================================= -->
<div class="registro-section">

    <div class="registro-section-title">
        <i class="fas fa-desktop"></i>
        DATOS {{ $equipo->tipoEquipo?->nombre ?? 'SIN TIPO DE EQUIPO' }}
    </div>

    <!-- Código GAMEA / Número recepción -->
    <div class="row">

        <!-- Código GAMEA -->
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
                       value="{{ old('cod_gamea', $equipo?->cod_gamea) }}"
                       placeholder="Código GAMEA"
                       required>

                @error('cod_gamea')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        <!-- Número recepción -->
        @if($equipo->id)

            <div class="col-md-6">

                <div class="registro-field">

                    <label for="cod_registro">
                        <i class="fas fa-receipt"></i>
                        NÚMERO DE RECEPCIÓN
                    </label>

                    <input type="text"
                           name="cod_registro"
                           id="cod_registro"
                           class="form-control @error('cod_registro') is-invalid @enderror"
                           value="{{ old('cod_registro', $equipo?->cod_registro) }}"
                           placeholder="N.º de recepción">

                    @error('cod_registro')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        @endif

    </div>


    <!-- Marca / Modelo -->
    <div class="row">

        <!-- Marca -->
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
                       value="{{ old('marca', $equipo?->marca) }}"
                       placeholder="Marca"
                       required>

                @error('marca')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        <!-- Modelo -->
        <div class="col-md-6">

            <div class="registro-field">

                <label for="modelo">
                    <i class="fas fa-cube"></i>
                    MODELO
                    <span class="required">*</span>
                </label>

                <input type="text"
                       name="modelo"
                       id="modelo"
                       class="form-control @error('modelo') is-invalid @enderror"
                       value="{{ old('modelo', $equipo?->modelo) }}"
                       placeholder="Modelo"
                       required>

                @error('modelo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>


    <!-- Falla / Observaciones -->
    <div class="row">

        <!-- Falla -->
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
                       value="{{ old('falla', $equipo?->falla) }}"
                       placeholder="Descripción de la falla"
                       required>

                @error('falla')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>


        <!-- Observaciones -->
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
                       value="{{ old('observaciones', $equipo?->observaciones) }}"
                       placeholder="Observaciones">

                @error('observaciones')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

    </div>


    <!-- =====================================================
         ESTADO
         ===================================================== -->
    @if($equipo->id)

        <div class="row">

            <div class="col-md-6">

                <div class="registro-field">

                    <label for="estado_id">
                        <i class="fas fa-info-circle"></i>
                        ESTADO
                        <span class="required">*</span>
                    </label>

                    <select name="estado_id"
                            id="estado_id"
                            class="form-control @error('estado_id') is-invalid @enderror"
                            required>

                        <option value=""
                                disabled
                                {{ old('estado_id', $equipo?->estado_id) ? '' : 'selected' }}>
                            SELECCIONAR ESTADO
                        </option>

                        @foreach($estado as $estados)

                            <option value="{{ $estados->id }}"
                                {{ old('estado_id', $equipo?->estado_id) == $estados->id ? 'selected' : '' }}>

                                {{ $estados->nombre }}

                            </option>

                        @endforeach

                    </select>

                    @error('estado_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    @else

        <input type="hidden"
               name="estado_id"
               value="{{ $estado?->first()->id }}">

    @endif


    <!-- Información -->
    <div class="registro-required">

        <i class="fas fa-info-circle"></i>

        Los campos marcados con
        <span class="required">*</span>
        son obligatorios.

    </div>

</div>

<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">