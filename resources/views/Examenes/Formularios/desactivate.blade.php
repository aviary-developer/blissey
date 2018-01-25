{!!Form::open(['url'=>['desactivateExamen',$examen->id],'method'=>'POST'])!!}
<a href={!! asset('/examenes/'.$examen->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
  <i class="fa fa-info-circle"></i>
</a>
<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Enviar a papelera" onclick="
  return swal({
    title: 'Enviar registro a papelera',
    text: '¿Está seguro? ¡Ya no estara disponible!',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Enviar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then(function () {
    submit();
    swal(
      '¡Desactivado!',
      'Acción realizada satisfactorimente',
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
