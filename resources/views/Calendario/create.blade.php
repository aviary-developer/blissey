<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="calendar-create" data-backdrop="static">
  <div class="modal-dialog">
		<div class="x_panel m_panel text-danger">
			<center>
				<h4 class="mb-1">
					Evento
					<span class="badge badge-danger">Nuevo</span>
				</h4>
			</center>
		</div>

		<div class="m_panel x_panel">

			<div class="flex-row">
				<center>
					<h5 class="text-primary">
						<i class="far fa-calendar"></i>
						<span id="cal-title"></span>
					</h5>
					<input type="hidden" id="start-date" value="">
					<input type="hidden" id="end-date" value="">
				</center>
			</div>

			<form action="" class="form-horizontal form-label-left">
				<div class="form-group col-sm-12">
					<label class="" for="seccion_select">Hora inicial y final *</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-clock"></i></div>
						</div>
						{!! Form::time('hora-inicio',$hora_i->format('H:i'),['id'=>'hora-inicio','class'=>'form-control form-control-sm']) !!}
						{!! Form::time('hora-final',$hora_f->format('H:i'),['id'=>'hora-final','class'=>'form-control form-control-sm']) !!}
					</div>
				</div>

				<div class="form-group col-sm-12">
					<label class="" for="seccion_select">Título *</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
						</div>
						{!! Form::text('titulo-ev',null,['id'=>'titulo-ev','class'=>'form-control form-control-sm','placeholder'=>'Nombre del evento','autocomplete'=>'off']) !!}
					</div>
				</div>

				<div class="form-group col-sm-12">
					<label class="" for="seccion_select">Descripción *</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
						</div>
						{!! Form::textarea('desc-ev',null,['id'=>'desc-ev','class'=>'form-control form-control-sm','placeholder'=>'Descripción del evento', 'rows'=>'2']) !!}
					</div>
				</div>

				@if (Auth::user()->tipoUsuario == "Recepción")
					<div class="form-group col-sm-12">
						<label class="" for="seccion_select">Usuario *</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-user"></i></div>
							</div>
							<select name="" id="sel-user" class="form-control form-control-sm">
								<option value="0">Todos</option>
								@foreach ($usuarios as $usuario)
										<option value={{$usuario->id}}>{{$usuario->nombre.' '.$usuario->apellido}}</option>
								@endforeach 
							</select>
						</div>
					</div>

					<div class="form-group col-sm-12" id="tipo-u-div">
						<label class="" for="seccion_select">Tipo de usuario *</label>
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-users"></i></div>
							</div>
							<select name="" id="sel-t-user" class="form-control form-control-sm">
								<option value="0">Todos</option>
								<option value="Gerencia">Gerencia</option>
								<option value="Médico">Médico</option>
								<option value="Recepción">Recepción</option>
								<option value="Laboaratorio">Laboratorio Clínico</option>
								<option value="Ultrasonografía">Ultrasonografía</option>
								<option value="Rayos X">Rayos X</option>
								<option value="Farmacia">Farmacia</option>
								<option value="Enfermería">Enfermería</option>
								<option value="TAC">TAC</option>
								</select>
							</div>
						</div>

				@endif
			</form>
		</div>
		
		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" class="btn btn-primary btn-sm col-2" id="guardar_evento">
					Guardar
				</button>
				<button type="button" class="btn btn-sm btn-light col-2" data-dismiss="modal">Cerrar</button>
			</center>
		</div>
  </div>
</div>