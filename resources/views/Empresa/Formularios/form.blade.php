<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div id="smartwizard">
	<ul>
		<li>
			<a href="#step-1">
				Paso 1
				<br>
				<small>Datos del hospital</small>
			</a>
		</li>
		<li>
			<a href="#step-2">
				Paso 2
				<br>
				<small>Datos del laboratorio</small>
			</a>
		</li>
		<li>
			<a href="#step-3">
				Paso 3
				<br>
				<small>Datos de la clínica</small>
			</a>
		</li>
		<li>
			<a href="#step-4">
				Paso 4
				<br>
				<small>Datos de la farmacia</small>
			</a>
		</li>
		<li>
			<a href="#step-5">
				Paso 5
				<br>
				<small>Logos institucionales</small>
			</a>
		</li>
	</ul>
	<div>
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

<script>
	$(document).ready(function(){
		$("#smartwizard").smartWizard({
			lang: {
				next: 'Siguiente',
				previous: 'Anterior'
			},
			toolbarSettings: {
				toolbarPosition: 'bottom', // none, top, bottom, both
				toolbarButtonPosition: 'right', // left, right
				showNextButton: true, // show/hide a Next button
				showPreviousButton: true, // show/hide a Previous button
				toolbarExtraButtons: [
					$('<button type="submit"></button>').text('Guardar')
						.addClass('btn btn-primary btn-sm')
				]
			},
			keyNavigation: false,
		});

		$(document).find('.btn-secondary').addClass('btn-sm');
	});
</script>