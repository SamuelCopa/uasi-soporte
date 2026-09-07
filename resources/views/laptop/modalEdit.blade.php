<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL ACTUALIZAR LAPTOP
     ========================================================= -->
<div class="modal fade"
     id="editar{{ $laptop->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editarLaptopLabel{{ $laptop->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

        <div class="modal-content modal-password">


            <!-- =================================================
                 HEADER
                 ================================================= -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-laptop"></i>
                    </div>

                    <div>

                        <h5 class="modal-title"
                            id="editarLaptopLabel{{ $laptop->id }}">

                            ACTUALIZAR LAPTOP

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
                  action="{{ route('laptops.update', $laptop->id) }}"
                  role="form"
                  enctype="multipart/form-data"
                  autocomplete="off">

                @method('PATCH')
                @csrf


                <!-- =================================================
                     BODY
                     ================================================= -->
                <div class="modal-body modal-password-body">

                    @include('laptop.form')


                    <!-- INFORMACIÓN -->
                    <div class="registro-required">

                        <i class="fas fa-info-circle"></i>

                        Verifique los datos de la laptop antes de guardar
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
<!-- =========================================================
     FIN MODAL ACTUALIZAR LAPTOP
     ========================================================= -->

