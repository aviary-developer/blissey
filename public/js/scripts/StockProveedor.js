$(document).on('ready', function () {
  $("#agregarStock").on("click", function () {
    gd = false;
    var v = validacionesStock();
    f_producto = $('#idoculto').val();
    if (v == true && !componentes_agregados.includes(f_producto)) {
      var tabla = $("#tablaDetalle");
      var cantidad = parseFloat($("#cantidadp").val());
      if ($("#confirmar").val() == false) {
        if ($("#tipo").val() != '2') {
          gd = true;
          html = "<tr id='fila" + f_producto + "'>" +
            "<td><input type='text' name='cantidad[]' class='form-control'></td>" +
            "<td>" + $("#divoculto").val() + "</td>" +
            "<td>" + $("#nomoculto").val() + "</td>";
          html = html + "<td>" +
            "<input type='hidden' name='f_producto[]' value ='" + f_producto + "'>";
          html = html + "<button type='button' class='btn btn-xs btn-danger' onclick='borrarFila(" + f_producto + ")'>" +
            "<i class='fas fa-times'></i>" +
            "</button>" +
            "</td>" +
            "</tr>";
          console.log(componentes_agregados);
          notaInfo('Ha sido agregado en detalles');
        }
      }
      if (gd) {
        tabla.append(html);
        $('#idoculto').val("");
        $('#divoculto').val("");
        $('#nomoculto').val("");
        $('#codigoBuscar').val("");
        $('#producto').val("");
        componentes_agregados.push(f_producto);
      }
    } else {
      if (componentes_agregados.includes(f_producto)) {
        console.log(componentes_agregados);
        notaError('El producto ya se encuentra agregado');
      }
    }
  });
});
function validacionesStock() { //campo cantidad
  c = 0;
  var error = [];
  valor = true;
  if ($('#producto').val() == "") {
    error[c] = 'No ha ingresado un código de producto válido';
    c = c + 1;
    valor = false;
  }
  for (var i = 0; i < c; i++) {
    notaError(error[i]);
  }
  return valor;
}
function borrarFila(id) {
  $('#fila' + id).remove();
  var indice = componentes_agregados.indexOf("" + id + "");
  componentes_agregados.splice(indice, 1);
  console.log(componentes_agregados);
  console.log(id);
}
