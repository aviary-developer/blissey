@if ($ingreso->tipo < 3 && $ingreso->estado == 0)
	<div class="flex-row">
    <center>
      El paciente aún no ha firmado el acta de consentimiento
    </center>
  </div>
@else
	<div class="row">
		<div class="col-sm-4">
			<div class="x_panel border border-danger rounded">
				@include('Ingresos.dashboard.partes.signos_r')
			</div>
		</div>
		<div class="col-sm-4">
			<div class="x_panel border border-info rounded">
				@include('Ingresos.dashboard.partes.indicaciones_e')
			</div>
		</div>
		<div class="col-sm-4">
			<div class="x_panel border border-info rounded">
				@include('Ingresos.dashboard.partes.seguimiento_e')
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
					<div class="x_panel border border-primary rounded">
						@include('Ingresos.dashboard.partes.producto_r')
					</div>
		</div>
		<div class="col-sm-4">
			<div class="x_panel border border-primary rounded">
				@include('Ingresos.dashboard.partes.servicio_r')
			</div>
		</div>
		<div class="col-sm-4">
			<div class="x_panel border border-purple rounded">
				@include('Ingresos.dashboard.partes.laboratorio_r')
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<div class="x_panel border border-purple rounded">
				@include('Ingresos.dashboard.partes.rayos_x_r')
			</div>
		</div>
		<div class="col-sm-4">
			<div class="x_panel border border-purple rounded">
				@include('Ingresos.dashboard.partes.ultra_r')
			</div>
		</div>
		<div class="col-sm-4">
			<div class="x_panel border border-purple rounded">
				@include('Ingresos.dashboard.partes.tac_r')
			</div>
		</div>
	</div>
	{!!Html::script('js/scripts/Seguimiento.js')!!}
@endif
