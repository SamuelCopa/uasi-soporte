
document.addEventListener('DOMContentLoaded', function () {

    const botones = document.querySelectorAll('.btn-estado');

    botones.forEach(btn => {

        let dias = btn.getAttribute('data-dias');

        // fallback si no existe atributo
        if (!dias) {
            const match = btn.textContent.match(/\d+/);
            dias = match ? parseInt(match[0]) : 0;
        } else {
            dias = parseInt(dias);
        }

        // limpiar estados previos
        btn.classList.remove('estado-verde', 'estado-amarillo', 'estado-rojo');

        // reglas
        if (dias <= 4) {
            btn.classList.add('estado-verde');
        } 
        else if (dias <= 8) {
            btn.classList.add('estado-amarillo');
        } 
        else {
            btn.classList.add('estado-rojo');
        }

    });

});
