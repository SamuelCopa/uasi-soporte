// --------------CASE MARCA---------------------

$(document).ready(function() {

  let marca_texto = null, color_texto = null;
$(document).on("click", ".nivel-2", function(e){
    e.preventDefault();
    let id = $(this).data("id");
    $("#marcacase_id").val(id);
    marca_texto = $(this).text();

    $('.nivel-3').hide();
    if (id == "otroMarcacase") {
        $('.otra_marca').show().focus();
        $(this).closest('ul').find('.nivel-3').first().show();
    } else {
        $(".otra_marca").hide();
        $(this).closest('li').find('.nivel-3').first().show();
    }
    actualizarLista();
});
        $('.otra_marca').on('input', function(){
        marca_texto = $(this).val();
        $('#marcacase_id').val("otroMarcacase");
        actualizarLista();
        $(this).closest('ul').find('.nivel-3').first().show();
});

// -----------------color-------------------
    $(document).on("click", ".nivel-4", function(e){
        e.preventDefault();
        let id = $(this).data("id");
        $("#colorcase_id").val(id);
         color_texto = $(this).text();

        if (id == "otroColorcase") {
            $(".otro_color").show().focus();
            $(this).closest('ul').find('.nivel-3').first().show();
        } else {
            $(".otro_color").hide();
        }
        actualizarLista();
    });
        // Cuando escriba en el input del color
        $('.otro_color').on('input', function(){
            color_texto = $(this).val();
            $('#colorcase_id').val("otroColorcase");
            actualizarLista();
        });

        function actualizarLista(){
        $('#selecciones').empty();

        if(marca_texto)
            $('#selecciones').append("<li>MARCA: "+marca_texto+"</li>");

        if(color_texto)
            $('#selecciones').append("<li>COLOR: "+color_texto+"</li>");
    }
});


// -------- PROCESADOR----------------------------------------------------------

$(document).ready(function() {

  let marca_texto = null, modelo_texto = null, gen_texto = null;

  // --- Selección de MARCA ---
$(document).on("click", ".nivel-5", function(e){
    e.preventDefault();

    let id = $(this).data('id');
    $('#marcaprocesador_id').val(id);
    marca_texto = $(this).text();

        // Ocultar todos los submenús de color antes de abrir el nuevo
    $('.nivel-6').hide();

    // Mostrar input si es OTRO
    if(id == 'otroMarcapro') {
      $('.otra_marca_procesador').show().focus();
      $(this).closest('ul').find('.nivel-6').first().show();
    } else {
      $('.otra_marca_procesador').hide();
      $(this).closest('li').find('.nivel-6').first().show();
    }

    actualizarLista();
  });

  // Input "Otro" para MARCA
  $('.otra_marca_procesador').on('input', function() {
    marca_texto = $(this).val();
    $('#marcaprocesador_id').val('otroMarcapro');
    actualizarLista();

    // Al escribir en el input "Otro", mostrar el siguiente nivel
    $(this).closest('ul').find('.nivel-6').first().show();
  });

  // --- Selección de MODELO ---
$(document).on("click", ".nivel-7", function(e){
    e.preventDefault();

    let id = $(this).data('id');
    modelo_texto = $(this).text();
    $('#modeloprocesador_id').val(id);

    $('.nivel-8').hide();
    if(id == 'otroModpro') {
      $('.otro_modelo_procesador').show().focus();
      $(this).closest('ul').find('.nivel-8').first().show();
    } else {
      $('.otro_modelo_procesador').hide();
      $(this).closest('li').find('.nivel-8').first().show();
    }

    actualizarLista();
  });

  // Input "Otro" para MODELO
  $('.otro_modelo_procesador').on('input', function() {
    modelo_texto = $(this).val();
    $('#modeloprocesador_id').val('otroModpro');
    actualizarLista();

    // Al escribir en el input "Otro", mostrar el siguiente nivel
    $(this).closest('ul').find('.nivel-8').first().show();
  });

  // --- Selección de GENERACIÓN ---
    $(document).on("click", ".nivel-9", function(e){
    e.preventDefault();

    let id = $(this).data('id');
    gen_texto = $(this).text();
    $('#genprocesador_id').val(id);

    if(id == 'otroGenpro') {
      $('.otra_generacion').show().focus();
    } else {
      $('.otra_generacion').hide();
    }

    actualizarLista();
  });

  // Input "Otro" para GENERACIÓN
  $('.otra_generacion').on('input', function() {
    gen_texto = $(this).val();
    $('#genprocesador_id').val('otroGenpro');
    actualizarLista();
  });

  // --- Función para actualizar la lista visible ---
  function actualizarLista() {
    let lista = $('#seleccionesp');
    lista.empty();
    if(marca_texto) lista.append('<li>MARCA: ' + marca_texto + '</li>');
    if(modelo_texto) lista.append('<li>MODELO: ' + modelo_texto + '</li>');
    if(gen_texto) lista.append('<li>GENERACIÓN: ' + gen_texto + '</li>');
  }

});


