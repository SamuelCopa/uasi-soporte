<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL ACTUALIZAR MOUSE
     ========================================================= -->
<div class="modal fade"
     id="editar{{ $raton->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editarRatonLabel{{ $raton->id }}"
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
                        <i class="fas fa-mouse"></i>
                    </div>

                    <div>

                        <h5 class="modal-title"
                            id="editarRatonLabel{{ $raton->id }}">

                            ACTUALIZAR MOUSE

                        </h5>

                        <small>
                            Modificación de los datos del equipo y funcionario
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
                  action="{{ route('ratons.update', $raton->id) }}"
                  role="form"
                  enctype="multipart/form-data"
                  autocomplete="off">

                @method('PATCH')

                @csrf


                <!-- =================================================
                     BODY
                     ================================================= -->
                <div class="modal-body modal-password-body">

                    @include('raton.form')


                    <!-- =================================================
                         INFORMACIÓN
                         ================================================= -->
                    <div class="registro-required">

                        <i class="fas fa-info-circle"></i>

                        Verifique los datos del mouse antes de guardar
                        los cambios. Los campos marcados con
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

                        CERRAR

                    </button>


                    <button type="submit"
                            class="btn btn-password-save">

                        <i class="fas fa-save"></i>

                        GUARDAR CAMBIOS

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

