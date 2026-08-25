<div class="modal fade" id="creara" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog modal-xl">

        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            {{-- ENCABEZADO --}}
            <div class="modal-header bg-primary text-white border-0 py-3">
                <h4>
                    REGISTRAR EQUIPO
                    <span id="nombreTipoEquipo" class="ml-2"></span> 
                    <input type="text" id="nombre_tipo_equipo_a" class="form-control" readonly>
                </h4>

                <button
                    type="button"
                    class="btn-close bg-primary"
                    data-dismiss="modal"
                    aria-label="Cerrar"
                >
                    <i class="fas fa-times"></i>
                </button>

            </div>


            <section class="content container-fluid">

                <div class="card">

                    <div class="col-md-12">

                        {{-- FORMULARIO --}}
                        <form
                            method="POST"
                            action="{{ route('otros-equipos.store') }}"
                            autocomplete="off"
                        >

                            @csrf


                            {{-- ========================================= --}}
                            {{-- TIPO DE EQUIPO --}}
                            {{-- ========================================= --}}

                            <input
                                type="hidden"
                                name="tipo_equipo_id"
                                id="tipo_equipo_id_a"
                            >


                            {{-- ========================================= --}}
                            {{-- DATOS DEL SOLICITANTE --}}
                            {{-- ========================================= --}}

                            <fieldset class="fieldset1">

                                <legend class="legend1">
                                    DATOS DEL SOLICITANTE
                                </legend>


                                {{-- TIPO FUNCIONARIO --}}

                                <div class="fila-3">

                                    <div class="title div">

                                        <label
                                            for="funcionario_activo"
                                            class="form-label"
                                        >
                                            TIPO DE FUNCIONARIO:
                                            <span class="required">*</span>
                                        </label>

                                        <select
                                            name="funcionario_activo"
                                            class="form-control"
                                            required
                                            id="miSelect"
                                        >

                                            <option value="" disabled selected>
                                                SELECCIONE UNA OPCION
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


                                <div id="formularioa">


                                    {{-- CI / EXPEDIDO / CELULAR --}}

                                    <div class="fila-2">

                                        {{-- CI --}}

                                        <div class="div title">

                                            <label
                                                for="ci"
                                                class="form-label"
                                            >
                                                C.I.
                                                <span class="required">*</span>
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    <i class="fas fa-id-card"></i>
                                                </span>

                                                <input
                                                    type="number"
                                                    name="ci"
                                                    class="form-control @error('ci') is-invalid @enderror"
                                                    id="ci"
                                                    placeholder="C.I."
                                                >

                                            </div>

                                            {!! $errors->first(
                                                'ci',
                                                '<div class="invalid-feedback">
                                                    <strong>:message</strong>
                                                </div>'
                                            ) !!}

                                        </div>


                                        {{-- EXPEDIDO --}}

                                        <div class="div title">

                                            <label
                                                for="expedido"
                                                class="form-label"
                                            >
                                                EXPEDIDO:
                                                <span class="required">*</span>
                                            </label>

                                            <select
                                                name="expedido"
                                                class="form-control"
                                                required
                                            >

                                                <option value="" disabled selected>
                                                    SELECCIONE UNA OPCION
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


                                        {{-- CELULAR --}}

                                        <div class="div title">

                                            <label
                                                for="celular"
                                                class="form-label"
                                            >
                                                CELULAR
                                                <span class="required">*</span>
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    <i class="fas fa-phone-alt"></i>
                                                </span>

                                                <input
                                                    type="number"
                                                    name="celular"
                                                    id="celular"
                                                    placeholder="Celular"
                                                    class="form-control @error('celular') is-invalid @enderror"
                                                >

                                            </div>

                                            {!! $errors->first(
                                                'celular',
                                                '<div class="invalid-feedback">
                                                    <strong>:message</strong>
                                                </div>'
                                            ) !!}

                                        </div>

                                    </div>


                                    {{-- GRADO / APELLIDOS / NOMBRE --}}

                                    <div class="fila-4">


                                        {{-- GRADO --}}

                                        <div class="div title">

                                            <label
                                                for="grado_academico"
                                                class="form-label"
                                            >
                                                GRADO ACADEMICO:
                                                <span class="required">*</span>
                                            </label>

                                            <select
                                                name="grado_academico"
                                                class="form-control"
                                                required
                                            >

                                                <option value="" disabled selected>
                                                    SELECCIONE UNA OPCION
                                                </option>

                                                <option value="Abg.">ABG.</option>
                                                <option value="Arq.">ARQ.</option>
                                                <option value="Dr.">DR.</option>
                                                <option value="Dra.">DRA.</option>
                                                <option value="Ing.">ING.</option>
                                                <option value="Lic.">LIC.</option>
                                                <option value="Tec.">TEC.</option>
                                                <option value="Sr.">SR.</option>
                                                <option value="Sra.">SRA.</option>

                                            </select>

                                        </div>


                                        {{-- PATERNO --}}

                                        <div class="div title">

                                            <label
                                                for="paterno"
                                                class="form-label"
                                            >
                                                APELLIDO PATERNO
                                                <span class="required">*</span>
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>

                                                <input
                                                    type="text"
                                                    name="paterno"
                                                    class="form-control"
                                                    id="paterno"
                                                    placeholder="Paterno"
                                                    required
                                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                                >

                                            </div>

                                        </div>


                                        {{-- MATERNO --}}

                                        <div class="div title">

                                            <label
                                                for="materno"
                                                class="form-label"
                                            >
                                                APELLIDO MATERNO
                                                <span class="required">*</span>
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    <i class="fas fa-user"></i>
                                                </span>

                                                <input
                                                    type="text"
                                                    name="materno"
                                                    class="form-control"
                                                    id="materno"
                                                    placeholder="Materno"
                                                    required
                                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                                >

                                            </div>

                                        </div>


                                        {{-- NOMBRE --}}

                                        <div class="div title">

                                            <label
                                                for="nombre"
                                                class="form-label"
                                            >
                                                NOMBRE(S)
                                                <span class="required">*</span>
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    <i class="fas fa-user-tie"></i>
                                                </span>

                                                <input
                                                    type="text"
                                                    name="nombre"
                                                    class="form-control"
                                                    id="nombre"
                                                    placeholder="Nombre"
                                                    required
                                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                                >

                                            </div>

                                        </div>

                                    </div>


                                    {{-- CARGO / EMAIL --}}

                                    <div class="fila-1">


                                        {{-- CARGO --}}

                                        <div class="div title">

                                            <label
                                                for="cargo"
                                                class="form-label"
                                            >
                                                CARGO
                                                <span class="required">*</span>
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    <i class="fa fa-briefcase"></i>
                                                </span>

                                                <input
                                                    type="text"
                                                    name="cargo"
                                                    class="form-control"
                                                    id="cargo"
                                                    placeholder="Cargo"
                                                    required
                                                    oninput="this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '')"
                                                >

                                            </div>

                                        </div>


                                        {{-- EMAIL --}}

                                        <div class="div title">

                                            <label
                                                for="email"
                                                class="form-label"
                                            >
                                                CORREO ELECTRÓNICO
                                                <span class="required">*</span>
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    <i class="fa fa-envelope"></i>
                                                </span>

                                                <input
                                                    type="email"
                                                    name="email"
                                                    class="form-control"
                                                    id="email"
                                                    placeholder="Correo electrónico"
                                                    required
                                                >

                                            </div>

                                        </div>

                                    </div>


                                    {{-- DEPENDENCIA / FECHA --}}

                                    <div class="fila-1">


                                        {{-- DEPENDENCIA --}}

                                        <div class="div title">

                                            <label
                                                for="search-inputA"
                                                class="form-label"
                                            >
                                                DEPENDENCIA
                                                <span class="required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                id="search-inputA"
                                                list="optionsA"
                                                placeholder="Buscar dependencia ..."
                                                class="form-control"
                                                required
                                            >

                                            <datalist id="optionsA">

                                                @foreach ($dependencia as $item)

                                                    <option
                                                        value="{{ $item->dependencias }}"
                                                        data-id="{{ $item->id }}"
                                                    ></option>

                                                @endforeach

                                            </datalist>

                                            <input
                                                type="hidden"
                                                id="id-selectedA"
                                                name="dependencia_id"
                                            >

                                        </div>


                                        {{-- FECHA --}}

                                        <div class="div title">

                                            <label
                                                for="fecha"
                                                class="form-label"
                                            >
                                                FECHA DE RECEPCIÓN
                                                <span class="required">*</span>
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>

                                                <input
                                                    type="datetime-local"
                                                    name="fecha"
                                                    class="form-control"
                                                    value="{{ old('fecha', date('Y-m-d\TH:i:s')) }}"
                                                    id="fecha"
                                                    readonly
                                                    required
                                                >

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </fieldset>


                            {{-- ========================================= --}}
                            {{-- DATOS DEL EQUIPO --}}
                            {{-- ========================================= --}}

                            <div id="formularioa2">

                                <fieldset class="fieldset1">

                                    <legend class="legend1">
                                        DATOS DEL EQUIPO
                                    </legend>


                                    {{-- TIPO DE EQUIPO --}}
