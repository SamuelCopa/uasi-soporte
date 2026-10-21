<!-- =========================================================
     MODAL REGISTRAR LAPTOP
     ========================================================= -->
<div class="modal fade"
     id="crearl"
     tabindex="-1"
     role="dialog"
     aria-labelledby="crearLaptopLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

        <div class="modal-content modal-password">

            <!-- =================================================
                 HEADER
                 ================================================= -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-laptop"></i>
                    </div>

                    <div>
                        <h5 class="modal-title" id="crearLaptopLabel">
                            REGISTRAR LAPTOP
                        </h5>

                        <small>
                            Registro de los datos del equipo y funcionario
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


            <!-- =================================================
                 FORMULARIO
                 ================================================= -->
            <form method="POST"
                  action="{{ route('laptops.store') }}"
                  autocomplete="off">

                @csrf


                <!-- =================================================
                     BODY
                     ================================================= -->
                <div class="modal-body modal-password-body">


                    <!-- =================================================
                         DATOS DEL SOLICITANTE
                         ================================================= -->
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


                        <!-- CAMPOS DINÁMICOS -->
                        <div id="formulariol">

                            <!-- C.I. / EXPEDIDO / CELULAR -->
                            <div class="row">

                                <div class="col-md-4">

                                    <div class="registro-field">

                                        <label for="ci">

                                            <i class="fas fa-id-card"></i>
                                            C.I.
                                            <span class="required">*</span>

                                        </label>

                                        <input type="text"
                                               name="ci"
                                               class="form-control @error('ci') is-invalid @enderror"
                                               id="ci"
                                               placeholder="Carnet de identidad"
                                               required>

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

                                            <i class="fas fa-phone-alt"></i>
                                            CELULAR
                                            <span class="required">*</span>

                                        </label>

                                        <input type="number"
                                               name="celular"
                                               class="form-control @error('celular') is-invalid @enderror"
                                               id="celular"
                                               placeholder="Número de celular"
                                               required>

                                        {!! $errors->first('celular',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                                        !!}

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
                                            <span class="required">*</span>

                                        </label>

                                        <input type="text"
                                               name="paterno"
                                               class="form-control @error('paterno') is-invalid @enderror"
                                               id="paterno"
                                               placeholder="Apellido paterno"
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                               required>

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
                                            <span class="required">*</span>

                                        </label>

                                        <input type="text"
                                               name="materno"
                                               class="form-control @error('materno') is-invalid @enderror"
                                               id="materno"
                                               placeholder="Apellido materno"
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                               required>

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
                                            <span class="required">*</span>

                                        </label>

                                        <input type="text"
                                               name="nombre"
                                               class="form-control @error('nombre') is-invalid @enderror"
                                               id="nombre"
                                               placeholder="Nombre(s)"
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                               required>

                                        {!! $errors->first('nombre',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                                        !!}

                                    </div>

                                </div>

                            </div>


                            <!-- CARGO / CORREO -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field" id="cargoA">

                                        <label for="cargo">

                                            <i class="fas fa-briefcase"></i>
                                            CARGO
                                            <span class="required">*</span>

                                        </label>

                                        <input type="text"
                                               name="cargo"
                                               class="form-control @error('cargo') is-invalid @enderror"
                                               id="cargo"
                                               placeholder="Cargo"
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                               required>

                                        {!! $errors->first('cargo',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                                        !!}

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <div class="registro-field" id="emailL">

                                        <label for="email">

                                            <i class="fas fa-envelope"></i>
                                            CORREO ELECTRÓNICO
                                            <span class="required">*</span>

                                        </label>

                                        <input type="email"
                                               name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               id="email"
                                               placeholder="Correo electrónico"
                                               required>

                                        {!! $errors->first('email',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                                        !!}

                                    </div>

                                </div>

                            </div>


                            <!-- DEPENDENCIA / FECHA -->
                            <div class="row">

<div class="col-md-8">
    <div class="registro-field" id="search-inputLL">

        <label for="search-inputL">
            <i class="fas fa-building"></i>
            DEPENDENCIA
        </label>

        <input type="text"
               id="search-inputL"
               list="optionsL"
               placeholder="Buscar dependencia..."
               class="form-control"
               autocomplete="off">

        <datalist id="optionsL">
            @foreach ($dependencia as $item)
                <option value="{{ $item->dependencias }}"
                        data-id="{{ $item->id }}">
                </option>
            @endforeach
        </datalist>

        <input type="hidden"
               id="id-selectedL"
               name="dependencia_id"
               value="">

    </div>
</div>


                                <div class="col-md-4">

                                    <div class="registro-field">

                                        <label for="fecha">

                                            <i class="fas fa-calendar-alt"></i>
                                            FECHA DE RECEPCIÓN
                                            <span class="required">*</span>

                                        </label>

                                        <input type="datetime-local"
                                               name="fecha"
                                               class="form-control @error('fecha') is-invalid @enderror"
                                               value="{{ old('fecha_hora', date('Y-m-d\TH:i:s')) }}"
                                               id="fecha"
                                               readonly
                                               required>

                                        {!! $errors->first('fecha',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                                        !!}

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         DATOS DE LA LAPTOP
                         ================================================= -->
                    <div id="formulariol2">

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
                                               id="contrasena"
                                               placeholder="Contraseña">

                                        {!! $errors->first('contrasena',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                                        !!}

                                    </div>

                                </div>

                            </div>


                            <!-- CÓDIGO GAMEA -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="cod_gamea">

                                            <i class="fas fa-barcode"></i>
                                            CÓDIGO GAMEA
                                            <span class="required">*</span>

                                        </label>

                                        <input type="number"
                                               name="cod_gamea"
                                               class="form-control @error('cod_gamea') is-invalid @enderror"
                                               id="cod_gamea"
                                               placeholder="Código GAMEA"
                                               required>

                                        {!! $errors->first('cod_gamea',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                                        !!}

                                    </div>

                                </div>

                            </div>


                            <!-- MARCA / MODELO -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="marca">

                                            <i class="fas fa-laptop"></i>
                                            MARCA
                                            <span class="required">*</span>

                                        </label>

                                        <input type="text"
                                               name="marca"
                                               class="form-control @error('marca') is-invalid @enderror"
                                               id="marca"
                                               placeholder="Marca"
                                               required>

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
                                            <span class="required">*</span>

                                        </label>

                                        <input type="text"
                                               name="modelo"
                                               class="form-control @error('modelo') is-invalid @enderror"
                                               id="modelo"
                                               placeholder="Modelo"
                                               required>

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
                                            <span class="required">*</span>

                                        </label>

                                        <input type="text"
                                               name="falla"
                                               class="form-control @error('falla') is-invalid @enderror"
                                               id="falla"
                                               placeholder="Describa la falla"
                                               required>

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
                                               id="observaciones"
                                               placeholder="Observaciones">

                                        {!! $errors->first('observaciones',
                                            '<div class="invalid-feedback"><strong>:message</strong></div>')
                                        !!}

                                    </div>

                                </div>

                            </div>


                            <!-- ESTADO -->
                            <input type="hidden"
                                   name="estado_id"
                                   value="{{ $estado?->first()->id }}">


                            <!-- INFORMACIÓN -->
                            <div class="registro-required">

                                <i class="fas fa-info-circle"></i>

                                Verifique los datos registrados de la laptop
                                antes de guardar. Los campos marcados con
                                <span class="required">*</span>
                                son obligatorios.

                            </div>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     FOOTER
                     ================================================= -->
                <div class="modal-footer modal-password-footer">

                    <button type="button"
                            class="btn btn-password-close"
                            data-dismiss="modal">

                        <i class="fas fa-times"></i>
                        CANCELAR

                    </button>


                    <button type="submit"
                            class="btn btn-password-save">

                        <i class="fas fa-save"></i>
                        GUARDAR

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- =========================================================
     FIN MODAL REGISTRAR LAPTOP
     ========================================================= -->

<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">