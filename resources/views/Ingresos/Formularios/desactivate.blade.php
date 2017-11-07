{!!Form::open(['url'=>['desactivateIngreso',$ingreso->id],'method'=>'POST'])!!}
<a href={!! asset('/ingresos/'.$ingreso->id)!!} class="btn btn-xs btn-dark">
  <i class="fa fa-print"></i>
</a>
@if ($ingreso->estado == 0)
  <button type="button" class="btn btn-danger btn-xs" onclick="
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
    submit();
    swal(
    '¡Eliminado!',
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
  <i class="fa fa-remove"></i>
</button>
@endif
{!!Form::close()!!}
