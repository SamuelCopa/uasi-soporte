<div class="row">

    <div class="col-md-12">

        <!-- =====================================================
             DATOS DEL SOLICITANTE
             ===================================================== -->
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
                            <span class="required">*</span>
                        </label>

                        <select name="funcionario_activo"
                                id="funcionario_activo"
                                class="form-control @error('funcionario_activo') is-invalid @enderror"
                                required>

                            <option value="" disabled
                                {{ old('funcionario_activo', $upese?->funcionario_activo) === null ? 'selected' : '' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="1"
                                {{ old('funcionario_activo', $upese?->funcionario_activo) == 1 ? 'selected' : '' }}>
                                FUNCIONARIO ACTIVO
                            </option>

                            <option value="0"
                                {{ old('funcionario_activo', $upese?->funcionario_activo) == 0 ? 'selected' : '' }}>
                                EX FUNCIONARIO
                            </option>

                        </select>

                        {!! $errors->first(
                            'funcionario_activo',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>

            </div>


            <!-- NOMBRES -->
            <div class="row">

                <!-- PATERNO -->
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
                               value="{{ old('paterno', $upese->funcionario?->paterno) }}"
                               placeholder="Apellido paterno">

                        {!! $errors->first(
                            'paterno',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>


                <!-- MATERNO -->
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
                               value="{{ old('materno', $upese->funcionario?->materno) }}"
                               placeholder="Apellido materno">

                        {!! $errors->first(
                            'materno',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>


                <!-- NOMBRE -->
                <div class="col-md-4">
                    <div class="registro-field">

                        <label for="nombre">
                            <i class="fas fa-id-badge"></i>
                            NOMBRE(S)
                        </label>

                        <input type="text"
                               name="nombre"
                               id="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre', $upese->funcionario?->nombre) }}"
                               placeholder="Nombre(s)">

                        {!! $errors->first(
                            'nombre',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>

            </div>


            <!-- CI / EXPEDIDO / CELULAR -->
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
                               value="{{ old('ci', $upese->funcionario?->ci) }}"
                               placeholder="Número de C.I."
                               required>

                        {!! $errors->first(
                            'ci',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
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

                        <select name="expedido"
                                id="expedido"
                                class="form-control @error('expedido') is-invalid @enderror"
                                required>

                            <option value="" disabled
                                {{ empty(old('expedido', $upese->funcionario?->expedido)) ? 'selected' : '' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="QR" {{ old('expedido', $upese->funcionario?->expedido) == 'QR' ? 'selected' : '' }}>
                                QR
                            </option>

                            <option value="LP" {{ old('expedido', $upese->funcionario?->expedido) == 'LP' ? 'selected' : '' }}>
                                LA PAZ
                            </option>

                            <option value="CB" {{ old('expedido', $upese->funcionario?->expedido) == 'CB' ? 'selected' : '' }}>
                                COCHABAMBA
                            </option>

                            <option value="SC" {{ old('expedido', $upese->funcionario?->expedido) == 'SC' ? 'selected' : '' }}>
                                SANTA CRUZ
                            </option>

                            <option value="OR" {{ old('expedido', $upese->funcionario?->expedido) == 'OR' ? 'selected' : '' }}>
                                ORURO
                            </option>

                            <option value="CH" {{ old('expedido', $upese->funcionario?->expedido) == 'CH' ? 'selected' : '' }}>
                                CHUQUISACA
                            </option>

                            <option value="PO" {{ old('expedido', $upese->funcionario?->expedido) == 'PO' ? 'selected' : '' }}>
                                POTOSÍ
                            </option>

                            <option value="T" {{ old('expedido', $upese->funcionario?->expedido) == 'T' ? 'selected' : '' }}>
                                TARIJA
                            </option>

                            <option value="B" {{ old('expedido', $upese->funcionario?->expedido) == 'B' ? 'selected' : '' }}>
                                BENI
                            </option>

                            <option value="P" {{ old('expedido', $upese->funcionario?->expedido) == 'P' ? 'selected' : '' }}>
                                PANDO
                            </option>

                        </select>

                        {!! $errors->first(
                            'expedido',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>


                <!-- CELULAR -->
                <div class="col-md-4">
                    <div class="registro-field">

                        <label for="celular">
                            <i class="fas fa-mobile-alt"></i>
                            CELULAR
                        </label>

                        <input type="text"
                               name="celular"
                               id="celular"
                               class="form-control @error('celular') is-invalid @enderror"
                               value="{{ old('celular', $upese->funcionario?->celular) }}"
                               placeholder="Número de celular">

                        {!! $errors->first(
                            'celular',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>

            </div>


            <!-- CARGO / CORREO / FECHA -->
            <div class="row">

                <!-- CARGO -->
                <div class="col-md-4">
                    <div class="registro-field">

                        <label for="cargo">
                            <i class="fas fa-briefcase"></i>
                            CARGO
                        </label>

                        <input type="text"
                               name="cargo"
                               id="cargo"
                               class="form-control @error('cargo') is-invalid @enderror"
                               value="{{ old('cargo', $upese->funcionario?->cargo) }}"
                               placeholder="Cargo">

                        {!! $errors->first(
                            'cargo',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>


                <!-- CORREO -->
                <div class="col-md-4">
                    <div class="registro-field">

                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            CORREO ELECTRÓNICO
                        </label>

                        <input type="email"
                               name="email"
                               id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $upese->funcionario?->email) }}"
                               placeholder="correo@ejemplo.com">

                        {!! $errors->first(
                            'email',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>


                <!-- FECHA RECEPCIÓN -->
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
                               value="{{ old('fecha', $upese?->fecha ? date('Y-m-d\TH:i', strtotime($upese->fecha)) : '') }}">

                        {!! $errors->first(
                            'fecha',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>

            </div>


            <!-- TÉCNICO / FECHAS -->
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

                            <option value="">
                                SELECCIONAR
                            </option>

                            @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ $user->id == $upese->user_id ? 'selected' : '' }}>

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
                               value="{{ old('fecha_asignacion', $upese?->fecha_asignacion ? date('Y-m-d\TH:i', strtotime($upese->fecha_asignacion)) : '') }}">

                        {!! $errors->first(
                            'fecha_asignacion',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
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
                               value="{{ old('fecha_inicio', $upese?->fecha_inicio ? date('Y-m-d\TH:i', strtotime($upese->fecha_inicio)) : '') }}">

                        {!! $errors->first(
                            'fecha_inicio',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>

            </div>


            <!-- DEPENDENCIA -->
            <div class="row">

                <div class="col-md-12">
                    <div class="registro-field">

                        <label for="dependencia_id">
                            <i class="fas fa-building"></i>
                            DEPENDENCIA
                            <span class="required">*</span>
                        </label>

                        <select name="dependencia_id"
                                id="dependencia_id"
                                class="form-control @error('dependencia_id') is-invalid @enderror"
                                required>

                            <option value="" disabled
                                {{ old('dependencia_id', $upese?->dependencia_id) ? '' : 'selected' }}>
                                SELECCIONAR
                            </option>

                            @foreach ($dependencia as $item)

                                <option value="{{ $item->id }}"
                                    {{ old('dependencia_id', $upese?->dependencia_id) == $item->id ? 'selected' : '' }}>

                                    {{ $item->dependencias }}

                                </option>

                            @endforeach

                        </select>

                        {!! $errors->first(
                            'dependencia_id',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>

            </div>


            <!-- CAMPOS OCULTOS -->
            <input type="hidden"
                   name="funcionario_id"
                   value="{{ old('funcionario_id', $upese?->funcionario_id) }}"
                   id="funcionario_id">

        </div>


        <!-- =====================================================
             DATOS DEL U.P.S.
             ===================================================== -->
        <div class="registro-section">

            <div class="registro-section-title">
                <i class="fas fa-plug"></i>
                DATOS DEL U.P.S.
            </div>


            <!-- CÓDIGOS -->
            <div class="row">

                <!-- CÓDIGO GAMEA -->
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
                               value="{{ old('cod_gamea', $upese?->cod_gamea) }}"
                               placeholder="Código GAMEA">

                        {!! $errors->first(
                            'cod_gamea',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>


                <!-- NÚMERO DE RECEPCIÓN -->
                @if($upese->id)

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
                                   value="{{ old('cod_registro', $upese?->cod_registro) }}"
                                   placeholder="Número de recepción">

                            {!! $errors->first(
                                'cod_registro',
                                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
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
                               value="{{ old('marca', $upese?->marca) }}"
                               placeholder="Marca">

                        {!! $errors->first(
                            'marca',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>


                <div class="col-md-6">
                    <div class="registro-field">

                        <label for="modelo">
                            <i class="fas fa-cube"></i>
                            MODELO
                        </label>

                        <input type="text"
                               name="modelo"
                               id="modelo"
                               class="form-control @error('modelo') is-invalid @enderror"
                               value="{{ old('modelo', $upese?->modelo) }}"
                               placeholder="Modelo">

                        {!! $errors->first(
                            'modelo',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
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
                               value="{{ old('falla', $upese?->falla) }}"
                               placeholder="Descripción de la falla">

                        {!! $errors->first(
                            'falla',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
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
                               value="{{ old('observaciones', $upese?->observaciones) }}"
                               placeholder="Observaciones">

                        {!! $errors->first(
                            'observaciones',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>
                </div>

            </div>


            <!-- ESTADO -->
            @if($upese->id)

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
                                    class="form-control @error('estado_id') is-invalid @enderror"
                                    required>

                                <option value="" disabled
                                    {{ old('estado_id', $upese?->estado_id) ? '' : 'selected' }}>
                                    SELECCIONAR
                                </option>

                                @foreach ($estado as $item)

                                    <option value="{{ $item->id }}"
                                        {{ old('estado_id', $upese?->estado_id) == $item->id ? 'selected' : '' }}>

                                        {{ $item->nombre }}

                                    </option>

                                @endforeach

                            </select>

                            {!! $errors->first(
                                'estado_id',
                                '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                            ) !!}

                        </div>

                    </div>

                </div>

            @else

                <input type="hidden"
                       name="estado_id"
                       value="{{ $estado?->first()->id }}">

            @endif

        </div>


        <!-- =====================================================
             INFORMACIÓN
             ===================================================== -->
        <div class="registro-required">

            <i class="fas fa-info-circle"></i>

            Verifique la información del funcionario y del U.P.S.
            antes de guardar los cambios.
            Los campos marcados con
            <strong>*</strong>
            son obligatorios.

        </div>

    </div>

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 