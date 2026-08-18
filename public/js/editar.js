
$('.form-updateNR').submit(function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    type: 'POST',
    url: $(this).attr('action'),
    data: formData,
    processData: false,
    contentType: false,
    success: function(data) {
      var row = $('tr[data-id="' + data.id + '"]');
      console.log('Fila seleccionada:', row);
      if (row.length > 0) {
        row.find('td:nth-child(9)').html(data.cod_registro);
      }
            $('#eRecepcion' + data.id).modal('hide');
        Swal.fire({
        position: "top-center",
        icon: "success",
        title: "NUMERO DE RECEPCIÓN ASIGNADO CORRECTAMENTE",
        showConfirmButton: false,
        timer: 3000
        });
    }
  });
});
