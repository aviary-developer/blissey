{!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
@if ($index)
	<div class="btn-group">
		<a href="#" class="btn btn-sm btn-dark" data-value={{asset(Storage::url($donacion->pruebaCruzada))}} title="Prueba cruzada" id="p_cruzada" data-target="#modalPruebaCruzada" data-toggle="modal">
			<i class="fa fa-image"></i>
		</a>
		<a href={!! asset('/bancosangre/'.$donacion->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
			<i class="fa fa-edit"></i>
		</a>
		<button type="button" class="btn btn-success btn-sm" title="Restaurar" onclick={!! "'alta(".$donacion->id.");'" !!}/>
			<i class="fa fa-check"></i>
		</button>
		<button type="button" class="btn btn-danger btn-sm" title="Eliminar" onclick={!! "'eliminar(".$donacion->id.");'" !!}/>
			<i class="fa fa-times"></i>
		</button>
	</div>
@endif
{!!Form::close()!!}
<script type="text/javascript">
  $(".index-table").on('click','#p_cruzada',function(e){
		e.preventDefault();
		{{--  $("#modalPruebaCruzada").modal('show');  --}}
		$("#img-cruzada").attr('src',$(this).data('value'));
	});

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
        $('#formulario').attr('action','activateBancoSangre/'+id);
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
        $('#formulario').attr('action','destroyBancoSangre/'+id);
      $('#formulario').submit();
      }
    });
  }
</script>
