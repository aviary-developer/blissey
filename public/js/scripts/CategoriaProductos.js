async function save_categoriaProducto() {
  var is_valid = true;

  var valido = new Validated('nombre');
  valido.required();
  valido.min(2);
  valido.max(30);
  await valido.unique('categoria_productos', 'nombre');
  is_valid = valido.value(is_valid);

  if(is_valid){
    $('#form').submit();
  }
}
