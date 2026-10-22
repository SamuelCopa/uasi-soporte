
document.addEventListener('DOMContentLoaded', function () {

    // Identificadores de los menús que deben cerrarse
    const identificadores = ['case', 'procesador'];

    identificadores.forEach(function (id) {

        const contenedor = document.getElementById(id);

        if (!contenedor) return;

        document.addEventListener('click', function (event) {

            // No cerrar si el clic ocurre dentro del menú
            if (contenedor.contains(event.target)) {
                return;
            }

            // Cerrar los submenús de este menú
            contenedor.querySelectorAll('ul ul.ul').forEach(function (submenu) {
                submenu.style.display = 'none';
            });

        });

    });

});




