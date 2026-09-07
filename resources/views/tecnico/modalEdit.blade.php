<!-- =========================================================
     MODAL ACTUALIZAR TÉCNICO
     ========================================================= -->
<div class="modal fade"
     id="editar{{ $user->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="editarTecnicoLabel{{ $user->id }}"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content modal-password">
            <!-- HEADER -->
            <div class="modal-header modal-password-header">
                <div class="modal-title-container">
                    <div class="modal-password-icon">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <div>
                        <h5 class="modal-title"
                            id="editarTecnicoLabel{{ $user->id }}">
                            ACTUALIZAR TÉCNICO
                        </h5>
                        <small>
                            Modificación de los datos del técnico
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
                      action="{{ route('tecnicos.update', $user->id) }}"
                      role="form"
                      enctype="multipart/form-data"
                      autocomplete="off">
                    @method('PATCH')
                    @csrf
                    @include('tecnico.form')
                    <!-- INFORMACIÓN -->
                    <div class="registro-required">
                        <i class="fas fa-info-circle"></i>
                        Los campos marcados con
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
<!-- =========================================================
     FIN MODAL ACTUALIZAR TÉCNICO
     ========================================================= -->