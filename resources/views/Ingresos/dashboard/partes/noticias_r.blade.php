<div class="col-12" id="contenido_noticias">
	@if ($lista_paquetes != null)
		@foreach ($lista_paquetes as $paquete)	
			<div class="row">
				<div class="alert alert-danger m-1 p-1">
					<div class="row">
						<div class="col-1">
							<i class="fas fa-calendar text-danger"></i> 
						</div>
						<div class="col-9">
							<span>
								No se ha agregado el cobro diario del <span class="badge badge-danger">PAQUETE HOSPITALARIO</span> con fecha de 
								<b>
									{{$paquete["fecha"]->format('d / m / Y')}}
									<input type="hidden" id="fecha_paquete_noticias" value="{{$paquete["fecha"]->format('d/m/Y')}}">
								</b>
							</span>
						</div>
						<div class="col-2">
							<button type="button" class="btn btn-outline-primary btn-sm" data-target="#paquete_m" data-toggle="modal" id="carga_paquete_modal">
								<i class="fas fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@endif
	@if ($lista_honorarios != null)
		@foreach ($lista_honorarios as $honorario)	
			<div class="row">
				<div class="alert alert-danger m-1 p-1">
					<div class="row">
						<div class="col-1">
							<i class="fas fa-medkit text-danger"></i> 
						</div>
						<div class="col-9">
							<span>
								No se ha agregado el cobro diario del <span class="badge badge-dark">HONORARIO MÉDICO</span> con fecha de 
								<b>
									{{$honorario["fecha"]->format('d / m / Y')}}
									<input type="hidden" id="fecha_honorario_noticias" value="{{$honorario["fecha"]->format('d/m/Y')}}">
								</b>
							</span>
						</div>
						<div class="col-2">
							<button type="button" class="btn btn-outline-primary btn-sm" data-target="#honorario_m" data-toggle="modal" id="carga_honorario_modal">
								<i class="fas fa-plus"></i>
							</button>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@endif
	@if ($lista_paquetes == null && $lista_honorarios == null)
		<div class="row">
			<div class="alert alert-secondary m-1 p-1 w-100">
				<div class="row">
					<div class="col-1">
						<i class="fas fa-check text-success"></i>
					</div>
					<div class="col-10">
						<span>¡No hay notificaciones pendientes!</span>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>