//---------TARJETA MADRE---------------------------------------------------------------------
//ver los niveles
$(document).ready(function() {

    // variables de selección
    let marcatmadre_id = null, modtmadre_id = null;
    let marca_texto = null, modelo_texto = null;


    $('.nivel-10').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        marca_texto = $(this).text();
        $('#marcatmadre_id').val(id);

    // Ocultar todos los submenús de color antes de abrir el nuevo
    $('.nivel-11').hide();

        // Mostrar input si es OTRO
        if(id == 'otroMarcatm') {
            $('.otra_marcatm').show().focus();
      // Buscar el submenú más cercano y mostrarlo
            $(this).closest('ul').find('.nivel-11').first().show();
        } else {
            $('.otra_marcatm').hide();
            $(this).closest('li').find('.nivel-11').first().show();
        }

        actualizarListaTM();
    });



    // Input "Otro" marca
    $('.otra_marcatm').on('input', function() {
        marca_texto = $(this).val();
        $('#marcatmadre_id').val('otroMarcatm');
        actualizarListaTM();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
    $(this).closest('ul').find('.nivel-11').first().show();
    });

    
    // --- Selección de MODELO ---
    $('.nivel-12').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        modtmadre_id = id;
        modelo_texto = $(this).text();

        if(id == 'otroModtm') {
            $('.otro_modtm').show().focus();
      // Buscar el submenú más cercano y mostrarlo
        $(this).closest('ul').find('.nivel-11').first().show();
        } else {
            $('.otro_modtm').hide();
        // Mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-11').first().show();
        }
        actualizarListaTM();

    });

    // Input "Otro" modelo
    $('.otro_modtm').on('input', function() {
        modelo_texto = $(this).val();
        $('#modtmadre_id').val('otroModtm');
        actualizarListaTM();
    });

    // Función para actualizar lista visible
    function actualizarListaTM() {
        let lista = $('#seleccionestm');
        lista.empty();
        if(marca_texto) lista.append('<li>MARCA: ' + marca_texto + '</li>');
        if(modelo_texto) lista.append('<li>MODELO: ' + modelo_texto + '</li>');
    }

});


//--------- DISCO DURO----------------------------------------------------------

$(document).ready(function() {

    // selección
    let marca_texto = null, capacidad_texto = null, tipo_texto = null;

    // --- Selección de MARCA ---
    $(document).on("click", ".nivel-13", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        marcadisco_id = id;
        marca_texto = $(this).text();
        $('#marcadisco_id').val(id);

        $('.nivel-14').hide();
        if(id == 'otroMarcadisco') {
            $('.otra_marca_disco').show().focus();
      // Buscar el submenú color más cercano y mostrarlo
      $(this).closest('ul').find('.nivel-14').first().show();
        } else {
            $('.otra_marca_disco').hide();
      // Mostrar el siguiente nivel
      $(this).closest('li').find('.nivel-14').first().show();
        }

        actualizarListaDD();
    });

    $('.otra_marca_disco').on('input', function() {
        marca_texto = $(this).val();
        $('#marcadisco_id').val('otroMarcadisco');
        actualizarListaDD();

    // Al escribir en el input "Otro", mostrar el siguiente nivel
    $(this).closest('ul').find('.nivel-14').first().show();
    });

    // --- Selección de CAPACIDAD ---
    $(document).on("click", ".nivel-15", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        capacidad_texto = $(this).text();
        $('#capacdisco_id').val(id);
    // Ocultar todos los submenús de color antes de abrir el nuevo
    $('.nivel-16').hide();

        if(id == 'otroCapdisco') {
            $('.otra_capacidad_disco').show().focus();

      $(this).closest('ul').find('.nivel-16').first().show();
        } else {
            $('.otra_capacidad_disco').hide();
      // Mostrar el siguiente nivel
      $(this).closest('ul').find('.nivel-16').first().show();
        }
        actualizarListaDD();
    });

    $('.otra_capacidad_disco').on('input', function() {
        capacidad_texto = $(this).val();
        $('#capacdisco_id').val('otroCapdisco');
        actualizarListaDD();

    // Al escribir en el input "Otro", mostrar el siguiente nivel
    $(this).closest('ul').find('.nivel-16').first().show();
    });


        $(document).on("click", ".nivel-17", function(e){
        e.preventDefault();
        let id = $(this).data("id");
        $("#tipodisco_id").val(id);
         tipo_texto = $(this).text();

        if (id == "otroTipodisco") {
            $(".otro_tipo_disco").show().focus();
        } else {
            $(".otro_tipo_disco").hide();
        }
        actualizarListaDD();
    });
        // Cuando escriba en el input 
        $('.otro_tipo_disco').on('input', function(){
            tipo_texto = $(this).val();
            $('#tipodisco_id').val("otroTipodisco");
            actualizarListaDD();
        });


    // Actualizar la lista visible
    function actualizarListaDD() {
        let lista = $('#seleccionesdd');
        lista.empty();
        if(marca_texto) lista.append('<li>MARCA: ' + marca_texto + '</li>');
        if(capacidad_texto) lista.append('<li>CAPACIDAD: ' + capacidad_texto + '</li>');
        if(tipo_texto) lista.append('<li>TIPO: ' + tipo_texto + '</li>');
    }
});


