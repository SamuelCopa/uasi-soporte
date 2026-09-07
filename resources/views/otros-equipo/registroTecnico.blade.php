<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">

<!-- =========================================================
     MODAL ASIGNAR TÉCNICO - OTROS EQUIPOS
     ========================================================= -->
<div class="modal fade"
     id="eTecnico{{ $equipo->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="asignarTecnicoLabel{{ $equipo->id }}"
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
                            id="asignarTecnicoLabel{{ $equipo->id }}">

                            ASIGNAR TÉCNICO

                        </h5>

                        <small>
                            {{ $equipo->tipoEquipo?->nombre ?? 'EQUIPO' }}
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
                  action="{{ route('equipo.tecnico', ['id' => $equipo->id]) }}"
                  autocomplete="off">

                @method('PATCH')
                @csrf


                <!-- =================================================
                     BODY
                     ================================================= -->
                <div class="modal-body modal-password-body">

                    <!-- DATOS DEL EQUIPO -->
                    <div class="registro-section">

                        <div class="registro-section-title">
                            <i class="fas fa-desktop"></i>
                            DATOS DEL EQUIPO
                        </div>


                        <div class="row">

                            <!-- TIPO DE EQUIPO -->
                            <div class="col-md-6">

                                <div class="registro-field">

                                    <label for="tipo_equipo_{{ $equipo->id }}">
                                        <i class="fas fa-layer-group"></i>
                                        TIPO DE EQUIPO
                                    </label>

                                    <input type="text"
                                           id="tipo_equipo_{{ $equipo->id }}"
                                           class="form-control"
                                           value="{{ $equipo->tipoEquipo?->nombre ?? 'NO DEFINIDO' }}"
                                           readonly>

                                </div>

                            </div>


                            <!-- CÓDIGO DE RECEPCIÓN -->


                        </div>

                    </div>


                    <!-- ASIGNACIÓN -->
                    <div class="registro-section">

                        <div class="registro-section-title">
                            <i class="fas fa-user-cog"></i>
                            ASIGNACIÓN DEL TÉCNICO
                        </div>


                        <div class="registro-field">

                            <label for="user_id_otro_{{ $equipo->id }}">
                                <i class="fas fa-user-cog"></i>
                                TÉCNICO RESPONSABLE
                                <span class="required">*</span>
                            </label>

                            <select name="user_id"
                                    id="user_id_otro_{{ $equipo->id }}"
                                    class="form-control @error('user_id') is-invalid @enderror"
                                    required>

                                <option value="" disabled selected>
                                    SELECCIONE UN TÉCNICO
                                </option>

                                @foreach($users as $user)

                                    <option value="{{ $user->id }}"
                                        {{ $equipo->user_id == $user->id ? 'selected' : '' }}>

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


                        <!-- FECHA -->
                        <div class="registro-field">


                            <input type="hidden"
                                   class="form-control"
                                   value="{{ now()->format('d-m-Y H:i') }}"
                                   readonly>

                            <input type="hidden"
                                   name="fecha_asignacion"
                                   value="{{ now()->format('Y-m-d H:i:s') }}">

                        </div>


                        <div class="registro-required">

                            <i class="fas fa-info-circle"></i>

                            Seleccione el técnico responsable del mantenimiento.
                            El sistema registrará automáticamente la fecha de asignación.

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

