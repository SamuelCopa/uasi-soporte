//---------------EX FUNCIONARIO------------------------
$(document).ready(function() {
    $('#formularioc').hide();
    $('#formularioc2').hide();
    $('#crearc').on('shown.bs.modal', function() {
    // $(this).removeAttr('aria-hidden');

        $('#crearc #miSelect').on('change', function() {
            var valor = $(this).val();
            if (valor == 0) {
            $('#formularioc').show();
            $('#formularioc2').show();
                $('#crearc #cargoC').hide()
                $('#crearc #cargo').prop('disabled', true);
                $('#crearc #search-inputCC').hide()
                $('#crearc #search-inputC').prop('disabled', true);

            } else {
                $('#formularioc').show();
                $('#formularioc2').show();
                $('#crearc #cargoC').show()
                $('#crearc #cargo').prop('disabled', false).val('');   
                $('#crearc #search-inputCC').show()
                $('#crearc #search-inputC').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
    $('#formularioi').hide();
    $('#formularioi2').hide();
    $('#creari').on('shown.bs.modal', function() {
        $('#creari #miSelect').on('change', function() {
            var valor = $(this).val();
            if (valor == 0) {
            $('#formularioi').show();        
            $('#formularioi2').show();        
                $('#creari #cargoI').hide();
                $('#creari #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#creari #search-inputII').hide();
                $('#creari #search-inputI').prop('disabled', true).val('SIN DEPENDENCIA');

        } else {
            $('#formularioi').show();  
            $('#formularioi2').show();  
            $('#creari #cargoI').show();             
            $('#creari #cargo').prop('disabled', false).val('');              
            $('#creari #search-inputII').show();
            $('#creari #search-inputI').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
    $('#formularioa').hide();
    $('#formularioa2').hide();
    $('#creara').on('shown.bs.modal', function() {
        $('#creara #miSelect').on('change', function() {
            var valor = $(this).val();
            if (valor == 0) {
            $('#formularioa').show();        
            $('#formularioa2').show();  
                $('#creara #cargoA').hide();
                $('#creara #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#creara #search-inputAA').hide();
                $('#creara #search-inputA').prop('disabled', true).val('SIN DEPENDENCIA');
            } else {
            $('#formularioa').show();        
            $('#formularioa2').show();  
                $('#creara #cargoA').show();              
                $('#creara #cargo').prop('disabled', false).val('');              
                $('#creara #search-inputAA').show();
                $('#creara #search-inputA').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
    $('#formulariom').hide();
    $('#formulariom2').hide();
    $('#crearm').on('shown.bs.modal', function() {
        $('#crearm #miSelect').on('change', function() {
            var valor = $(this).val();
            if (valor == 0) {
            $('#formulariom').show();        
            $('#formulariom2').show();  
                $('#crearm #cargoM').hide();
                $('#crearm #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#crearm #search-inputMM').hide();
                $('#crearm #search-inputM').prop('disabled', true).val('SIN DEPENDENCIA');

            } else {
            $('#formulariom').show();        
            $('#formulariom2').show();  
                $('#crearm #cargoM').show();              
                $('#crearm #cargo').prop('disabled', false).val('');              
                $('#crearm #search-inputMM').show();
                $('#crearm #search-inputM').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
    $('#formulariot').hide();
    $('#formulariot2').hide();
    $('#creart').on('shown.bs.modal', function() {
        $('#creart #miSelect').on('change', function() {
            var valor = $(this).val();
            if (valor == 0) {
                $('#formulariot').show();
                $('#formulariot2').show();
                $('#creart #cargoT').hide();
                $('#creart #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#creart #search-inputTT').hide();
                $('#creart #search-inputT').prop('disabled', true).val('SIN DEPENDENCIA');

            } else {
                $('#formulariot').show();
                $('#formulariot2').show();
                $('#creart #cargoT').show();             
                $('#creart #cargo').prop('disabled', false).val('');              
                $('#creart #search-inputTT').show();
                $('#creart #search-inputT').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
                $('#formulariop').hide();
                $('#formulariop2').hide();
            $('#crearp').on('shown.bs.modal', function() {
            $('#crearp #miSelect').on('change', function() {
                var valor = $(this).val();
                if (valor == 0) {
                $('#formulariop').show();
                $('#formulariop2').show();
                $('#crearp #cargoP').hide();
                $('#crearp #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#crearp #search-inputPP').hide();
                $('#crearp #search-inputP').prop('disabled', true).val('SIN DEPENDENCIA');

            } else {
                $('#formulariop').show();
                $('#formulariop2').show();
                $('#crearp #cargoP').show();             
                $('#crearp #cargo').prop('disabled', false).val('');              
                $('#crearp #search-inputPP').show();
                $('#crearp #search-inputP').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
                $('#formularior').hide();
                $('#formularior2').hide();
        $('#crearr').on('shown.bs.modal', function() {
            $('#crearr #miSelect').on('change', function() {
                var valor = $(this).val();
                if (valor == 0) {
                $('#formularior').show();
                $('#formularior2').show();
                $('#crearr #cargoR').hide();
                $('#crearr #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#crearr #search-inputRR').hide();
                $('#crearr #search-inputR').prop('disabled', true).val('SIN DEPENDENCIA');

            } else {
                $('#formularior').show();
                $('#formularior2').show();
                $('#crearr #cargoR').show();             
                $('#crearr #cargo').prop('disabled', false).val('');              
                $('#crearr #search-inputRR').show();
                $('#crearr #search-inputR').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
                $('#formulariou').hide();
                $('#formulariou2').hide();
    $('#crearu').on('shown.bs.modal', function() {
        $('#crearu #miSelect').on('change', function() {
            var valor = $(this).val();
            if (valor == 0) {
                $('#formulariou').show();
                $('#formulariou2').show();
                $('#crearu #cargoU').hide();
                $('#crearu #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#crearu #search-inputUU').hide();
                $('#crearu #search-inputU').prop('disabled', true).val('SIN DEPENDENCIA');

            } else {
                $('#formulariou').show();
                $('#formulariou2').show();
                $('#crearu #cargoU').show();             
                $('#crearu #cargo').prop('disabled', false).val('');              
                $('#crearu #search-inputUU').show();
                $('#crearu #search-inputU').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
                $('#formularioe').hide();
                $('#formularioe2').hide();
        $('#creare').on('shown.bs.modal', function() {
        $('#creare #miSelect').on('change', function() {
            var valor = $(this).val();
            if (valor == 0) {
                $('#formularioe').show();
                $('#formularioe2').show();
                $('#creare #cargoE').hide();
                $('#creare #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#creare #search-inputEE').hide();
                $('#creare #search-inputE').prop('disabled', true).val('SIN DEPENDENCIA');

            } else {
                $('#formularioe').show();
                $('#formularioe2').show();
                $('#creare #cargoE').show();             
                $('#creare #cargo').prop('disabled', false).val('');              
                $('#creare #search-inputEE').show();
                $('#creare #search-inputE').prop('disabled', false).val('');
            }
        });
    });
});

$(document).ready(function() {
                $('#formulariol').hide();
                $('#formulariol2').hide();
        $('#crearl').on('shown.bs.modal', function() {
        $('#crearl #miSelect').on('change', function() {
            var valor = $(this).val();
            if (valor == 0) {
                $('#formulariol').show();
                $('#formulariol2').show();
                $('#crearl #cargoL').hide();
                $('#crearl #cargo').prop('disabled', true).val('EX FUNCIONARIO');
                $('#crearl #search-inputLL').hide();
                $('#crearl #search-inputL').prop('disabled', true).val('SIN DEPENDENCIA');
            } else {
                $('#formulariol').show();
                $('#formulariol2').show();
                $('#crearl #cargoL').show();             
                $('#crearl #cargo').prop('disabled', false).val('');              
                $('#crearl #search-inputLL').show();
                $('#crearl #search-inputL').prop('disabled', false).val('');
            }
        });
    });
});