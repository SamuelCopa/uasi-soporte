<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL ACTUALIZAR CPU
     ========================================================= -->
<div class="modal fade"
     id="editar{{ $registroCpu->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editarCpuLabel{{ $registroCpu->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

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
                        <h4 class="modal-title mb-0"
                            id="editarCpuLabel{{ $registroCpu->id }}">
                            ACTUALIZAR CPU
                        </h4>

                        <small class="modal-subtitle">
                            Actualización de los datos del equipo y funcionario
                        </small>
                    </div>

                </div>

                <button type="button"
                        class="close modal-password-close"
                        data-dismiss="modal"
                        aria-label="Cerrar">
                    <i class="fas fa-times"></i>
                </button>

            </div>


            <!-- =================================================
                 BODY
                 ================================================= -->
            <div class="modal-body modal-password-body">

                <form method="POST"
                      action="{{ route('registro-cpus.update', $registroCpu->id) }}"
                      role="form"
                      enctype="multipart/form-data"
                      autocomplete="off">

                    {{ method_field('PATCH') }}
                    @csrf

                    @include('registro-cpu.form')


                    <!-- =================================================
                         FOOTER
                         ================================================= -->
                    <div class="modal-footer modal-password-footer">

                        <button type="button"
                                class="btn btn-password-close"
                                data-dismiss="modal">
                            <i class="fas fa-times"></i>
                            CERRAR
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
</div>

