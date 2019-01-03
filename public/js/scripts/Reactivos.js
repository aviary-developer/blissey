$("#registroReactivo").click(function () {
  var nombreReactivo = $("#nombreReactivoCrear").val();
  var descripcionReactivo = $("#descripcionReactivoCrear").val();
  var contenidoPorEnvaseReactivo = $("#contenidoPorEnvaseReactivoCrear").val();
  var ruta = $('#guardarruta').val() + "/reactivos";
  var token = $('#tokenReactivos').val();
  $.ajax({
    url: ruta,
    headers: { 'X-CSRF-TOKEN': token },
    type: 'POST',
    dataType: 'json',
    data: { nombre: nombreReactivo, descripcion: descripcionReactivo, contenidoPorEnvase: contenidoPorEnvaseReactivo },
    success: function () {
      CargaReactivos();
      $("#modal").modal('toggle');
      swal(
        'Reactivo Registrado!',
        '',
        'success'
      )
    }
  });
});
function CargaReactivos() {
  var tablaReactivos = $("#tablaReactivos");
  var ruta = $('#guardarruta').val() + "/leerReactivos";
  $("#tablaReactivos").empty();
  var correlativo = 1;
  $.get(ruta, function (res) {
    $(res).each(function (key, value) {
      tablaReactivos.append("<tr><td>" + correlativo + "</td><td>" + value.nombre + "</td><td>" + value.descripcion + "</td><td>" + value.contenidoPorEnvase + "</td><td><button value=" + value.id + " class='btn btn-primary' data-toggle='modal' data-target='.modal-new1' onClick='MostrarReactivos(this);'>Editar</td><td><button class='btn btn-danger' value=" + value.id + " onClick='EliminarReactivos(this);'>Eliminar</td></tr>");
      correlativo = correlativo + 1;
    });
  });
}
