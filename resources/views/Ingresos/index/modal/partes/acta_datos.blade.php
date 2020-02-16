<form action="" autocomplete="off">

	<center>
		<h5 class="mb-1">Datos personales del Paciente</h5>
	</center>
	<div class="ln_solid mb-1 mt-1"></div>
	
	<div class="row">
	
		<div class="form-group col-6">
			<label class="" for="nombre">Nombre *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-user"></i></div>
				</div>
				{!! Form::text(
					'nombre',
					null,
					['class'=>'form-control form-control-sm',
						'placeholder'=>'Nombre del paciente',
						'id'=>'acta-p-nombre']
				) !!}
			</div>
		</div>
		
		<div class="form-group col-6">
			<label class="" for="apellido">Apellido *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-user"></i></div>
				</div>
				{!! Form::text(
					'apellido',
					null,
					['class'=>'form-control form-control-sm',
						'placeholder'=>'Apellido del paciente',
						'id'=>'acta-p-apellido']
				) !!}
			</div>
		</div>
		
		<div class="form-group col-6">
			<label class="" for="fechaNacimiento">Fecha de nacimiento *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-calendar"></i></div>
				</div>
				@php
					$fecha = Carbon\Carbon::now();
					$ahora = Carbon\Carbon::now();
				@endphp
				{!! Form::date(
					'fechaNacimiento',
					$fecha,
					['class'=>'form-control form-control-sm',
						'placeholder'=>'Nombre del paciente',
						'max'=>$ahora->format('Y-m-d'),
						'id' => 'acta-p-fecha']
				) !!}
			</div>
		</div>
	
		<div class="form-group col-6">
			<label class="" for="telefono">DUI *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
				</div>
				{!! Form::text(
					'dui',
					null,
					['class'=>'form-control form-control-sm',
						'placeholder'=>'DUI del paciente',
						'data-inputmask'=>"'mask' : '99999999-9'",
						'id'=>'acta-p-dui']
				) !!}
			</div>
		</div>
		
		<div class="form-group col-6">
			<label class="" for="telefono">Teléfono *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-phone"></i></div>
				</div>
				{!! Form::text(
					'telefono',
					null,
					['class'=>'form-control form-control-sm',
						'placeholder'=>'Teléfono del paciente',
						'data-inputmask'=>"'mask' : '9999-9999'",
						'id'=>'acta-p-telefono']
				) !!}
			</div>
		</div>
	
		<div class="form-group col-6">
			<label class="" for="telefono">Dirección *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-map-marked"></i></div>
				</div>
				{!! Form::text(
					'direccion',
					null,
					['class'=>'form-control form-control-sm',
						'placeholder'=>'Dirección del paciente',
						'id'=>'acta-p-direccion']
				) !!}
			</div>
		</div>
	</div>
	
	<div id="acta-datos_responsable" style="display:none;">
		<center>
			<h5 class="mb-1">Datos personales del Responsable</h5>
		</center>
		<div class="ln_solid mb-1 mt-1"></div>
	
		<div class="row">
			<div class="form-group col-6">
				<label class="" for="nombre">Nombre *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-user"></i></div>
					</div>
					{!! Form::text(
						'nombre',
						null,
						['class'=>'form-control form-control-sm',
							'placeholder'=>'Nombre del paciente',
							'id'=>'acta-r-nombre']
					) !!}
				</div>
			</div>
			
			<div class="form-group col-6">
				<label class="" for="apellido">Apellido *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-user"></i></div>
					</div>
					{!! Form::text(
						'apellido',
						null,
						['class'=>'form-control form-control-sm',
							'placeholder'=>'Apellido del paciente',
							'id'=>'acta-r-apellido']
					) !!}
				</div>
			</div>
		
			<div class="form-group col-6">
				<label class="" for="telefono">DUI *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					{!! Form::text(
						'dui',
						null,
						['class'=>'form-control form-control-sm',
							'placeholder'=>'DUI del paciente',
							'data-inputmask'=>"'mask' : '99999999-9'",
							'id'=>'acta-r-dui']
					) !!}
				</div>
			</div>
		</div>
	</div>
</form>
