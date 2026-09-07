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

                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="funcionario_activo">
                            <i class="fas fa-user-check"></i>
                            TIPO DE FUNCIONARIO
                        </label>

                        <select name="funcionario_activo"
                                id="funcionario_activo"
                                class="form-control @error('funcionario_activo') is-invalid @enderror">

                            <option value="" disabled
                                {{ old('funcionario_activo', $estabilizador->funcionario_activo ?? '') === '' ? 'selected' : '' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="1"
                                {{ old('funcionario_activo', $estabilizador->funcionario_activo ?? '') == 1 ? 'selected' : '' }}>
                                FUNCIONARIO ACTIVO
                            </option>

                            <option value="0"
                                {{ old('funcionario_activo', $estabilizador->funcionario_activo ?? '') == 0 ? 'selected' : '' }}>
                                EX FUNCIONARIO
                            </option>

                        </select>

                        @error('funcionario_activo')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- NOMBRES -->
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
                               value="{{ old('paterno', $estabilizador->funcionario?->paterno) }}"
                               placeholder="Apellido paterno">

                        @error('paterno')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

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
                               value="{{ old('materno', $estabilizador->funcionario?->materno) }}"
                               placeholder="Apellido materno">

                        @error('materno')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="nombre">
                            <i class="fas fa-user"></i>
                            NOMBRE(S)
                        </label>

                        <input type="text"
                               name="nombre"
                               id="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre', $estabilizador->funcionario?->nombre) }}"
                               placeholder="Nombre(s)">

                        @error('nombre')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- CI / EXPEDIDO / CELULAR -->
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
                               value="{{ old('ci', $estabilizador->funcionario?->ci) }}"
                               placeholder="Número de C.I.">

                        @error('ci')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

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
                                class="form-control @error('expedido') is-invalid @enderror">

                            <option value="" disabled
                                {{ old('expedido', $estabilizador->funcionario?->expedido ?? '') === '' ? 'selected' : '' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="QR" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'QR' ? 'selected' : '' }}>QR</option>
                            <option value="LP" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'LP' ? 'selected' : '' }}>LA PAZ</option>
                            <option value="CB" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
                            <option value="SC" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
                            <option value="OR" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'OR' ? 'selected' : '' }}>ORURO</option>
                            <option value="CH" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
                            <option value="PO" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'PO' ? 'selected' : '' }}>POTOSI</option>
                            <option value="T" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'T' ? 'selected' : '' }}>TARIJA</option>
                            <option value="B" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'B' ? 'selected' : '' }}>BENI</option>
                            <option value="P" {{ old('expedido', $estabilizador->funcionario?->expedido) == 'P' ? 'selected' : '' }}>PANDO</option>

                        </select>

                        @error('expedido')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>


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
                               value="{{ old('celular', $estabilizador->funcionario?->celular) }}"
                               placeholder="Número de celular">

                        @error('celular')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- CARGO / CORREO / FECHA -->
            <div class="row">

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
                               value="{{ old('cargo', $estabilizador->funcionario?->cargo) }}"
                               placeholder="Cargo">

                        @error('cargo')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

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
                               id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $estabilizador->funcionario?->email) }}"
                               placeholder="Correo electrónico">

                        @error('email')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

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
                               id="fecha"
                               class="form-control @error('fecha') is-invalid @enderror"
                               value="{{ old('fecha', date('Y-m-d\TH:i', strtotime($estabilizador?->fecha))) }}">

                        @error('fecha')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- DEPENDENCIA -->
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

                            <option value="" disabled
                                {{ old('dependencia_id', $estabilizador?->dependencia_id) ? '' : 'selected' }}>
                                SELECCIONE UNA DEPENDENCIA
                            </option>

                            @foreach ($dependencia as $item)

                                <option value="{{ $item->id }}"
                                    {{ old('dependencia_id', $estabilizador?->dependencia_id) == $item->id ? 'selected' : '' }}>

                                    {{ $item->dependencias }}

                                </option>

                            @endforeach

                        </select>

                        @error('dependencia_id')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- ID FUNCIONARIO -->
            <input type="hidden"
                   name="funcionario_id"
                   value="{{ old('funcionario_id', $estabilizador?->funcionario_id) }}"
                   id="funcionario_id">

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
                                class="form-control mi-select @error('user_id') is-invalid @enderror">

                            <option value="" disabled
                                {{ old('user_id', $estabilizador?->user_id) ? '' : 'selected' }}>
                                SELECCIONE UN TÉCNICO
                            </option>

                            @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $estabilizador?->user_id) == $user->id ? 'selected' : '' }}>

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
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>


                <!-- FECHA ASIGNACIÓN -->
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="fecha_asignacion">
                            <i class="fas fa-calendar-check"></i>
                            FECHA DE ASIGNACIÓN
                        </label>

                        @if(!$estabilizador->fecha_asignacion)

                            <input type="datetime-local"
                                   name="fecha_asignacion"
                                   id="fecha_asignacion"
                                   class="form-control @error('fecha_asignacion') is-invalid @enderror">

                        @else

                            <input type="datetime-local"
                                   name="fecha_asignacion"
                                   id="fecha_asignacion"
                                   class="form-control @error('fecha_asignacion') is-invalid @enderror"
                                   value="{{ old('fecha_asignacion', date('Y-m-d\TH:i', strtotime($estabilizador?->fecha_asignacion))) }}">

                        @endif

                        @error('fecha_asignacion')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>


                <!-- FECHA INICIO -->
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="fecha_inicio">
                            <i class="fas fa-play-circle"></i>
                            FECHA DE INICIO
                        </label>

                        @if(!$estabilizador->fecha_inicio)

                            <input type="datetime-local"
                                   name="fecha_inicio"
                                   id="fecha_inicio"
                                   class="form-control @error('fecha_inicio') is-invalid @enderror">

                        @else

                            <input type="datetime-local"
                                   name="fecha_inicio"
                                   id="fecha_inicio"
                                   class="form-control @error('fecha_inicio') is-invalid @enderror"
                                   value="{{ old('fecha_inicio', date('Y-m-d\TH:i', strtotime($estabilizador?->fecha_inicio))) }}">

                        @endif

                        @error('fecha_inicio')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        <!-- =====================================================
             DATOS DEL ESTABILIZADOR
             ===================================================== -->
        <div class="registro-section">

            <div class="registro-section-title">
                <i class="fas fa-bolt"></i>
                DATOS DEL ESTABILIZADOR
            </div>


            <!-- CÓDIGOS -->
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
                               value="{{ old('cod_gamea', $estabilizador?->cod_gamea) }}"
                               placeholder="Código GAMEA">

                        @error('cod_gamea')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>


                @if($estabilizador->id)

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
                                   value="{{ old('cod_registro', $estabilizador?->cod_registro) }}"
                                   placeholder="Número de recepción">

                            @error('cod_registro')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

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
                               value="{{ old('marca', $estabilizador?->marca) }}"
                               placeholder="Marca">

                        @error('marca')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

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
                               value="{{ old('modelo', $estabilizador?->modelo) }}"
                               placeholder="Modelo">

                        @error('modelo')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

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
                               value="{{ old('falla', $estabilizador?->falla) }}"
                               placeholder="Descripción de la falla">

                        @error('falla')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

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
                               value="{{ old('observaciones', $estabilizador?->observaciones) }}"
                               placeholder="Observaciones">

                        @error('observaciones')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- ESTADO -->
            <div class="row">

                @if($estabilizador->id)

                    <div class="col-md-6">

                        <div class="registro-field">

                            <label for="estado_id">
                                <i class="fas fa-tasks"></i>
                                ESTADO
                            </label>

                            <select name="estado_id"
                                    id="estado_id"
                                    class="form-control @error('estado_id') is-invalid @enderror">

                                <option value="" disabled
                                    {{ old('estado_id', $estabilizador?->estado_id) ? '' : 'selected' }}>
                                    SELECCIONE UN ESTADO
                                </option>

                                @foreach ($estado as $estados)

                                    <option value="{{ $estados->id }}"
                                        {{ old('estado_id', $estabilizador?->estado_id) == $estados->id ? 'selected' : '' }}>

                                        {{ $estados->nombre }}

                                    </option>

                                @endforeach

                            </select>

                            @error('estado_id')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

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

                Verifique los datos del estabilizador antes de guardar.
                Los campos marcados con
                <span class="required">*</span>
                son obligatorios.

            </div>

        </div>

    </div>

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 