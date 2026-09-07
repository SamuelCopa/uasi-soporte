<div class="modal fade"
     id="crear"
     tabindex="-1"
     role="dialog"
     aria-labelledby="crearModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content modal-password">

            {{-- =====================================================
                 CABECERA
                 ===================================================== --}}
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>

                    <div>
                        <h4 class="modal-title">
                            REGISTRAR USUARIO
                        </h4>

                        <small>
                            Registro de nuevo usuario del sistema
                        </small>
                    </div>

                </div>

                <button type="button"
                        class="close modal-password-close"
                        data-dismiss="modal"
                        aria-label="Cerrar">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            {{-- =====================================================
                 FORMULARIO
                 ===================================================== --}}
            <form method="POST" action="{{ route('users.store') }}">

                @csrf

                <div class="modal-body modal-password-body">

                    {{-- =================================================
                         DATOS PERSONALES
                         ================================================= --}}
                    <div class="registro-section">

                        <div class="registro-section-title">
                            <i class="fas fa-id-card"></i>
                            DATOS PERSONALES
                        </div>


                        <div class="row">

                            {{-- PATERNO --}}
                            <div class="col-md-4">
                                <div class="registro-field">

                                    <label for="paterno">
                                        APELLIDO PATERNO
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text"
                                           name="paterno"
                                           class="form-control @error('paterno') is-invalid @enderror"
                                           id="paterno"
                                           placeholder="Apellido paterno"
                                           oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                           required>

                                    {!! $errors->first(
                                        'paterno',
                                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                                    ) !!}

                                </div>
                            </div>


                            {{-- MATERNO --}}
                            <div class="col-md-4">
                                <div class="registro-field">

                                    <label for="materno">
                                        APELLIDO MATERNO
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text"
                                           name="materno"
                                           class="form-control @error('materno') is-invalid @enderror"
                                           id="materno"
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

                                    <label for="name">
                                        NOMBRE
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text"
                                           name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           id="name"
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

                            {{-- CI --}}
                            <div class="col-md-4">
                                <div class="registro-field">

                                    <label for="ci">
                                        C.I.
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="ci"
                                           name="ci"
                                           placeholder="Ingrese C.I."
                                           minlength="6"
                                           maxlength="10"
                                           pattern="[0-9]{6,10}"
                                           inputmode="numeric"
                                           required>

                                </div>
                            </div>


                            {{-- EXPEDIDO --}}
                            <div class="col-md-4">
                                <div class="registro-field">

                                    <label for="expedido">
                                        EXPEDIDO
                                        <span class="required">*</span>
                                    </label>

                                    <select name="expedido"
                                            id="expedido"
                                            class="form-control"
                                            required>

                                        <option value="" disabled selected>
                                            SELECCIONE UNA OPCIÓN
                                        </option>

                                        <option value="QR">QR</option>
                                        <option value="LP">LA PAZ</option>
                                        <option value="CB">COCHABAMBA</option>
                                        <option value="SC">SANTA CRUZ</option>
                                        <option value="OR">ORURO</option>
                                        <option value="CH">CHUQUISACA</option>
                                        <option value="PO">POTOSI</option>
                                        <option value="T">TARIJA</option>
                                        <option value="B">BENI</option>
                                        <option value="P">PANDO</option>

                                    </select>

                                </div>
                            </div>


                            {{-- CORREO --}}
                            <div class="col-md-4">
                                <div class="registro-field">

                                    <label for="email">
                                        CORREO ELECTRÓNICO
                                        <span class="required">*</span>
                                    </label>

                                    <input type="email"
                                           name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           id="email"
                                           placeholder="correo@ejemplo.com"
                                           required>

                                    {!! $errors->first(
                                        'email',
                                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                                    ) !!}

                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         DATOS DE CONTACTO Y ACCESO
                         ================================================= --}}
                    <div class="registro-section">

                        <div class="registro-section-title">
                            <i class="fas fa-user-shield"></i>
                            ACCESO Y CONTACTO
                        </div>


                        <div class="row">

                            {{-- CELULAR --}}
                            <div class="col-md-4">

                                <div class="registro-field">

                                    <label for="celular">
                                        CELULAR
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text"
                                           class="form-control"
                                           id="celular"
                                           name="celular"
                                           placeholder="Ingrese celular"
                                           minlength="8"
                                           maxlength="8"
                                           pattern="[0-9]{8}"
                                           inputmode="numeric"
                                           required>

                                </div>

                            </div>


                            {{-- CONTRASEÑA --}}
                            <div class="col-md-4">

                                <div class="registro-field">

                                    <label for="password">
                                        CONTRASEÑA
                                        <span class="required">*</span>
                                    </label>

                                    <div class="password-input">

                                        <input type="password"
                                               name="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               id="password"
                                               placeholder="Número de C.I."
                                               required>

                                        <button type="button"
                                                class="password-toggle"
                                                onclick="togglePassword('password', this)">

                                            <i class="fas fa-eye"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>


                            {{-- ROL --}}
                            <div class="col-md-4">

                                <div class="registro-field">

                                    <label>
                                        ROL
                                        <span class="required">*</span>
                                    </label>

                                    <div class="roles-container">

                                        @foreach ($roles as $rol)

                                            <label class="rol-option">

                                                <input type="radio"
                                                       name="role"
                                                       value="{{ $rol->name }}"
                                                       required>

                                                <span>
                                                    {{ $rol->name }}
                                                </span>

                                            </label>

                                        @endforeach

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- CAMPOS OCULTOS --}}
                    <input type="hidden"
                           name="password_confirmation">

                    <input type="hidden"
                           name="id_estadousuario"
                           value="{{ $estados?->first()->id }}">


                    {{-- AVISO --}}
                    <div class="registro-required">
                        <i class="fas fa-info-circle"></i>

                        Los campos marcados con
                        <span class="required">*</span>
                        son obligatorios.
                    </div>

                </div>


                {{-- =====================================================
                     FOOTER
                     ===================================================== --}}
                <div class="modal-footer modal-password-footer">

                    <button type="submit"
                            class="btn btn-password-save">

                        <i class="fas fa-save"></i>
                        GUARDAR

                    </button>

                    <button type="button"
                            class="btn btn-password-close"
                            data-dismiss="modal">

                        <i class="fas fa-times"></i>
                        CERRAR

                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

<script src="{{ asset('js/pass.js') }}"></script>

<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
