{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
<input name="id" type="hidden" value={{$solicitud->id}}>
<input name="exa" type="hidden" value={{$solicitud->f_rayox}}>
@if($solicitud->estado == 1)
  <a id="evaluar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_rayox)!!} class="btn btn-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Evaluar"/>
    <i class="fa fa-paste"></i>
  </a>
  <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick={!! "'eliminarSolicitud(".$solicitud->id.");'" !!}>
    <i class="fa fa-trash"></i>
  </button>
@else
  <a id="evaluar" href= {!! asset('/solicitudex/'.$solicitud->id.'/edit')!!} class="btn btn-dark btn-sm"  data-toggle="tooltip" data-placement="top" title="Editar"/>
    <i class="fa fa-edit"></i>
  </a>
  <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_rayox)!!} class="btn btn-primary btn-sm"  data-toggle="tooltip" data-placement="top" title="Entregar" target="_blank"/>
    <i class="fa fa-envelope"></i>
  </a>
@endif
<script>
function eliminarSolicitud(id){
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
    var dominio = window.location.host;
    $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroySolicitudExamen/'+id);
    $('#formulario').submit();
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
  });
}
</script>
{!!Form::close()!!}