//---------MEMORIA RAM---------------------------------------------------------------------

$(document).ready(function() {

    // letiables de selección
    let disipador_texto = null, marca_texto = null, capacidad_texto = null, tipo_texto = null, cantidad_texto = null;

    // --- Selección de DISIPADOR---
    $(document).on("click", ".nivel-18", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        disipador_texto = $(this).text();
        $('#disipador_id').val(id);

    // Ocultar todos los submenús de color antes de abrir el nuevo
    $('.nivel-19').hide();

        if(id == 'otro') {
            $('.otra_disp_ram').show().focus();
        $(this).closest('ul').find('.nivel-19').first().show();
        } else { 
            $('.otra_disp_ram').hide();
        $(this).closest('li').find('.nivel-19').first().show();
        }

        actualizarListaRAM();
    });

        $('.otra_disp_ram').on('input', function() {
        disipador_texto = $(this).val();
        actualizarListaRAM();
        $(this).closest('ul').find('.nivel-19').first().show();
    });

    // --- Selección de MARCA ---
   $(document).on("click", ".nivel-20", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        marca_texto = $(this).text();
        $('#marcaram_id').val(id);
    // Ocultar todos los submenús de color antes de abrir el nuevo
        $('.nivel-21').hide();
        if(id == 'otroMarcaram') {
            $('.otra_marca_ram').show().focus();
            $(this).closest('ul').find('.nivel-21').first().show();
        } else {
            $('.otra_marca_ram').hide();
      // Mostrar el siguiente nivel
            $(this).closest('li').find('.nivel-21').first().show();
        }
        actualizarListaRAM();
    });

    $('.otra_marca_ram').on('input', function() {
        marca_texto = $(this).val();
        $('#marcaram_id').val('otroMarcaram');
        actualizarListaRAM();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
    $(this).closest('ul').find('.nivel-21').first().show();
    });

    // --- Selección de CAPACIDAD ---
    $(document).on("click", ".nivel-22", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        capacidad_texto = $(this).text();
        $('#capacram_id').val(id);
    // Ocultar todos los submenús de color antes de abrir el nuevo
        $('.nivel-23').hide();
        if(id == 'otroCapram') {
            $('.otra_capacidad_ram').show().focus();
      // Buscar el submenú color más cercano y mostrarlo
        $(this).closest('ul').find('.nivel-23').first().show();
        } else {
            $('.otra_capacidad_ram').hide();
      // Mostrar el siguiente nivel
        $(this).closest('li').find('.nivel-23').first().show();
        }
        actualizarListaRAM();
    });

    $('.otra_capacidad_ram').on('input', function() {
        capacidad_texto = $(this).val();
        $('#capacram_id').val('otroCapram');
        actualizarListaRAM();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-23').first().show();
    });

    // --- Selección de tipo ---
    $(document).on("click", ".nivel-24", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        tipo_texto = $(this).text();
        $('#tiporam_id').val(id);
    // Ocultar todos los submenús de color antes de abrir el nuevo
        $('.nivel-25').hide();
        if(id == 'otroTiporam') {
            $('.otra_tipo_ram').show().focus();
      // Buscar el submenú color más cercano y mostrarlo
            $(this).closest('ul').find('.nivel-25').first().show();
        } else {
            $('.otra_tipo_ram').hide();
      // Mostrar el siguiente nivel
        $(this).closest('li').find('.nivel-25').first().show();
        }
        actualizarListaRAM();
    });

    $('.otra_tipo_ram').on('input', function() {
        tipo_texto = $(this).val();
        $('#tiporam_id').val('otroTiporam');
        actualizarListaRAM();

    // Al escribir en el input "Otro", mostrar el siguiente nivel
    $(this).closest('ul').find('.nivel-25').first().show();
    });

    // --- Selección de CANTIDAD ---
        $(document).on("click", ".nivel-26", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $('#cantidad_id').val(id);
        cantidad_texto = $(this).text();

        actualizarListaRAM();
    });

    // Actualizar la lista visible
    function actualizarListaRAM() {
        let lista = $('#seleccionesram');
        lista.empty();
        if(disipador_texto) lista.append('<li>DISIPADOR: ' + disipador_texto + '</li>');
        if(marca_texto) lista.append('<li>MARCA: ' + marca_texto + '</li>');
        if(capacidad_texto) lista.append('<li>CAPACIDAD: ' + capacidad_texto + '</li>');
        if(tipo_texto) lista.append('<li>TIPO: ' + tipo_texto + '</li>');
        if(cantidad_texto) lista.append('<li>CANTIDAD: ' + cantidad_texto + '</li>');
    }
});
//---------MEMORIA RAM 2---------------------------------------------------------------------

