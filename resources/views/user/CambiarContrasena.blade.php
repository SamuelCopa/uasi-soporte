<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #1493ee !important;">
          <h3 class="modal-title" style="color: #fff; text-align: center;">
           CAMBIAR CONTRASEÑA
          </h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <section class="content container-fluid">
        <div class="">
          <div class="">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card">
                  <form method="POST" action="{{ route('usuario.cambiar.password') }}" id="formPassword">
                    @csrf
                    <div class="modal-body" id="cont_modal">
                      <div>
                        <label>Contraseña actual</label>
                          <input class="form-control" type="password" id="password_actual" name="password_actual" placeholder="Contraseña actual" required>
                          <label>Nueva contraseña</label>
                            <input class="form-control" type="password" id="password_nueva" name="password_nueva" placeholder="Nueva contraseña" required>
                            <ul id="passwordRules" class="mt-2">
                                <li id="ruleLength">❌ Mínimo 8 caracteres</li>
                                <li id="ruleUpper">❌ Una mayúscula</li>
                                <li id="ruleLower">❌ Una minúscula</li>
                                <li id="ruleNumber">❌ Un número</li>
                                <li id="ruleSymbol">❌ Un carácter especial</li>
                            </ul>
                          <label>Confirmar nueva contraseña</label>
                            <input class="form-control" type="password" id="password_nueva_confirmation" name="password_nueva_confirmation" placeholder="Confirmar nueva contraseña" required>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" id="btnGuardar" disabled>GUARDAR</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
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
