{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
	<div class="btn-group">
		<a href={!! asset('/parametros/'.$parametro->id)!!} class="btn btn-sm btn-info" title="Ver">
			<i class="fa fa-info-circle"></i>
		</a>
		<a href={!! asset('/parametros/'.$parametro->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
			<i class="fa fa-edit"></i>
		</a>
		<button type="button" class="btn btn-success btn-sm" title="Restaurar" onclick={!! "'alta(".$parametro->id.");'" !!}/>
			<i class="fa fa-check"></i>
		</button>
		<button type="button" class="btn btn-danger btn-sm" title="Eliminar" onclick={!! "'eliminar(".$parametro->id.");'" !!}/>
			<i class="fa fa-times"></i>
		</button>
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
        $('#formulario').attr('action','http://'+dominio+'/blissey/public/activateParametro/'+id);
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
        $('#formulario').attr('action','http://'+dominio+'/blissey/public/destroyParametro/'+id);
      $('#formulario').submit();
      }
    });
  }
</script>
