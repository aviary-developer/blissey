<a class="btn btn-danger btn-xs" onclick={!! "'eliminarPedido(".$transaccion->id.");'" !!}/>
  <i class="fa fa-remove"></i>
</a>
{{-- href={!! asset('/eliminarPedido/'.$transaccion->id)!!} --}}
<script type="text/javascript">
function eliminarPedido(id){
  return swal({
    title: 'Eliminar requisición',
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
    location.href ='http://'+dominio+'/blissey/public/eliminarPedido/'+id+"/4";
    $('#formulario').submit();
    swal(
      '¡Eliminado!',
      'Acción realizada satisfactorimente',
      'success'
    )
  }, function (dismiss) {
    if (dismiss === 'cancel') {
      swal(
        'Cancelado',
        'La requisición se mantiene',
        'info'
      )
    }
  });
}
</script>