$(document).ready(function() {

    let disipador_texto2 = null, marca_texto2 = null, capacidad_texto2 = null, tipo_texto2 = null, cantidad_texto2 = null;

    // --- Selección de DISIPADOR---
    $(document).on("click", ".nivel-51", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        disipador_texto2 = $(this).text();
        $('#disipador2_id').val(id);

        $('.nivel-52').hide();
        if(id == 'otro') {
            $('.otra_disp_ram2').show().focus();
        $(this).closest('ul').find('.nivel-52').first().show();
        } else {
            $('.otra_disp_ram2').hide();
        $(this).closest('li').find('.nivel-52').first().show();
        }
        actualizarListaRAM2();

    });

        $('.otra_disp_ram2').on('input', function() {
        disipador_texto2 = $(this).val();
        $('#disipador2_id').val('otro');
        actualizarListaRAM2();
        $(this).closest('ul').find('.nivel-52').first().show();
    });

    // --- Selección de MARCA ---
    $(document).on("click", ".nivel-53", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        marca_texto2 = $(this).text();
        $('#marcaram2_id').val(id);

        $('.nivel-54').hide();
        if(id == 'otroMarcaram2') {
        $('.otra_marca_ram2').show().focus();
        $(this).closest('ul').find('.nivel-54').first().show();
        } else {
            $('.otra_marca_ram2').hide();
      // Mostrar el siguiente nivel
        $(this).closest('li').find('.nivel-54').first().show();
        }
        actualizarListaRAM2();

    });

    $('.otra_marca_ram2').on('input', function() {
        marca_texto2 = $(this).val();
        $('#marcaram2_id').val('otroMarcaram2');
        actualizarListaRAM2();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-54').first().show();
    });

    // --- Selección de CAPACIDAD ---
    $(document).on("click", ".nivel-55", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        capacidad_texto2 = $(this).text();
        $('#capacram2_id').val(id);
    // Ocultar todos los submenús de color antes de abrir el nuevo
        $('.nivel-56').hide();
        if(id == 'otroCapram2') {
            $('.otra_capacidad_ram2').show().focus();
            $(this).closest('ul').find('.nivel-56').first().show();
        } else {
            $('.otra_capacidad_ram2').hide();
      // Mostrar el siguiente nivel
            $(this).closest('li').find('.nivel-56').first().show();
        }
        actualizarListaRAM2();
    });

    $('.otra_capacidad_ram2').on('input', function() {
        capacidad_texto2 = $(this).val();
        $('#capacram2_id').val('otroCapram2');
        actualizarListaRAM2();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-56').first().show();
    });

    // --- Selección de tipo ---
    $(document).on("click", ".nivel-57", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        tipo_texto2 = $(this).text();
        $('#tiporam2_id').val(id);

        $('.nivel-58').hide();
        if(id == 'otroTiporam2') {
            $('.otra_tipo_ram2').show().focus();
            $(this).closest('ul').find('.nivel-58').first().show();
        } else {
            $('.otra_tipo_ram2').hide();
      // Mostrar el siguiente nivel
            $(this).closest('li').find('.nivel-58').first().show();
        }
        actualizarListaRAM2();
    });

    $('.otra_tipo_ram2').on('input', function() {
        tipo_texto2 = $(this).val();
        $('#tiporam2_id').val('otroTiporam2');
        actualizarListaRAM2();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-58').first().show();
    });

    // --- Selección de CANTIDAD ---
    $(document).on("click", ".nivel-59", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        $('#cantidad2_id').val(id);
        cantidad_texto2 = $(this).text();

        actualizarListaRAM2();
    });

    // Actualizar la lista visible
    function actualizarListaRAM2() {
        let lista = $('#seleccionesram2');
        lista.empty();
        if(disipador_texto2) lista.append('<li>DISIPADOR: ' + disipador_texto2 + '</li>');
        if(marca_texto2) lista.append('<li>MARCA: ' + marca_texto2 + '</li>');
        if(capacidad_texto2) lista.append('<li>CAPACIDAD: ' + capacidad_texto2 + '</li>');
        if(tipo_texto2) lista.append('<li>TIPO: ' + tipo_texto2 + '</li>');
        if(cantidad_texto2) lista.append('<li>CANTIDAD: ' + cantidad_texto2 + '</li>');
    }
});
//---------MEMORIA RAM 3---------------------------------------------------------------------

