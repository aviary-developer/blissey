<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="calculadora" data-backdrop="static">
  <div class="modal-dialog modal-lg">
		<div class="row">
			<div class="col-sm-12">
				<div class="x_panel m_panel text-danger">
					<center>
						<h4 class="mb-1">
							<i class="fas fa-calculator"></i>
							Calculadora
						</h4>
					</center>
				</div>
			</div>
		</div>
		<div class="row" id="primary_panel">
			<div class="col-sm-4">
				<div class="m_panel x_panel bg-primary text-light h-25">
					<center>
						<span class="text-monospace">
							Total
						</span>
						<h2 id="c_amount">9999.99</h2>
					</center>
				</div>
				<div class="x_panel m_panel">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Ingreso</a>
						<a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Médicos</a>
						<a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab" aria-controls="v-pills-3" aria-selected="false">Médicamentos</a>
						<a class="nav-link" id="v-pills-4-tab" data-toggle="pill" href="#v-pills-4" role="tab" aria-controls="v-pills-4" aria-selected="false">Servicios</a>
						<a class="nav-link" id="v-pills-5-tab" data-toggle="pill" href="#v-pills-5" role="tab" aria-controls="v-pills-5" aria-selected="false">Laboratorio</a>
						<a class="nav-link" id="v-pills-6-tab" data-toggle="pill" href="#v-pills-6" role="tab" aria-controls="v-pills-6" aria-selected="false">Ultrasonografía</a>
						<a class="nav-link" id="v-pills-7-tab" data-toggle="pill" href="#v-pills-7" role="tab" aria-controls="v-pills-7" aria-selected="false">TAC</a>
						<a class="nav-link" id="v-pills-8-tab" data-toggle="pill" href="#v-pills-8" role="tab" aria-controls="v-pills-8" aria-selected="false">Rayos X</a>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="x_panel m_panel h-100">
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-1-tab">
							@include('Ingresos.index.modal.partes.c_ingreso')
						</div>
						<div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-2-tab">
							@include('Ingresos.index.modal.partes.c_medico')
						</div>
						<div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-3-tab">
							@include('Ingresos.index.modal.partes.c_medicamento')
						</div>
						<div class="tab-pane fade" id="v-pills-4" role="tabpanel" aria-labelledby="v-pills-4-tab">
							@include('Ingresos.index.modal.partes.c_servicio')
						</div>
						<div class="tab-pane fade" id="v-pills-5" role="tabpanel" aria-labelledby="v-pills-5-tab">
							@include('Ingresos.index.modal.partes.c_laboratorio')
						</div>
						<div class="tab-pane fade" id="v-pills-6" role="tabpanel" aria-labelledby="v-pills-6-tab">
							@include('Ingresos.index.modal.partes.c_ultra')
						</div>
						<div class="tab-pane fade" id="v-pills-7" role="tabpanel" aria-labelledby="v-pills-7-tab">
							@include('Ingresos.index.modal.partes.c_tacs')
						</div>
						<div class="tab-pane fade" id="v-pills-8" role="tabpanel" aria-labelledby="v-pills-8-tab">
							@include('Ingresos.index.modal.partes.c_rayos')
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" class="btn btn-light btn-sm col-2" onclick="location.reload()">Cerrar</button>
			</center>
		</div>
  </div>
</div>

{!!Html::script('js/scripts/Calculadora.js')!!}