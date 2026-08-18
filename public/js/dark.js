function toggleDarkMode() {
    const body = document.body;
    const icon = document.getElementById('dark-mode-icon');

    body.classList.toggle('dark-mode');
    const isDark = body.classList.contains('dark-mode');

    // Guardar en localStorage
    localStorage.setItem('darkMode', isDark);

    // Cambiar icono
    icon.classList.replace(isDark ? 'fa-sun' : 'fa-moon', isDark ? 'fa-moon' : 'fa-sun');
}

document.addEventListener('DOMContentLoaded', function() {
    const icon = document.getElementById('dark-mode-icon');
    const isDark = localStorage.getItem('darkMode') === 'true';

    if (isDark) {
        document.body.classList.add('dark-mode');
        icon.classList.replace('fa-sun', 'fa-moon');
    } else {
        icon.classList.replace('fa-moon', 'fa-sun');
    }
});
