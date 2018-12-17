{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
<input name="id" type="hidden" value={{$solicitud->id}}>
<input name="exa" type="hidden" value={{$solicitud->f_ultrasonografia}}>

<center>
  <div class="btn-group">
    @if($solicitud->estado == 1)
      @if (Auth::user()->tipoUsuario == "Recepción")
        <button type="button" disabled="disabled" class="btn btn-sm btn-warning" title="Evaluando...">
          <i class="fas fa-wrench"></i>
        </button>
      @else
        <a id="evaluar" href= {!! asset('/evaluarExamen/'.$solicitud->id.'/'.$solicitud->f_ultrasonografia)!!} class="btn btn-dark btn-sm"  title="Evaluar"/>
          <i class="fas fa-paste"></i>
        </a>
        <button type="button" class="btn btn-danger btn-sm" title="Eliminar" onclick={!! "'eliminarSolicitud(".$solicitud->id.");'" !!}>
          <i class="fas fa-trash"></i>
        </button>
      @endif
    @else
      @if (Auth::user()->tipoUsuario != "Recepción")  
        <a id="editar" href= {!! asset('/solicitudex/'.$solicitud->id.'/edit')!!} class="btn btn-dark btn-sm"  title="Editar"/>
          <i class="fas fa-edit"></i>
        </a>
      @endif
      <a id="entregar" href={!! asset('/entregarExamen/'.$solicitud->id.'/'.$solicitud->f_ultrasonografia)!!} class="btn btn-primary btn-sm"  title="Entregar" target="_blank"/>
        <i class="fas fa-envelope"></i>
      </a>
    @endif
  </div>
</center>

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
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if(result.value){
      var dominio = window.location.host;
      $('#formulario').attr('action','destroySolicitudExamen/'+id);
      localStorage.setItem('msg', 'yes');
      $('#formulario').submit();
    }
  });
}
</script>
{!!Form::close()!!}
