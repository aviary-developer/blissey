$("#cambio_div_consulta").on('click', function (e) {
  e.preventDefault();
  $("#div_previo").hide();
  $("#div_consulta").show();
});

$("#cancelar_consulta").on('click', function (e) {
  e.preventDefault();
  $("#div_previo").show();
  $("#div_consulta").hide();
});