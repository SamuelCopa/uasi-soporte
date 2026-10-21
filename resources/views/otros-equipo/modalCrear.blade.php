<!-- =========================================================
     MODAL REGISTRAR OTRO EQUIPO
     ========================================================= -->
<div class="modal fade"
     id="creara"
     tabindex="-1"
     role="dialog"
     aria-labelledby="crearOtroEquipoLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered"
         role="document">

        <div class="modal-content modal-password">

            <!-- =================================================
                 HEADER
                 ================================================= -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-desktop"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="crearOtroEquipoLabel">

                            REGISTRAR EQUIPO

                            <span id="nombreTipoEquipo"
                                  class="ml-1">
                            </span>

                        </h5>

                        <small>
                            Registro de nuevo equipo y datos del funcionario
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
                  action="{{ route('otros-equipos.store') }}"
                  autocomplete="off">

                @csrf

                <!-- Tipo de equipo -->
                <input type="hidden"
                       name="tipo_equipo_id"
                       id="tipo_equipo_id_a">


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


                        <!-- Tipo funcionario -->
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


                        <!-- =================================================
                             FORMULARIO FUNCIONARIO
                             ================================================= -->
                        <div id="formularioa">


                            <!-- CI / EXPEDIDO / CELULAR -->
                            <div class="row">

                                <!-- CI -->
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
                                               placeholder="Número de C.I."
                                               required>

                                        @error('ci')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>


                                <!-- Expedido -->
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

                                        @error('expedido')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>


                                <!-- Celular -->
                                <div class="col-md-4">

                                    <div class="registro-field">

                                        <label for="celular">
                                            <i class="fas fa-mobile-alt"></i>
                                            CELULAR
                                            <span class="required">*</span>
                                        </label>

                                        <input type="number"
                                               name="celular"
                                               id="celular"
                                               class="form-control @error('celular') is-invalid @enderror"
                                               placeholder="Número de celular"
                                               required>

                                        @error('celular')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 NOMBRES
                                 ================================================= -->
                            <div class="row">

                                <!-- Paterno -->
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
                                               placeholder="Apellido paterno"
                                               required
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                                        @error('paterno')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>


                                <!-- Materno -->
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
                                               placeholder="Apellido materno"
                                               required
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                                        @error('materno')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>


                                <!-- Nombre -->
                                <div class="col-md-4">

                                    <div class="registro-field">

                                        <label for="nombre">
                                            <i class="fas fa-user-tie"></i>
                                            NOMBRE(S)
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="nombre"
                                               id="nombre"
                                               class="form-control @error('nombre') is-invalid @enderror"
                                               placeholder="Nombre(s)"
                                               required
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                                        @error('nombre')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 CARGO / CORREO
                                 ================================================= -->
                            <div class="row">

                                <!-- Cargo -->
                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="cargo">
                                            <i class="fas fa-briefcase"></i>
                                            CARGO
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="cargo"
                                               id="cargo"
                                               class="form-control @error('cargo') is-invalid @enderror"
                                               placeholder="Cargo"
                                               required
                                               oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')">

                                        @error('cargo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>


                                <!-- Email -->
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
                                               placeholder="correo@ejemplo.com"
                                               required>

                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 DEPENDENCIA / FECHA
                                 ================================================= -->
                            <div class="row">

                                <!-- Dependencia -->
<div class="col-md-8">
    <div class="registro-field">

        <label for="search-inputA">
            <i class="fas fa-building"></i>
            DEPENDENCIA
            <span class="required">*</span>
        </label>

        <input type="text"
               id="search-inputA"
               list="optionsA"
               placeholder="Buscar dependencia..."
               class="form-control"
               autocomplete="off"
               required>

        <datalist id="optionsA">
            @foreach($dependencia as $item)
                <option value="{{ $item->dependencias }}"
                        data-id="{{ $item->id }}">
                </option>
            @endforeach
        </datalist>

        <input type="hidden"
               id="id-selectedA"
               name="dependencia_id"
               value="">

    </div>
</div>


                                <!-- Fecha -->
                                <div class="col-md-4">

                                    <div class="registro-field">

                                        <label for="fecha">
                                            <i class="fas fa-calendar-alt"></i>
                                            FECHA DE RECEPCIÓN
                                            <span class="required">*</span>
                                        </label>

                                        <input type="datetime-local"
                                               name="fecha"
                                               id="fecha"
                                               class="form-control @error('fecha') is-invalid @enderror"
                                               value="{{ old('fecha', date('Y-m-d\TH:i')) }}"
                                               readonly
                                               required>

                                        @error('fecha')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =========================================================
                         DATOS DEL EQUIPO
                         ========================================================= -->
                    <div id="formularioa2">

                        <div class="registro-section">

                            <div class="registro-section-title">
                                <i class="fas fa-desktop"></i>
                                DATOS DEL EQUIPO
                            </div>


                            <!-- Tipo seleccionado -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="nombre_tipo_equipo_a">
                                            <i class="fas fa-layer-group"></i>
                                            TIPO DE EQUIPO
                                        </label>

                                        <input type="text"
                                               id="nombre_tipo_equipo_a"
                                               class="form-control"
                                               readonly
                                               placeholder="Tipo seleccionado">

                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 CÓDIGO GAMEA
                                 ================================================= -->
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
                                               id="cod_gamea"
                                               class="form-control @error('cod_gamea') is-invalid @enderror"
                                               placeholder="Código GAMEA"
                                               required>

                                        @error('cod_gamea')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 MARCA / MODELO
                                 ================================================= -->
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="registro-field">

                                        <label for="marca">
                                            <i class="fas fa-tag"></i>
                                            MARCA
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="marca"
                                               id="marca"
                                               class="form-control @error('marca') is-invalid @enderror"
                                               placeholder="Marca"
                                               required>

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
                                            <span class="required">*</span>
                                        </label>

                                        <input type="text"
                                               name="modelo"
                                               id="modelo"
                                               class="form-control @error('modelo') is-invalid @enderror"
                                               placeholder="Modelo"
                                               required>

                                        @error('modelo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>


                            <!-- =================================================
                                 FALLA / OBSERVACIONES
                                 ================================================= -->
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
                                               id="falla"
                                               class="form-control @error('falla') is-invalid @enderror"
                                               placeholder="Descripción de la falla"
                                               required>

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
                                               id="observaciones"
                                               class="form-control @error('observaciones') is-invalid @enderror"
                                               placeholder="Observaciones">

                                        @error('observaciones')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>

                                </div>

                            </div>


                            <!-- Estado inicial -->
                            <input type="hidden"
                                   name="estado_id"
                                   value="{{ $estado?->first()->id }}">


                            <!-- Información -->
                            <div class="registro-required">

                                <i class="fas fa-info-circle"></i>

                                Los campos marcados con
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
                        GUARDAR EQUIPO

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">