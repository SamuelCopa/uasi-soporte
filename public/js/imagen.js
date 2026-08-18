// --------------mostrar imagen------------
let imagenVisible = false;

document.getElementById('input-imagen').addEventListener('click', (event) => {
    event.stopPropagation();
    imagenVisible = true;
    document.getElementById('imagen-container').style.display = 'block';
});

document.addEventListener('click', (event) => {
    if (imagenVisible && !document.getElementById('input-imagen').contains(event.target) && !document.getElementById('imagen-container').contains(event.target)) {
        imagenVisible = false;
        document.getElementById('imagen-container').style.display = 'none';
    }
});