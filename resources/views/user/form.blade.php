<div class="row">

    {{-- =====================================================
         DATOS PERSONALES
    ====================================================== --}}
    <div class="col-md-12">

        <div class="registro-section">

            <div class="registro-section-title">
                <i class="fas fa-id-card"></i>
                DATOS PERSONALES
            </div>


            <div class="row">

                {{-- APELLIDO PATERNO --}}
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="paterno{{ $user->id }}">
                            APELLIDO PATERNO
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="paterno"
                               class="form-control @error('paterno') is-invalid @enderror"
                               value="{{ old('paterno', $user?->paterno) }}"
                               id="paterno{{ $user->id }}"
                               placeholder="Apellido paterno"
                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                               required>

                        {!! $errors->first(
                            'paterno',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>


                {{-- APELLIDO MATERNO --}}
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="materno{{ $user->id }}">
                            APELLIDO MATERNO
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="materno"
                               class="form-control @error('materno') is-invalid @enderror"
                               value="{{ old('materno', $user?->materno) }}"
                               id="materno{{ $user->id }}"
                               placeholder="Apellido materno"
                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                               required>

                        {!! $errors->first(
                            'materno',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>


                {{-- NOMBRE --}}
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="name{{ $user->id }}">
                            NOMBRE
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $user?->name) }}"
                               id="name{{ $user->id }}"
                               placeholder="Nombre"
                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                               required>

                        {!! $errors->first(
                            'name',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>

            </div>


            <div class="row">

                {{-- C.I. --}}
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="ci{{ $user->id }}">
                            C.I.
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="ci"
                               class="form-control @error('ci') is-invalid @enderror"
                               value="{{ old('ci', $user?->ci) }}"
                               id="ci{{ $user->id }}"
                               placeholder="Número de C.I."
                               minlength="6"
                               maxlength="10"
                               inputmode="numeric"
                               required>

                        {!! $errors->first(
                            'ci',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>


                {{-- EXPEDIDO --}}
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="expedido{{ $user->id }}">
                            EXPEDIDO
                            <span class="required">*</span>
                        </label>

                        <select name="expedido"
                                id="expedido{{ $user->id }}"
                                class="form-control"
                                required>

                            <option value=""
                                    disabled
                                    {{ old('expedido', $user?->expedido) ? '' : 'selected' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            <option value="QR"
                                {{ old('expedido', $user?->expedido) == 'QR' ? 'selected' : '' }}>
                                QR
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

                        </select>

                    </div>

                </div>


                {{-- CELULAR --}}
                <div class="col-md-4">

                    <div class="registro-field">

                        <label for="celular{{ $user->id }}">
                            CELULAR
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="celular"
                               class="form-control @error('celular') is-invalid @enderror"
                               value="{{ old('celular', $user?->celular) }}"
                               id="celular{{ $user->id }}"
                               placeholder="Número de celular"
                               maxlength="8"
                               inputmode="numeric"
                               required>

                        {!! $errors->first(
                            'celular',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             ACCESO Y ESTADO
        ====================================================== --}}
        <div class="registro-section">

            <div class="registro-section-title">
                <i class="fas fa-user-shield"></i>
                ACCESO Y ESTADO
            </div>


            <div class="row">

                {{-- CORREO --}}
                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="email{{ $user->id }}">
                            CORREO ELECTRÓNICO
                            <span class="required">*</span>
                        </label>

                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $user?->email) }}"
                               id="email{{ $user->id }}"
                               placeholder="correo@ejemplo.com"
                               required>

                        {!! $errors->first(
                            'email',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>


                {{-- ESTADO --}}
                <div class="col-md-6">

                    <div class="registro-field">

                        <label for="id_estadousuario{{ $user->id }}">
                            ESTADO
                            <span class="required">*</span>
                        </label>

                        <select name="id_estadousuario"
                                id="id_estadousuario{{ $user->id }}"
                                class="form-control @error('id_estadousuario') is-invalid @enderror"
                                required>

                            <option value=""
                                    disabled
                                    {{ old('id_estadousuario', $user?->id_estadousuario) ? '' : 'selected' }}>
                                SELECCIONE UNA OPCIÓN
                            </option>

                            @foreach ($estados as $item)

                                <option value="{{ $item->id }}"
                                    {{ old('id_estadousuario', $user?->id_estadousuario) == $item->id ? 'selected' : '' }}>

                                    {{ $item->nombre }}

                                </option>

                            @endforeach

                        </select>

                        {!! $errors->first(
                            'id_estadousuario',
                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                        ) !!}

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
             ROLES
        ====================================================== --}}
        <div class="registro-section">

            <div class="registro-section-title">
                <i class="fas fa-user-tag"></i>
                ROLES DEL USUARIO
            </div>


            <div class="roles-container">

                @foreach ($roles as $rol)

                    <label class="rol-option">

                        <input type="checkbox"
                               name="roles[]"
                               value="{{ $rol->id }}"
                               id="rol-{{ $rol->id }}-{{ $user->id }}"
                               @if(in_array($rol->id, $user->roles->pluck('id')->toArray()))
                                   checked
                               @endif>

                        <span>
                            {{ $rol->name }}
                        </span>

                    </label>

                @endforeach

            </div>

        </div>


        {{-- =====================================================
             INFORMACIÓN
        ====================================================== --}}
        <div class="registro-required">

            <i class="fas fa-info-circle"></i>

            Los campos marcados con
            <span class="required">*</span>
            son obligatorios.

        </div>

    </div>

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
