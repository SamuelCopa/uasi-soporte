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
                        // $('#grado_academico').val('');
                        $('#nombre').val('');
                        $('#paterno').val('');
                        $('#materno').val('');
                        $('#celular').val('');
                        $('#email').val('');
                        $('#cargo').val('');
                        $('#expedido').val('');
                        $('#search-input').val('');
                        $('#id-selected').val('');

                        // Mostrar el primer resultado en los inputs
                        if (data.length > 0) {
                            $('#nombre').val(data[0].nombre);
                            $('#nombre').val(
                                // data[0].grado_academico + ' ' +
                                data[0].nombre + ' ' +
                                data[0].paterno + ' ' +
                                data[0].materno
                            );
                            $('#celular').val(data[0].celular);
                            $('#cargo').val(data[0].cargo);
                            $('select[name="expedido"]').val(data[0].expedido);
                            // Capturar ID del funcionario
                             $('#funcionario_id').val(data[0].id);
                            $('#search-input').val(data[0].dependencia.dependencias);
                            $('#id-selected').val(data[0].dependencia_id);
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