$(document).ready(function() {
    var timeout = null;
    $('#ci').on('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            var query = $('#ci').val();
            if (query.length >= 6) {
                $.ajax({
                    type: 'GET',
                    url: '/buscarFuncionario',
                    data: { query: query },
                    success: function(data) {
                        // Limpiar los inputs antes de agregar nuevos resultados
                        $('#grado_academico').val('');
                        $('#nombre').val('');
                        $('#paterno').val('');
                        $('#materno').val('');
                        $('#celular').val('');
                        $('#email').val('');
                        $('#cargo').val('');
                        $('#expedido').val('');
                        $('#search-inputA').val('');
                        $('#id-selectedM').val('');

                        // Mostrar el primer resultado en los inputs
                        if (data.length > 0) {
                            $('select[name="grado_academico"]').val(data[0].grado_academico);
                            $('#nombre').val(data[0].nombre);
                            $('#paterno').val(data[0].paterno);
                            $('#materno').val(data[0].materno);
                            $('#celular').val(data[0].celular);
                            $('#email').val(data[0].email);
                            $('#cargo').val(data[0].cargo);
                            $('select[name="expedido"]').val(data[0].expedido);
                            $('#search-inputA').val(data[0].dependencia.dependencias);
                            $('#id-selectedM').val(data[0].dependencia_id);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }, 500);
    });
});


$(document).ready(function() {
    var timeout = null;
    $('#cod_gamea').on('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            var query = $('#cod_gamea').val();
            if (query.length >= 3) {
                $.ajax({
                    type: 'GET',
                    url: '/buscarEquipo',
                    data: { query: query },
                    success: function(data) {
                        // Limpiar los inputs antes de agregar nuevos resultados
                        $('#marca').val('');
                        $('#modelo').val('');
                        // Mostrar el primer resultado en los inputs
                        if (data.length > 0) {
                            $('#marca').val(data[0].marca);
                            $('#modelo').val(data[0].modelo);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }, 500);
    });
});
