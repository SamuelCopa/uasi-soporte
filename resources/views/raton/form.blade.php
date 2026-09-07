<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<div class="row padding-1 p-1">

    <div class="col-md-12">

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

                            <span class="required">*</span>

                        </label>

                        <select name="funcionario_activo"
                                id="funcionario_activo"
                                class="form-control @error('funcionario_activo') is-invalid @enderror">

                            <option value=""
                                    disabled
                                    {{ old('funcionario_activo', $raton->funcionario_activo) === null ? 'selected' : '' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="1"
                                {{ old('funcionario_activo', $raton->funcionario_activo) == 1 ? 'selected' : '' }}>
                                FUNCIONARIO ACTIVO
                            </option>

                            <option value="0"
                                {{ old('funcionario_activo', $raton->funcionario_activo) == 0 ? 'selected' : '' }}>
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


            <!-- =========================================================
                 DATOS PERSONALES
                 ========================================================= -->
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
                               class="form-control @error('paterno') is-invalid @enderror"
                               value="{{ old('paterno', $raton->funcionario?->paterno) }}"
                               id="paterno"
                               placeholder="Paterno">

                        @error('paterno')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

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
                               class="form-control @error('materno') is-invalid @enderror"
                               value="{{ old('materno', $raton->funcionario?->materno) }}"
                               id="materno"
                               placeholder="Materno">

                        @error('materno')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

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
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre', $raton->funcionario?->nombre) }}"
                               id="nombre"
                               placeholder="Nombre">

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- =========================================================
                 CI / EXPEDIDO / CELULAR
                 ========================================================= -->
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
                               class="form-control @error('ci') is-invalid @enderror"
                               value="{{ old('ci', $raton->funcionario?->ci) }}"
                               id="ci"
                               placeholder="C.I.">

                        @error('ci')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

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
                                class="form-control">

                            <option value=""
                                    disabled
                                    {{ old('expedido', $raton->funcionario?->expedido) ? '' : 'selected' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="QR" {{ old('expedido', $raton->funcionario?->expedido) == 'QR' ? 'selected' : '' }}>
                                QR
                            </option>

                            <option value="LP" {{ old('expedido', $raton->funcionario?->expedido) == 'LP' ? 'selected' : '' }}>
                                LA PAZ
                            </option>

                            <option value="CB" {{ old('expedido', $raton->funcionario?->expedido) == 'CB' ? 'selected' : '' }}>
                                COCHABAMBA
                            </option>

                            <option value="SC" {{ old('expedido', $raton->funcionario?->expedido) == 'SC' ? 'selected' : '' }}>
                                SANTA CRUZ
                            </option>

                            <option value="OR" {{ old('expedido', $raton->funcionario?->expedido) == 'OR' ? 'selected' : '' }}>
                                ORURO
                            </option>

                            <option value="CH" {{ old('expedido', $raton->funcionario?->expedido) == 'CH' ? 'selected' : '' }}>
                                CHUQUISACA
                            </option>

                            <option value="PO" {{ old('expedido', $raton->funcionario?->expedido) == 'PO' ? 'selected' : '' }}>
                                POTOSI
                            </option>

                            <option value="T" {{ old('expedido', $raton->funcionario?->expedido) == 'T' ? 'selected' : '' }}>
                                TARIJA
                            </option>

                            <option value="B" {{ old('expedido', $raton->funcionario?->expedido) == 'B' ? 'selected' : '' }}>
                                BENI
                            </option>

                            <option value="P" {{ old('expedido', $raton->funcionario?->expedido) == 'P' ? 'selected' : '' }}>
                                PANDO
                            </option>

                        </select>

                    </div>

                </div>


                <!-- CELULAR -->
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="celular">

                            <i class="fas fa-phone-alt"></i>

                            CELULAR

                        </label>

                        <input type="text"
                               name="celular"
                               class="form-control @error('celular') is-invalid @enderror"
                               value="{{ old('celular', $raton->funcionario?->celular) }}"
                               id="celular"
                               placeholder="Celular">

                        @error('celular')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- =========================================================
                 CARGO / CORREO / FECHA
                 ========================================================= -->
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
                               class="form-control @error('cargo') is-invalid @enderror"
                               value="{{ old('cargo', $raton->funcionario?->cargo) }}"
                               id="cargo"
                               placeholder="Cargo">

                        @error('cargo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

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
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $raton->funcionario?->email) }}"
                               id="email"
                               placeholder="CORREO ELECTRÓNICO">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <!-- FECHA -->
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="fecha">

                            <i class="fas fa-calendar-alt"></i>

                            FECHA DE RECEPCIÓN

                        </label>

                        <input type="datetime-local"
                               name="fecha"
                               class="form-control @error('fecha') is-invalid @enderror"
                               value="{{ old('fecha', date('Y-m-d\TH:i', strtotime($raton?->fecha))) }}"
                               id="fecha"
                               placeholder="Fecha Recepción">

                        @error('fecha')
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
                   value="{{ old('funcionario_id', $raton?->funcionario_id) }}"
                   id="funcionario_id">


            <!-- =========================================================
                 ASIGNACIÓN
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
                                    {{ old('user_id', $raton?->user_id) ? '' : 'selected' }}>
                                SELECCIONE
                            </option>

                            @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ $user->id == $raton->user_id ? 'selected' : '' }}>

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

                        @if(!$raton->fecha_asignacion)

                            <input type="datetime-local"
                                   name="fecha_asignacion"
                                   class="form-control @error('fecha_asignacion') is-invalid @enderror"
                                   id="fecha_asignacion">

                        @else

                            <input type="datetime-local"
                                   name="fecha_asignacion"
                                   class="form-control @error('fecha_asignacion') is-invalid @enderror"
                                   value="{{ old('fecha_asignacion', date('Y-m-d\TH:i', strtotime($raton?->fecha_asignacion))) }}"
                                   id="fecha_asignacion">

                        @endif

                    </div>

                </div>


                <!-- FECHA INICIO -->
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="fecha_inicio">

                            <i class="fas fa-play-circle"></i>

                            FECHA DE INICIO

                        </label>

                        @if(!$raton->fecha_inicio)

                            <input type="datetime-local"
                                   name="fecha_inicio"
                                   class="form-control @error('fecha_inicio') is-invalid @enderror"
                                   id="fecha_inicio">

                        @else

                            <input type="datetime-local"
                                   name="fecha_inicio"
                                   class="form-control @error('fecha_inicio') is-invalid @enderror"
                                   value="{{ old('fecha_inicio', date('Y-m-d\TH:i', strtotime($raton?->fecha_inicio))) }}"
                                   id="fecha_inicio">

                        @endif

                    </div>

                </div>

            </div>


            <!-- =========================================================
                 DEPENDENCIA
                 ========================================================= -->
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
                                    disabled
                                    {{ old('dependencia_id', $raton?->dependencia_id) ? '' : 'selected' }}>
                                SELECCIONE
                            </option>

                            @foreach($dependencia as $item)

                                <option value="{{ $item->id }}"
                                    {{ old('dependencia_id', $raton?->dependencia_id) == $item->id ? 'selected' : '' }}>

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
             DATOS DEL MOUSE
             ========================================================= -->
        <div class="registro-section">

            <div class="registro-section-title">

                <i class="fas fa-mouse"></i>

                DATOS DEL MOUSE

            </div>


            <!-- CÓDIGOS -->
            <div class="row">

                <div class="{{ $raton->id ? 'col-md-6' : 'col-md-12' }}">

                    <div class="registro-field">

                        <label for="cod_gamea">

                            <i class="fas fa-barcode"></i>

                            CÓDIGO GAMEA

                        </label>

                        <input type="text"
                               name="cod_gamea"
                               class="form-control @error('cod_gamea') is-invalid @enderror"
                               value="{{ old('cod_gamea', $raton?->cod_gamea) }}"
                               id="cod_gamea"
                               placeholder="Código GAMEA">

                        @error('cod_gamea')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                @if($raton->id)

                    <div class="col-md-6">

                        <div class="registro-field">

                            <label for="cod_registro">

                                <i class="fas fa-hashtag"></i>

                                NÚMERO DE REGISTRO

                            </label>

                            <input type="text"
                                   name="cod_registro"
                                   class="form-control @error('cod_registro') is-invalid @enderror"
                                   value="{{ old('cod_registro', $raton?->cod_registro) }}"
                                   id="cod_registro"
                                   placeholder="Número de registro">

                            @error('cod_registro')
                                <div class="invalid-feedback">
                                    {{ $message }}
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
                               class="form-control @error('marca') is-invalid @enderror"
                               value="{{ old('marca', $raton?->marca) }}"
                               id="marca"
                               placeholder="Marca">

                        @error('marca')
                            <div class="invalid-feedback">
                                {{ $message }}
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
                               class="form-control @error('modelo') is-invalid @enderror"
                               value="{{ old('modelo', $raton?->modelo) }}"
                               id="modelo"
                               placeholder="Modelo">

                        @error('modelo')
                            <div class="invalid-feedback">
                                {{ $message }}
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
                               class="form-control @error('falla') is-invalid @enderror"
                               value="{{ old('falla', $raton?->falla) }}"
                               id="falla"
                               placeholder="Falla">

                        @error('falla')
                            <div class="invalid-feedback">
                                {{ $message }}
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
                               class="form-control @error('observaciones') is-invalid @enderror"
                               value="{{ old('observaciones', $raton?->observaciones) }}"
                               id="observaciones"
                               placeholder="Observaciones">

                        @error('observaciones')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

            </div>


            <!-- =========================================================
                 ESTADO
                 ========================================================= -->
            @if($raton->id)

                <div class="row">

                    <div class="col-md-6">

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
                                        {{ old('estado_id', $raton?->estado_id) ? '' : 'selected' }}>
                                    SELECCIONE
                                </option>

                                @foreach($estado as $estados)

                                    <option value="{{ $estados->id }}"
                                        {{ old('estado_id', $raton?->estado_id) == $estados->id ? 'selected' : '' }}>

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

        </div>


        <!-- =========================================================
             INFORMACIÓN
             ========================================================= -->
        <div class="registro-required">

            <i class="fas fa-info-circle"></i>

            Verifique los datos del mouse antes de guardar los cambios.
            Los campos marcados con
            <span class="required">*</span>
            son obligatorios.

        </div>

    </div>

</div>

