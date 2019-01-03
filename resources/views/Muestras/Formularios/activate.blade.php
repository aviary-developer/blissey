{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
	<div class="btn-group">
		<a href={!! asset('/muestras/'.$muestra->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
			<i class="fa fa-edit"></i>
		</a>
		<button type="button" class="btn btn-success btn-sm" title="Restaurar" onclick={!! "'alta(".$muestra->id.");'" !!}/>
			<i class="fa fa-check"></i>
    </button>
    @php
      $cuenta=App\MuestraExamen::foraneos($muestra->id);
    @endphp
    @if ($cuenta>0)
      <button type="button" class="btn btn-sm btn-danger disabled"  title="No se puede eliminar">
        <i class="fas fa-ban"></i>
      </button>
    @else
      <button type="button" class="btn btn-danger btn-sm" title="Eliminar" onclick={!! "'eliminar(".$muestra->id.");'" !!}/>
        <i class="fa fa-times"></i>
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
      cancelButtonClass: 'btn btn-light',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {
        localStorage.setItem('msg','yes');
        $('#formulario').attr('action','activateMuestraExamen/'+id);
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
        $('#formulario').attr('action','destroyMuestraExamen/'+id);
      $('#formulario').submit();
      }
    });
  }
</script>