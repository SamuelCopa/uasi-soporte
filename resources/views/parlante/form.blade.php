<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     FORMULARIO PARLANTE
     Compatible con REGISTRAR / ACTUALIZAR
     ========================================================= -->

<!-- =========================================================
     DATOS DEL SOLICITANTE
     ========================================================= -->
<div class="registro-section">

    <div class="registro-section-title">
        <i class="fas fa-user"></i>
        DATOS DEL SOLICITANTE
    </div>


    <!-- TIPO DE FUNCIONARIO -->
    <div class="row">

        <div class="col-md-4">

            <div class="registro-field">

                <label for="funcionario_activo">
                    <i class="fas fa-user-check"></i>
                    TIPO DE FUNCIONARIO
                </label>

                <select name="funcionario_activo"
                        id="funcionario_activo"
                        class="form-control">

                    <option value=""
                            disabled
                            {{ old('funcionario_activo', $parlante->funcionario_activo) === null ? 'selected' : '' }}>
                        SELECCIONE UNA OPCIÓN
                    </option>

                    <option value="1"
                        {{ old('funcionario_activo', $parlante->funcionario_activo) == 1 ? 'selected' : '' }}>
                        FUNCIONARIO ACTIVO
                    </option>

                    <option value="0"
                        {{ old('funcionario_activo', $parlante->funcionario_activo) == 0 ? 'selected' : '' }}>
                        EX FUNCIONARIO
                    </option>

                </select>

            </div>

        </div>

    </div>


    <!-- APELLIDOS / NOMBRE -->
    <div class="row">

        <div class="col-md-4">

            <div class="registro-field">

                <label for="paterno">
                    <i class="fas fa-user"></i>
                    APELLIDO PATERNO
                </label>

                <input type="text"
                       name="paterno"
                       id="paterno"
                       class="form-control @error('paterno') is-invalid @enderror"
                       value="{{ old('paterno', $parlante->funcionario?->paterno) }}"
                       placeholder="Apellido paterno">

                {!! $errors->first(
                    'paterno',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>


        <div class="col-md-4">

            <div class="registro-field">

                <label for="materno">
                    <i class="fas fa-user"></i>
                    APELLIDO MATERNO
                </label>

                <input type="text"
                       name="materno"
                       id="materno"
                       class="form-control @error('materno') is-invalid @enderror"
                       value="{{ old('materno', $parlante->funcionario?->materno) }}"
                       placeholder="Apellido materno">

                {!! $errors->first(
                    'materno',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>


        <div class="col-md-4">

            <div class="registro-field">

                <label for="nombre">
                    <i class="fas fa-user-tie"></i>
                    NOMBRE(S)
                </label>

                <input type="text"
                       name="nombre"
                       id="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $parlante->funcionario?->nombre) }}"
                       placeholder="Nombre(s)">

                {!! $errors->first(
                    'nombre',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>

    </div>


    <!-- C.I. / EXPEDIDO / CELULAR -->
    <div class="row">

        <div class="col-md-4">

            <div class="registro-field">

                <label for="ci">
                    <i class="fas fa-id-card"></i>
                    C.I.
                </label>

                <input type="text"
                       name="ci"
                       id="ci"
                       class="form-control @error('ci') is-invalid @enderror"
                       value="{{ old('ci', $parlante->funcionario?->ci) }}"
                       placeholder="Carnet de identidad">

                {!! $errors->first(
                    'ci',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>


        <div class="col-md-4">

            <div class="registro-field">

                <label for="expedido">
                    <i class="fas fa-map-marker-alt"></i>
                    EXPEDIDO
                    <span class="required">*</span>
                </label>

                <select name="expedido"
                        id="expedido"
                        class="form-control"
                        required>

                    <option value=""
                            disabled
                            {{ old('expedido', $parlante->funcionario?->expedido) ? '' : 'selected' }}>
                        SELECCIONE UNA OPCIÓN
                    </option>

                    <option value="QR" {{ old('expedido', $parlante->funcionario?->expedido) == 'QR' ? 'selected' : '' }}>
                        QR
                    </option>

                    <option value="LP" {{ old('expedido', $parlante->funcionario?->expedido) == 'LP' ? 'selected' : '' }}>
                        LA PAZ
                    </option>

                    <option value="CB" {{ old('expedido', $parlante->funcionario?->expedido) == 'CB' ? 'selected' : '' }}>
                        COCHABAMBA
                    </option>

                    <option value="SC" {{ old('expedido', $parlante->funcionario?->expedido) == 'SC' ? 'selected' : '' }}>
                        SANTA CRUZ
                    </option>

                    <option value="OR" {{ old('expedido', $parlante->funcionario?->expedido) == 'OR' ? 'selected' : '' }}>
                        ORURO
                    </option>

                    <option value="CH" {{ old('expedido', $parlante->funcionario?->expedido) == 'CH' ? 'selected' : '' }}>
                        CHUQUISACA
                    </option>

                    <option value="PO" {{ old('expedido', $parlante->funcionario?->expedido) == 'PO' ? 'selected' : '' }}>
                        POTOSI
                    </option>

                    <option value="T" {{ old('expedido', $parlante->funcionario?->expedido) == 'T' ? 'selected' : '' }}>
                        TARIJA
                    </option>

                    <option value="B" {{ old('expedido', $parlante->funcionario?->expedido) == 'B' ? 'selected' : '' }}>
                        BENI
                    </option>

                    <option value="P" {{ old('expedido', $parlante->funcionario?->expedido) == 'P' ? 'selected' : '' }}>
                        PANDO
                    </option>

                </select>

            </div>

        </div>


        <div class="col-md-4">

            <div class="registro-field">

                <label for="celular">
                    <i class="fas fa-phone-alt"></i>
                    CELULAR
                </label>

                <input type="text"
                       name="celular"
                       id="celular"
                       class="form-control @error('celular') is-invalid @enderror"
                       value="{{ old('celular', $parlante->funcionario?->celular) }}"
                       placeholder="Número de celular">

                {!! $errors->first(
                    'celular',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>

    </div>


    <!-- CARGO / CORREO -->
    <div class="row">

        <div class="col-md-6">

            <div class="registro-field">

                <label for="cargo">
                    <i class="fas fa-briefcase"></i>
                    CARGO
                </label>

                <input type="text"
                       name="cargo"
                       id="cargo"
                       class="form-control @error('cargo') is-invalid @enderror"
                       value="{{ old('cargo', $parlante->funcionario?->cargo) }}"
                       placeholder="Cargo">

                {!! $errors->first(
                    'cargo',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>


        <div class="col-md-6">

            <div class="registro-field">

                <label for="email">
                    <i class="fas fa-envelope"></i>
                    CORREO ELECTRÓNICO
                </label>

                <input type="email"
                       name="email"
                       id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $parlante->funcionario?->email) }}"
                       placeholder="correo@ejemplo.com">

                {!! $errors->first(
                    'email',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>

    </div>


    <!-- ID FUNCIONARIO -->
    <input type="hidden"
           name="funcionario_id"
           value="{{ old('funcionario_id', $parlante?->funcionario_id) }}"
           id="funcionario_id">


    <!-- FECHA DE RECEPCIÓN -->
    <div class="row">

        <div class="col-md-5">

            <div class="registro-field">

                <label for="fecha">
                    <i class="fas fa-calendar-alt"></i>
                    FECHA DE RECEPCIÓN
                </label>

                <input type="datetime-local"
                       name="fecha"
                       id="fecha"
                       class="form-control @error('fecha') is-invalid @enderror"
                       value="{{ old('fecha', $parlante?->fecha ? date('Y-m-d\TH:i', strtotime($parlante->fecha)) : date('Y-m-d\TH:i')) }}"
                       placeholder="Fecha de recepción">

                {!! $errors->first(
                    'fecha',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>

    </div>


    <!-- =========================================================
         ASIGNACIÓN Y SEGUIMIENTO
         ========================================================= -->
    <div class="registro-section-title">

        <i class="fas fa-user-cog"></i>

        ASIGNACIÓN Y SEGUIMIENTO

    </div>


    <div class="row">

        <!-- TÉCNICO -->
        <div class="col-md-4">

            <div class="registro-field">

                <label for="user_id">
                    <i class="fas fa-user-cog"></i>
                    TÉCNICO A CARGO
                </label>

                <select name="user_id"
                        id="user_id"
                        class="form-control mi-select">

                    <option value=""
                            disabled
                            {{ old('user_id', $parlante?->user_id) ? '' : 'selected' }}>
                        SELECCIONAR
                    </option>

                    @foreach($users as $user)

                        <option value="{{ $user->id }}"
                            {{ $user->id == $parlante->user_id ? 'selected' : '' }}>

                            {{ $user->name }}
                            {{ $user->paterno }}
                            {{ $user->materno }}

                        </option>

                    @endforeach

                    <option value="">
                        QUITAR
                    </option>

                </select>

            </div>

        </div>


        <!-- FECHA ASIGNACIÓN -->
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
                       value="{{ old('fecha_asignacion', $parlante?->fecha_asignacion ? date('Y-m-d\TH:i', strtotime($parlante->fecha_asignacion)) : '') }}">

                {!! $errors->first(
                    'fecha_asignacion',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>


        <!-- FECHA INICIO -->
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
                       value="{{ old('fecha_inicio', $parlante?->fecha_inicio ? date('Y-m-d\TH:i', strtotime($parlante->fecha_inicio)) : '') }}">

                {!! $errors->first(
                    'fecha_inicio',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>

    </div>


    <!-- DEPENDENCIA -->
    <div class="row">

        <div class="col-md-7">

            <div class="registro-field">

                <label for="dependencia_id">
                    <i class="fas fa-building"></i>
                    DEPENDENCIA
                </label>

                <select name="dependencia_id"
                        id="dependencia_id"
                        class="form-control @error('dependencia_id') is-invalid @enderror">

                    <option value=""
                            disabled
                            {{ old('dependencia_id', $parlante?->dependencia_id) ? '' : 'selected' }}>
                        SELECCIONAR
                    </option>

                    @foreach ($dependencia as $item)

                        <option value="{{ $item->id }}"
                            {{ old('dependencia_id', $parlante?->dependencia_id) == $item->id ? 'selected' : '' }}>

                            {{ $item->dependencias }}

                        </option>

                    @endforeach

                </select>

                {!! $errors->first(
                    'dependencia_id',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     DATOS DEL PARLANTE
     ========================================================= -->
<div class="registro-section">

    <div class="registro-section-title">

        <i class="fas fa-volume-up"></i>

        DATOS DEL PARLANTE

    </div>


    <!-- CÓDIGO GAMEA / NÚMERO RECEPCIÓN -->
    <div class="row">

        <div class="col-md-6">

            <div class="registro-field">

                <label for="cod_gamea">
                    <i class="fas fa-barcode"></i>
                    CÓDIGO GAMEA
                </label>

                <input type="text"
                       name="cod_gamea"
                       id="cod_gamea"
                       class="form-control @error('cod_gamea') is-invalid @enderror"
                       value="{{ old('cod_gamea', $parlante?->cod_gamea) }}"
                       placeholder="Código GAMEA">

                {!! $errors->first(
                    'cod_gamea',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>


        @if($parlante->id)

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
                           value="{{ old('cod_registro', $parlante?->cod_registro) }}"
                           placeholder="N.º de recepción">

                    {!! $errors->first(
                        'cod_registro',
                        '<div class="invalid-feedback" role="alert">
                            <strong>:message</strong>
                        </div>'
                    ) !!}

                </div>

            </div>

        @endif

    </div>


    <!-- MARCA / MODELO -->
    <div class="row">

        <div class="col-md-6">

            <div class="registro-field">

                <label for="marca">
                    <i class="fas fa-tag"></i>
                    MARCA
                </label>

                <input type="text"
                       name="marca"
                       id="marca"
                       class="form-control @error('marca') is-invalid @enderror"
                       value="{{ old('marca', $parlante?->marca) }}"
                       placeholder="Marca">

                {!! $errors->first(
                    'marca',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>


        <div class="col-md-6">

            <div class="registro-field">

                <label for="modelo">
                    <i class="fas fa-volume-up"></i>
                    MODELO
                </label>

                <input type="text"
                       name="modelo"
                       id="modelo"
                       class="form-control @error('modelo') is-invalid @enderror"
                       value="{{ old('modelo', $parlante?->modelo) }}"
                       placeholder="Modelo">

                {!! $errors->first(
                    'modelo',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>

    </div>


    <!-- FALLA / OBSERVACIONES -->
    <div class="row">

        <div class="col-md-6">

            <div class="registro-field">

                <label for="falla">
                    <i class="fas fa-exclamation-triangle"></i>
                    FALLA
                </label>

                <input type="text"
                       name="falla"
                       id="falla"
                       class="form-control @error('falla') is-invalid @enderror"
                       value="{{ old('falla', $parlante?->falla) }}"
                       placeholder="Falla">

                {!! $errors->first(
                    'falla',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
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
                       value="{{ old('observaciones', $parlante?->observaciones) }}"
                       placeholder="Observaciones">

                {!! $errors->first(
                    'observaciones',
                    '<div class="invalid-feedback" role="alert">
                        <strong>:message</strong>
                    </div>'
                ) !!}

            </div>

        </div>

    </div>


    <!-- ESTADO -->
    <div class="row">

        @if($parlante->id)

            <div class="col-md-5">

                <div class="registro-field">

                    <label for="estado_id">
                        <i class="fas fa-tasks"></i>
                        ESTADO
                    </label>

                    <select name="estado_id"
                            id="estado_id"
                            class="form-control @error('estado_id') is-invalid @enderror">

                        <option value=""
                                disabled
                                {{ old('estado_id', $parlante?->estado_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($estado as $estados)

                            <option value="{{ $estados->id }}"
                                {{ old('estado_id', $parlante?->estado_id) == $estados->id ? 'selected' : '' }}>

                                {{ $estados->nombre }}

                            </option>

                        @endforeach

                    </select>

                    {!! $errors->first(
                        'estado_id',
                        '<div class="invalid-feedback" role="alert">
                            <strong>:message</strong>
                        </div>'
                    ) !!}

                </div>

            </div>

        @else

            <input type="hidden"
                   name="estado_id"
                   value="{{ $estado?->first()->id }}">

        @endif

    </div>


    <!-- INFORMACIÓN -->
    <div class="registro-required">

        <i class="fas fa-info-circle"></i>

        Los campos marcados con
        <span class="required">*</span>
        son obligatorios.

    </div>

</div>

