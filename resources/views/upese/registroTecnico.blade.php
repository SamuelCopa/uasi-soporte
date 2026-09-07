<link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 
<!-- =========================================================
     MODAL ASIGNAR TÉCNICO - U.P.S.
     ========================================================= -->
<div class="modal fade"
     id="eTecnico{{ $upese->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="asignarTecnicoUpsLabel{{ $upese->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered"
         role="document">

        <div class="modal-content modal-password">

            <!-- =================================================
                 HEADER
                 ================================================= -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="asignarTecnicoUpsLabel{{ $upese->id }}">
                            ASIGNAR TÉCNICO
                        </h5>

                        <small>
                            Asignación del técnico responsable del U.P.S.
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
                  action="{{ route('ups.tecnico', ['id' => $upese->id]) }}"
                  role="form"
                  enctype="multipart/form-data"
                  autocomplete="off">

                @method('PATCH')
                @csrf


                <!-- =================================================
                     BODY
                     ================================================= -->
                <div class="modal-body modal-password-body">

                    <div class="registro-section">

                        <div class="registro-section-title">
                            <i class="fas fa-user-cog"></i>
                            DATOS DE ASIGNACIÓN
                        </div>


                        <div class="row">

                            <div class="col-md-12">

                                <div class="registro-field">

                                    <label for="user_id_ups_{{ $upese->id }}">
                                        <i class="fas fa-user-cog"></i>
                                        ASIGNAR TÉCNICO
                                        <span class="required">*</span>
                                    </label>

                                    <select name="user_id"
                                            id="user_id_ups_{{ $upese->id }}"
                                            class="form-control @error('user_id') is-invalid @enderror"
                                            title="Seleccione un técnico"
                                            required>

                                        <option value=""
                                                disabled
                                                selected>
                                            SELECCIONE UN TÉCNICO
                                        </option>

                                        @foreach($users as $user)

                                            <option value="{{ $user->id }}">

                                                {{ $user->name }}
                                                {{ $user->paterno }}
                                                {{ $user->materno }}

                                            </option>

                                        @endforeach

                                    </select>

                                    @error('user_id')

                                        <div class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </div>

                                    @enderror

                                </div>

                            </div>

                        </div>


                        <!-- FECHA DE ASIGNACIÓN -->
                        <input type="hidden"
                               name="fecha_asignacion"
                               value="{{ old('fecha_hora', date('Y-m-d\TH:i:s')) }}">


                        @error('fecha_asignacion')

                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>

                        @enderror


                        <div class="registro-required">

                            <i class="fas fa-info-circle"></i>

                            Seleccione el técnico responsable del mantenimiento
                            del U.P.S. La fecha de asignación se registrará
                            automáticamente.

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

                        <i class="fas fa-user-check"></i>
                        ASIGNAR TÉCNICO

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- =========================================================
     FIN MODAL ASIGNAR TÉCNICO - U.P.S.
     ========================================================= -->