$(document).ready(function() {

    let disipador_texto3 = null, marca_texto3 = null, capacidad_texto3 = null, tipo_texto3 = null, cantidad_texto3 = null;

    // --- Selección de DISIPADOR---
    $(document).on("click", ".nivel-60", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        disipador_texto3 = $(this).text();
        $('#disipador3_id').val(disipador3_id);
    // Ocultar todos los submenús de color antes de abrir el nuevo
        $('.nivel-61').hide();
        if(id == 'otro') {
            $('.otra_disp_ram3').show().focus();
      // Buscar el submenú color más cercano y mostrarlo
        $(this).closest('ul').find('.nivel-61').first().show();
        } else {
            $('.otra_disp_ram3').hide();
        $(this).closest('li').find('.nivel-61').first().show();
        }
        actualizarListaRAM3();

    });
        $('.otra_disp_ram2').on('input', function() {
        disipador_texto3 = $(this).val();
        $('#disipador3_id').val('otro');
        actualizarListaRAM3();

        $('#submenu-marcaram3').show();
    });

    // --- Selección de MARCA ---
    $(document).on("click", ".nivel-62", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        marca_texto3 = $(this).text();
        $('#marcaram3_id').val(id);

    // Ocultar todos los submenús de color antes de abrir el nuevo
        $('.nivel-63').hide();
        if(id == 'otroMarcaram3') {
            $('.otra_marca_ram3').show().focus();
            $(this).closest('ul').find('.nivel-63').first().show();
        } else {
            $('.otra_marca_ram3').hide();
           $(this).closest('li').find('.nivel-63').first().show();
        }
        actualizarListaRAM3();
    });

    $('.otra_marca_ram3').on('input', function() {
        marca_texto3 = $(this).val();
        $('#marcaram3_id').val('otroMarcaram3');
        actualizarListaRAM3();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-63').first().show();
    });

    // --- Selección de CAPACIDAD ---
    $(document).on("click", ".nivel-64", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        capacidad_texto3 = $(this).text();
        $('#capacram3_id').val(id);


        $('.nivel-65').hide();
        if(id == 'otroCapram3') {
            $('.otra_capacidad_ram3').show().focus();
      // Buscar el submenú color más cercano y mostrarlo
            $(this).closest('ul').find('.nivel-65').first().show();
        } else {
            $('.otra_capacidad_ram3').hide();
            $(this).closest('li').find('.nivel-65').first().show();

        }

        actualizarListaRAM3();
    });

    $('.otra_capacidad_ram3').on('input', function() {
        capacidad_texto3 = $(this).val();
        $('#capacram3_id').val('otroCapram3');
        actualizarListaRAM3();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-65').first().show();
    });

    // --- Selección de tipo ---
    $(document).on("click", ".nivel-66", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        tipo_texto3 = $(this).text();
        $('#tiporam3_id').val(id);

        $('.nivel-67').hide();
        if(id == 'otroTiporam3') {
            $('.otra_tipo_ram3').show().focus();
            $(this).closest('ul').find('.nivel-67').first().show();
        } else {
            $('.otra_tipo_ram3').hide();
            $(this).closest('li').find('.nivel-67').first().show();
        }
        actualizarListaRAM3();
    });

    $('.otra_tipo_ram3').on('input', function() {
        tipo_texto3 = $(this).val();
        $('#tiporam3_id').val('otroTiporam3');
        actualizarListaRAM3();

    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-67').first().show();
    });

    // --- Selección de CANTIDAD ---
    $('.nivel-68').on('click', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $('#cantidad3_id').val(id);
        cantidad_texto3 = $(this).text();

        actualizarListaRAM3();
    });

    // Actualizar la lista visible
    function actualizarListaRAM3() {
        let lista = $('#seleccionesram3');
        lista.empty();
        if(disipador_texto3) lista.append('<li>DISIPADOR: ' + disipador_texto3 + '</li>');
        if(marca_texto3) lista.append('<li>MARCA: ' + marca_texto3 + '</li>');
        if(capacidad_texto3) lista.append('<li>CAPACIDAD: ' + capacidad_texto3 + '</li>');
        if(tipo_texto3) lista.append('<li>TIPO: ' + tipo_texto3 + '</li>');
        if(cantidad_texto3) lista.append('<li>CANTIDAD: ' + cantidad_texto3 + '</li>');
    }
});

