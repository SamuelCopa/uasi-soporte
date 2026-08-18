
document.addEventListener('DOMContentLoaded', function () {

    const panel = document.getElementById('panelPdf');
    const frame = document.getElementById('visorPdf');
    const btnDescargar = document.getElementById('btnDescargar');
    const formEnviar = document.getElementById('formEnviar');
    const btnCerrar = document.getElementById('btnCerrarPdf');

    // Abrir panel con PDF
    document.querySelectorAll('.btn-preview-pdf').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            let id = this.dataset.id;

            let urlVer = this.dataset.ver.replace(':id', id);
            let urlDescargar = this.dataset.descargar.replace(':id', id);
            let urlEnviar = this.dataset.enviar.replace(':id', id);

            // Asignar datos
            frame.src = urlVer;
            btnDescargar.href = urlDescargar;
            formEnviar.action = urlEnviar;

            // Mostrar panel
            panel.classList.add('active');
        });
    });

    // Cerrar panel
    btnCerrar.addEventListener('click', function () {
        panel.classList.remove('active');
        frame.src = ''; // limpiar
    });

});


document.getElementById('btnDescargar').addEventListener('click', function(e) {
    e.preventDefault();

    let url = this.href;

    Swal.fire({
        title: '¿Descargar Formulario?',
        text: 'Se descargará el documento en su equipo',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, descargar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
});


document.getElementById('formEnviar').addEventListener('submit', function(e) {
    e.preventDefault();

    let form = this;
    let url = form.action;
    let token = document.querySelector('input[name="_token"]').value;

    Swal.fire({
        title: '¿Enviar Formulario?',
        text: 'El documento será enviado por correo',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, enviar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#28a745'
    }).then((result) => {

        if (result.isConfirmed) {

            // Loader mientras envía
            Swal.fire({
                title: 'Enviando...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {

                Swal.fire({
                    icon: data.success ? 'success' : 'error',
                    title: data.success ? 'Correcto' : 'Error',
                    text: data.message
                });

            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo enviar el Formulario'
                });
            });
        }
    });
});
