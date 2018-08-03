{!!Form::open(['url'=>['desactivatePresentacion',$presentacion->id],'method'=>'POST'])!!}
<a href={!! asset('/presentaciones/'.$presentacion->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
  <i class="fa fa-info-circle"></i>
</a>
<a href={{asset('/presentaciones/'.$presentacion->id.'/edit')}} class="btn btn-sm btn-primary"  data-toggle="tooltip" data-placement="top" title="Editar">
  <i class="fa fa-edit"></i>
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
