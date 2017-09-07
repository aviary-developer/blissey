$(document).ready(function(){
  CargaReactivos();
});

function CargaReactivos(){
  var tablaReactivos=$("#tablaReactivos");
  var ruta="/blissey/public/leerReactivos";
  $("#tablaReactivos").empty();
  var correlativo=1;
  $.get(ruta,function(res){
    $(res).each(function(key,value){
          tablaReactivos.append("<tr><td>"+correlativo+"</td><td>"+value.nombre+"</td><td>"+value.descripcion+"</td><td>"+value.contenidoPorEnvase+"</td><td><button value="+value.id+" class='btn btn-primary' data-toggle='modal' data-target='.modal-new1' onClick='Mostrar(this);'>Editar</td><td><button class='btn btn-danger'>Eliminar</td></tr>");
          correlativo=correlativo+1;
    });
  });
}
function Mostrar(btn){
  console.log(btn.value);
  var ruta="/blissey/public/reactivos/"+btn.value+"/edit";
  $.get(ruta,function(res){
    $("#nombreReactivo").val(res.nombre);
    $("#descripcionReactivo").val(res.descripcion);
    $("#contenidoPorEnvaseReactivo").val(res.contenidoPorEnvase);
    $("#idReactivo").val(res.id);
  });
}

$("#actualizarReactivo").click(function(){
  var idReactivo=$("#idReactivo").val();
  var nombreReactivo=$("#nombreReactivo").val();
  var descripcionReactivo=$("#descripcionReactivo").val();
  var contenidoPorEnvaseReactivo=$("#contenidoPorEnvaseReactivo").val();
  var ruta="/blissey/public/reactivos/"+idReactivo+"";
  var token=$('#tokenReactivos').val();
  $.ajax({
    url: ruta,
    headers:{'X-CSRF-TOKEN':token},
    type: 'PUT',
    dataType: 'json',
    data:{nombre:nombreReactivo,descripcion:descripcionReactivo,contenidoPorEnvase:contenidoPorEnvaseReactivo},
    success: function(){
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
