```blade
<div class="modal fade"
     id="crearu"
     tabindex="-1"
     role="dialog"
     aria-labelledby="crearUPSModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content modal-password">

            {{-- =====================================================
                 CABECERA
            ====================================================== --}}
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-plug"></i>
                    </div>

                    <div>
                        <h4 class="modal-title">
                            REGISTRAR U.P.S.
                        </h4>

                        <small>
                            Registro de recepción y mantenimiento de equipo
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
                  action="{{ route('upeses.store') }}">

                @csrf


                {{-- =================================================
                     CUERPO
                ================================================== --}}
                <div class="modal-body modal-password-body">


                    {{-- =================================================
                         DATOS DEL SOLICITANTE
                    ================================================== --}}
                    <div class="registro-section">

                        <div class="registro-section-title">

                            <i class="fas fa-user"></i>

                            DATOS DEL SOLICITANTE

                        </div>


                        {{-- TIPO DE FUNCIONARIO --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="registro-field">
                                    <label for="miSelect">
                                        <i class="fas fa-user-check"></i>
                                        TIPO DE FUNCIONARIO
                                        <span class="required">*</span>
                                    </label>

                                    <select name="funcionario_activo"
                                            id="miSelect"
                                            class="form-control"
                                            required>

                                        <option value="" disabled selected>
                                            SELECCIONE UNA OPCIÓN
                                        </option>

                                        <option value="1">
                                            FUNCIONARIO ACTIVO
                                        </option>

                                        <option value="0">
                                            EX FUNCIONARIO
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>


                        <div id="formulariou">

                            {{-- C.I. / EXPEDIDO / CELULAR --}}
                            <div class="row">

                                <div class="col-md-4">

                                    <div class="registro-field">

                                        <label for="ci">
                                            C.I.
                                            <span class="required">*</span>
                                        </label>

                                        <div class="password-input">

                                            <input type="number"
                                                   name="ci"
                                                   id="ci"
                                                   class="form-control @error('ci') is-invalid @enderror"
                                                   placeholder="Ingrese C.I."
                                                   required>

                                        </div>

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
                                            <option value="PO">POTOSI</option>
                                            <option value="T">TARIJA</option>
                                            <option value="B">BENI</option>
                                            <option value="P">PANDO</option>

                                        </select>

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <div class="registro-field">

                                        <label for="celular">
                                            CELULAR
                                            <span class="required">*</span>
                                        </label>

                                        <input type="number"
                                               name="celular"
                                               id="celular"
                                               class="form-control @error('celular') is-invalid @enderror"
                                               placeholder="Ingrese celular"
                                               required>

                                        {!! $errors->first(
                                            'celular',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>

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
                                               id="paterno"
                                               class="form-control @error('paterno') is-invalid @enderror"
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
                                               id="materno"
                                               class="form-control @error('materno') is-invalid @enderror"
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

                                        <label for="nombre">
                                            NOMBRE(S)
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="nombre"
                                               id="nombre"
                                               class="form-control @error('nombre') is-invalid @enderror"
                                               placeholder="Nombre(s)"
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                               required>

                                        {!! $errors->first(
                                            'nombre',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>

                            </div>


                            {{-- CARGO / CORREO --}}
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="cargo">
                                            CARGO
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="cargo"
                                               id="cargo"
                                               class="form-control @error('cargo') is-invalid @enderror"
                                               placeholder="Cargo"
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                               required>

                                        {!! $errors->first(
                                            'cargo',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="email">
                                            CORREO ELECTRÓNICO
                                            <span class="required">*</span>
                                        </label>

                                        <input type="email"
                                               name="email"
                                               id="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               placeholder="correo@ejemplo.com"
                                               required>

                                        {!! $errors->first(
                                            'email',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>

                            </div>


                            {{-- DEPENDENCIA / FECHA --}}
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="search-inputU">
                                            DEPENDENCIA
                                        </label>

                                        <input type="text"
                                               id="search-inputU"
                                               list="optionsU"
                                               placeholder="Buscar dependencia..."
                                               class="form-control">

                                        <datalist id="optionsU">

                                            <option value=""></option>

                                            @foreach ($dependencia as $item)

                                                <option value="{{ $item->dependencias }}"
                                                        data-id="{{ $item->id }}">
                                                </option>

                                            @endforeach

                                            <option value=" ">
                                                QUITAR
                                            </option>

                                        </datalist>

                                        <input type="hidden"
                                               id="id-selectedU"
                                               name="dependencia_id">

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="fecha">
                                            FECHA DE RECEPCIÓN
                                            <span class="required">*</span>
                                        </label>

                                        <input type="datetime-local"
                                               name="fecha"
                                               id="fecha"
                                               class="form-control @error('fecha') is-invalid @enderror"
                                               value="{{ old('fecha', date('Y-m-d\TH:i:s')) }}"
                                               readonly
                                               required>

                                        {!! $errors->first(
                                            'fecha',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         DATOS DEL U.P.S.
                    ================================================== --}}
                    <div id="formulariou2">

                        <div class="registro-section">

                            <div class="registro-section-title">

                                <i class="fas fa-plug"></i>

                                DATOS DEL U.P.S.

                            </div>


                            {{-- CÓDIGO GAMEA --}}
                            <div class="row">

                                <div class="col-md-4">

                                    <div class="registro-field">

                                        <label for="cod_gamea">
                                            CÓDIGO GAMEA
                                            <span class="required">*</span>
                                        </label>

                                        <input type="number"
                                               name="cod_gamea"
                                               id="cod_gamea"
                                               class="form-control @error('cod_gamea') is-invalid @enderror"
                                               placeholder="Código GAMEA"
                                               required>

                                        {!! $errors->first(
                                            'cod_gamea',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>

                            </div>


                            {{-- MARCA / MODELO --}}
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="marca">
                                            MARCA
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="marca"
                                               id="marca"
                                               class="form-control @error('marca') is-invalid @enderror"
                                               placeholder="Marca"
                                               required>

                                        {!! $errors->first(
                                            'marca',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="modelo">
                                            MODELO
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="modelo"
                                               id="modelo"
                                               class="form-control @error('modelo') is-invalid @enderror"
                                               placeholder="Modelo"
                                               required>

                                        {!! $errors->first(
                                            'modelo',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>

                            </div>


                            {{-- FALLA / OBSERVACIONES --}}
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="falla">
                                            FALLA
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="falla"
                                               id="falla"
                                               class="form-control @error('falla') is-invalid @enderror"
                                               placeholder="Describa la falla"
                                               required>

                                        {!! $errors->first(
                                            'falla',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="observaciones">
                                            OBSERVACIONES
                                        </label>

                                        <input type="text"
                                               name="observaciones"
                                               id="observaciones"
                                               class="form-control @error('observaciones') is-invalid @enderror"
                                               placeholder="Observaciones">

                                        {!! $errors->first(
                                            'observaciones',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>'
                                        ) !!}

                                    </div>

                                </div>

                            </div>


                            {{-- ESTADO --}}
                            <input type="hidden"
                                   name="estado_id"
                                   value="{{ $estado?->first()->id }}">


                            {{-- CAMPOS OBLIGATORIOS --}}
                            <div class="registro-required">

                                <i class="fas fa-info-circle"></i>

                                Los campos marcados con
                                <span class="required">*</span>
                                son obligatorios.

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     FOOTER
                ================================================== --}}
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

                        CANCELAR

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
