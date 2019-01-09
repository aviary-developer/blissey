<a class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$transaccion->id.");'" !!} title="Eliminar"/>
  <i class="fas fa-times" style="color:#fff;"></i>
</a>
<script type="text/javascript">
function eliminar(id){
  return swal({
    title: 'Eliminar pedido',
    text: '¿Está seguro? ¡El registro no podrá ser recuperado!',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Eliminar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      location.href =$("#guardarruta").val()+'/eliminarPedido/'+id+"/0";
    }
  });
}
</script>
