<div class="row">

    <!-- =========================================================
         DATOS DEL SOLICITANTE
         ========================================================= -->
    <div class="col-12">

        <div class="registro-section">

            <div class="registro-section-title">
                <i class="fas fa-user"></i>
                DATOS DEL SOLICITANTE
            </div>


            <!-- TIPO DE FUNCIONARIO -->
            <div class="row">

                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="miSelect">
                            <i class="fas fa-user-check"></i>
                            TIPO DE FUNCIONARIO
                        </label>

                        <select name="funcionario_activo"
                                class="form-control"
                                id="miSelect">

                            <option value=""
                                    disabled
                                    {{ old('funcionario_activo', $laptop->funcionario_activo) === null ? 'selected' : '' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="1"
                                {{ old('funcionario_activo', $laptop->funcionario_activo) == 1 ? 'selected' : '' }}>
                                FUNCIONARIO ACTIVO
                            </option>

                            <option value="0"
                                {{ old('funcionario_activo', $laptop->funcionario_activo) == 0 ? 'selected' : '' }}>
                                EX FUNCIONARIO
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            <!-- =====================================================
                 NOMBRES
                 ===================================================== -->
            <div class="row">

                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="paterno">
                            <i class="fas fa-user"></i>
                            APELLIDO PATERNO
                        </label>

                        <input type="text"
                               name="paterno"
                               class="form-control @error('paterno') is-invalid @enderror"
                               value="{{ old('paterno', $laptop->funcionario?->paterno) }}"
                               id="paterno"
                               placeholder="Apellido paterno">

                        {!! $errors->first('paterno',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

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
                               class="form-control @error('materno') is-invalid @enderror"
                               value="{{ old('materno', $laptop->funcionario?->materno) }}"
                               id="materno"
                               placeholder="Apellido materno">

                        {!! $errors->first('materno',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

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
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre', $laptop->funcionario?->nombre) }}"
                               id="nombre"
                               placeholder="Nombre(s)">

                        {!! $errors->first('nombre',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>

            </div>


            <!-- =====================================================
                 CI / EXPEDIDO / CELULAR
                 ===================================================== -->
            <div class="row">

                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="ci">
                            <i class="fas fa-id-card"></i>
                            C.I.
                        </label>

                        <input type="text"
                               name="ci"
                               class="form-control @error('ci') is-invalid @enderror"
                               value="{{ old('ci', $laptop->funcionario?->ci) }}"
                               id="ci"
                               placeholder="Carnet de identidad">

                        {!! $errors->first('ci',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

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
                                    disabled>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="QR" {{ old('expedido', $laptop->funcionario?->expedido) == 'QR' ? 'selected' : '' }}>
                                QR
                            </option>

                            <option value="LP" {{ old('expedido', $laptop->funcionario?->expedido) == 'LP' ? 'selected' : '' }}>
                                LA PAZ
                            </option>

                            <option value="CB" {{ old('expedido', $laptop->funcionario?->expedido) == 'CB' ? 'selected' : '' }}>
                                COCHABAMBA
                            </option>

                            <option value="SC" {{ old('expedido', $laptop->funcionario?->expedido) == 'SC' ? 'selected' : '' }}>
                                SANTA CRUZ
                            </option>

                            <option value="OR" {{ old('expedido', $laptop->funcionario?->expedido) == 'OR' ? 'selected' : '' }}>
                                ORURO
                            </option>

                            <option value="CH" {{ old('expedido', $laptop->funcionario?->expedido) == 'CH' ? 'selected' : '' }}>
                                CHUQUISACA
                            </option>

                            <option value="PO" {{ old('expedido', $laptop->funcionario?->expedido) == 'PO' ? 'selected' : '' }}>
                                POTOSÍ
                            </option>

                            <option value="T" {{ old('expedido', $laptop->funcionario?->expedido) == 'T' ? 'selected' : '' }}>
                                TARIJA
                            </option>

                            <option value="B" {{ old('expedido', $laptop->funcionario?->expedido) == 'B' ? 'selected' : '' }}>
                                BENI
                            </option>

                            <option value="P" {{ old('expedido', $laptop->funcionario?->expedido) == 'P' ? 'selected' : '' }}>
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
                               class="form-control @error('celular') is-invalid @enderror"
                               value="{{ old('celular', $laptop->funcionario?->celular) }}"
                               id="celular"
                               placeholder="Número de celular">

                        {!! $errors->first('celular',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>

            </div>


            <!-- =====================================================
                 CARGO / CORREO / FECHA
                 ===================================================== -->
            <div class="row">

                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="cargo">
                            <i class="fas fa-briefcase"></i>
                            CARGO
                        </label>

                        <input type="text"
                               name="cargo"
                               class="form-control @error('cargo') is-invalid @enderror"
                               value="{{ old('cargo', $laptop->funcionario?->cargo) }}"
                               id="cargo"
                               placeholder="Cargo">

                        {!! $errors->first('cargo',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="email">
                            <i class="fas fa-envelope"></i>
                            CORREO ELECTRÓNICO
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $laptop->funcionario?->email) }}"
                               id="email"
                               placeholder="Correo electrónico">

                        {!! $errors->first('email',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="fecha">
                            <i class="fas fa-calendar-alt"></i>
                            FECHA DE RECEPCIÓN
                        </label>

                        <input type="datetime-local"
                               name="fecha"
                               class="form-control @error('fecha') is-invalid @enderror"
                               value="{{ old('fecha', date('Y-m-d\TH:i', strtotime($laptop?->fecha))) }}"
                               id="fecha">

                        {!! $errors->first('fecha',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>

            </div>


            <!-- ID FUNCIONARIO -->
            <input type="hidden"
                   name="funcionario_id"
                   class="@error('funcionario_id') is-invalid @enderror"
                   value="{{ old('funcionario_id', $laptop?->funcionario_id) }}"
                   id="funcionario_id">


            <!-- =====================================================
                 TÉCNICO / FECHAS
                 ===================================================== -->
            <div class="row">

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
                                    {{ old('user_id', $laptop?->user_id) ? '' : 'selected' }}>
                                SELECCIONAR
                            </option>

                            @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ $user->id == $laptop->user_id ? 'selected' : '' }}>

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


                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="fecha_asignacion">
                            <i class="fas fa-calendar-check"></i>
                            FECHA DE ASIGNACIÓN
                        </label>

                        <input type="datetime-local"
                               name="fecha_asignacion"
                               class="form-control @error('fecha_asignacion') is-invalid @enderror"
                               value="{{ old('fecha_asignacion', $laptop->fecha_asignacion ? date('Y-m-d\TH:i', strtotime($laptop->fecha_asignacion)) : '') }}"
                               id="fecha_asignacion">

                        {!! $errors->first('fecha_asignacion',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="fecha_inicio">
                            <i class="fas fa-play-circle"></i>
                            FECHA DE INICIO
                        </label>

                        <input type="datetime-local"
                               name="fecha_inicio"
                               class="form-control @error('fecha_inicio') is-invalid @enderror"
                               value="{{ old('fecha_inicio', $laptop->fecha_inicio ? date('Y-m-d\TH:i', strtotime($laptop->fecha_inicio)) : '') }}"
                               id="fecha_inicio">

                        {!! $errors->first('fecha_inicio',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>

            </div>


            <!-- =====================================================
                 DEPENDENCIA
                 ===================================================== -->
            <div class="row">

                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="dependencia_id">
                            <i class="fas fa-building"></i>
                            DEPENDENCIA
                        </label>

                        <select name="dependencia_id"
                                class="form-control @error('dependencia_id') is-invalid @enderror"
                                id="dependencia_id">

                            <option value=""
                                    disabled
                                    {{ old('dependencia_id', $laptop?->dependencia_id) ? '' : 'selected' }}>
                                SELECCIONAR
                            </option>

                            @foreach($dependencia as $item)

                                <option value="{{ $item->id }}"
                                    {{ old('dependencia_id', $laptop?->dependencia_id) == $item->id ? 'selected' : '' }}>

                                    {{ $item->dependencias }}

                                </option>

                            @endforeach

                        </select>

                        {!! $errors->first('dependencia_id',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         DATOS DE LA LAPTOP
         ========================================================= -->
    <div class="col-12">

        <div class="registro-section">

            <div class="registro-section-title">

                <i class="fas fa-laptop"></i>
                DATOS DE LA LAPTOP

            </div>


            <!-- USUARIO / CONTRASEÑA -->
            <div class="row">

                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="usuario">
                            <i class="fas fa-user"></i>
                            USUARIO
                        </label>

                        <input type="text"
                               name="usuario"
                               class="form-control @error('usuario') is-invalid @enderror"
                               value="{{ old('usuario', $laptop?->usuario) }}"
                               id="usuario"
                               placeholder="Usuario">

                        {!! $errors->first('usuario',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="contrasena">
                            <i class="fas fa-key"></i>
                            CONTRASEÑA
                        </label>

                        <input type="text"
                               name="contrasena"
                               class="form-control @error('contrasena') is-invalid @enderror"
                               value="{{ old('contrasena', $laptop?->contrasena) }}"
                               id="contrasena"
                               placeholder="Contraseña">

                        {!! $errors->first('contrasena',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>

            </div>


            <!-- CÓDIGO GAMEA / RECEPCIÓN -->
            <div class="row">

                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="cod_gamea">
                            <i class="fas fa-barcode"></i>
                            CÓDIGO GAMEA
                        </label>

                        <input type="text"
                               name="cod_gamea"
                               class="form-control @error('cod_gamea') is-invalid @enderror"
                               value="{{ old('cod_gamea', $laptop?->cod_gamea) }}"
                               id="cod_gamea"
                               placeholder="Código GAMEA">

                        {!! $errors->first('cod_gamea',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>


                @if($laptop->id)

                    <div class="col-md-6">

                        <div class="registro-field">

                            <label for="cod_registro">
                                <i class="fas fa-receipt"></i>
                                NÚMERO DE RECEPCIÓN
                            </label>

                            <input type="text"
                                   name="cod_registro"
                                   class="form-control @error('cod_registro') is-invalid @enderror"
                                   value="{{ old('cod_registro', $laptop?->cod_registro) }}"
                                   id="cod_registro"
                                   placeholder="Número de recepción">

                            {!! $errors->first('cod_registro',
                                '<div class="invalid-feedback"><strong>:message</strong></div>')
                            !!}

                        </div>

                    </div>

                @endif

            </div>


            <!-- MARCA / MODELO -->
            <div class="row">

                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="marca">
                            <i class="fas fa-laptop"></i>
                            MARCA
                        </label>

                        <input type="text"
                               name="marca"
                               class="form-control @error('marca') is-invalid @enderror"
                               value="{{ old('marca', $laptop?->marca) }}"
                               id="marca"
                               placeholder="Marca">

                        {!! $errors->first('marca',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="modelo">
                            <i class="fas fa-tag"></i>
                            MODELO
                        </label>

                        <input type="text"
                               name="modelo"
                               class="form-control @error('modelo') is-invalid @enderror"
                               value="{{ old('modelo', $laptop?->modelo) }}"
                               id="modelo"
                               placeholder="Modelo">

                        {!! $errors->first('modelo',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

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
                               class="form-control @error('falla') is-invalid @enderror"
                               value="{{ old('falla', $laptop?->falla) }}"
                               id="falla"
                               placeholder="Falla">

                        {!! $errors->first('falla',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

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
                               class="form-control @error('observaciones') is-invalid @enderror"
                               value="{{ old('observaciones', $laptop?->observaciones) }}"
                               id="observaciones"
                               placeholder="Observaciones">

                        {!! $errors->first('observaciones',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>

            </div>


            <!-- ESTADO -->
            <div class="row">

                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="estado_id">
                            <i class="fas fa-tasks"></i>
                            ESTADO
                        </label>

                        <select name="estado_id"
                                class="form-control @error('estado_id') is-invalid @enderror"
                                id="estado_id">

                            <option value=""
                                    disabled
                                    {{ old('estado_id', $laptop?->estado_id) ? '' : 'selected' }}>
                                SELECCIONAR
                            </option>

                            @foreach($estado as $estados)

                                <option value="{{ $estados->id }}"
                                    {{ old('estado_id', $laptop?->estado_id) == $estados->id ? 'selected' : '' }}>

                                    {{ $estados->nombre }}

                                </option>

                            @endforeach

                        </select>

                        {!! $errors->first('estado_id',
                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                        !!}

                    </div>

                </div>

            </div>


            <!-- INFORMACIÓN -->
            <div class="registro-required">

                <i class="fas fa-info-circle"></i>

                Verifique los datos de la laptop antes de guardar los cambios.
                Los campos marcados con <span class="required">*</span>
                son obligatorios.

            </div>

        </div>

    </div>

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
