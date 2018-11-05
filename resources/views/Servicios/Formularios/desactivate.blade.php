{!!Form::open(['url'=>['desactivateServicio',$servicio->id],'method'=>'POST'])!!}
<div class="btn-group">
	@if ($servicio->categoria->nombre == "Cama" || $servicio->categoria->nombre == "Laboratorio Clínico" || $servicio->categoria->nombre == "Ultrasonografía" || $servicio->categoria->nombre == "TAC" || $servicio->categoria->nombre == "Honorarios" || $servicio->categoria->nombre == "Rayos X")
		<button type="button" class="btn btn-primary btn-sm disabled" title="Servicio creado por el sistema"><i class="fas fa-ban"></i></button>
	@else	
		<a href={!! asset('/servicios/'.$servicio->id.'/edit')!!} class="btn btn-sm btn-primary" title="Editar">
			<i class="fa fa-edit"></i>
		</a>
	@endif


	@if ($servicio->categoria->nombre == "Cama" || $servicio->categoria->nombre == "Laboratorio Clínico" || $servicio->categoria->nombre == "Ultrasonografía" || $servicio->categoria->nombre == "TAC" || $servicio->categoria->nombre == "Honorarios" || $servicio->categoria->nombre == "Rayos X")
		<button type="button" class="btn btn-danger btn-sm disabled" title="Servicio creado por el sistema"><i class="fas fa-ban"></i></button>
	@else	
		<button type="button" class="btn btn-danger btn-sm" title="Enviar a papelera" onclick="
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
	@endif
</div>
{!!Form::close()!!}
