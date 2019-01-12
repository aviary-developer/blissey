<a class="btn btn-danger btn-sm" onclick={!! "'anular(".$transaccion->id.");'" !!} data-toggle="tooltip" data-placement="top" title="Anular"/>
  <i class="fas fa-times" style="color: #fff;"></i>
</a>
<script type="text/javascript">
function anular(id){
  aux='¿Está seguro? ¡El registro no podrá ser recuperado!'+
  '<label style="color: red;">Debe comentar la razón para anular la factura</label>'+
  '<input class="swal2-input" id="comentario" placeholder="Razón">';
  return swal({
    title: 'Anular Venta',
    html:aux,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Anular!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      if($('#comentario').val().trim()==""){
        anular(id);
      }else{
        var dominio = window.location.host;
        location.href =$('#guardarruta').val() + '/anularVenta/'+id+'/'+$('#comentario').val();
      }
    }
  });
}

</script>
