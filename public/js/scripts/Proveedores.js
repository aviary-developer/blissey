
function agregarVisitador() {
  var is_valid = true;

  var valido = new Validated('tvn');
  valido.required();
  valido.min(2);
  valido.max(30);
  is_valid = valido.value(is_valid);

  var valido = new Validated('tva');
  valido.required();
  valido.min(2);
  valido.max(30);
  is_valid = valido.value(is_valid);

  var valido = new Validated('tvt');
  valido.required();
  is_valid = valido.value(is_valid);

  if (is_valid) {
    var nombre = $("#tvn").val();
    var apellido = $("#tva").val();
    var telefono = $("#tvt").val();

    $("#visitadores").append("<tr><td><input type='hidden' name='nombrev[]' value='" + nombre + "'><input type='hidden' name='apellidov[]' value='" + apellido + "'><input type='hidden' name='telefonov[]' value='" + telefono + "'></td><td>" + nombre + "</td><td>" + apellido + "</td><td>" + telefono + "</td><td class='deleteVisitador' style='cursor:pointer;'><a class='btn btn-danger btn-sm'><i class='fas fa-times' style='color:white'></i></a></td></tr>");

    //Limpiar campos
    $("#tvn").val("");
    $("#tva").val("");
    $("#tvt").val("");
  }
}
$(document).on("click", ".deleteVisitador", function () {
  var parent = $(this).parents().get(0);
  $(parent).remove();
});

async function save_proveedor() {
  var is_valid = true;

  var valido = new Validated('nombre');
  valido.required();
  valido.min(5);
  valido.max(50);
  await valido.unique('proveedors', 'nombre');
  is_valid = valido.value(is_valid);

  if ($('#correo').val() != "") {
    var valido = new Validated('correo');
    await valido.unique('proveedors', 'correo');
    is_valid = valido.value(is_valid);
  }
  if ($('#telefono').val() != "") {
    var valido = new Validated('telefono');
    await valido.unique('proveedors', 'telefono');
    is_valid = valido.value(is_valid);
  }

  if (is_valid) {
    $("#form").submit();
  }
}