//----------------------------TARJETA RAM 4 -------------------------------
$(document).ready(function() {

    let disipador_texto4 = null, marca_texto4 = null, capacidad_texto4 = null, tipo_texto4 = null, cantidad_texto4 = null;

    // --- Selección de DISIPADOR---
    $(document).on("click", ".nivel-69", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        disipador_texto4 = $(this).text();
        $('#disipador4_id').val(disipador4_id);

        $('.nivel-70').hide();
        if(id == 'otro') {
            $('.otra_disp_ram4').show().focus();
            $(this).closest('ul').find('.nivel-70').first().show();
        } else {
            $('.otra_disp_ram4').hide();
            $(this).closest('li').find('.nivel-70').first().show();
        }
        actualizarListaRAM4();
    });

        $('.otra_disp_ram4').on('input', function() {
        disipador_texto4 = $(this).val();
        $('#disipador4_id').val('otro');
        actualizarListaRAM4();

        $(this).closest('ul').find('.nivel-70').first().show();
    });

        // --- Selección de MARCA ---
    $(document).on("click", ".nivel-71", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        marca_texto4 = $(this).text();
        $('#marcaram4_id').val(id);

    // Ocultar todos los submenús de color antes de abrir el nuevo
        $('.nivel-72').hide();
        if(id == 'otroMarcaram4') {
            $('.otra_marca_ram4').show().focus();
            $(this).closest('ul').find('.nivel-72').first().show();
        } else {
            $('.otra_marca_ram4').hide();
           $(this).closest('li').find('.nivel-72').first().show();
        }
        actualizarListaRAM4();
    });

    $('.otra_marca_ram4').on('input', function() {
        marca_texto4 = $(this).val();
        $('#marcaram4_id').val('otroMarcaram4');
        actualizarListaRAM4();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-72').first().show();
    });


    // --- Selección de CAPACIDAD ---
    $(document).on("click", ".nivel-73", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        capacidad_texto4 = $(this).text();
        $('#capacram4_id').val(id);

        $('.nivel-74').hide();
        if(id == 'otroCapram4') {
            $('.otra_capacidad_ram4').show().focus();
            $(this).closest('ul').find('.nivel-74').first().show();
        } else {
            $('.otra_capacidad_ram4').hide();
            $(this).closest('li').find('.nivel-74').first().show();
        }
        actualizarListaRAM4();
    });

    $('.otra_capacidad_ram4').on('input', function() {
        capacidad_texto4 = $(this).val();
        $('#capacram4_id').val('otroCapram4');
        actualizarListaRAM4();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-74').first().show();
    });

    // --- Selección de tipo ---
    $(document).on("click", ".nivel-75", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        tipo_texto4 = $(this).text();
        $('#tiporam4_id').val(id);

        $('.nivel-76').hide();
        if(id == 'otroTiporam4') {
            $('.otra_tipo_ram4').show().focus();
            $(this).closest('ul').find('.nivel-76').first().show();
        } else {
            $('.otra_tipo_ram4').hide();
            $(this).closest('li').find('.nivel-76').first().show();
        }
        actualizarListaRAM4();
    });

    $('.otra_tipo_ram4').on('input', function() {
        tipo_texto4 = $(this).val();
        $('#tiporam4_id').val('otroTiporam4');
        actualizarListaRAM4();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-76').first().show();
    });

    // --- Selección de CANTIDAD ---
    $(document).on("click", ".nivel-77", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        cantidad4_id = id;
        $('#cantidad4_id').val(id);
        cantidad_texto4 = $(this).text();

        actualizarListaRAM4();
    });

    // Actualizar la lista visible
    function actualizarListaRAM4() {
        let lista = $('#seleccionesram4');
        lista.empty();
        if(disipador_texto4) lista.append('<li>DISIPADOR: ' + disipador_texto4 + '</li>');
        if(marca_texto4) lista.append('<li>MARCA: ' + marca_texto4 + '</li>');
        if(capacidad_texto4) lista.append('<li>CAPACIDAD: ' + capacidad_texto4 + '</li>');
        if(tipo_texto4) lista.append('<li>TIPO: ' + tipo_texto4 + '</li>');
        if(cantidad_texto4) lista.append('<li>CANTIDAD: ' + cantidad_texto4 + '</li>');
    }
});


//--------- TARJETA DE VIDEO----------------------------------------------------------

$(document).ready(function() {

    let marcatvideo = null, capacidadtvideo = null, tipotvideo = null;

    // --- Selección de MARCA ---
    $(document).on("click", ".nivel-27", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        marcatvideo = $(this).text();
        $('#marcatvideo_id').val(id);

        $('.nivel-28').hide();
        if(id == 'otroMarcatv') {
            $('.otra_marca_tvideo').show().focus();
            $(this).closest('ul').find('.nivel-28').first().show();
        } else {
            $('.otra_marca_tvideo').hide();
      // Mostrar el siguiente nivel
            $(this).closest('li').find('.nivel-28').first().show();
        }

        actualizarListaTV();
    });

    $('.otra_marca_tvideo').on('input', function() {
        marcatvideo = $(this).val();
        $('#marcatvideo_id').val('otroMarcatv');
        actualizarListaTV();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-28').first().show();
    });

    // --- Selección de CAPACIDAD ---
    $(document).on("click", ".nivel-29", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        capacidadtvideo = $(this).text();
        $('#capactvideo_id').val(id);

        $('.nivel-30').hide();
        if(id == 'otroCaptv') {
            $('.otra_capacidad_tvideo').show().focus();
            $(this).closest('ul').find('.nivel-30').first().show();
        } else {
            $('.otra_capacidad_tvideo').hide();
      // Mostrar el siguiente nivel
            $(this).closest('li').find('.nivel-30').first().show();
        }
        actualizarListaTV();
    });

    $('.otra_capacidad_tvideo').on('input', function() {
        capacidadtvideo = $(this).val();
        $('#capactvideo_id').val('otroCaptv');
        actualizarListaTV();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
            $(this).closest('ul').find('.nivel-30').first().show();
    });

    // --- Selección de TIPO -------------------------
    $(document).on("click", ".nivel-31", function(e){
        e.preventDefault();

        let id = $(this).data('id');
        tipotvideo = $(this).text();
        $('#tipotvideo_id').val(id);
        if(id == 'otro') {
            $('.otro_tipo_tvideo').show().focus();
        } else {
            $('.otro_tipo_tvideo').hide();
        }

        actualizarListaTV();
    });

    $('.otro_tipo_tvideo').on('input', function() {
        tipotvideo = $(this).val();
        $('#tipotvideo_id').val('otro');
        actualizarListaTV();
    });

    // Actualizar la lista visible
    function actualizarListaTV() {
        let lista = $('#seleccionestvideo');
        lista.empty();
        if(marcatvideo) lista.append('<li>MARCA: ' + marcatvideo + '</li>');
        if(capacidadtvideo) lista.append('<li>CAPACIDAD: ' + capacidadtvideo + '</li>');
        if(tipotvideo) lista.append('<li>TIPO: ' + tipotvideo + '</li>');
    }
});

