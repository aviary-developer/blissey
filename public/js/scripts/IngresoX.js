function eliminar_ingreso(id) {
  return swal({
    title: 'Eliminar registro',
    text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Eliminar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then(function () {
    var dominio = window.location.host;
    $('#formulario').attr('action', 'http://' + dominio + '/blissey/public/desactivateIngreso/' + id);
    $('#formulario').submit();
    swal({
      type: 'success',
      title: '¡Ingresado!',
      text: 'Acción realizada satisfactoriamente',
      showConfirmButton: false
    });
  }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {
      swal(
        'Cancelado',
        'El registro se mantiene',
        'info'
      )
    }
  });
}

function confirmar_ingreso(id) {
  return swal({
    title: 'Confirmar ingreso',
    text: '¡El paciente estará ingresado!',
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Confirmar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then(function () {
    var dominio = window.location.host;
    $('#formulario').attr('action', 'http://' + dominio + '/blissey/public/activateIngreso/' + id);
    $('#formulario').submit();
    swal({
      type: 'success',
      title: '¡Ingresado!',
      text: 'Acción realizada satisfactoriamente',
      showConfirmButton: false
    });
  }, function (dismiss) {
    // dismiss can be 'cancel', 'overlay',
    // 'close', and 'timer'
    if (dismiss === 'cancel') {
      swal({
        type: 'info',
        title: 'Cancelado',
        text: 'El registro se mantiene'
      });
    }
  });
}