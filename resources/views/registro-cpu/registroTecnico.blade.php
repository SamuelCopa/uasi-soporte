<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL ASIGNAR TÉCNICO - CPU
     ========================================================= -->
<div class="modal fade"
     id="eTecnico{{ $registroCpu->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="asignarCpuTecnicoLabel{{ $registroCpu->id }}"
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
                            id="asignarCpuTecnicoLabel{{ $registroCpu->id }}">
                            ASIGNAR TÉCNICO
                        </h5>

                        <small>
                            CPU · Asignación del responsable de mantenimiento
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
                  action="{{ route('cpu.tecnico', ['id' => $registroCpu->id]) }}"
                  autocomplete="off">

                @method('PATCH')
                @csrf


                <!-- =================================================
                     BODY
                     ================================================= -->
                <div class="modal-body modal-password-body">

                    <!-- DATOS DEL EQUIPO -->
                    <div class="registro-section">




                    </div>


                    <!-- ASIGNACIÓN -->
                    <div class="registro-section">

                        <div class="registro-section-title">
                            <i class="fas fa-user-cog"></i>
                            ASIGNACIÓN DEL TÉCNICO
                        </div>


                        <div class="registro-field">

                            <label for="user_id_cpu_{{ $registroCpu->id }}">
                                <i class="fas fa-user-cog"></i>
                                TÉCNICO RESPONSABLE
                                <span class="required">*</span>
                            </label>

                            <select name="user_id"
                                    id="user_id_cpu_{{ $registroCpu->id }}"
                                    class="form-control @error('user_id') is-invalid @enderror"
                                    title="Seleccione un técnico"
                                    required>

                                <option value="" disabled selected>
                                    SELECCIONE UN TÉCNICO
                                </option>

                                @foreach($users as $user)

                                    <option value="{{ $user->id }}"
                                        {{ $registroCpu->user_id == $user->id ? 'selected' : '' }}>

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
                            Seleccione el técnico responsable.
                            La fecha de asignación se registrará automáticamente.
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