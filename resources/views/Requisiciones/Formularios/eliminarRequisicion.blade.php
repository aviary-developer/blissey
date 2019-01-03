<button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminarPedido(".$transaccion->id.");'" !!} title="Eliminar"/>
  <i class="fa fa-times"></i>
</button>

<script type="text/javascript">
function eliminarPedido(id){
  return swal({
		title: 'Eliminar registro',
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
			localStorage.setItem('msg','yes');
			var dominio = window.location.host;
			location.href = $('#guardarruta').val() + '/eliminarPedido/'+id+"/4";
			$('#formulario').submit();
		}
	});
}
</script>
