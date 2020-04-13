$(document).on('ready', function () {
  $("#resultadoRequisicion").keyup(function () {
    valor = $("#resultadoRequisicion").val();
    if (valor.length > 0) {
      var ruta = $('#guardarruta').val() + "/buscarProductoRequisicion/" + valor;
      var tabla = $("#tablaRequisicion");
      $.get(ruta, function (res) {
        tabla.empty();
        head =
          "<thead>" +
          "<th>Código</th>" +
          "<th colspan='2'>Producto</th>" +
          "<th>Existencias</th>" +
          "<th>Stock</th>" +
          "<th>Acción</th>" +
          "</thead>";
        tabla.append(head);
        $(res).each(function (key, value) {
          $(value.division_producto).each(function (key2, value2) {
            if (value2.contenido != null) {
              var aux = value2.unidad.nombre;
            } else {
              var aux = value.presentacion.nombre;
            }
            html = "<tr>" +
              "<td id='cu" + value2.id + "'>" + value2.codigo + "</td>" +
              "<td id='cd" + value2.id + "'>" + value.nombre + "</td>" +
              "<td id='ct" + value2.id + "'>" + " " + value2.division.nombre + " " + value2.cantidad + " " + aux + "</td>" +
              "<td id='ca" + value2.id + "'>" + value2.inventario + "</td>" +
              "<td id='ci" + value2.id + "'>" + value2.stock + "</td>" +
              "<td>";
            if (parseFloat(value2.inventario) > parseFloat(value2.stock)) {
              html = html +
                "<button type='button' class='btn btn-sm btn-primary' onclick='registrarRequisicion(" + value2.id + ");'>" +
                "<i class='fa fa-check'></i>" +
                "</button>";
            } else {
              html = html +
                "<button type='button' class='btn btn-sm btn-danger disabled' data-toggle='tooltip' data-placement='top' title='Inventario en inferior al stock mínimo'>" +
                "<i class='fa fa-exclamation-triangle'></i>" +
                "</button>";
            }
            html = html +
              "</td>" +
              "</tr>";
            tabla.append(html);
          });
        });
      });
    }
  });
});
function registrarRequisicion(id) {
  var cantidad = parseFloat($('#cantidad_resultado').val());
  var existencia = parseFloat($('#ca' + id).text());
  c1 = $('#cu' + id).text();
  c2 = $('#cd' + id).text();
  c3 = $('#ct' + id).text();
  c4 = $('#ci' + id).text(); //Stock mínimo
  disponible = existencia - parseFloat(c4);
  if (cantidad > disponible || componentes_agregados.includes("" + id + "")) {
    if (cantidad > disponible) {
      notaError('La cantidad solicitada supera las unidades disponibles sobre el stock mínimo');
    } else {
      notaError('El producto ya se encuentra incluido');
    }
  } else {
    tabla = $('#tablaDetalle');
    html = "<tr>" +
      "<td>" + cantidad + "</td>" +
      "<td>" + c1 + "</td>" +
      "<td>" + c2 + "</td>" +
      "<td>" + c3 + "</td>" +
      "<td>" +
      "<input type='hidden' name='f_producto[]' value='" + id + "'>" +
      "<input type='hidden' name='cantidad[]' value='" + cantidad + "'>" +
      "<button type='button' class='btn btn-sm btn-danger' id='eliminar_detalle'>" +
      "<i class='fa fa-times'></i>" +
      "</button>" +
      "</td>" +
      "</tr>";
    tabla.append(html);
    notaInfo('Ha sido agregado en detalles');
    componentes_agregados.push("" + id + "");
  }
}
