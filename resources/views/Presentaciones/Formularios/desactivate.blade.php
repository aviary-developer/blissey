{!!Form::open(['url'=>['desactivatePresentacion',$presentacion->id],'method'=>'POST'])!!}
<a href={!! asset('/presentaciones/'.$presentacion->id)!!} class="btn btn-xs btn-info">
  <i class="fa fa-info-circle"></i>
</a>
<a onclick="{{'editarPresentacion('.$presentacion->id.',"'.$presentacion->nombre.'")'}}" class="btn btn-xs btn-primary" data-toggle="modal" data-target=".bs-modal-lg">
  <i class="fa fa-edit"></i>
</a>
<button type="button" class="btn btn-danger btn-xs" onclick="
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
