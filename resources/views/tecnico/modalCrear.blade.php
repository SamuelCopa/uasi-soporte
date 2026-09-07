<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">

{{-- SELECT2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

<div class="modal fade"
     id="crear"
     tabindex="-1"
     role="dialog"
     aria-labelledby="crearTecnicoModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content modal-password">

            {{-- =====================================================
                 CABECERA
            ====================================================== --}}
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>

                    <div>
                        <h4 class="modal-title">
                            REGISTRAR TÉCNICO
                        </h4>

                        <small>
                            Registro de nuevo técnico del sistema
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
            ====================================================== --}}
            <form method="POST"
                  action="{{ route('tecnicos.store') }}"
                  autocomplete="off">

                @csrf


                {{-- =================================================
                     CUERPO
                ================================================== --}}
                <div class="modal-body modal-password-body">


                    {{-- =================================================
                         DATOS DEL TÉCNICO
                    ================================================== --}}
                    <div class="registro-section">

                        <div class="registro-section-title">

                            <i class="fas fa-id-card"></i>

                            DATOS DEL TÉCNICO

                        </div>


                        {{-- APELLIDOS Y NOMBRE --}}
                        <div class="row">

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


                        {{-- C.I. / EXPEDIDO / CORREO --}}
                        <div class="row">

                            <div class="col-md-4">

                                <div class="registro-field">

                                    <label for="ci">
                                        C.I.
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text"
                                           name="ci"
                                           class="form-control @error('ci') is-invalid @enderror"
                                           id="ci"
                                           placeholder="Número de C.I."
                                           minlength="6"
                                           maxlength="10"
                                           pattern="[0-9]{6,10}"
                                           inputmode="numeric"
                                           required>

                                    {!! $errors->first(
                                        'ci',
                                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                                    ) !!}

                                </div>

                            </div>


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

                                        <option value=""
                                                disabled
                                                selected>
                                            SELECCIONE UNA OPCIÓN
                                        </option>

                                        <option value="QR">QR</option>
                                        <option value="LP">LA PAZ</option>
                                        <option value="CB">COCHABAMBA</option>
                                        <option value="SC">SANTA CRUZ</option>
                                        <option value="OR">ORURO</option>
                                        <option value="CH">CHUQUISACA</option>
                                        <option value="PO">POTOSÍ</option>
                                        <option value="T">TARIJA</option>
                                        <option value="B">BENI</option>
                                        <option value="P">PANDO</option>

                                    </select>

                                </div>

                            </div>


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


                        {{-- CELULAR / CONTRASEÑA --}}
                        <div class="row">

                            <div class="col-md-6">

                                <div class="registro-field">

                                    <label for="celular">
                                        CELULAR
                                        <span class="required">*</span>
                                    </label>

                                    <input type="text"
                                           name="celular"
                                           class="form-control @error('celular') is-invalid @enderror"
                                           id="celular"
                                           placeholder="Número de celular"
                                           minlength="8"
                                           maxlength="8"
                                           pattern="[0-9]{8}"
                                           inputmode="numeric"
                                           required>

                                    {!! $errors->first(
                                        'celular',
                                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                                    ) !!}

                                </div>

                            </div>


                            <div class="col-md-6">

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
                                                onclick="togglePassword('password', this)"
                                                aria-label="Mostrar contraseña">

                                            <i class="fas fa-eye"></i>

                                        </button>

                                    </div>

                                    {!! $errors->first(
                                        'password',
                                        '<div class="invalid-feedback"><strong>:message</strong></div>'
                                    ) !!}

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                             ESPECIALIDADES
                        ================================================== --}}
 {{-- ESPECIALIDADES --}}
<div class="col-md-4">

    <div class="registro-field">

        <label>
            ESPECIALIDADES
            <span class="required">*</span>
        </label>

        <div class="roles-container">

            @foreach ($especialidades as $especialidad)

                <label class="rol-option">

                    <input type="checkbox"
                           name="especialidades[]"
                           value="{{ $especialidad->id }}"
                           {{ in_array(
                               $especialidad->id,
                               old('especialidades', [])
                           ) ? 'checked' : '' }}>

                    <span>
                        {{ $especialidad->nombre }}
                    </span>

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


                        {{-- =================================================
                             INFORMACIÓN DE CONTRASEÑA
                        ================================================== --}}
                        <div class="registro-required">

                            <i class="fas fa-info-circle"></i>

                            La contraseña inicial corresponde al número de
                            C.I. del técnico.

                        </div>

                    </div>


                    {{-- =================================================
                         ESTADO DEL USUARIO
                    ================================================== --}}
                    <input type="hidden"
                           name="id_estadousuario"
                           value="{{ $estados?->first()->id }}">


                    {{-- CONFIRMACIÓN AUTOMÁTICA --}}
                    <input type="hidden"
                           name="password_confirmation"
                           id="password_confirmation">


                    {{-- CAMPOS OBLIGATORIOS --}}
                    <div class="registro-required">

                        <i class="fas fa-check-circle"></i>

                        Los campos marcados con
                        <span class="required">*</span>
                        son obligatorios.

                    </div>

                </div>


                {{-- =====================================================
                     FOOTER
                ====================================================== --}}
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


{{-- =====================================================
     JQUERY
====================================================== --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


{{-- =====================================================
     SELECT2
====================================================== --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
$(document).ready(function () {

    $('#especialidades').select2({
        placeholder: 'SELECCIONE UNA O MÁS ESPECIALIDADES',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#crear')
    });

});
</script>


{{-- =====================================================
     SCRIPT DE CONTRASEÑA
====================================================== --}}
<script src="{{ asset('js/pass.js') }}"></script>