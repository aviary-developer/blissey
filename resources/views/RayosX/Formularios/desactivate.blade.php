{!!Form::open(['url'=>['desactivateRayosx',$rayox->id],'method'=>'POST'])!!}
<div class="btn-group">

	<a href={!! asset('/rayosx/'.$rayox->id.'/edit')!!} class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="Editar">
		<i class="fa fa-edit"></i>
	</a>
	<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Enviar a papelera" onclick="
		return swal({
			title: 'Enviar registro a papelera',
			text: '¿Está seguro? ¡Ya no estara disponible!',
			type: 'question',
			showCancelButton: true,
			confirmButtonText: 'Si, ¡Enviar!',
			cancelButtonText: 'No, ¡Cancelar!',
			confirmButtonClass: 'btn btn-danger',
			cancelButtonClass: 'btn btn-light',
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
