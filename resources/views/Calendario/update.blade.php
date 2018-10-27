<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="calendar-update" data-backdrop="static">
  <div class="modal-dialog">
		<div class="x_panel m_panel text-danger">
			<center>
				<h4 class="mb-1">
					Evento
					<span class="badge badge-danger">Editar</span>
				</h4>
			</center>
		</div>

		<div class="m_panel x_panel">

			<div class="flex-row">
				<center>
					<h5 class="text-primary">
						<i class="far fa-calendar"></i>
						<span id="cal-title-u"></span>
					</h5>
					<input type="hidden" id="event-id" value="">
				</center>
			</div>

			<form action="" class="form-horizontal form-label-left">
				<div class="form-group">
					<label class="control-label col-sm-3">Hora de inicio:</label>
					<span class="badge font-sm badge-primary col-sm-3 control-label" id="hora-i-u" style="margin-bottom: 0px; text-align:center">00:00</span>
					<label class="control-label col-sm-3">Hora final:</label>
					<span class="badge font-sm badge-danger col-sm-3 control-label" id="hora-f-u" style="margin-bottom: 0px; text-align:center">00:00</span>
					
				</div>
				<div class="form-group col-sm-12">
					<label class="" for="seccion_select">Título *</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
						</div>
						{!! Form::text('titulo-ev-u',null,['id'=>'titulo-ev-u','class'=>'form-control form-control-sm','placeholder'=>'Nombre del evento']) !!}
					</div>
				</div>

				<div class="form-group col-sm-12">
					<label class="" for="seccion_select">Descripción *</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
						</div>
						{!! Form::textarea('desc-ev-u',null,['id'=>'desc-ev-u','class'=>'form-control form-control-sm','placeholder'=>'Descripción del evento', 'rows'=>'2']) !!}
					</div>
				</div>
			</form>
		</div>

		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" class="btn btn-sm btn-danger col-2" id="eliminar_evento">
          Eliminar
        </button>
				<button type="button" class="btn btn-primary btn-sm col-2" id="editar_evento">
          Guardar
        </button>
				<button type="button" class="btn btn-sm btn-light col-2" data-dismiss="modal">Cerrar</button>
			</center>
		</div>
  </div>
</div>