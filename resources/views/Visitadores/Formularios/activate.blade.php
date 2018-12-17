{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
<div class="btn-group">
  <a href={!! asset('/visitadores/'.$visitador->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
    <i class="fas fa-edit"></i>
  </a>
</div>
<div class="btn-group">
  <button type="button" class="btn btn-success btn-sm" title="Restaurar" onclick={!! "'alta(".$visitador->id.");'" !!}/>
    <i class="fas fa-check"></i>
  </button>
  <button type="button" class="btn btn-danger btn-sm" title="Eliminar" onclick={!! "'eliminar(".$visitador->id.");'" !!}/>
    <i class="fas fa-times"></i>
  </button>
</div>
@else
  <div class="btn-group">
    @if (!$visitador->estado)
      @php
        $regreso = "?estado=0&id=".$visitador->f_proveedor;
      @endphp
    @else
      @php
        $regreso = '?id='.$visitador->f_proveedor;
      @endphp
    @endif
    <a href={!! asset('/visitadores'.$regreso)!!} class="btn btn-dark btn-sm">
      <i class="fas fa-arrow-left"></i> Atras
    </a>
    <a href={!! asset('/visitadores/'.$visitador->id.'/edit')!!} class="btn btn-dark btn-sm">
      <i class="fas fa-edit"></i> Editar
    </a>
    @if ($visitador->estado)
      <button type="button" class="btn btn-dark btn-sm" onclick={!! "'baja(".$visitador->id.");'" !!}>
        <i class="fas fa-trash"></i> Papelera
      </button>
    @else
      <button type="button" class="btn btn-dark btn-sm" onclick={!! "'alta(".$visitador->id.");'" !!}/>
        <i class="fas fa-check"></i> Restaurar
      </button>
      <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$visitador->id.");'" !!}/>
        <i class="fas fa-remove"></i> Eliminar
      </button>
    @endif
    <a href={!! asset('#')!!} class="btn btn-primary btn-sm">
      <i class="fas fa-question"></i> Ayuda
    </a>
  </div>
@endif
{!!Form::close()!!}
<script type="text/javascript">
function alta(id){
  return swal({
    title: 'Restaurar registro',
    text: '¿Está seguro? ¡El registro estará activo nuevamente!',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Restaurar!',
    cancelButtonText: 'No, ¡Cancelar!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      var dominio = window.location.host;
      $('#formulario').attr('action','desactivateVisitador/'+id);
      $('#formulario').submit();
    }
  });
}

function eliminar(id){
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
      $('#formulario').attr('action','destroyVisitador/'+id);
      $('#formulario').submit();
    }
  });
}
</script>