//---------TARJETA DE RED---------------------------------------------------------------------
$(document).ready(function() {

  let marcatred = null, modelotred = null;

  // --- Selección de MARCA ---
  $(document).on("click", ".nivel-40", function(e){
    e.preventDefault();

    let id = $(this).data('id');
    marcatred = $(this).text();
    $('#marcatred_id').val(id);

    $('.nivel-41').hide();
    if (id == 'otroMarcatred') {
        $('.otra_marca_tred').show().focus();
        $(this).closest('ul').find('.nivel-41').first().show();
    } else {
        $('.otra_marca_tred').hide();
      // Mostrar el siguiente nivel
        $(this).closest('li').find('.nivel-41').first().show();
    }
    actualizarListaTR();
    });

  // Input "Otro" para MARCA
    $('.otra_marca_tred').on('input', function() {
    marcatred = $(this).val();
    $('#marcatred_id').val('otroMarcatred');
    actualizarListaTR();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-41').first().show();
    });

  // --- Selección de MODELO ---
    $(document).on("click", ".nivel-42", function(e){
    e.preventDefault();

    let id = $(this).data('id');
    modelotred = $(this).text();
    $('#modtred_id').val(id);

    if (id == 'otroModtred') {
        $('.otro_modelo_tred').show().focus();
    } else {
        $('.otro_modelo_tred').hide();
    }
    actualizarListaTR();
  });

  // Input "Otro" para MODELO
  $('.otro_modelo_tred').on('input', function() {
    modelotred = $(this).val();
    $('#modtred_id').val('otroModtred');
    actualizarListaTR();
  });

  // --- Mostrar lista seleccionada ---
  function actualizarListaTR() {
    let lista = $('#seleccionestred');
    lista.empty();
    if (marcatred) lista.append('<li>MARCA: ' + marcatred + '</li>');
    if (modelotred) lista.append('<li>MODELO: ' + modelotred + '</li>');
  }
});

//---------TARJETA WIFI---------------------------------------------------------------------

$(document).ready(function() {

    let marcaTwifi = null, modeloWifi = null, antena = null;

    // --- Selección de MARCA ---
    $(document).on("click", ".nivel-43", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        marcaTwifi = $(this).text();
        $('#marcawifi_id').val(id);

        $('.nivel-44').hide();
        if(id == 'otroMarcawifi') {
            $('.otra_marca_wifi').show().focus();
            $(this).closest('ul').find('.nivel-44').first().show();
        } else {
            $('.otra_marca_wifi').hide();
      // Mostrar el siguiente nivel
            $(this).closest('li').find('.nivel-44').first().show();
        }
        actualizarListaWIFI();
    });

    $('.otra_marca_wifi').on('input', function() {
        marcaTwifi = $(this).val();
        $('#marcawifi_id').val('otroMarcawifi');
        actualizarListaWIFI();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-44').first().show();
    });

    // --- Selección MODELO---
    $(document).on("click", ".nivel-45", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        modeloWifi = $(this).text();
        $('#modcawifi_id').val(id);

    $('.nivel-80').hide();
        if(id == 'otroModwifi') {
            $('.otra_modelo_wifi').show().focus();
            $(this).closest('ul').find('.nivel-80').first().show();
        } else {
            $('.otra_modelo_wifi').hide();
      // Mostrar el siguiente nivel
            $(this).closest('li').find('.nivel-80').first().show();
        }
        actualizarListaWIFI();
    });

    $('.otra_modelo_wifi').on('input', function() {
        modeloWifi = $(this).val();
        $('#modcawifi_id').val('otroModwifi');
        actualizarListaWIFI();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-80').first().show();
    });

    // --- Selección ANTENA-------------------------
    $(document).on("click", ".nivel-81", function(e){
        e.preventDefault();

        let id = $(this).data('id');
        antena_id = id;
        antena = $(this).text();
        $('#antena_id').val(id);

        if(id == 'otro') {
            $('.otro_antena').show().focus();
        } else {
            $('.otro_antena').hide();
        }

        actualizarListaWIFI();
    });

    $('.otro_antena').on('input', function() {
        antena = $(this).val();
        $('#antena_id').val('otro');
        actualizarListaWIFI();
    });

    // Actualizar la lista visible
    function actualizarListaWIFI() {
        let lista = $('#seleccioneswifi');
        lista.empty();
        if(marcaTwifi) lista.append('<li>MARCA: ' + marcaTwifi + '</li>');
        if(modeloWifi) lista.append('<li>MODELO: ' + modeloWifi + '</li>');
        if(antena) lista.append('<li>ANTENA: ' + antena + '</li>');
    }
});

