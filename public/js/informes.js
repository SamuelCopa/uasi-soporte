
$(document).ready(function() {
    $('#form').hide();

$(document).ready(function() {
    $('#resultado_id').change(function() {
        var seleccion = $(this).val();

        //------------DEVOLUCION-----------------
        if (seleccion == '1') {
            $('#form').show()
            $('#desc_trabajoR').text('DESCRIPCIÓN DEL TRABAJO REALIZADO');
            // Mostrar y habilitar el bloque de devolución
            $('#antecedentesDevolucion').show().find(':input').prop('disabled', false);
            // Ocultar y deshabilitar los demás bloques
            $('#antecedentesReposicion, #antecedentesRepliegue, #antecedentesCustodioBaja')
            .hide().find(':input').prop('disabled', true);

            $('#desarrolloDevolucion').show().find(':input').prop('disabled', false);
            $('#desarrolloReposicion, #desarrolloRepliegue, #desarrolloCustodioBaja')
            .hide().find(':input').prop('disabled', true);

            $('#conclusionDevolucion').show().find(':input').prop('disabled', false);
            $('#conclusionReposicion, #conclusionRepliegue, #conclusionCustodio, #conclusionBaja')
            .hide().find(':input').prop('disabled', true);

            $('#caracteristicas').hide().find('select').prop('disabled', true);
            $('#cargoUnidad').val('').prop('disabled', false).show(); 
            
            //------------REPOSICION-----------------
        } else if (seleccion == '2') {
            $('#form').show();
            $('#desc_trabajoR').text('CARACTERÍSTICAS TÉCNICAS DEL EQUIPO DE REPOSICIÓN');
            $('#antecedentesReposicion').show().find(':input').prop('disabled', false);
            $('#antecedentesDevolucion, #antecedentesRepliegue, #antecedentesCustodioBaja')
            .hide().find(':input').prop('disabled', true);

            $('#desarrolloReposicion').show().find(':input').prop('disabled', false);
            $('#desarrolloDevolucion, #desarrolloRepliegue, #desarrolloCustodioBaja')
            .hide().find(':input').prop('disabled', true);

            $('#conclusionReposicion').show().find(':input').prop('disabled', false);
            $('#conclusionDevolucion, #conclusionRepliegue, #conclusionCustodio, #conclusionBaja')
            .hide().find(':input').prop('disabled', true);

            $('#caracteristicas').show().find('select').prop('disabled', false);
            $('#cargoUnidad').val('').prop('disabled', false).show(); 

            //------------REPLIEGUE-----------------
        } else if (seleccion == '3') {
            $('#form').show();
            $('#desc_trabajoR').text('DESCRIPCIÓN DEL TRABAJO REALIZADO');
            $('#antecedentesRepliegue').show().find(':input').prop('disabled', false);
            $('#antecedentesDevolucion, #antecedentesReposicion, #antecedentesCustodioBaja')
            .hide().find(':input').prop('disabled', true);

            $('#desarrolloRepliegue').show().find(':input').prop('disabled', false);
            $('#desarrolloDevolucion, #desarrolloReposicion, #desarrolloCustodioBaja')
            .hide().find(':input').prop('disabled', true);

            $('#conclusionRepliegue').show().find(':input').prop('disabled', false);
            $('#conclusionDevolucion, #conclusionReposicion, #conclusionCustodio, #conclusionBaja')
            .hide().find(':input').prop('disabled', true);

            $('#caracteristicas').hide().find('select').prop('disabled', true);
            $('#cargoUnidad').val('JEFE DE UNIDAD DE ACTIVOS FIJOS').prop('disabled', true).show();
            
            //------------CUSTODIO-----------------
        } else if (seleccion == '4') {
            $('#form').show();
            $('#desc_trabajoR').text('DESCRIPCIÓN DEL TRABAJO REALIZADO');
            $('#antecedentesCustodioBaja').show().find(':input').prop('disabled', false);
            $('#antecedentesDevolucion, #antecedentesReposicion, #antecedentesRepliegue')
            .hide().find(':input').prop('disabled', true);

            $('#desarrolloCustodioBaja').show().find(':input').prop('disabled', false);
            $('#desarrolloDevolucion, #desarrolloReposicion, #desarrolloRepliegue')
            .hide().find(':input').prop('disabled', true);

            $('#conclusionCustodio').show().find(':input').prop('disabled', false);
            $('#conclusionDevolucion, #conclusionReposicion, #conclusionRepliegue, #conclusionBaja')
            .hide().find(':input').prop('disabled', true);

            $('#caracteristicas').hide().find('select').prop('disabled', true);
            $('#cargoUnidad').val('').prop('disabled', false).show(); 
              

            //------------BAJA-----------------
        } else if (seleccion == '5') {
            $('#form').show();
            $('#desc_trabajoR').text('DESCRIPCIÓN DEL TRABAJO REALIZADO');
            $('#antecedentesCustodioBaja').show().find(':input').prop('disabled', false);
            $('#antecedentesDevolucion, #antecedentesReposicion, #antecedentesRepliegue')
            .hide().find(':input').prop('disabled', true);
            
            $('#desarrolloCustodioBaja').show().find(':input').prop('disabled', false);
            $('#desarrolloDevolucion, #desarrolloReposicion, #desarrolloRepliegue')
            .hide().find(':input').prop('disabled', true);
            
            $('#conclusionBaja').show().find(':input').prop('disabled', false);
            $('#conclusionDevolucion, #conclusionReposicion, #conclusionRepliegue, #conclusionCustodio')
            .hide().find(':input').prop('disabled', true);

            $('#caracteristicas').hide().find('select').prop('disabled', true);
            $('#cargoUnidad').val('JEFE DE UNIDAD DE ACTIVOS FIJOS').prop('disabled', true).show();  
        }
    });
});
});
