<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<div class="modal-form-container">

    {{-- =========================================================
         DATOS DEL SOLICITANTE
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-user"></i>
            DATOS DEL SOLICITANTE
        </div>

        <div class="row">

            <div class="col-md-4 registro-field">
                <label for="funcionario_activo" class="form-label">
                    TIPO DE FUNCIONARIO
                </label>

                <select name="funcionario_activo" class="form-control">
                    <option value="" disabled>
                        SELECCIONE UNA OPCIÓN
                    </option>

                    <option value="1"
                        {{ old('funcionario_activo', $registroCpu->funcionario_activo) == 1 ? 'selected' : '' }}>
                        FUNCIONARIO ACTIVO
                    </option>

                    <option value="0"
                        {{ old('funcionario_activo', $registroCpu->funcionario_activo) == 0 ? 'selected' : '' }}>
                        EX FUNCIONARIO
                    </option>
                </select>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4 registro-field">
                <label for="paterno" class="form-label">
                    APELLIDO PATERNO
                </label>

                <input type="text"
                       name="paterno"
                       class="form-control @error('paterno') is-invalid @enderror"
                       value="{{ old('paterno', $registroCpu->funcionario?->paterno) }}"
                       id="paterno"
                       placeholder="Paterno">

                {!! $errors->first('paterno',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

            <div class="col-md-4 registro-field">
                <label for="materno" class="form-label">
                    APELLIDO MATERNO
                </label>

                <input type="text"
                       name="materno"
                       class="form-control @error('materno') is-invalid @enderror"
                       value="{{ old('materno', $registroCpu->funcionario?->materno) }}"
                       id="materno"
                       placeholder="Materno">

                {!! $errors->first('materno',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

            <div class="col-md-4 registro-field">
                <label for="nombre" class="form-label">
                    NOMBRE(S)
                </label>

                <input type="text"
                       name="nombre"
                       class="form-control @error('nombre') is-invalid @enderror"
                       value="{{ old('nombre', $registroCpu->funcionario?->nombre) }}"
                       id="nombre"
                       placeholder="Nombre">

                {!! $errors->first('nombre',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

        </div>

        <div class="row">

            <div class="col-md-4 registro-field">
                <label for="ci" class="form-label">
                    C.I.
                </label>

                <input type="text"
                       name="ci"
                       class="form-control @error('ci') is-invalid @enderror"
                       value="{{ old('ci', $registroCpu->funcionario?->ci) }}"
                       id="ci"
                       placeholder="C.I.">

                {!! $errors->first('ci',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

            <div class="col-md-4 registro-field">
                <label for="expedido" class="form-label">
                    EXPEDIDO
                </label>

                <select name="expedido" class="form-control">
                    <option value="" disabled>
                        SELECCIONE UNA OPCIÓN
                    </option>

                    <option value="LP" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'LP' ? 'selected' : '' }}>LA PAZ</option>
                    <option value="CB" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'CB' ? 'selected' : '' }}>COCHABAMBA</option>
                    <option value="SC" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'SC' ? 'selected' : '' }}>SANTA CRUZ</option>
                    <option value="OR" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'OR' ? 'selected' : '' }}>ORURO</option>
                    <option value="CH" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'CH' ? 'selected' : '' }}>CHUQUISACA</option>
                    <option value="PO" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'PO' ? 'selected' : '' }}>POTOSI</option>
                    <option value="T" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'T' ? 'selected' : '' }}>TARIJA</option>
                    <option value="B" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'B' ? 'selected' : '' }}>BENI</option>
                    <option value="P" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'P' ? 'selected' : '' }}>PANDO</option>
                    <option value="QR" {{ old('expedido', $registroCpu->funcionario->expedido ?? '') == 'QR' ? 'selected' : '' }}>QR</option>
                </select>
            </div>

            <div class="col-md-4 registro-field">
                <label for="celular" class="form-label">
                    CELULAR
                </label>

                <input type="text"
                       name="celular"
                       class="form-control @error('celular') is-invalid @enderror"
                       value="{{ old('celular', $registroCpu->funcionario?->celular) }}"
                       id="celular"
                       placeholder="Celular">

                {!! $errors->first('celular',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

        </div>

        <div class="row">

            <div class="col-md-4 registro-field">
                <label for="cargo" class="form-label">
                    CARGO
                </label>

                <input type="text"
                       name="cargo"
                       class="form-control @error('cargo') is-invalid @enderror"
                       value="{{ old('cargo', $registroCpu->funcionario?->cargo) }}"
                       id="cargo"
                       placeholder="Cargo">

                {!! $errors->first('cargo',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

            <div class="col-md-4 registro-field">
                <label for="email" class="form-label">
                    CORREO ELECTRÓNICO
                </label>

                <input type="email"
                       name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $registroCpu->funcionario?->email) }}"
                       id="email"
                       placeholder="CORREO ELECTRÓNICO">

                {!! $errors->first('email',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

            <div class="col-md-4 registro-field">
                <label for="fecha" class="form-label">
                    FECHA DE RECEPCIÓN
                </label>

                <input type="datetime-local"
                       name="fecha"
                       class="form-control @error('fecha') is-invalid @enderror"
                       value="{{ old('fecha', date('Y-m-d\TH:i', strtotime($registroCpu?->fecha))) }}"
                       id="fecha">

                {!! $errors->first('fecha',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

        </div>

        <input type="hidden"
               name="funcionario_id"
               value="{{ old('funcionario_id', $registroCpu?->funcionario_id) }}"
               id="funcionario_id">

    </div>


    {{-- =========================================================
         ASIGNACIÓN
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-user-cog"></i>
            ASIGNACIÓN Y SEGUIMIENTO
        </div>

        <div class="row">

            <div class="col-md-4 registro-field">
                <label for="user_id" class="form-label">
                    TÉCNICO A CARGO
                </label>

                <select name="user_id"
                        id="user_id"
                        class="form-control mi-select">

                    <option value="" disabled
                        {{ old('user_id', $registroCpu?->user_id) ? '' : 'selected' }}>
                        SELECCIONAR
                    </option>

                    @foreach($users as $user)
                        <option value="{{ $user->id }}"
                            {{ $user->id == $registroCpu->user_id ? 'selected' : '' }}>
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

            <div class="col-md-4 registro-field">
                <label for="fecha_asignacion" class="form-label">
                    FECHA DE ASIGNACIÓN
                </label>

                <input type="datetime-local"
                       name="fecha_asignacion"
                       class="form-control @error('fecha_asignacion') is-invalid @enderror"
                       value="{{ $registroCpu->fecha_asignacion
                            ? old('fecha_asignacion', date('Y-m-d\TH:i', strtotime($registroCpu->fecha_asignacion)))
                            : old('fecha_asignacion') }}"
                       id="fecha_asignacion">

                {!! $errors->first('fecha_asignacion',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

            <div class="col-md-4 registro-field">
                <label for="fecha_inicio" class="form-label">
                    FECHA DE INICIO
                </label>

                <input type="datetime-local"
                       name="fecha_inicio"
                       class="form-control @error('fecha_inicio') is-invalid @enderror"
                       value="{{ $registroCpu->fecha_inicio
                            ? old('fecha_inicio', date('Y-m-d\TH:i', strtotime($registroCpu->fecha_inicio)))
                            : old('fecha_inicio') }}"
                       id="fecha_inicio">

                {!! $errors->first('fecha_inicio',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

        </div>

        <div class="row">

            <div class="col-md-8 registro-field">
                <label for="dependencia_id" class="form-label">
                    DEPENDENCIA
                </label>

                <select name="dependencia_id"
                        class="form-control @error('dependencia_id') is-invalid @enderror"
                        id="dependencia_id">

                    <option value="" disabled
                        {{ old('dependencia_id', $registroCpu?->dependencia_id) ? '' : 'selected' }}>
                        SELECCIONAR
                    </option>

                    @foreach ($dependencia as $item)
                        <option value="{{ $item->id }}"
                            {{ old('dependencia_id', $registroCpu?->dependencia_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->dependencias }}
                        </option>
                    @endforeach

                </select>

                {!! $errors->first('dependencia_id',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

        </div>

    </div>


    {{-- =========================================================
         DATOS GENERALES DEL CPU
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-desktop"></i>
            DATOS GENERALES DEL CPU
        </div>

        <div class="row">

            <div class="col-md-6 registro-field">
                <label for="usuario" class="form-label">
                    USUARIO
                </label>

                <input type="text"
                       name="usuario"
                       class="form-control @error('usuario') is-invalid @enderror"
                       value="{{ old('usuario', $registroCpu?->usuario) }}"
                       id="usuario"
                       placeholder="Usuario">

                {!! $errors->first('usuario',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

            <div class="col-md-6 registro-field">
                <label for="contrasena" class="form-label">
                    CONTRASEÑA
                </label>

                <input type="text"
                       name="contrasena"
                       class="form-control @error('contrasena') is-invalid @enderror"
                       value="{{ old('contrasena', $registroCpu?->contrasena) }}"
                       id="contrasena"
                       placeholder="Contraseña">

                {!! $errors->first('contrasena',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

        </div>

        <div class="row">

            <div class="col-md-6 registro-field">
                <label for="cod_gamea" class="form-label">
                    CÓDIGO GAMEA
                </label>

                <input type="text"
                       name="cod_gamea"
                       class="form-control @error('cod_gamea') is-invalid @enderror"
                       value="{{ old('cod_gamea', $registroCpu?->cod_gamea) }}"
                       id="cod_gamea"
                       placeholder="Código GAMEA"
                       required>

                {!! $errors->first('cod_gamea',
                    '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>

            @if($registroCpu->id)

                <div class="col-md-6 registro-field">

                    <label for="cod_registro" class="form-label">
                        NÚMERO DE RECEPCIÓN
                    </label>

                    <input type="text"
                           name="cod_registro"
                           class="form-control @error('cod_registro') is-invalid @enderror"
                           value="{{ old('cod_registro', $registroCpu?->cod_registro) }}"
                           id="cod_registro"
                           placeholder="No. DE RECEPCIÓN">

                    {!! $errors->first('cod_registro',
                        '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}

                </div>

            @endif

        </div>

    </div>


    {{-- =========================================================
         COMPONENTES PRINCIPALES
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-microchip"></i>
            COMPONENTES PRINCIPALES
        </div>


        {{-- CASE / PROCESADOR / TARJETA MADRE / DISCO --}}
        <div class="row">

            {{-- CASE --}}
            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    CASE
                </div>

                <div class="registro-field">
                    <label>MARCA</label>

                    <select name="marcacase_id"
                            class="form-control @error('marcacase_id') is-invalid @enderror"
                            id="marcacase_id">

                        <option value="" disabled
                            {{ old('marcacase_id',$registroCpu?->marcacase_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($marcacase as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcacase_id',$registroCpu?->marcacase_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->marca }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    {!! $errors->first('marcacase_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                <div class="registro-field">
                    <label>COLOR</label>

                    <select name="colorcase_id"
                            class="form-control @error('colorcase_id') is-invalid @enderror"
                            id="colorcase_id">

                        <option value="" disabled
                            {{ old('colorcase_id',$registroCpu?->colorcase_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($colorcase as $color)
                            <option value="{{ $color->id }}"
                                {{ old('colorcase_id',$registroCpu?->colorcase_id) == $color->id ? 'selected' : '' }}>
                                {{ $color->color }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="colorcase_otro"
                           class="form-control mt-2"
                           id="colorcase_otro"
                           style="display:none;"
                           placeholder="Ingrese el color">

                    {!! $errors->first('colorcase_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

            </div>


            {{-- PROCESADOR --}}
            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    PROCESADOR
                </div>

                <div class="registro-field">
                    <label>MARCA</label>

                    <select name="marcaprocesador_id"
                            class="form-control @error('marcaprocesador_id') is-invalid @enderror"
                            id="marcaprocesador_id">

                        <option value="" disabled
                            {{ old('marcaprocesador_id',$registroCpu?->marcaprocesador_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($marcaprocesador as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcaprocesador_id',$registroCpu?->marcaprocesador_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->marca }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="marcaprocesador_otro"
                           class="form-control mt-2"
                           id="marcaprocesador_otro"
                           style="display:none;"
                           placeholder="Ingrese la marca">

                    {!! $errors->first('marcaprocesador_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                <div class="registro-field">
                    <label>MODELO</label>

                    <select name="modeloprocesador_id"
                            class="form-control @error('modeloprocesador_id') is-invalid @enderror"
                            id="modeloprocesador_id">

                        <option value="" disabled
                            {{ old('modeloprocesador_id',$registroCpu?->modeloprocesador_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($modprocesador as $modelo)
                            <option value="{{ $modelo->id }}"
                                {{ old('modeloprocesador_id',$registroCpu?->modeloprocesador_id) == $modelo->id ? 'selected' : '' }}>
                                {{ $modelo->modelo }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="modeloprocesador_otro"
                           class="form-control mt-2"
                           id="modeloprocesador_otro"
                           style="display:none;"
                           placeholder="Ingrese el modelo">

                    {!! $errors->first('modeloprocesador_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                <div class="registro-field">
                    <label>GENERACIÓN</label>

                    <select name="genprocesador_id"
                            class="form-control @error('genprocesador_id') is-invalid @enderror"
                            id="genprocesador_id">

                        <option value="" disabled
                            {{ old('genprocesador_id',$registroCpu?->genprocesador_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($genprocesador as $generacion)
                            <option value="{{ $generacion->id }}"
                                {{ old('genprocesador_id',$registroCpu?->genprocesador_id) == $generacion->id ? 'selected' : '' }}>
                                {{ $generacion->generacion }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="genprocesador_otro"
                           class="form-control mt-2"
                           id="genprocesador_otro"
                           style="display:none;"
                           placeholder="Ingrese la generación">

                    {!! $errors->first('genprocesador_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

            </div>


            {{-- TARJETA MADRE --}}
            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    TARJETA MADRE
                </div>

                <div class="registro-field">
                    <label>MARCA</label>

                    <select name="marcatmadre_id"
                            class="form-control @error('marcatmadre_id') is-invalid @enderror"
                            id="marcatmadre_id">

                        <option value="" disabled
                            {{ old('marcatmadre_id',$registroCpu?->marcatmadre_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($marcatmadre as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcatmadre_id',$registroCpu?->marcatmadre_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->marca }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="marcatmadre_otro"
                           class="form-control mt-2"
                           id="marcatmadre_otro"
                           style="display:none;"
                           placeholder="Ingrese la marca">

                    {!! $errors->first('marcatmadre_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                <div class="registro-field">
                    <label>MODELO</label>

                    <select name="modtmadre_id"
                            class="form-control @error('modtmadre_id') is-invalid @enderror"
                            id="modtmadre_id">

                        <option value="" disabled
                            {{ old('modtmadre_id',$registroCpu?->modtmadre_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($modelotmadre as $modelo)
                            <option value="{{ $modelo->id }}"
                                {{ old('modtmadre_id',$registroCpu?->modtmadre_id) == $modelo->id ? 'selected' : '' }}>
                                {{ $modelo->modelo }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="modtmadre_otro"
                           class="form-control mt-2"
                           id="modtmadre_otro"
                           style="display:none;"
                           placeholder="Ingrese el modelo">

                    {!! $errors->first('modtmadre_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

            </div>


            {{-- DISCO DURO --}}
            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    DISCO DURO
                </div>

                <div class="registro-field">
                    <label>MARCA</label>

                    <select name="marcadisco_id"
                            class="form-control @error('marcadisco_id') is-invalid @enderror"
                            id="marcadisco_id">

                        <option value="" disabled
                            {{ old('marcadisco_id',$registroCpu?->marcadisco_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($marcadisco as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcadisco_id',$registroCpu?->marcadisco_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->marca }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="marcadisco_otro"
                           class="form-control mt-2"
                           id="marcadisco_otro"
                           style="display:none;"
                           placeholder="Ingrese la marca">

                    {!! $errors->first('marcadisco_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                <div class="registro-field">
                    <label>CAPACIDAD</label>

                    <select name="capacdisco_id"
                            class="form-control @error('capacdisco_id') is-invalid @enderror"
                            id="capacdisco_id">

                        <option value="" disabled
                            {{ old('capacdisco_id',$registroCpu?->capacdisco_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($capdisco as $capacidad)
                            <option value="{{ $capacidad->id }}"
                                {{ old('capacdisco_id',$registroCpu?->capacdisco_id) == $capacidad->id ? 'selected' : '' }}>
                                {{ $capacidad->capacidad }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="capacdisco_otro"
                           class="form-control mt-2"
                           id="capacdisco_otro"
                           style="display:none;"
                           placeholder="Ingrese la capacidad">

                    {!! $errors->first('capacdisco_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                <div class="registro-field">
                    <label>TIPO</label>

                    <select name="tipodisco_id"
                            class="form-control @error('tipodisco_id') is-invalid @enderror"
                            id="tipodisco_id">

                        <option value="" disabled
                            {{ old('tipodisco_id',$registroCpu?->tipodisco_id) ? '' : 'selected' }}>
                            SELECCIONAR
                        </option>

                        @foreach ($tipodisco as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ old('tipodisco_id',$registroCpu?->tipodisco_id) == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->tipo }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="tipodisco_otro"
                           class="form-control mt-2"
                           id="tipodisco_otro"
                           style="display:none;"
                           placeholder="Ingrese el tipo">

                    {!! $errors->first('tipodisco_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         MEMORIAS RAM
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-memory"></i>
            MEMORIA RAM
        </div>

        <div class="row">

            {{-- RAM 1 --}}
            @for($ram = 1; $ram <= 4; $ram++)

                @php
                    $sufijo = $ram == 1 ? '' : $ram;
                @endphp

                <div class="col-md-3 registro-component">

                    <div class="registro-component-title">
                        MEMORIA RAM {{ $ram }}
                    </div>

                    <div class="registro-field">
                        <label for="disipador{{ $sufijo }}_id">
                            DISIPADOR
                        </label>

                        <select name="disipador{{ $sufijo }}_id"
                                id="disipador{{ $sufijo }}_id"
                                class="form-control">

                            <option value="" disabled>
                                SELECCIONAR
                            </option>

                            @foreach ($disipadorram as $disip)
                                <option value="{{ $disip->id }}"
                                    {{ old("disipador{$sufijo}_id", $registroCpu?->{"disipador{$sufijo}_id"}) == $disip->id ? 'selected' : '' }}>
                                    {{ $disip->opcion }}
                                </option>
                            @endforeach

                            @if($ram != 2 && $ram != 4)
                                <option value="">QUITAR</option>
                            @endif

                        </select>
                    </div>

                    <div class="registro-field">
                        <label for="marcaram{{ $sufijo }}_id">
                            MARCA
                        </label>

                        <select name="marcaram{{ $sufijo }}_id"
                                id="marcaram{{ $sufijo }}_id"
                                class="form-control">

                            <option value="" disabled>
                                SELECCIONAR
                            </option>

                            @foreach ($marcaram as $marca)
                                <option value="{{ $marca->id }}"
                                    {{ old("marcaram{$sufijo}_id", $registroCpu?->{"marcaram{$sufijo}_id"}) == $marca->id ? 'selected' : '' }}>
                                    {{ $marca->marca }}
                                </option>
                            @endforeach

                            <option value="">QUITAR</option>
                        </select>

                        <input type="text"
                               name="marcaram{{ $sufijo }}_otro"
                               class="form-control mt-2"
                               id="marcaram{{ $sufijo }}_otro"
                               style="display:none;"
                               placeholder="Ingrese la marca">
                    </div>

                    <div class="registro-field">
                        <label for="capacram{{ $sufijo }}_id">
                            CAPACIDAD
                        </label>

                        <select name="capacram{{ $sufijo }}_id"
                                id="capacram{{ $sufijo }}_id"
                                class="form-control">

                            <option value="" disabled>
                                SELECCIONAR
                            </option>

                            @foreach ($capram as $capacidad)
                                <option value="{{ $capacidad->id }}"
                                    {{ old("capacram{$sufijo}_id", $registroCpu?->{"capacram{$sufijo}_id"}) == $capacidad->id ? 'selected' : '' }}>
                                    {{ $capacidad->capacidad }}
                                </option>
                            @endforeach

                            <option value="">QUITAR</option>
                        </select>

                        <input type="text"
                               name="capacram{{ $sufijo }}_otro"
                               class="form-control mt-2"
                               id="capacram{{ $sufijo }}_otro"
                               style="display:none;"
                               placeholder="Ingrese la capacidad">
                    </div>

                    <div class="registro-field">
                        <label for="tiporam{{ $sufijo }}_id">
                            TIPO DE CONEXIÓN
                        </label>

                        <select name="tiporam{{ $sufijo }}_id"
                                id="tiporam{{ $sufijo }}_id"
                                class="form-control">

                            <option value="" disabled>
                                SELECCIONAR
                            </option>

                            @foreach ($tiporam as $tipo)
                                <option value="{{ $tipo->id }}"
                                    {{ old("tiporam{$sufijo}_id", $registroCpu?->{"tiporam{$sufijo}_id"}) == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->tipo }}
                                </option>
                            @endforeach

                            <option value="">QUITAR</option>
                        </select>
                    </div>

                    <div class="registro-field">
                        <label for="cantidad{{ $sufijo }}_id">
                            CANTIDAD
                        </label>

                        <select name="cantidad{{ $sufijo }}_id"
                                id="cantidad{{ $sufijo }}_id"
                                class="form-control">

                            <option value="" disabled>
                                SELECCIONAR
                            </option>

                            @foreach ($cantidadram as $cantidad)
                                <option value="{{ $cantidad->id }}"
                                    {{ old("cantidad{$sufijo}_id", $registroCpu?->{"cantidad{$sufijo}_id"}) == $cantidad->id ? 'selected' : '' }}>
                                    {{ $cantidad->cantidad }}
                                </option>
                            @endforeach

                            <option value="">QUITAR</option>
                        </select>
                    </div>

                </div>

            @endfor

        </div>

    </div>


    {{-- =========================================================
         TARJETAS Y CONECTIVIDAD
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-network-wired"></i>
            TARJETAS Y CONECTIVIDAD
        </div>

        <div class="row">

            {{-- VIDEO --}}
            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    TARJETA DE VIDEO
                </div>

                <div class="registro-field">
                    <label>MARCA</label>

                    <select name="marcatvideo_id"
                            id="marcatvideo_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($marcatvideo as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcatvideo_id',$registroCpu?->marcatvideo_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->marca }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="marcatvideo_otro"
                           id="marcatvideo_otro"
                           class="form-control mt-2"
                           style="display:none;"
                           placeholder="Ingrese la marca">
                </div>

                <div class="registro-field">
                    <label>CAPACIDAD</label>

                    <select name="capactvideo_id"
                            id="capactvideo_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($captvideo as $capacidad)
                            <option value="{{ $capacidad->id }}"
                                {{ old('capactvideo_id',$registroCpu?->capactvideo_id) == $capacidad->id ? 'selected' : '' }}>
                                {{ $capacidad->capacidad }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

                <div class="registro-field">
                    <label>TIPO</label>

                    <select name="tipotvideo_id"
                            id="tipotvideo_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($tipotvideo as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ old('tipotvideo_id',$registroCpu?->tipotvideo_id) == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->tipo }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

            </div>


            {{-- RED --}}
            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    TARJETA DE RED
                </div>

                <div class="registro-field">
                    <label>MARCA</label>

                    <select name="marcatred_id"
                            id="marcatred_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($marcatred as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcatred_id',$registroCpu?->marcatred_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->marca }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

                <div class="registro-field">
                    <label>MODELO</label>

                    <select name="modtred_id"
                            id="modtred_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($modelotred as $modelo)
                            <option value="{{ $modelo->id }}"
                                {{ old('modtred_id',$registroCpu?->modtred_id) == $modelo->id ? 'selected' : '' }}>
                                {{ $modelo->modelo }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

            </div>


            {{-- WIFI --}}
            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    TARJETA WIFI
                </div>

                <div class="registro-field">
                    <label>MARCA</label>

                    <select name="marcawifi_id"
                            id="marcawifi_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($marcatwifi as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcawifi_id',$registroCpu?->marcawifi_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->marca }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

                <div class="registro-field">
                    <label>MODELO</label>

                    <select name="modcawifi_id"
                            id="modcawifi_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($modelowifi as $modelo)
                            <option value="{{ $modelo->id }}"
                                {{ old('modcawifi_id',$registroCpu?->modcawifi_id) == $modelo->id ? 'selected' : '' }}>
                                {{ $modelo->modelo }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

                <div class="registro-field">
                    <label>ANTENA</label>

                    <select name="antena_id"
                            id="antena_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($disipadorram as $antena)
                            <option value="{{ $antena->id }}"
                                {{ old('antena_id',$registroCpu?->antena_id) == $antena->id ? 'selected' : '' }}>
                                {{ $antena->opcion }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

            </div>


            {{-- FUENTE --}}
            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    FUENTE
                </div>

                <div class="registro-field">
                    <label>MARCA</label>

                    <select name="marcafuente_id"
                            id="marcafuente_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($marcafuente as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcafuente_id',$registroCpu?->marcafuente_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->marca }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

                <div class="registro-field">
                    <label>POTENCIA</label>

                    <select name="potfuente_id"
                            id="potfuente_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($potenciafuente as $potencia)
                            <option value="{{ $potencia->id }}"
                                {{ old('potfuente_id',$registroCpu?->potfuente_id) == $potencia->id ? 'selected' : '' }}>
                                {{ $potencia->potencia }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

                <div class="registro-field">
                    <label>CABLE DE PODER</label>

                    <select name="cable_id"
                            id="cable_id"
                            class="form-control">

                        <option value="" disabled>SELECCIONAR</option>

                        @foreach ($disipadorram as $cable)
                            <option value="{{ $cable->id }}"
                                {{ old('cable_id',$registroCpu?->cable_id) == $cable->id ? 'selected' : '' }}>
                                {{ $cable->opcion }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         LECTOR Y FALLA
         ========================================================= --}}
    <div class="registro-section">

        <div class="registro-section-title">
            <i class="fas fa-tools"></i>
            DIAGNÓSTICO Y RECEPCIÓN
        </div>

        <div class="row">

            <div class="col-md-3 registro-component">

                <div class="registro-component-title">
                    LECTOR CD
                </div>

                <div class="registro-field">

                    <label for="marcacd_id">
                        MARCA
                    </label>

                    <select name="marcacd_id"
                            id="marcacd_id"
                            class="form-control">

                        <option value="" disabled>
                            SELECCIONAR
                        </option>

                        @foreach ($marcalectorcd as $marca)
                            <option value="{{ $marca->id }}"
                                {{ old('marcacd_id',$registroCpu?->maracd_id) == $marca->id ? 'selected' : '' }}>
                                {{ $marca->nombre }}
                            </option>
                        @endforeach

                        <option value="">QUITAR</option>
                    </select>

                    <input type="text"
                           name="marcacd_otro"
                           id="marcacd_otro"
                           class="form-control mt-2"
                           style="display:none;"
                           placeholder="Ingrese la marca">

                    {!! $errors->first('marcacd_id',
                        '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

            </div>


            <div class="col-md-3 registro-field">

                <label for="falla" class="form-label">
                    TIPO DE FALLA
                </label>

                <input type="text"
                       name="falla"
                       class="form-control @error('falla') is-invalid @enderror"
                       value="{{ old('falla', $registroCpu?->falla) }}"
                       id="falla"
                       placeholder="Falla">

                {!! $errors->first('falla',
                    '<div class="invalid-feedback"><strong>:message</strong></div>') !!}

            </div>


            <div class="col-md-3 registro-field">

                <label for="respaldo" class="form-label">
                    ¿REQUIERE RESPALDO?
                </label>

                <select name="respaldo"
                        id="respaldo"
                        class="form-control @error('respaldo') is-invalid @enderror">

                    <option value="" disabled>
                        SELECCIONE UNA OPCIÓN
                    </option>

                    <option value="SI"
                        {{ old('respaldo', $registroCpu?->respaldo) == 'SI' ? 'selected' : '' }}>
                        SI
                    </option>

                    <option value="NO"
                        {{ old('respaldo', $registroCpu?->respaldo) == 'NO' ? 'selected' : '' }}>
                        NO
                    </option>

                </select>

                {!! $errors->first('respaldo',
                    '<div class="invalid-feedback"><strong>:message</strong></div>') !!}

            </div>


            <div class="col-md-3 registro-field">

                <label for="otro" class="form-label">
                    OTROS
                </label>

                <input type="text"
                       name="otro"
                       class="form-control @error('otro') is-invalid @enderror"
                       value="{{ old('otro', $registroCpu?->otro) }}"
                       id="otro"
                       placeholder="Otros">

                {!! $errors->first('otro',
                    '<div class="invalid-feedback"><strong>:message</strong></div>') !!}

            </div>

        </div>


        <div class="row">

            <div class="col-md-8 registro-field">

                <label for="observaciones" class="form-label">
                    OBSERVACIONES
                </label>

                <textarea name="observaciones"
                          id="observaciones"
                          rows="3"
                          class="form-control @error('observaciones') is-invalid @enderror"
                          placeholder="Observaciones">{{ old('observaciones', $registroCpu?->observaciones) }}</textarea>

                {!! $errors->first('observaciones',
                    '<div class="invalid-feedback"><strong>:message</strong></div>') !!}

            </div>


            <div class="col-md-4 registro-field">

                <label for="estado_id" class="form-label">
                    ESTADO
                </label>

                <select name="estado_id"
                        id="estado_id"
                        class="form-control @error('estado_id') is-invalid @enderror">

                    <option value="" disabled>
                        SELECCIONAR
                    </option>

                    @foreach ($estado as $estados)

                        <option value="{{ $estados->id }}"
                            {{ old('estado_id',$registroCpu?->estado_id) == $estados->id ? 'selected' : '' }}>
                            {{ $estados->nombre }}
                        </option>

                    @endforeach

                </select>

                {!! $errors->first('estado_id',
                    '<div class="invalid-feedback"><strong>:message</strong></div>') !!}

            </div>

        </div>

    </div>

</div>