<div class="row">
    <div class="col-md-12">
        <!-- =====================================================
             DATOS PERSONALES
             ===================================================== -->
        <div class="registro-section">
            <div class="registro-section-title">
                <i class="fas fa-user"></i>
                DATOS PERSONALES
            </div>
            <div class="row">
                <!-- APELLIDO PATERNO -->
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
                               value="{{ old('paterno', $user?->paterno) }}"
                               placeholder="Apellido paterno"
                               required>
                        {!! $errors->first(
                            'paterno',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}
                    </div>
                </div>
                <!-- APELLIDO MATERNO -->
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
                               value="{{ old('materno', $user?->materno) }}"
                               placeholder="Apellido materno"
                               required>
                        {!! $errors->first(
                            'materno',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}
                    </div>
                </div>
                <!-- NOMBRE -->
                <div class="col-md-4">
                    <div class="registro-field">
                        <label for="name">
                            <i class="fas fa-id-badge"></i>
                            NOMBRE
                            <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user?->name) }}"
                               placeholder="Nombre"
                               required>
                        {!! $errors->first(
                            'name',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}
                    </div>
                </div>
            </div>

       
        <!-- =====================================================
             DOCUMENTACIÓN Y CONTACTO
             ===================================================== -->
        <div class="registro-section">
            <div class="registro-section-title">
                <i class="fas fa-address-card"></i>
                DOCUMENTACIÓN Y CONTACTO
            </div>
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
                               value="{{ old('ci', $user?->ci) }}"
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
                            <option value="" disabled>
                                SELECCIONE UNA OPCIÓN
                            </option>
                            <option value="LP"
                                {{ old('expedido', $user?->expedido) == 'LP' ? 'selected' : '' }}>
                                LA PAZ
                            </option>
                            <option value="CB"
                                {{ old('expedido', $user?->expedido) == 'CB' ? 'selected' : '' }}>
                                COCHABAMBA
                            </option>
                            <option value="SC"
                                {{ old('expedido', $user?->expedido) == 'SC' ? 'selected' : '' }}>
                                SANTA CRUZ
                            </option>
                            <option value="OR"
                                {{ old('expedido', $user?->expedido) == 'OR' ? 'selected' : '' }}>
                                ORURO
                            </option>
                            <option value="CH"
                                {{ old('expedido', $user?->expedido) == 'CH' ? 'selected' : '' }}>
                                CHUQUISACA
                            </option>
                            <option value="PO"
                                {{ old('expedido', $user?->expedido) == 'PO' ? 'selected' : '' }}>
                                POTOSÍ
                            </option>
                            <option value="T"
                                {{ old('expedido', $user?->expedido) == 'T' ? 'selected' : '' }}>
                                TARIJA
                            </option>
                            <option value="B"
                                {{ old('expedido', $user?->expedido) == 'B' ? 'selected' : '' }}>
                                BENI
                            </option>
                            <option value="P"
                                {{ old('expedido', $user?->expedido) == 'P' ? 'selected' : '' }}>
                                PANDO
                            </option>
                            <option value="QR"
                                {{ old('expedido', $user?->expedido) == 'QR' ? 'selected' : '' }}>
                                QUILLACOLLO
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
                            <span class="required">*</span>
                        </label>
                        <input type="text"
                               name="celular"
                               id="celular"
                               class="form-control @error('celular') is-invalid @enderror"
                               value="{{ old('celular', $user?->celular) }}"
                               placeholder="Número de celular"
                               required>
                        {!! $errors->first(
                            'celular',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- CORREO -->
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
                               value="{{ old('email', $user?->email) }}"
                               placeholder="correo@ejemplo.com"
                               required>
                        {!! $errors->first(
                            'email',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}
                    </div>
                </div>
                <!-- ESTADO -->
                <div class="col-md-6">
                    <div class="registro-field">
                        <label for="id_estadousuario">
                            <i class="fas fa-toggle-on"></i>
                            ESTADO
                            <span class="required">*</span>
                        </label>
                        <select name="id_estadousuario"
                                id="id_estadousuario"
                                class="form-control @error('id_estadousuario') is-invalid @enderror"
                                required>
                            <option value="" disabled>
                                SELECCIONE UN ESTADO
                            </option>
                            @foreach ($estados as $item)
                                <option value="{{ $item->id }}"
                                    {{ old(
                                        'id_estadousuario',
                                        $user?->id_estadousuario
                                    ) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nombre }}
                                </option>
                            @endforeach
                        </select>
                        {!! $errors->first(
                            'id_estadousuario',
                            '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>'
                        ) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="registro-section">
            <div class="row">
            <!-- =====================================================
                ESPECIALIDADES
                ===================================================== -->
            <div class="col-md-12">

                <div class="registro-field">
                    <div class="registro-section-title">
                        <label>
                            <i class="fas fa-tools"></i>
                            ESPECIALIDADES
                            <span class="required">*</span>
                        </label>
                    </div>

                    <div class="roles-container">
                        @foreach ($especialidades as $especialidad)
                            <label class="rol-option"
                                for="especialidad-{{ $user->id }}-{{ $especialidad->id }}">
                                <input type="checkbox" name="especialidades[]" value="{{ $especialidad->id }}"
                                    id="especialidad-{{ $user->id }}-{{ $especialidad->id }}"
                                    {{ $user->especialidades->contains('id', $especialidad->id) ? 'checked' : '' }}>
                                <i class="fas fa-tools"></i>
                                {{ $especialidad->nombre }}
                            </label>
                        @endforeach
                   </div>

                    @error('especialidades')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                </div>

            </div>
        </div>
        </div>
        <!-- =====================================================
             ROLES DEL TÉCNICO
             ===================================================== -->
        <div class="registro-section">

            <div class="registro-section-title">
                <i class="fas fa-user-shield"></i>
                ROL
            </div>

            <div class="registro-field">

                <div class="roles-container">
                    @foreach ($roles as $rol)
                        <label class="rol-option"
                            for="rol-{{ $user->id }}-{{ $rol->id }}">

                            <input type="checkbox"
                                name="roles[]"
                                value="{{ $rol->id }}"
                                id="rol-{{ $user->id }}-{{ $rol->id }}"
                                {{ in_array(
                                        $rol->id,
                                        $user->roles->pluck('id')->toArray()
                                ) ? 'checked' : '' }}

                                @if (!auth()->user()->hasRole('SuperAdministrador'))
                                    onclick="return false;"
                                @endif
                            >

                            <i class="fas fa-user-check"></i>

                            {{ $rol->name }}

                        </label>
                    @endforeach
                </div>
                {!! $errors->first(
                    'roles',
                    '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>'
                ) !!}
            </div>
        </div>

        <!-- =====================================================
             INFORMACIÓN
             ===================================================== -->
        <div class="registro-required">
            <i class="fas fa-info-circle"></i>
            Verifique los datos antes de guardar los cambios.
            Los campos marcados con
            <strong>*</strong>
            son obligatorios.
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  