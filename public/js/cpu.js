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
                        $('#search-inputC').val('');
                        $('#id-selectedC').val('');
                        // Mostrar el primer resultado en los inputs
                        if (data.length > 0) {
                            // $('select[name="grado_academico"]').val(data[0].grado_academico);
                            $('#nombre').val(data[0].nombre);
                            $('#grado_academico').val(data[0].grado_academico);
                            $('#paterno').val(data[0].paterno);
                            $('#materno').val(data[0].materno);
                            $('#celular').val(data[0].celular);
                            $('#email').val(data[0].email);
                            $('#cargo').val(data[0].cargo);
                            $('select[name="expedido"]').val(data[0].expedido);
                            $('#search-inputC').val(data[0].dependencia.dependencias);
                            $('#id-selectedC').val(data[0].dependencia_id);
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
    $('#selecciones').hide();
    $('#seleccionesp').hide();
    $('#seleccionesdd').hide();
    $('#seleccionesdd2').hide();
    $('#seleccionestm').hide();
    $('#seleccionesram').hide();
    $('#seleccionesram2').hide();
    $('#seleccionesram3').hide();
    $('#seleccionesram4').hide();
    $('#seleccionestvideo').hide();
    $('#seleccionestred').hide();
    $('#seleccioneswifi').hide();
    $('#seleccionesfuente').hide();
    $('#seleccionescd').hide();
    var timeout = null;
    $('#cod_gamea').on('keyup', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            var query = $('#cod_gamea').val();
            if (query.length >= 2) {
                $.ajax({
                    type: 'GET',
                    url: '/buscaCpu',
                    data: { query: query },
                    success: function(data) {
                        // Limpiar los inputs antes de agregar nuevos resultados

                            $('#marcacase_id').val(''); 
                            $('#colorcase_id').val(''); 
                            $('#marcacase').text('-------'); 
                            $('#colorcase').text('-------');

                            $('#marcaprocesador_id').val('');
                            $('#modeloprocesador_id').val('');
                            $('#genprocesador_id').val('');
                            $('#marcaprocesador').text('-------');
                            $('#modeloprocesador').text('-------');
                            $('#genprocesador').text('-------');

                            $('#marcadisco_id').val(''); 
                            $('#capacdisco_id').val(''); 
                            $('#tipodisco_id').val(''); 
                            $('#marcadisco').text('-------');
                            $('#capdisco').text('-------');
                            $('#tipodisco').text('-------');

                            $('#marcadisco2_id').val(''); 
                            $('#capacdisco2_id').val(''); 
                            $('#tipodisco2_id').val(''); 
                            $('#marcadisco2').text('-------');
                            $('#capdisco2').text('-------');
                            $('#tipodisco2').text('-------');

                            $('#marcatmadre_id').val(''); 
                            $('#modtmadre_id').val(''); 
                            $('#marcatmadre').text('-------');
                            $('#modtmadre').text('-------');

                            $('#disipador_id').val(''); 
                            $('#marcaram_id').val(''); 
                            $('#capacram_id').val(''); 
                            $('#tiporam_id').val(''); 
                            $('#cantidad_id').val(''); 
                            $('#disipadorram').text('-------');
                            $('#marcaram').text('-------');
                            $('#capacidadram').text('-------');
                            $('#tiporam').text('-------');
                            $('#cantidad').text('-------');

                            $('#disipador2_id').val(''); 
                            $('#marcaram2_id').val(''); 
                            $('#capacram2_id').val(''); 
                            $('#tiporam2_id').val(''); 
                            $('#cantidad2_id').val(''); 
                            $('#disipadorram2').text('-------');
                            $('#marcaram2').text('-------');
                            $('#capacidadram2').text('-------');
                            $('#tiporam2').text('-------');
                            $('#cantidad2').text('-------');

                            $('#disipador3_id').val(''); 
                            $('#marcaram3_id').val(''); 
                            $('#capacram3_id').val(''); 
                            $('#tiporam3_id').val(''); 
                            $('#cantidad3_id').val(''); 
                            $('#disipadorram3').text('-------');
                            $('#marcaram3').text('-------');
                            $('#capacidadram3').text('-------');
                            $('#tiporam3').text('-------');
                            $('#cantidad3').text('-------');

                            $('#disipador4_id').val(''); 
                            $('#marcaram4_id').val(''); 
                            $('#capacram4_id').val(''); 
                            $('#tiporam4_id').val(''); 
                            $('#cantidad4_id').val(''); 
                            $('#disipadorram4').text('-------');
                            $('#marcaram4').text('-------');
                            $('#capacidadram4').text('-------');
                            $('#tiporam4').text('-------');
                            $('#cantidad4').text('-------');

                            $('#marcatvideo_id').val(''); 
                            $('#capactvideo_id').val(''); 
                            $('#tipotvideo_id').val(''); 
                            $('#marcatvideo').text('-------');
                            $('#capacidadtvideo').text('-------');
                            $('#tipotvideo').text('-------');

                            $('#marcatred_id').val(''); 
                            $('#modtred_id').val(''); 
                            $('#marcatred').text('-------');
                            $('#modelotred').text('-------');

                            $('#antena_id').val(''); 
                            $('#marcawifi_id').val(''); 
                            $('#modcawifi_id').val(''); 
                            $('#antena').text('-------');
                            $('#marcaTwifi').text('-------');
                            $('#modeloWifi').text('-------');

                            $('#marcafuente_id').val(''); 
                            $('#potfuente_id').val(''); 
                            $('#cable_id').val(''); 
                            $('#marcafuente').text('-------'); 
                            $('#potenciafuente').text('-------');
                            $('#cable').text('-------');

                            $('#marcacd_id').val(''); 
                            $('#marcalectorcd').text('-------'); 
                            
                        // Mostrar el primer resultado en los inputs
                        if (data.length > 0) {
                            var ultimoResultado = data[data.length - 1];
                            $('#selecciones').show();
                            $('#marcacase_id').val(ultimoResultado.marcacase_id); 
                            $('#colorcase_id').val(ultimoResultado.colorcase_id);
                            $('#marcacase').text(ultimoResultado.marcacase && ultimoResultado.marcacase.marca ? 'MARCA: ' + ultimoResultado.marcacase.marca : '-------');
                            $('#colorcase').text(ultimoResultado.colorcase && ultimoResultado.colorcase.color ? 'COLOR: ' + ultimoResultado.colorcase.color : '-------');

                            $('#seleccionesp').show();
                            $('#marcaprocesador_id').val(ultimoResultado.marcaprocesador_id); 
                            $('#modeloprocesador_id').val(ultimoResultado.modeloprocesador_id);
                            $('#genprocesador_id').val(ultimoResultado.genprocesador_id);
                            $('#marcaprocesador').text(ultimoResultado.marcaprocesador && ultimoResultado.marcaprocesador.marca ? 'MARCA: ' + ultimoResultado.marcaprocesador.marca : '-------');
                            $('#modeloprocesador').text(ultimoResultado.modeloprocesador && ultimoResultado.modeloprocesador.modelo ? 'MODELO: ' + ultimoResultado.modeloprocesador.modelo : '-------');
                            $('#genprocesador').text(ultimoResultado.genprocesador && ultimoResultado.genprocesador.generacion ? 'GENERACIÓN: ' + ultimoResultado.genprocesador.generacion : '-------');

                            $('#seleccionesdd').show();
                            $('#marcadisco_id').val(ultimoResultado.marcadisco_id); 
                            $('#capacdisco_id').val(ultimoResultado.capacdisco_id);
                            $('#tipodisco_id').val(ultimoResultado.tipodisco_id);
                            $('#marcadisco').text(ultimoResultado.marcadisco && ultimoResultado.marcadisco.marca ? 'MARCA: ' + ultimoResultado.marcadisco.marca : '-------');
                            $('#capdisco').text(ultimoResultado.capacidaddisco && ultimoResultado.capacidaddisco.capacidad ? 'CAPACIDAD: ' + ultimoResultado.capacidaddisco.capacidad : '-------');
                            $('#tipodisco').text(ultimoResultado.tipodisco && ultimoResultado.tipodisco.tipo ? 'TIPO: ' + ultimoResultado.tipodisco.tipo : '-------');

                            $('#seleccionesdd2').show();
                            $('#marcadisco2_id').val(ultimoResultado.marcadisco2_id); 
                            $('#capacdisco2_id').val(ultimoResultado.capacdisco2_id);
                            $('#tipodisco2_id').val(ultimoResultado.tipodisco2_id);
                            $('#marcadisco2').text(ultimoResultado.marcadisco2 && ultimoResultado.marcadisco2.marca ? 'MARCA: ' + ultimoResultado.marcadisco2.marca : '-------');
                            $('#capdisco2').text(ultimoResultado.capacidaddisco2 && ultimoResultado.capacidaddisco2.capacidad ? 'CAPACIDAD: ' + ultimoResultado.capacidaddisco2.capacidad : '-------');
                            $('#tipodisco2').text(ultimoResultado.tipodisco2 && ultimoResultado.tipodisco2.tipo ? 'TIPO: ' + ultimoResultado.tipodisco2.tipo : '-------');

                            $('#seleccionestm').show();
                            $('#marcatmadre_id').val(ultimoResultado.marcatmadre_id); 
                            $('#modtmadre_id').val(ultimoResultado.modtmadre_id);
                            $('#marcatmadre').text(ultimoResultado.marcatmadre && ultimoResultado.marcatmadre.marca ? 'MARCA: ' + ultimoResultado.marcatmadre.marca : '-------');
                            $('#modtmadre').text(ultimoResultado.modelotmadre && ultimoResultado.modelotmadre.modelo ? 'MODELO: ' + ultimoResultado.modelotmadre.modelo : '------');

                            $('#seleccionesram').show();
                            $('#disipador_id').val(ultimoResultado.disipador_id); 
                            $('#marcaram_id').val(ultimoResultado.marcaram_id);
                            $('#capacram_id').val(ultimoResultado.capacram_id);
                            $('#tiporam_id').val(ultimoResultado.tiporam_id);
                            $('#cantidad_id').val(ultimoResultado.cantidad_id);
                            $('#disipadorram').text(ultimoResultado.disipadorram && ultimoResultado.disipadorram.opcion ? 'DISIPADOR: ' + ultimoResultado.disipadorram.opcion : '-------');
                            $('#marcaram').text(ultimoResultado.marcaram && ultimoResultado.marcaram.marca ? 'MARCA: ' + ultimoResultado.marcaram.marca : '-------');
                            $('#capacidadram').text(ultimoResultado.capacidadram && ultimoResultado.capacidadram.capacidad ? 'CAPACIDAD: ' + ultimoResultado.capacidadram.capacidad : '-------');
                            $('#tiporam').text(ultimoResultado.tiporam && ultimoResultado.tiporam.tipo ? 'TIPO: ' + ultimoResultado.tiporam.tipo : '-------');
                            $('#cantidad').text(ultimoResultado.cantidadram && ultimoResultado.cantidadram.cantidad ? 'CANTIDAD: ' + ultimoResultado.cantidadram.cantidad : '-------');

                            $('#seleccionesram2').show();
                            $('#disipador2_id').val(ultimoResultado.disipador2_id); 
                            $('#marcaram2_id').val(ultimoResultado.marcaram2_id);
                            $('#capacram2_id').val(ultimoResultado.capacram2_id);
                            $('#tiporam2_id').val(ultimoResultado.tiporam2_id);
                            $('#cantidad2_id').val(ultimoResultado.cantidad2_id);
                            $('#disipadorram2').text(ultimoResultado.disipadorram2 && ultimoResultado.disipadorram2.opcion ? 'DISIPADOR: ' + ultimoResultado.disipadorram2.opcion : '-------');
                            $('#marcaram2').text(ultimoResultado.marcaram2 && ultimoResultado.marcaram2.marca ? 'MARCA: ' + ultimoResultado.marcaram2.marca : '-------');
                            $('#capacidadram2').text(ultimoResultado.capacidadram2 && ultimoResultado.capacidadram2.capacidad ? 'CAPACIDAD: ' + ultimoResultado.capacidadram2.capacidad : '-------');
                            $('#tiporam2').text(ultimoResultado.tiporam2 && ultimoResultado.tiporam2.tipo ? 'TIPO: ' + ultimoResultado.tiporam2.tipo : '-------');
                            $('#cantidad2').text(ultimoResultado.cantidadram2 && ultimoResultado.cantidadram2.cantidad ? 'CANTIDAD: ' + ultimoResultado.cantidadram2.cantidad : '-------');

                            $('#seleccionesram3').show();
                            $('#disipador3_id').val(ultimoResultado.disipador3_id); 
                            $('#marcaram3_id').val(ultimoResultado.marcaram3_id);
                            $('#capacram3_id').val(ultimoResultado.capacram3_id);
                            $('#tiporam3_id').val(ultimoResultado.tiporam3_id);
                            $('#cantidad3_id').val(ultimoResultado.cantidad3_id);
                            $('#disipadorram3').text(ultimoResultado.disipadorram3 && ultimoResultado.disipadorram3.opcion ? 'DISIPADOR: ' + ultimoResultado.disipadorram3.opcion : '-------');
                            $('#marcaram3').text(ultimoResultado.marcaram3 && ultimoResultado.marcaram3.marca ? 'MARCA: ' + ultimoResultado.marcaram3.marca : '-------');
                            $('#capacidadram3').text(ultimoResultado.capacidadram3 && ultimoResultado.capacidadram3.capacidad ? 'CAPACIDAD: ' + ultimoResultado.capacidadram3.capacidad : '-------');
                            $('#tiporam3').text(ultimoResultado.tiporam3 && ultimoResultado.tiporam3.tipo ? 'TIPO: ' + ultimoResultado.tiporam3.tipo : '-------');
                            $('#cantidad3').text(ultimoResultado.cantidadram3 && ultimoResultado.cantidadram3.cantidad ? 'CANTIDAD: ' + ultimoResultado.cantidadram3.cantidad : '-------');

                            $('#seleccionesram4').show();
                            $('#disipador4_id').val(ultimoResultado.disipador4_id); 
                            $('#marcaram4_id').val(ultimoResultado.marcaram4_id);
                            $('#capacram4_id').val(ultimoResultado.capacram4_id);
                            $('#tiporam4_id').val(ultimoResultado.tiporam4_id);
                            $('#cantidad4_id').val(ultimoResultado.cantidad4_id);
                            $('#disipadorram4').text(ultimoResultado.disipadorram4 && ultimoResultado.disipadorram4.opcion ? 'DISIPADOR: ' + ultimoResultado.disipadorram4.opcion : '-------');
                            $('#marcaram4').text(ultimoResultado.marcaram4 && ultimoResultado.marcaram4.marca ? 'MARCA: ' + ultimoResultado.marcaram4.marca : '-------');
                            $('#capacidadram4').text(ultimoResultado.capacidadram4 && ultimoResultado.capacidadram4.capacidad ? 'CAPACIDAD: ' + ultimoResultado.capacidadram4.capacidad : '-------');
                            $('#tiporam4').text(ultimoResultado.tiporam4 && ultimoResultado.tiporam4.tipo ? 'TIPO: ' + ultimoResultado.tiporam4.tipo : '-------');
                            $('#cantidad4').text(ultimoResultado.cantidadram4 && ultimoResultado.cantidadram4.cantidad ? 'CANTIDAD: ' + ultimoResultado.cantidadram4.cantidad : '-------');

                            $('#seleccionestvideo').show();
                            $('#marcatvideo_id').val(ultimoResultado.marcatvideo_id); 
                            $('#capactvideo_id').val(ultimoResultado.capactvideo_id);
                            $('#tipotvideo_id').val(ultimoResultado.tipotvideo_id);
                            $('#marcatvideo').text(ultimoResultado.marcatvideo && ultimoResultado.marcatvideo.marca ? 'MARCA: ' + ultimoResultado.marcatvideo.marca : 'INTEGRADO');
                            $('#capacidadtvideo').text(ultimoResultado.capacidadtvideo && ultimoResultado.capacidadtvideo.capacidad ? 'CAPACIDAD: ' + ultimoResultado.capacidadtvideo.capacidad : '-------');
                            $('#tipotvideo').text(ultimoResultado.tipotvideo && ultimoResultado.tipotvideo.tipo ? 'TIPO: ' + ultimoResultado.tipotvideo.tipo : '-------');

                            $('#seleccionestred').show();
                            $('#marcatred_id').val(ultimoResultado.marcatred_id); 
                            $('#modtred_id').val(ultimoResultado.modtred_id);
                            $('#marcatred').text(ultimoResultado.marcatred && ultimoResultado.marcatred.marca ? 'MARCA: ' + ultimoResultado.marcatred.marca : '-------');
                            $('#modelotred').text(ultimoResultado.modelotred && ultimoResultado.modelotred.modelo ? 'MODELO: ' + ultimoResultado.modelotred.modelo : '-------');

                            $('#seleccioneswifi').show();
                            $('#marcawifi_id').val(ultimoResultado.marcawifi_id); 
                            $('#modcawifi_id').val(ultimoResultado.modcawifi_id);
                            $('#antena_id').val(ultimoResultado.antena_id); 
                            $('#marcaTwifi').text(ultimoResultado.marcatwifi && ultimoResultado.marcatwifi.marca ? 'MARCA: ' + ultimoResultado.marcatwifi.marca : '-------');
                            $('#modeloWifi').text(ultimoResultado.modelowifi && ultimoResultado.modelowifi.modelo ? 'MODELO: ' + ultimoResultado.modelowifi.modelo : '------');
                            $('#antena').text(ultimoResultado.antena && ultimoResultado.antena.opcion ? 'ANTENA: ' + ultimoResultado.antena.opcion : '-------');

                            $('#seleccionesfuente').show();
                            $('#cable_id').val(ultimoResultado.cable_id);
                            $('#marcafuente_id').val(ultimoResultado.marcafuente_id); 
                            $('#potfuente_id').val(ultimoResultado.potfuente_id);
                            $('#cable').text(ultimoResultado.cable && ultimoResultado.cable.opcion ? 'CABLE: ' + ultimoResultado.cable.opcion: '-------');
                            $('#marcafuente').text(ultimoResultado.marcafuente && ultimoResultado.marcafuente.marca ? 'MARCA: ' + ultimoResultado.marcafuente.marca : '-------');
                            $('#potenciafuente').text(ultimoResultado.potenciafuente && ultimoResultado.potenciafuente.potencia ? 'POTENCIA: ' + ultimoResultado.potenciafuente.potencia : '-------');


                            $('#seleccionescd').show();
                            $('#marcacd_id').val(ultimoResultado.marcacd_id); 
                            $('#marcalectorcd').text(ultimoResultado.marcalectorcd && ultimoResultado.marcalectorcd.nombre ? 'MARCA: ' + ultimoResultado.marcalectorcd.nombre : '-------');
                        }
                        else{
                        $('#selecciones').show();
                        $('#seleccionesp').show();
                        $('#seleccionesdd').show();
                        $('#seleccionesdd2').show();
                        $('#seleccionestm').show();
                        $('#seleccionesram').show();
                        $('#seleccionesram2').show();
                        $('#seleccionesram3').show();
                        $('#seleccionesram4').show();
                        $('#seleccionestvideo').show();
                        $('#seleccionestred').show();
                        $('#seleccioneswifi').show();
                        $('#seleccionesfuente').show();
                        $('#seleccionescd').show();
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
