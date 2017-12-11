$(document).on('ready',function(){
$("#guardar_presentacion").on('click', function (e) {
  e.preventDefault();
  var v_nombre = $("#nombre_presentacion").val();
  var modal = $("#modal");
  if(validarPresentacion(v_nombre)==true){
    if($('#accion').val()=='n'){
      location.href ="/blissey/public/guardarPresentacion/"+v_nombre;
    }else if($('#accion').val()=='e'){
      id=$('#idEditar').val();
      location.href ="/blissey/public/editarPresentacion/"+id+"/"+v_nombre;
    }
}
});
$("#nuevo").on('click', function (e) {
  $("#idEditar").val("");
  $("#accion").val("n");
});
});

function validarPresentacion(nombre){
  c=0;
  var error =[];
  valor=true;
  if(nombre==""){
    error[c]='El campo nombre es requerido';
    c=c+1;
    valor=false;
  }else if(nombre.length<3){
    error[c]='El campo nombre debe contener mínimo 3 caracteres';
    c=c+1;
    valor=false;
  }
  for (var i = 0; i < c; i++) {
    new PNotify({
      title: 'Error!',
      text: error[i],
      type: 'error',
      styling: 'bootstrap3'
    });
  }
  return valor;
}
function editarPresentacion(id,nombre){
  $('#accion').val('e');
  $('#nombre_presentacion').val(nombre);
  $('#idEditar').val(id);
}
