//-----------------movimiento de nav---------------------
const enlaces = document.querySelectorAll('.movnav');

enlaces.forEach((enlace) => {
  enlace.style.transition = 'transform 0.5s ease-in-out';

  enlace.addEventListener('mouseover', () => {
    enlace.style.transform = 'translateX(10px)';
  });

  enlace.addEventListener('mouseout', () => {
    enlace.style.transform = '';
  });
});

// --------------------------------------------------------
const botones = document.querySelectorAll('.boton');
botones.forEach((boton) => {
    boton.addEventListener('mouseover', () => {
        boton.style.borderRadius = '10px'; // Bordes curveados
        boton.style.backgroundColor = '#ff3737'; // Cambia el color de fondo
        boton.style.borderColor = '#0f0e0eff'; 
        

    });

    boton.addEventListener('mouseout', () => {
        boton.style.transform = 'scale(1)';
        boton.style.borderRadius = ''; // Restaura el borde original
        boton.style.backgroundColor = ''; // Restaura el color de fondo original
        boton.style.borderColor = ''; 
    });


  boton.addEventListener('mouseout', () => {
    boton.style.transform = '';
  });
});

const botones1 = document.querySelectorAll('.boton1');

botones1.forEach((boton1) => {
    boton1.addEventListener('mouseover', () => {
        boton1.style.transform = 'scale(1.1)';

    });

    boton1.addEventListener('mouseout', () => {
        boton1.style.transform = 'scale(1)';
    });


  boton1.addEventListener('mouseout', () => {
    boton1.style.transform = '';
  });
});
// ------------------------------------------------------------
const botones3 = document.querySelectorAll('.boton3');
botones3.forEach((boton3) => {
    boton3.addEventListener('mouseover', () => {
        boton3.style.borderRadius = '10px'; // Bordes curveados
        boton3.style.backgroundColor = '#ff3737'; 
        boton3.style.borderColor = '#0f0e0eff'; 
        boton3.style.color = 'rgba(52, 208, 233, 0.8)'; 
    });

    boton3.addEventListener('mouseout', () => {
        boton3.style.borderRadius = ''; // Restaura el borde original
        boton3.style.backgroundColor = ''; // Restaura el color de fondo original
        boton3.style.borderColor = ''; 
        boton3.style.color = ''; 
    });


  boton3.addEventListener('mouseout', () => {
    boton3.style.transform = '';
  });
});
// ------------------------------------------------------------
const botones4 = document.querySelectorAll('.boton4');
botones4.forEach((boton4) => {
    boton4.addEventListener('mouseover', () => {
        boton4.style.borderRadius = '10px'; // Bordes curveados
        boton4.style.backgroundColor = '#07cde8ff'; 
        boton4.style.borderColor = '#0f0e0eff'; 
        boton4.style.color = 'rgba(2, 7, 8, 1)'; 
    });

    boton4.addEventListener('mouseout', () => {
        boton4.style.borderRadius = ''; // Restaura el borde original
        boton4.style.backgroundColor = ''; // Restaura el color de fondo original
        boton4.style.borderColor = ''; 
        boton4.style.color = ''; 
    });


  boton4.addEventListener('mouseout', () => {
    boton4.style.transform = '';
  });
});

const botones5 = document.querySelectorAll('.boton5');
botones5.forEach((boton5) => {
    boton5.addEventListener('mouseover', () => {
        boton5.style.borderRadius = '10px'; // Bordes curveados
        boton5.style.backgroundColor = '#ff3737'; 
        boton5.style.borderColor = '#0f0e0eff'; 
        boton5.style.color = 'rgba(2, 7, 8, 1)'; 
    });

    boton5.addEventListener('mouseout', () => {
        boton5.style.borderRadius = ''; // Restaura el borde original
        boton5.style.backgroundColor = ''; // Restaura el color de fondo original
        boton5.style.borderColor = ''; 
        boton5.style.color = ''; 
    });


  boton5.addEventListener('mouseout', () => {
    boton5.style.transform = '';
  });
});

// -------------aparecer input otro para registrar----------------
// $(".miSelect").change(function() {
//   if ($(this).val() == "otro") {
//     $("#miInput").show();
//   } else {
//     $("#miInput").hide();
//   }
// });


const btnMenu = document.getElementById('btnMenu');
const menu = document.getElementById('navbarResponsive');

btnMenu.addEventListener('click', () => {
  const expanded = btnMenu.getAttribute('aria-expanded') === 'true';

  btnMenu.setAttribute('aria-expanded', !expanded);
  menu.classList.toggle('activo');
});