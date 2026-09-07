<div class="modal fade"
     id="Password{{ $user->id }}"
     tabindex="-1"
     role="dialog"
     aria-labelledby="passwordModalLabel{{ $user->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content modal-password">

            {{-- CABECERA --}}
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-key"></i>
                    </div>

                    <div>
                        <h4 class="modal-title">
                            CAMBIAR CONTRASEÑA
                        </h4>

                        <small>
                            Actualización de contraseña del usuario
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


            {{-- FORMULARIO --}}
            <form id="form-update-{{ $user->id }}"
                  method="POST"
                  action="{{ route('user.pass', ['id' => $user->id]) }}"
                  role="form">

                {{ method_field('PATCH') }}

                @csrf


                {{-- CUERPO --}}
                <div class="modal-body modal-password-body">

                    <div class="registro-section">

                        <div class="registro-section-title">

                            <i class="fas fa-lock"></i>

                            NUEVA CONTRASEÑA

                        </div>


                        <div class="password-group">

                            <label for="password{{ $user->id }}">
                                <i class="fas fa-key"></i>
                                CONTRASEÑA
                                <span class="required">*</span>
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
                                        aria-label="Mostrar contraseña">

                                    <i class="fas fa-eye"></i>

                                </button>

                            </div>

                            {!! $errors->first('password',
                                '<div class="invalid-feedback"><strong>:message</strong></div>')
                            !!}

                        </div>


                        {{-- INFORMACIÓN --}}
                        <div class="registro-required">

                            <i class="fas fa-info-circle"></i>

                            Ingrese una nueva contraseña para este usuario.
                            Se recomienda utilizar una contraseña segura.

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer modal-password-footer">

                    <button type="submit"
                            class="btn btn-password-save">

                        <i class="fas fa-save"></i>

                        GUARDAR

                    </button>


                    <button type="button"
                            class="btn btn-password-close"
                            data-dismiss="modal">

                        <i class="fas fa-times"></i>

                        CERRAR

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

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

@endsection
