$(document).ready(function(){
  CargaPacientes();
});

function EliminarReactivos(btn){
  var ruta="/blissey/public/pacientes/"+btn.value+"";
  var token=$('#tokenPacientes').val();
  swal({
    title: '¿Estas seguro?',
    text: "Se mandará a papelera",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, borrar!',
    cancelButtonText: 'No, cancelar!',
    confirmButtonClass: 'btn btn-success',
    cancelButtonClass: 'btn btn-danger',
    buttonsStyling: false
  }).then(function () {
    $.ajax({
      url: ruta,
      headers:{'X-CSRF-TOKEN':token},
      type: 'DELETE',
      dataType: 'json',
      success: function(){
        CargaPacientes();
        swal(
          '¡Eliminado!',
          'El paciente se eliminó',
          'success'
        )
      }
    });
  }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {
      swal({
        title: 'Cancelado!',
        text: 'Paciente no eliminado',
        timer: 1500,
        type: 'error'
      })
    }
  })
}

function MostrarPacientes(btn){
  console.log(btn.value);
  var ruta="/blissey/public/pacientes/"+btn.value+"/edit";
  $.get(ruta,function(res){
    $("#nombrePaciente").val(res.nombre);
    $("#apellidoPaciete").val(res.apellido);
    $("#idPaciente").val(res.id);
  });
}

$("#actualizarPaciente").click(function(){
  var idPaciente=$("#idPaciente").val();
  var nombrePaciente=$("#nombreReactivo").val();
  var apellidoPaciete=$("#apellidoPaciete").val();
  if($("#sexoMasculino").val()==true){
    var sexoPaciente = true;
  }else{
    var sexoPaciente = false;
  }
  var ruta="/blissey/public/pacientes/"+idPaciente+"";
  var token=$('#tokenPacientes').val();
  $.ajax({
    url: ruta,
    headers:{'X-CSRF-TOKEN':token},
    type: 'PUT',
    dataType: 'json',
    data:{nombre:nombrePaciente,apellido:apellidoPaciente,sexo:sexoPaciente},
    success: function(){
      CargaReactivos();
      $("#gg").modal('toggle');
      swal(
        'Paciente actualizado!',
        '',
        'success'
      )
    }
  });
});
