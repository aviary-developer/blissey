$("#registroPaciente").click(function(){
  var nombrePaciete=$("#nombrePaciente").val();
  var apellidoPaciete=$("#apellidoPaciete").val();

  if($("#sexoMasculino").val()==true){
    var sexoPaciente = true;
  }else{
    var sexoPaciente = false;
  }


  var ruta="/blissey/public/pacientes";
  var token=$('#tokenPacientes').val();
  $.ajax({
    url: ruta,
    headers:{'X-CSRF-TOKEN':token},
    type: 'POST',
    dataType: 'json',
    data:{nombre:nombrePaciente,apellido:apellidoPaciente,sexo:sexoPaciente},
    success: function(){
      CargaPacientes();
      $("#modal").modal('toggle');
      swal(
        'Paciente Registrado!',
        '',
        'success'
      )
    }
  });
});

function CargaPacientes(){
  var tablaPacientes=$("#tablaPacientes");
  var ruta="/blissey/public/leerPacientes";
  $("#tablaPacientes").empty();
  var correlativo=1;
  $.get(ruta,function(res){
    $(res).each(function(key,value){
      var sexo = (value.sexo)?"Masculino":"Femenino";
      tablaPacientes.append(
        "<tr><td>"+correlativo+"</td>"+
        "<td>"+value.apellido+"</td>"+
        "<td>"+value.nombre+"</td>"+
        "<td>"+sexo+"</td>"+
        "<td>"+value.telefono+"</td>"+
        "<td><button value="+value.id+" class='btn btn-primary btn-xs' data-toggle='modal' data-target='.modal-new1' onClick='MostrarPacientes(this);'>Editar</td>"+
        "<td><button class='btn btn-danger btn-xs' value="+value.id+" onClick='EliminarPacientes(this);'>Eliminar</td></tr>"
      );
      correlativo=correlativo+1;
    });
  });
}
