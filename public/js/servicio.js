
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

                    data: {
                        query: query
                    },

                    success: function(data) {

                        // =====================================================
                        // LIMPIAR DATOS
                        // =====================================================

                        $('#nombre').val('');
                        $('#paterno').val('');
                        $('#materno').val('');
                        $('#funcionario_id').val('');

                        $('#celular').val('');
                        $('#email').val('');
                        $('#cargo').val('');
                        $('#expedido').val('');

                        $('#search-input').val('');
                        $('#id-selected').val('');


                        // =====================================================
                        // FUNCIONARIO ENCONTRADO
                        // =====================================================

                        if (data.length > 0) {

                            var funcionario = data[0];

                            // ---------------------------------------------
                            // Guardar ID del funcionario
                            // ---------------------------------------------

                            $('#funcionario_id').val(funcionario.id);


                            // ---------------------------------------------
                            // Ocultar campos para funcionario nuevo
                            // ---------------------------------------------

                            $('#funcionario-nuevo').hide();

                            // Mostrar funcionario encontrado
                            $('#funcionario-existente').show();


                            // ---------------------------------------------
                            // Mostrar nombre completo
                            // ---------------------------------------------

                            $('#nombre-existente').val(
                                funcionario.nombre + ' ' +
                                funcionario.paterno + ' ' +
                                funcionario.materno
                            );


                            // ---------------------------------------------
                            // Dependencia
                            // ---------------------------------------------

                            $('#search-input').val(
                                funcionario.dependencia.dependencias
                            );

                            $('#id-selected').val(
                                funcionario.dependencia_id
                            );


                            // ---------------------------------------------
                            // Otros datos existentes
                            // ---------------------------------------------

                            $('#celular').val(funcionario.celular);
                            $('#cargo').val(funcionario.cargo);

                            $('select[name="expedido"]').val(
                                funcionario.expedido
                            );

                        }


                        // =====================================================
                        // FUNCIONARIO NO ENCONTRADO
                        // =====================================================

                        else {

                            // ---------------------------------------------
                            // Mostrar campos para registrar funcionario
                            // ---------------------------------------------

                            $('#funcionario-existente').hide();

                            $('#funcionario-nuevo').show();


                            // ---------------------------------------------
                            // Limpiar campos nuevos
                            // ---------------------------------------------

                            $('#nombre').val('');
                            $('#paterno').val('');
                            $('#materno').val('');


                            // ---------------------------------------------
                            // Quitar funcionario_id
                            // ---------------------------------------------

                            $('#funcionario_id').val('');

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
