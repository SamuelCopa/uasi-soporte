<div class="modal fade"
     id="changePasswordModal"
     tabindex="-1"
     role="dialog"
     aria-labelledby="changePasswordModalLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-md">

        <div class="modal-content modal-password">

            {{-- CABECERA --}}
            <div class="modal-header modal-password-header">

                <div class="modal-title-container">

                    <div class="modal-password-icon">
                        <i class="fas fa-lock"></i>
                    </div>

                    <div>
                        <h4 class="modal-title">
                            CAMBIAR CONTRASEÑA
                        </h4>

                        <small>
                            Actualiza la contraseña de tu cuenta
                        </small>
                    </div>

                </div>

                <button type="button"
                        class="close modal-password-close"
                        data-dismiss="modal"
                        aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

            </div>


            {{-- FORMULARIO --}}
            <form method="POST"
                  action="{{ route('usuario.cambiar.password') }}"
                  id="formPassword">

                @csrf

                <div class="modal-body modal-password-body">

                    {{-- CONTRASEÑA ACTUAL --}}
                    <div class="password-group">

                        <label for="password_actual">
                            <i class="fas fa-key"></i>
                            Contraseña actual
                        </label>

                        <div class="password-input">

                            <input class="form-control"
                                   type="password"
                                   id="password_actual"
                                   name="password_actual"
                                   placeholder="Ingrese su contraseña actual"
                                   required>

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password_actual', this)">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                    </div>


                    {{-- NUEVA CONTRASEÑA --}}
                    <div class="password-group">

                        <label for="password_nueva">
                            <i class="fas fa-lock"></i>
                            Nueva contraseña
                        </label>

                        <div class="password-input">

                            <input class="form-control"
                                   type="password"
                                   id="password_nueva"
                                   name="password_nueva"
                                   placeholder="Ingrese una nueva contraseña"
                                   required>

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password_nueva', this)">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                    </div>


                    {{-- REQUISITOS --}}
                    <div class="password-rules">

                        <div class="password-rules-title">
                            <i class="fas fa-shield-alt"></i>
                            Requisitos de seguridad
                        </div>

                        <div class="password-rules-grid">

                            <div id="ruleLength">
                                <i class="fas fa-times"></i>
                                Mínimo 8 caracteres
                            </div>

                            <div id="ruleUpper">
                                <i class="fas fa-times"></i>
                                Una mayúscula
                            </div>

                            <div id="ruleLower">
                                <i class="fas fa-times"></i>
                                Una minúscula
                            </div>

                            <div id="ruleNumber">
                                <i class="fas fa-times"></i>
                                Un número
                            </div>

                            <div id="ruleSymbol">
                                <i class="fas fa-times"></i>
                                Un carácter especial
                            </div>

                        </div>

                    </div>


                    {{-- CONFIRMAR --}}
                    <div class="password-group">

                        <label for="password_nueva_confirmation">
                            <i class="fas fa-check-circle"></i>
                            Confirmar nueva contraseña
                        </label>

                        <div class="password-input">

                            <input class="form-control"
                                   type="password"
                                   id="password_nueva_confirmation"
                                   name="password_nueva_confirmation"
                                   placeholder="Repita la nueva contraseña"
                                   required>

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword('password_nueva_confirmation', this)">

                                <i class="fas fa-eye"></i>

                            </button>

                        </div>

                        <small id="passwordMatch"
                               class="password-match">
                        </small>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer modal-password-footer">

                    <button type="submit"
                            class="btn btn-password-save"
                            id="btnGuardar"
                            disabled>

                        <i class="fas fa-save"></i>
                        GUARDAR CAMBIOS

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

<!---fin ventana modal --->
<script>
  document.getElementById('formPassword').addEventListener('submit', function(e) {
    e.preventDefault(); // evita el envío inmediato

    let pass1 = document.getElementById('password_nueva').value;
    let pass2 = document.getElementById('password_nueva_confirmation').value;

    if (pass1 !== pass2) {
        Swal.fire({
            icon: 'error',
            title: 'Las contraseñas no coinciden',
            text: 'Por favor, verifica que ambas contraseñas sean iguales.',
        });
        return; // NO enviar el formulario
    }

    // Si coinciden enviar formulario normalmente
    this.submit();
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const password = document.getElementById('password_nueva');
    const form = document.getElementById('formPassword');

    password.addEventListener('input', function() {

        const value = this.value;

        document.getElementById('ruleLength').innerHTML =
            value.length >= 8 ? '✅ Mínimo 8 caracteres' : '❌ Mínimo 8 caracteres';

        document.getElementById('ruleUpper').innerHTML =
            /[A-Z]/.test(value) ? '✅ Una mayúscula' : '❌ Una mayúscula';

        document.getElementById('ruleLower').innerHTML =
            /[a-z]/.test(value) ? '✅ Una minúscula' : '❌ Una minúscula';

        document.getElementById('ruleNumber').innerHTML =
            /\d/.test(value) ? '✅ Un número' : '❌ Un número';

        document.getElementById('ruleSymbol').innerHTML =
            /[^A-Za-z0-9]/.test(value) ? '✅ Un carácter especial' : '❌ Un carácter especial';
    });

    form.addEventListener('submit', function(e) {

        const value = password.value;

        const valid =
            value.length >= 8 &&
            /[A-Z]/.test(value) &&
            /[a-z]/.test(value) &&
            /\d/.test(value) &&
            /[^A-Za-z0-9]/.test(value);

        if (!valid) {
            e.preventDefault();

            Swal.fire({
                icon: 'error',
                title: 'Contraseña inválida',
                text: 'La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.'
            });
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.getElementById('password_nueva');
    const confirmPassword = document.getElementById('password_nueva_confirmation');
    const btnGuardar = document.getElementById('btnGuardar');

    function validarPassword() {

        const value = password.value;
        const confirm = confirmPassword.value;

        const valid =
            value.length >= 8 &&
            /[A-Z]/.test(value) &&
            /[a-z]/.test(value) &&
            /\d/.test(value) &&
            /[^A-Za-z0-9]/.test(value) &&
            value === confirm;

        console.log('Valid:', valid);

        btnGuardar.disabled = !valid;
    }

    password.addEventListener('input', validarPassword);
    confirmPassword.addEventListener('input', validarPassword);
});
</script>

<style>

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

<link rel="stylesheet" href="{{ asset('estilos/password.css') }}">  
