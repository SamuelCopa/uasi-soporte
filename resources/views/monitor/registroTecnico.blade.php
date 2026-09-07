<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL ASIGNAR TÉCNICO - MONITOR
     ========================================================= -->
<div class="modal fade"
     id="eTecnico{{ $monitor->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="asignarMonitorLabel{{ $monitor->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

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
                            id="asignarMonitorLabel{{ $monitor->id }}">
                            ASIGNAR TÉCNICO
                        </h5>

                        <small>
                            Asignación del responsable para la atención del monitor
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
                  action="{{ route('monitor.tecnico', ['id' => $monitor->id]) }}"
                  role="form"
                  enctype="multipart/form-data"
                  autocomplete="off">

                @method('PATCH')
                @csrf

                <div class="modal-body modal-password-body">

                    <div class="registro-section">

                        <div class="registro-section-title">
                            <i class="fas fa-user-cog"></i>
                            DATOS DE ASIGNACIÓN
                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="registro-field">

                                    <label for="user_id_monitor_{{ $monitor->id }}">
                                        <i class="fas fa-user-cog"></i>
                                        TÉCNICO RESPONSABLE
                                        <span class="required">*</span>
                                    </label>

                                    <select name="user_id"
                                            id="user_id_monitor_{{ $monitor->id }}"
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

                            </div>

                        </div>

                    </div>


                    <!-- Fecha de asignación -->
                    <input type="hidden"
                           name="fecha_asignacion"
                           value="{{ old('fecha_asignacion', date('Y-m-d\TH:i:s')) }}">

                    <div class="registro-required">

                        <i class="fas fa-info-circle"></i>

                        Seleccione el técnico responsable de la atención.
                        El sistema registrará automáticamente la
                        <strong>fecha de asignación</strong>.

                        Los campos marcados con
                        <span class="required">*</span>
                        son obligatorios.

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
                        ASIGNAR TÉCNICO

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

