$(document).ready(function () {
  CargaReactivos();
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
function EliminarReactivos(btn) {
  var ruta = $('#guardarruta').val() + "/reactivos/" + btn.value;
  var token = $('#tokenReactivos').val();
  swal({
    title: '¿Estas seguro?',
    text: "Se mandará a papelera",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, borrar!',
    cancelButtonText: 'No, cancelar!',
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false
  }).then(function () {
    $.ajax({
      url: ruta,
      headers: { 'X-CSRF-TOKEN': token },
      type: 'DELETE',
      dataType: 'json',
      success: function () {
        CargaReactivos();
        swal(
          '¡Eliminado!',
          'El reactivo se eliminó',
          'success'
        )
      }
    });
  }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {
      swal({
        title: 'Cancelado!',
        text: 'Reactivo no eliminado',
        timer: 1500,
        type: 'error'
      })
    }
  })
}
function MostrarReactivos(btn) {
  console.log(btn.value);
  var ruta = $('#guardarruta').val() + "/reactivos/" + btn.value + "/edit";
  $.get(ruta, function (res) {
    $("#nombreReactivo").val(res.nombre);
    $("#descripcionReactivo").val(res.descripcion);
    $("#contenidoPorEnvaseReactivo").val(res.contenidoPorEnvase);
    $("#idReactivo").val(res.id);
  });
}

$("#actualizarReactivo").click(function () {
  var idReactivo = $("#idReactivo").val();
  var nombreReactivo = $("#nombreReactivo").val();
  var descripcionReactivo = $("#descripcionReactivo").val();
  var contenidoPorEnvaseReactivo = $("#contenidoPorEnvaseReactivo").val();
  var ruta = $('#guardarruta').val() + "/reactivos/" + idReactivo;
  var token = $('#tokenReactivos').val();
  $.ajax({
    url: ruta,
    headers: { 'X-CSRF-TOKEN': token },
    type: 'PUT',
    dataType: 'json',
    data: { nombre: nombreReactivo, descripcion: descripcionReactivo, contenidoPorEnvase: contenidoPorEnvaseReactivo },
    success: function () {
      CargaReactivos();
      $("#gg").modal('toggle');
      swal(
        'Reactivo actualizado!',
        '',
        'success'
      )
    }
  });
});
