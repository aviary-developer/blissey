<div class="row">
	<div class="col-sm-12">
		<div class="x_panel m_panel">
			<div class="row">
				<div class="col-4">
					<center>
						<h4 class="text-danger">
							<i class="fas fa-prescription"></i>
							Tratamiento
						</h4>
					</center>
				</div>
				<!--MAR20: Nombre de la receta-->
				<div class="col-8">
					<div class="form-group col-sm-12">
						<div class="input-group mb-2 mr-sm-2">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-prescription"></i></div>
							</div>
							<input type="text" class="form-control form-control-sm" placeholder="Nombre de la Receta" id="nombre_receta">
						</div>
					</div>
				</div>
			</div>
			<div class="btn-group col-sm-12">
				{{-- <button type="button" class="btn btn-danger btn-sm col-sm-3" id="med-btn">Medicamento</button>
				<button type="button" class="btn btn-light btn-sm col-sm-3" id="lab-btn">Laboratorio Clínico</button>
				<button type="button" class="btn btn-light btn-sm col-sm-3" id="ryu-btn">Rayos X, Ultras y TAC</button> --}}
				{{-- <button type="button" class="btn btn-light btn-sm col-sm-12" id="otro-btn">Ingresar tratamiento</button> --}}
			</div>
		</div>
	</div>
</div>
<div class="row">
	{{-- <div id="med-div">
		<div class="col-sm-6">
			<div class="x_panel m_panel" style="min-height: 440px">
				@include('Ingresos.dashboard.modales.partes.buscar_medicamento')
			</div>
		</div>
		<div class="col-sm-6">
			<div class="x_panel m_panel" style="height: 340px">
				@include('Ingresos.dashboard.modales.partes.texto_medicamento')
			</div>
			<div class="x_panel m_panel bg-warning" style="height: 90px">
				<div class="row">
					<div class="col-sm-8">
						<h5 class="">Alergias del paciente</h5>
					</div>
					<div class="col-sm-4">
						<button type="button" class="btn btn-sm btn-dark alignright" id="alergia_btn"><i class="fa fa-edit"></i> Editar</button>
					</div>
				</div>
				<div class="row">
					<center>
						<span id="alergias">{!!($paciente->alergia == null)?"<i>Ninguna</i>":$paciente->alergia!!}</span>
					</center>
				</div>
			</div>
		</div>
	</div>
	<div id="lab-div" class="w-100" style="display:none">
		<div class="col-sm-3">
			<div class="x_panel m_panel" style="height: 440px">
				@include('SolicitudExamenes.Formularios.opciones')
			</div>
		</div>
		<div class="col-sm-5" style="height: 440px">
			<div class="x_panel m_panel" style="height: 440px">
				@include('SolicitudExamenes.Formularios.contenido2')
			</div>
		</div>
		<div class="col-sm-4">
			<div class="x_panel m_panel" style="height: 440px">
				<div class="flex-row">
					<center>
						<h5 class="">Receta de laboratorio</h5>
					</center>
				</div>
				<div class="row" id="texto_receta_laboratorio" style="overflow-x: hidden; overflow-y: scroll; height: 370px">
					<div class="col-12"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="ryu-div" style="display:none">
		<div class="col-sm-6">
			<form action="" class="form-horizontal input_mask">
				<div class="x_panel m_panel" style="height: 140px">
					@include('Ingresos.dashboard.modales.partes.rayos_x')
				</div>
				<div class="x_panel m_panel" style="height: 140px">
					@include('Ingresos.dashboard.modales.partes.ultras')
				</div>
				<div class="x_panel m_panel" style="height: 140px">
					@include('Ingresos.dashboard.modales.partes.tac')
				</div>
			</form>
		</div>
		<div class="col-sm-6">
			<div class="x_panel m_panel" style="height: 440px">
				@include('Ingresos.dashboard.modales.partes.texto_evaluacion')
			</div>
		</div>
	</div> --}}
	<div id="otro-div" class="w-100">
		<div class="col-sm-12">
			<div class="x_panel m_panel" style="height: 440px">
				<div class="flex-row">
					<center>
						<h5 class="">Editor de texto</h5>
					</center>
				</div>
				<div class="row">
					@include('Ingresos.dashboard.modales.partes.editor_texto')
				</div>
			</div>
		</div>
	</div>
</div>

<div class="m_panel x_panel bg-transparent" style="border:0px !important">
	<center>
		<button type="button" class="btn-sm btn-primary btn col-2" id="guardar_consulta">Guardar</button>
		<button type="button" class="btn btn-light col-2 btn-sm" data-dismiss="modal">Cerrar</button>
	</center>
</div>