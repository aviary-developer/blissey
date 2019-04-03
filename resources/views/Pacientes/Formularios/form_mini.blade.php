<div class="x_panel m_panel">
  <center>
    <h5 class="mb-1">Datos Personales</h5>
  </center>
  <div class="ln_solid mb-1 mt-1"></div>
  <div class="form-group col-sm-12">
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
          'id'=>'pac_nombre']
      ) !!}
    </div>
  </div>
  
  <div class="form-group col-sm-12">
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
          'id'=>'pac_apellido']
      ) !!}
    </div>
  </div>
  
  <div class="form-group col-sm-12">
    <label class="" for="nombre">Sexo *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div id="radioBtn" class="btn-group col-sm-12">
        <a class="btn btn-primary btn-sm active col-sm-6" data-toggle="pac_sexo" data-title="1">Masculino</a>
        <a class="btn btn-primary btn-sm notActive col-sm-6" data-toggle="pac_sexo" data-title="0">Femenino</a>
      </div>
      <input type="hidden" name="pac_sexo" id="pac_sexo" value="1">
    </div>
  </div>
  
  <div class="form-group col-sm-12">
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
          'id' => 'pac_fecha']
      ) !!}
    </div>
  </div>
  
  <div class="form-group col-sm-12">
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
          'id'=>'pac_telefono']
      ) !!}
    </div>
	</div>
	
	{{-- <div class="flex-row">
		<center>
			<button type="button" class="btn btn-sm btn-success col-4" id="guardarPaciente">Guardar</button>
		</center>
	</div> --}}
</div>
