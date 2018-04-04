<a class="btn btn-danger btn-sm" onclick={!! "'anularVenta(".$transaccion->id.");'" !!} data-toggle="tooltip" data-placement="top" title="Anular"/>
  <i class="fa fa-remove"></i>
</a>
<script type="text/javascript">
async function anularVenta(id){
  aux='¿Está seguro? ¡El registro no podrá ser recuperado!'+
  '<label style="color: red;">Debe comentar la razón para anular la factura</label>'+
  '<input class="swal2-input" id="comentario" placeholder="Razón">';
  return swal({
    title: 'Anular Venta',
    html:aux,
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#DD6B55',
    confirmButtonText: 'Si, ¡Eliminar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-danger',
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then(function () {
    if($('#comentario').val().trim()==""){
      anularVenta(id);
    }else{
    var dominio = window.location.host;
    location.href ='http://'+dominio+'/blissey/public/anularVenta/'+id+'/'+$('#comentario').val();
    }
  }, function (dismiss) {
    if (dismiss === 'cancel') {
      swal(
        'Cancelado',
        'La factura se mantiene',
        'info'
      )
    }
  });
}

</script>
