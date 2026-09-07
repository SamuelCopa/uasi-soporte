<!-- =========================================================
     MODAL CAMBIAR CONTRASEÑA DEL TÉCNICO
     ========================================================= -->
<div class="modal fade"
     id="Password{{ $user->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="passwordTecnicoLabel{{ $user->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

        <div class="modal-content modal-password">

            <!-- HEADER -->
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-key"></i>
                    </div>

                    <div>
                        <h5 class="modal-title"
                            id="passwordTecnicoLabel{{ $user->id }}">
                            CAMBIAR CONTRASEÑA
                        </h5>

                        <small>
                            Actualización de credenciales del técnico
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

                <form id="form-update-{{ $user->id }}"
                      method="POST"
                      action="{{ route('tecnico.pass', ['id' => $user->id]) }}"
                      role="form"
                      autocomplete="off">

                    @method('PATCH')
                    @csrf

                    <!-- CONTRASEÑA -->
                    <div class="password-group">

                        <label for="password{{ $user->id }}">
                            <i class="fas fa-lock"></i>
                            NUEVA CONTRASEÑA
                        </label>

                        <div class="password-input">

                            <input type="password"
                                   name="password"
                                   id="password{{ $user->id }}"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Ingrese la nueva contraseña"
                                   required>

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password{{ $user->id }}', this)"
                                    aria-label="Mostrar u ocultar contraseña">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                        {!! $errors->first(
                            'password',
                            '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>'
                        ) !!}

                    </div>


                    <!-- INFORMACIÓN -->
                    <div class="registro-required">

                        <i class="fas fa-info-circle"></i>

                        Ingrese una nueva contraseña para actualizar
                        las credenciales de acceso del técnico.

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
                            GUARDAR

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
<!-- =========================================================
     FIN MODAL CAMBIAR CONTRASEÑA
     ========================================================= -->
<!---fin ventana modal --->
@section('css')
<style>
  .modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
}
</style>
<script>
function togglePassword(id, button) {

    const input = document.getElementById(id);
    const icon = button.querySelector('i');

    if (input.type === 'password') {

        input.type = 'text';

        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');

    } else {

        input.type = 'password';

        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endsection
