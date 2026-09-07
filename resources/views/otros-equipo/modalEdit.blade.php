<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">
<!-- =========================================================
     MODAL ACTUALIZAR OTROS EQUIPO
     ========================================================= -->
<div class="modal fade"
     id="editar{{ $equipo->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editarOtroEquipoLabel{{ $equipo->id }}"
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
                        <i class="fas fa-edit"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="editarOtroEquipoLabel{{ $equipo->id }}">
                            ACTUALIZAR EQUIPO
                        </h5>

                        <small>
                            Modificación de datos del equipo y funcionario
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
                  action="{{ route('otros-equipos.update', $equipo->id) }}"
                  enctype="multipart/form-data"
                  autocomplete="off">

                @csrf
                @method('PATCH')


                <!-- =================================================
                     BODY
                     ================================================= -->
                <div class="modal-body modal-password-body">

                    @include('otros-equipo.form')

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

