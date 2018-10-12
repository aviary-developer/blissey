async function save_Componente() {
  var is_valid = true;

  var valido = new Validated('nombre');
  valido.required();
  valido.min(2);
  valido.max(30);
  await valido.unique('componentes', 'nombre');
  is_valid = valido.value(is_valid);

  if(is_valid){
    $('#form').submit();
  }
}