//---------FUENTE DE PODER--------------------------------------------------------------------
$(document).ready(function() {

    let marcafuente = null, potenciafuente = null, cable = null;

    // --- Selección de MARCA ---
    $(document).on("click", ".nivel-46", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        marcafuente = $(this).text();
        $('#marcafuente_id').val(id);

        $('.nivel-47').hide();
        if(id == 'otroMarcafuente') {
            $('.otra_marca_fuente').show().focus();
            $(this).closest('ul').find('.nivel-47').first().show();
        } else {
            $('.otra_marca_fuente').hide();
            $(this).closest('li').find('.nivel-47').first().show();
        }

        actualizarListaFUENTE();
    });

    $('.otra_marca_fuente').on('input', function() {
        marcafuente = $(this).val();
        $('#marcafuente_id').val('otroMarcafuente');
        actualizarListaFUENTE();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-47').first().show();
    });

    // --- Selección POTENCIA ---
    $(document).on("click", ".nivel-48", function(e){
        e.preventDefault();
        let id = $(this).data('id');
        potenciafuente = $(this).text();
        $('#potfuente_id').val(id);

        $('.nivel-78').hide();
        if(id == 'otroPotenciafuente') {
            $('.otra_potencia_fuente').show().focus();
            $(this).closest('ul').find('.nivel-78').first().show();
        } else {
            $('.otra_potencia_fuente').hide();
            $(this).closest('li').find('.nivel-78').first().show();
        }
        actualizarListaFUENTE();
    });

    $('.otra_potencia_fuente').on('input', function() {
        potenciafuente = $(this).val();
        $('#potfuente_id').val('otroPotenciafuente');
        actualizarListaFUENTE();
    // Al escribir en el input "Otro", mostrar el siguiente nivel
        $(this).closest('ul').find('.nivel-78').first().show();
    });

    // --- Selección cable-------------------------
    $(document).on("click", ".nivel-79", function(e){
        e.preventDefault();

        let id = $(this).data('id');
        cable_id = id;
        cable = $(this).text();
        $('#cable_id').val(id);

        if(id == 'otro') {
            $('.otro_cable').show().focus();
        } else {
            $('.otro_cable').hide();
        }

        actualizarListaFUENTE();
    });

    $('.otro_cable').on('input', function() {
        cable = $(this).val();
        $('#cable_id').val('otro');
        actualizarListaFUENTE();
    });

    // Actualizar la lista visible
    function actualizarListaFUENTE() {
        let lista = $('#seleccionesfuente');
        lista.empty();
        if(marcafuente) lista.append('<li>MARCA: ' + marcafuente + '</li>');
        if(potenciafuente) lista.append('<li>POTENCIA: ' + potenciafuente + '</li>');
        if(cable) lista.append('<li>CABLE: ' + cable + '</li>');
    }
});

//---------LECTOR DE CD--------------------------------------------------------------------
$(document).ready(function() {

  let marcalectorcd = null;

  // --- Selección de MARCA ---
  $(document).on("click", ".nivel-49", function(e){
    e.preventDefault();

    let id = $(this).data('id');
    marcalectorcd = $(this).text();
    $('#marcacd_id').val(id);

    if (id == 'otroMarcacd') {
      $('.otro_marca_cd').show().focus();
    } else {
      $('.otro_marca_cd').hide();
    }
    actualizarListaCD();
  });

  // Input "Otro" para COLOR
  $('.otro_marca_cd').on('input', function() {
    marcalectorcd = $(this).val();
    $('#marcacd_id').val('otroMarcacd');
    actualizarListaCD();
  });
    // --- Mostrar lista seleccionada ---
  function actualizarListaCD() {
    let lista = $('#seleccionescd');
    lista.empty();
    if (marcalectorcd) lista.append('<li>MARCA: ' + marcalectorcd + '</li>');
  }
});

