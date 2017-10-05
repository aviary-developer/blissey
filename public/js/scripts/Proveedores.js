
function agregarVisitador(){
  var nombre=$("#tvn").val();
  var apellido=$("#tva").val();
  var telefono=$("#tvt").val();

  $("#visitadores").append("<tr><td><input type='hidden' name='nombrev[]' value='"+nombre+"'><input type='hidden' name='apellidov[]' value='"+apellido+"'><input type='hidden' name='telefonov[]' value='"+telefono+"'></td><td>"+nombre+"</td><td>"+apellido+"</td><td>"+telefono+"</td><td class='deleteVisitador' style='cursor:pointer;'>Eliminar</td></tr>");
  //Limpiar campos
  $("#tvn").val("");
  $("#tva").val("");
  $("#tvt").val("");
}
$(document).on("click",".deleteVisitador",function(){
var parent = $(this).parents().get(0);
$(parent).remove();
});
function guardarProveedor(){
    vnombre=validarNombre();
    vcorreo=validarCorreo();
    vtelefono=validarTelefono();
    if(vnombre==false || vcorreo==false || vtelefono==false){

    }else{
      alert("Todo bien");
    }

}
function validarNombre(){
  nombre=$("#nombre").val();
  val= true;
    cont=0;
    var errores= [];
    if(nombre==""){
      errores[cont]="El campo drogería es obligatorio";
      cont=cont+1;
    }else if(nombre.length<5){
      errores[cont]="El campo drogería debe contener mínimo 5 caracteres";
      cont=cont+1;
    }else if(nombre.length>40){
      errores[cont]="El campo drogería debe contener máximo 5 caracteres";
      cont=cont+1;
    }
    if(cont>0){
      val= false;
    }
    for(a=0;a<cont;a++){
      new PNotify({
        title: 'Error!',
        text: errores[a],
        type: 'error',
        styling: 'bootstrap3'
      });
    }
    return val;
}

function validarCorreo(){
  correo=$("#correo").val();
  val= true;
    cont=0;
    var errores= [];
    if(correo==""){
      errores[cont]="El campo correo es obligatorio";
      cont=cont+1;
    }
    if(cont>0){
      val= false;
    }
    for(a=0;a<cont;a++){
      new PNotify({
        title: 'Error!',
        text: errores[a],
        type: 'error',
        styling: 'bootstrap3'
      });
    }
    return val;
}
function validarTelefono(){
  telefono=$("#Telefono").val();
  val= true;
    cont=0;
    var errores= [];
    if(telefono==""){
      errores[cont]="El campo teléfono es obligatorio";
      cont=cont+1;
    }else if(telefono.length!=9){
      errores[cont]="El campo teléfono debe contener 9 caracteres";
      cont=cont+1;
    }
    if(cont>0){
      val= false;
    }
    for(a=0;a<cont;a++){
      new PNotify({
        title: 'Error!',
        text: errores[a],
        type: 'error',
        styling: 'bootstrap3'
      });
    }
    return val;
}
