{!!Form::open(['url'=>['desactivateMuestraExamen',$muestra->id],'method'=>'POST'])!!}
<div class="btn-group">
	<a href={!! asset('/muestras/'.$muestra->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
		<i class="fa fa-edit"></i>
	</a>
	<button type="button" class="btn btn-danger btn-sm" title="Enviar a papelera" onclick="
      return swal({
        title: 'Enviar registro a papelera',
        text: '¿Está seguro? ¡Ya no estara disponible!',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Si, ¡Enviar!',
        cancelButtonText: 'No, ¡Cancelar!',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-default',
        buttonsStyling: false
      }).then((result) => {
        if (result.value) {
          localStorage.setItem('msg','yes');
          submit();
        }
      });"/>
        <i class="fa fa-trash"></i>
    </button>
</div>
{!!Form::close()!!}
