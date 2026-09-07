<!-- =========================================================
     MODAL ACTUALIZAR U.P.S.
     ========================================================= -->
<div class="modal fade"
     id="editar{{ $upese->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editarUpsLabel{{ $upese->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">

        <div class="modal-content modal-password">

            <!-- HEADER -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-plug"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="editarUpsLabel{{ $upese->id }}">
                            ACTUALIZAR U.P.S.
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


            <!-- BODY -->
            <div class="modal-body modal-password-body">

                <form method="POST"
                      action="{{ route('upeses.update', $upese->id) }}"
                      role="form"
                      enctype="multipart/form-data"
                      autocomplete="off">

                    @method('PATCH')
                    @csrf

                    @include('upese.form')


                    <!-- INFORMACIÓN -->
                    <div class="registro-required">

                        <i class="fas fa-info-circle"></i>

                        Verifique los datos del U.P.S. antes de guardar
                        los cambios. Los campos marcados con
                        <strong>*</strong>
                        son obligatorios.

                    </div>


                    <!-- FOOTER -->
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

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
