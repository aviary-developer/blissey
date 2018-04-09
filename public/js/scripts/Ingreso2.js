$(document).on('ready', function () {
  $("#guardarSignoModal").on("click", function (e) { 
    $.ajax({
      type : 'post',
      url  : '/blissey/public/signos',
      headers: { 'X-CSRF-TOKEN': $("#tokenTransaccion").val() },
      data: {
        temperatura: $("#temperatura").val(),
        pulso: $("#pulso").val(),
        sistole: $("#sistole").val(),
        diastole: $("#diastole").val(),
        peso: $("#peso").val(),
        altura: $("#altura").val(),
        medida: $("#medida").val(),
        glucosa: $("#glucosa").val(),
        frecuencia_respiratoria: $("#frecuencia_respiratoria").val(),
        frecuencia_cardiaca: $("#frecuencia_cardiaca").val(),
        f_ingreso: $("#id").val(),
      },
      success: function (r) {
        if (r == 3) {
          swal("¡Hecho!", "Registro almacenado satisfactoriamente", "success");
          location.reload();
        } else {
          swal("¡Error!", "Algo ha salido mal", "error");
        }
      }
    });
  });
});