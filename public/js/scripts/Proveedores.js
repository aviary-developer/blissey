
function agregarVisitador(){
  var nombre=$("#tvn").val();
  var apellido=$("#tva").val();
  var telefono=$("#tvt").val();

  $("#visitadores").append("<tr><td><input type='hidden' name='nombrev[]' value='"+nombre+"'><input type='hidden' name='apellidov[]' value='"+apellido+"'><input type='hidden' name='telefonov[]' value='"+telefono+"'></td><td>"+nombre+"</td><td>"+apellido+"</td><td>"+telefono+"</td><td class='deleteVisitador' style='cursor:pointer;'><a class='btn btn-danger btn-sm'><i class='fas fa-times' style='color:white'></i></a></td></tr>");

  //Limpiar campos
  $("#tvn").val("");
  $("#tva").val("");
  $("#tvt").val("");
}
$(document).on("click",".deleteVisitador",function(){
var parent = $(this).parents().get(0);
$(parent).remove();
});
