<div class="x_content">
	<div class="form_wizard wizard_horizontal" id="wizard">
		<ul class="wizard_steps">
			<li>
				<a href="#step-1">
					<span class="step_no">
						<i class="fa fa-hospital-o"></i>
					</span>
					<span class="step_descr">
						Paso 1
						<br>
						<small>Datos del hospital</small>
					</span>
				</a>
			</li>
			<li>
				<a href="#step-2">
					<span class="step_no">
						<i class="fa fa-flask"></i>
					</span>
					<span class="step_descr">
						Paso 2
						<br>
						<small>Datos del laboratorio</small>
					</span>
				</a>
			</li>
			<li>
				<a href="#step-3">
					<span class="step_no">
						<i class="fa fa-stethoscope"></i>
					</span>
					<span class="step_descr">
						Paso 3
						<br>
						<small>Datos de la clínica</small>
					</span>
				</a>
			</li>
			<li>
				<a href="#step-4">
					<span class="step_no">
						<i class="fa fa-medkit"></i>
					</span>
					<span class="step_descr">
						Paso 4
						<br>
						<small>Datos de la farmacia</small>
					</span>
				</a>
			</li>
			<li>
				<a href="#step-5">
					<span class="step_no">
						<i class="fa fa-image"></i>
					</span>
					<span class="step_descr">Paso 5
						<br>
						<small>Logos institucionales</small>
					</span>
				</a>
			</li>
		</ul>
		<div id="step-1">
			@include('Empresa.Formularios.paso1')
		</div>
		<div id="step-2">
			@include('Empresa.Formularios.paso2')
		</div>
		<div id="step-3">
			@include('Empresa.Formularios.paso3')
		</div>
		<div id="step-4">
			@include('Empresa.Formularios.paso4')
		</div>
		<div id="step-5">
			@include('Empresa.Formularios.paso5')
		</div>
	</div>
</div>