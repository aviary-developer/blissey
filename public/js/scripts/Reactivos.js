$("#registroReactivo").click(function(){
  var nombreReactivo=$("#nombreReactivo").val();
  var descripcionReactivo=$("#descripcionReactivo").val();
  var contenidoPorEnvaseReactivo=$("#contenidoPorEnvaseReactivo").val();
  var ruta="/blissey/public/reactivos";
  var token=$('#tokenReactivos').val();
  $.ajax({
    url: ruta,
    headers:{'X-CSRF-TOKEN':token},
    type: 'POST',
    dataType: 'json',
    data:{nombre:nombreReactivo,descripcion:descripcionReactivo,contenidoPorEnvase:contenidoPorEnvaseReactivo}
  });
});
