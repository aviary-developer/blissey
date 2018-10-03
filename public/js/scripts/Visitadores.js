async function save_visitador() {
  var is_valid = true;

  var valido = new Validated('nombre');
  valido.required();
  valido.min(2);
  valido.max(30);
  is_valid = valido.value(is_valid);

  var valido = new Validated('apellido');
  valido.required();
  valido.min(2);
  valido.max(30);
  is_valid = valido.value(is_valid);

  var valido = new Validated('telefono');
  valido.required();
  await valido.unique('dependientes','telefono');
  is_valid = valido.value(is_valid);

  if(is_valid){
    $('#form').submit();
  }
}
