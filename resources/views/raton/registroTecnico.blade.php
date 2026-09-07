<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL ASIGNAR TÉCNICO - MOUSE
     ========================================================= -->
<div class="modal fade"
     id="eTecnico{{ $raton->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="asignarRatonLabel{{ $raton->id }}"
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
                            id="asignarRatonLabel{{ $raton->id }}">

                            ASIGNAR TÉCNICO

                        </h5>

                        <small>
                            Asignación del responsable del mantenimiento
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
                  action="{{ route('mouse.tecnico', ['id' => $raton->id]) }}"
                  role="form"
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


                        <!-- TÉCNICO -->
                        <div class="registro-field">

                            <label for="user_id_mouse_{{ $raton->id }}">

                                <i class="fas fa-user-tie"></i>

                                ASIGNAR TÉCNICO

                                <span class="required">*</span>

                            </label>

                            <select name="user_id"
                                    id="user_id_mouse_{{ $raton->id }}"
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
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <!-- FECHA DE ASIGNACIÓN -->
                        <input type="hidden"
                               name="fecha_asignacion"
                               value="{{ old('fecha_asignacion', date('Y-m-d\TH:i:s')) }}">

                        @error('fecha_asignacion')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror


                        <!-- INFORMACIÓN -->
                        <div class="registro-required">

                            <i class="fas fa-info-circle"></i>

                            Seleccione el técnico responsable del mantenimiento
                            del mouse. La fecha de asignación se registrará
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

