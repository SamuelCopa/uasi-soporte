<!-- =========================================================
     MODAL ASIGNAR TÉCNICO - AUDÍFONO
     ========================================================= -->
<div class="modal fade" id="eTecnico{{ $audifono->id }}" tabindex="-1" role="dialog"  aria-labelledby="asignarTecnicoAudifonoLabel{{ $audifono->id }}"
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
                            id="asignarTecnicoAudifonoLabel{{ $audifono->id }}">
                            ASIGNAR TÉCNICO
                        </h5>
                        <small>
                            Asignación del técnico responsable del audífono
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
            <form method="POST" action="{{ route('audi.tecnico', ['id' => $audifono->id]) }}" id="formAsignarAudifono{{ $audifono->id }}" role="form" enctype="multipart/form-data" autocomplete="off">
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
                            <!-- TÉCNICO -->
                            <div class="col-md-12">
                                <div class="registro-field">
                                    <label for="user_id_audifono_{{ $audifono->id }}">
                                        <i class="fas fa-user-cog"></i>
                                        ASIGNAR TÉCNICO
                                        <span class="required">*</span>
                                    </label>
                                    <select
                                        name="user_id"
                                        id="user_id_audifono_{{ $audifono->id }}"
                                        class="form-control @error('user_id') is-invalid @enderror"
                                        title="Seleccione un técnico"
                                        required>
                                        <option value="" disabled selected>
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
                        <input
                            type="hidden"
                            name="fecha_asignacion"
                            value="{{ old('fecha_hora', date('Y-m-d\TH:i:s')) }}">
                        @error('fecha_asignacion')
                            <div class="invalid-feedback d-block">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <!-- INFORMACIÓN -->
                        <div class="registro-required">
                            <i class="fas fa-info-circle"></i>
                            Seleccione el técnico responsable del mantenimiento
                            del audífono. La fecha de asignación se registrará
                            automáticamente.
                        </div>
                    </div>
                </div>
                    <!-- <div id="mensajeAsignandoAudifono{{ $audifono->id }}"
                        class="alert alert-info text-center d-none"
                        style="margin: 0 20px 15px 20px;">
                        <i class="fas fa-spinner fa-spin"></i>
                        <strong>ASIGNANDO TÉCNICO...</strong>
                        <br>
                        <small>
                            Registrando la asignación y enviando la notificación por correo.
                        </small>
                    </div> -->
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
                                class="btn btn-password-save"
                                id="btnAsignarAudifono{{ $audifono->id }}">
                            <i class="fas fa-user-check"></i>
                            <span class="texto-asignar">ASIGNAR TÉCNICO</span>
                            <span class="texto-asignando d-none">
                                <i class="fas fa-spinner fa-spin"></i>
                                ASIGNANDO...
                            </span>
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <script>
$(document).on('submit', '#formAsignarAudifono{{ $audifono->id }}', function () {

    const form = this;
    const boton = document.getElementById(
        'btnAsignarAudifono{{ $audifono->id }}'
    );

    const mensaje = document.getElementById(
        'mensajeAsignandoAudifono{{ $audifono->id }}'
    );

    // Evitar doble envío
    boton.disabled = true;

    // Cambiar texto del botón
    boton.querySelector('.texto-asignar').classList.add('d-none');
    boton.querySelector('.texto-asignando').classList.remove('d-none');

    // Mostrar mensaje
    mensaje.classList.remove('d-none');
});
</script> -->
<!-- =========================================================
     FIN MODAL ASIGNAR TÉCNICO - AUDÍFONO
     ========================================================= -->

     <link rel="stylesheet" href="{{ asset('estilos/password.css') }}"> 