<!-- 
                                    <div class="fila-1">

                                        <div class="div title">

                                            <label
                                                class="form-label"
                                            >
                                                TIPO DE EQUIPO
                                            </label>

                                            <input
                                                type="text"
                                                id="nombre_tipo_equipo_a"
                                                class="form-control"
                                                readonly
                                                placeholder="Tipo seleccionado"
                                            >

                                        </div>

                                    </div> -->

                                    {{-- CODIGO GAMEA --}}

                                    <div class="fila-1">

                                        <div class="div title">

                                            <label
                                                for="cod_gamea"
                                                class="form-label"
                                            >
                                                CODIGO GAMEA
                                                <span class="required">*</span>
                                            </label>

                                            <input
                                                type="number"
                                                name="cod_gamea"
                                                class="form-control"
                                                id="cod_gamea"
                                                placeholder="Código GAMEA"
                                                required
                                            >

                                        </div>

                                    </div>


                                    {{-- MARCA / MODELO --}}

                                    <div class="fila-1">

                                        <div class="div title">

                                            <label
                                                for="marca"
                                                class="form-label"
                                            >
                                                MARCA
                                                <span class="required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="marca"
                                                class="form-control"
                                                id="marca"
                                                placeholder="Marca"
                                                required
                                            >

                                        </div>


                                        <div class="div title">

                                            <label
                                                for="modelo"
                                                class="form-label"
                                            >
                                                MODELO
                                                <span class="required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="modelo"
                                                class="form-control"
                                                id="modelo"
                                                placeholder="Modelo"
                                                required
                                            >

                                        </div>

                                    </div>


                                    {{-- FALLA / OBSERVACIONES --}}

                                    <div class="fila-1">

                                        <div class="div title">

                                            <label
                                                for="falla"
                                                class="form-label"
                                            >
                                                FALLA
                                                <span class="required">*</span>
                                            </label>

                                            <input
                                                type="text"
                                                name="falla"
                                                class="form-control"
                                                id="falla"
                                                placeholder="Falla"
                                                required
                                            >

                                        </div>


                                        <div class="div title">

                                            <label
                                                for="observaciones"
                                                class="form-label"
                                            >
                                                OBSERVACIONES
                                            </label>

                                            <input
                                                type="text"
                                                name="observaciones"
                                                class="form-control"
                                                id="observaciones"
                                                placeholder="Observaciones"
                                            >

                                        </div>

                                    </div>


                                    {{-- ESTADO --}}

                                    <input
                                        type="hidden"
                                        name="estado_id"
                                        value="{{ $estado?->first()->id }}"
                                    >


                                    <label class="form-label">
                                        Campos obligatorios
                                        <span class="required">(*)</span>
                                    </label>

                                </fieldset>

                            </div>


                            {{-- ========================================= --}}
                            {{-- BOTONES --}}
                            {{-- ========================================= --}}

                            <div class="modal-footer">

                                <button
                                    type="submit"
                                    class="btn btn-primary rounded-pill px-4 shadow-sm"
                                >
                                    <i class="fa fa-fw fa-save"></i>
                                    GUARDAR
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-danger rounded-pill px-4 shadow-sm"
                                    data-dismiss="modal"
                                >
                                    <i class="fas fa-times"></i>
                                    CANCELAR
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </section>

        </div>

    </div>

</div>