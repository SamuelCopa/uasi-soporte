<link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 
<div class="row padding-1 p-1">

    <div class="contenedor">

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

                <div class="col-md-12">

                    <div class="registro-field">

                        <label for="miSelect">
                            <i class="fas fa-user-check"></i>
                            TIPO DE FUNCIONARIO
                        </label>

                        <select name="funcionario_activo"
                                class="form-control"
                                id="miSelect">

                            <option value="" disabled
                                {{ old('funcionario_activo', $impresora->funcionario_activo) === null ? 'selected' : '' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="1"
                                {{ old('funcionario_activo', $impresora->funcionario_activo) == 1 ? 'selected' : '' }}>
                                FUNCIONARIO ACTIVO
                            </option>

                            <option value="0"
                                {{ old('funcionario_activo', $impresora->funcionario_activo) == 0 ? 'selected' : '' }}>
                                EX FUNCIONARIO
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            <!-- DATOS PERSONALES -->
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
                               value="{{ old('paterno', $impresora->funcionario?->paterno) }}"
                               placeholder="Apellido paterno">

                        {!! $errors->first('paterno',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
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
                               value="{{ old('materno', $impresora->funcionario?->materno) }}"
                               placeholder="Apellido materno">

                        {!! $errors->first('materno',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
                        ) !!}

                    </div>

                </div>


                <!-- NOMBRE -->
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
                               value="{{ old('nombre', $impresora->funcionario?->nombre) }}"
                               placeholder="Nombre(s)">

                        {!! $errors->first('nombre',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
                        ) !!}

                    </div>

                </div>

            </div>


            <!-- CI / EXPEDIDO / CELULAR -->
            <div class="row">

                <!-- CI -->
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
                               value="{{ old('ci', $impresora->funcionario?->ci) }}"
                               placeholder="C.I.">

                        {!! $errors->first('ci',
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

                        <select name="expedido"
                                id="expedido"
                                class="form-control"
                                required>

                            <option value="" disabled
                                {{ old('expedido', $impresora->funcionario?->expedido) ? '' : 'selected' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="QR" {{ old('expedido', $impresora->funcionario?->expedido) == 'QR' ? 'selected' : '' }}>QR</option>
                            <option value="LP" {{ old('expedido', $impresora->funcionario?->expedido) == 'LP' ? 'selected' : '' }}>LA PAZ</option>
                            <option value="CB" {{ old('expedido', $impresora->funcionario?->expedido) == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
                            <option value="SC" {{ old('expedido', $impresora->funcionario?->expedido) == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
                            <option value="OR" {{ old('expedido', $impresora->funcionario?->expedido) == 'OR' ? 'selected' : '' }}>ORURO</option>
                            <option value="CH" {{ old('expedido', $impresora->funcionario?->expedido) == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
                            <option value="PO" {{ old('expedido', $impresora->funcionario?->expedido) == 'PO' ? 'selected' : '' }}>POTOSÍ</option>
                            <option value="T" {{ old('expedido', $impresora->funcionario?->expedido) == 'T' ? 'selected' : '' }}>TARIJA</option>
                            <option value="B" {{ old('expedido', $impresora->funcionario?->expedido) == 'B' ? 'selected' : '' }}>BENI</option>
                            <option value="P" {{ old('expedido', $impresora->funcionario?->expedido) == 'P' ? 'selected' : '' }}>PANDO</option>

                        </select>

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
                               value="{{ old('celular', $impresora->funcionario?->celular) }}"
                               placeholder="Celular">

                        {!! $errors->first('celular',
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
                               value="{{ old('cargo', $impresora->funcionario?->cargo) }}"
                               placeholder="Cargo">

                        {!! $errors->first('cargo',
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
                               value="{{ old('email', $impresora->funcionario?->email) }}"
                               placeholder="Correo electrónico">

                        {!! $errors->first('email',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
                        ) !!}

                    </div>

                </div>

            </div>


            <!-- FUNCIONARIO ID -->
            <input type="hidden"
                   name="funcionario_id"
                   class="@error('funcionario_id') is-invalid @enderror"
                   value="{{ old('funcionario_id', $impresora?->funcionario_id) }}"
                   id="funcionario_id">


            <!-- FECHA DE RECEPCIÓN / DEPENDENCIA -->
            <div class="row">

                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="fecha">
                            <i class="fas fa-calendar-alt"></i>
                            FECHA DE RECEPCIÓN
                        </label>

                        <input type="datetime-local"
                               name="fecha"
                               id="fecha"
                               class="form-control @error('fecha') is-invalid @enderror"
                               value="{{ old('fecha', $impresora?->fecha ? date('Y-m-d\TH:i', strtotime($impresora->fecha)) : '') }}"
                               placeholder="Fecha de recepción">

                        {!! $errors->first('fecha',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
                        ) !!}

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="dependencia_id">
                            <i class="fas fa-building"></i>
                            DEPENDENCIA
                        </label>

                        <select name="dependencia_id"
                                id="dependencia_id"
                                class="form-control @error('dependencia_id') is-invalid @enderror">

                            <option value="" disabled
                                {{ old('dependencia_id', $impresora?->dependencia_id) ? '' : 'selected' }}>
                                SELECCIONE UNA DEPENDENCIA
                            </option>

                            @foreach ($dependencia as $item)

                                <option value="{{ $item->id }}"
                                    {{ old('dependencia_id', $impresora?->dependencia_id) == $item->id ? 'selected' : '' }}>

                                    {{ $item->dependencias }}

                                </option>

                            @endforeach

                        </select>

                        {!! $errors->first('dependencia_id',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
                        ) !!}

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             ASIGNACIÓN Y SEGUIMIENTO
             ===================================================== -->
        <div class="registro-section">

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

                            <option value="" disabled
                                {{ old('user_id', $impresora?->user_id) ? '' : 'selected' }}>
                                SELECCIONE UN TÉCNICO
                            </option>

                            @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ $user->id == $impresora->user_id ? 'selected' : '' }}>

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
                               value="{{ old('fecha_asignacion', $impresora?->fecha_asignacion ? date('Y-m-d\TH:i', strtotime($impresora->fecha_asignacion)) : '') }}">

                        {!! $errors->first('fecha_asignacion',
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
                               value="{{ old('fecha_inicio', $impresora?->fecha_inicio ? date('Y-m-d\TH:i', strtotime($impresora->fecha_inicio)) : '') }}">

                        {!! $errors->first('fecha_inicio',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
                        ) !!}

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             DATOS DE LA IMPRESORA
             ===================================================== -->
        <div class="registro-section">

            <div class="registro-section-title">
                <i class="fas fa-print"></i>
                DATOS DE LA IMPRESORA
            </div>


            <!-- CÓDIGO GAMEA / NÚMERO DE RECEPCIÓN -->
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
                               value="{{ old('cod_gamea', $impresora?->cod_gamea) }}"
                               placeholder="Código GAMEA">

                        {!! $errors->first('cod_gamea',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
                        ) !!}

                    </div>

                </div>


                @if($impresora->id)

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
                                   value="{{ old('cod_registro', $impresora?->cod_registro) }}"
                                   placeholder="Número de recepción">

                            {!! $errors->first('cod_registro',
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
                               value="{{ old('marca', $impresora?->marca) }}"
                               placeholder="Marca">

                        {!! $errors->first('marca',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
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
                               value="{{ old('modelo', $impresora?->modelo) }}"
                               placeholder="Modelo">

                        {!! $errors->first('modelo',
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
                               value="{{ old('falla', $impresora?->falla) }}"
                               placeholder="Falla">

                        {!! $errors->first('falla',
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
                               value="{{ old('observaciones', $impresora?->observaciones) }}"
                               placeholder="Observaciones">

                        {!! $errors->first('observaciones',
                            '<div class="invalid-feedback" role="alert">
                                <strong>:message</strong>
                            </div>'
                        ) !!}

                    </div>

                </div>

            </div>


            <!-- ESTADO -->
            <div class="row">

                <div class="col-md-12">

                    @if($impresora->id)

                        <div class="registro-field">

                            <label for="estado_id">
                                <i class="fas fa-tasks"></i>
                                ESTADO
                            </label>

                            <select name="estado_id"
                                    id="estado_id"
                                    class="form-control @error('estado_id') is-invalid @enderror">

                                <option value="" disabled
                                    {{ old('estado_id', $impresora?->estado_id) ? '' : 'selected' }}>
                                    SELECCIONE UN ESTADO
                                </option>

                                @foreach ($estado as $estados)

                                    <option value="{{ $estados->id }}"
                                        {{ old('estado_id', $impresora?->estado_id) == $estados->id ? 'selected' : '' }}>

                                        {{ $estados->nombre }}

                                    </option>

                                @endforeach

                            </select>

                            {!! $errors->first('estado_id',
                                '<div class="invalid-feedback" role="alert">
                                    <strong>:message</strong>
                                </div>'
                            ) !!}

                        </div>

                    @else

                        <input type="hidden"
                               name="estado_id"
                               value="{{ $estado?->first()->id }}">

                    @endif

                </div>

            </div>


            <!-- INFORMACIÓN -->
            <div class="registro-required">

                <i class="fas fa-info-circle"></i>

                Verifique los datos de la impresora antes de guardar los cambios.
                Los campos marcados con
                <span class="required">*</span>
                son obligatorios.

            </div>

        </div>

    </div>

</div>

