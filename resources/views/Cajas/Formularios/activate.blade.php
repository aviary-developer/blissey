{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
  <div class="btn-group">
  </div>
  <div class="btn-group">
  <button type="button" class="btn btn-success btn-sm" onclick={!! "'alta(".$caja->id.");'" !!}  title="Restaurar"/>
    <i class="fas fa-check"></i>
  </button>
  @php
  $cuenta=App\Caja::foreanos($caja->id);
  @endphp
  @if ($cuenta>0)
    <button type="button" class="btn btn-sm btn-danger disabled"  title="No se puede eliminar">
      <i class="fas fa-exclamation-triangle"></i>
    </button>
  @else
    <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$caja->id.");'" !!}  title="Eliminar"/>
      <i class="fas fa-times"></i>
    </button>
  @endif
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
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateCaja/'+id);
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
    cancelButtonClass: 'btn btn-default',
    buttonsStyling: false
  }).then((result) => {
    if (result.value) {
      localStorage.setItem('msg','yes');
      var dominio = window.location.host;
      $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyCaja/'+id);
      $('#formulario').submit();
    }
  });
}
</script>
