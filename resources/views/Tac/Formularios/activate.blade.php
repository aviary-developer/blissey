{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
	<div class="btn-group">
		<a href={!! asset('/tacs/'.$tac->id.'/edit')!!} class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar">
			<i class="fa fa-edit"></i>
		</a>
		<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Restaurar" onclick={!! "'alta(".$tac->id.");'" !!}/>
			<i class="fa fa-check"></i>
		</button>
		@php
    $cuenta=App\Tac::foraneos($tac->id);
  @endphp
  @if ($cuenta>0)
    <button type="button" class="btn btn-sm btn-danger disabled" title="No se puede eliminar">
      <i class="fas fa-ban"></i>
    </button>
  @else
    <button type="button" class="btn btn-danger btn-sm" onclick={!! "'eliminar(".$tac->id.");'" !!} title="Eliminar"/>
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
      cancelButtonClass: 'btn btn-light',
      buttonsStyling: false
    }).then((result) => {
      if (result.value) {
        localStorage.setItem('msg','yes');
        var dominio = window.location.host;
        $('#formulario').attr('action','activateTac/'+id);
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
        $('#formulario').attr('action','destroyTac/'+id);
      $('#formulario').submit();
      }
    });
  }
</script>
