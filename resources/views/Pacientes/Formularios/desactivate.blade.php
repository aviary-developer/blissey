{!!Form::open(['url'=>['desactivatePaciente',$paciente->id],'method'=>'POST'])!!}
<button type="button" class="btn btn-danger btn-xs" onclick="
  return swal({
    title: 'Enviar registro a papelera',
    text: '¿Está seguro? ¡Ya no estara disponible!',
    type: 'question',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Enviar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then(function () {
    submit();
    swal(
      '¡Hecho!',
      'El registro ha sido enviado a papelera',
      'success'
    )
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
  });"/>
    <i class="fa fa-trash"></i>
</button>
{!!Form::close()!!}