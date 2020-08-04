<div class="form-group col-sm-12">
  <label class="" for="peso">Peso</label> &nbsp; <small class="red">Obligatorio para IMC</small>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
    </div>
    {!! Form::number(
      'peso',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Peso',
      'min'=>'0.01',
      'step'=>'0.10',
      'id'=>'peso']
    ) !!}
    <select name="medida" id="medida" class="form-control form-control-sm">
      <option value="0">Libras</option>
      <option value="1">Kilogramos</option>
    </select>
  </div>
</div>

<div class="form-group col-sm-12">
  <label class="" for="altura">Estatura (cm)</label>  &nbsp; <small class="red">Obligatorio para IMC</small>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
    </div>
    {!! Form::number(
      'altura',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Estatura en centimetros',
      'min'=>'1',
      'step'=>'1',
      'id'=>'altura']
    ) !!}
  </div>
</div>

<div class="form-group col-sm-12">
  <label class="" for="temperatura">Temperatura (°C)</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
    </div>
    {!! Form::number(
      'temperatura',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Temperatura en grados Celsius',
      'min'=>'0.0',
      'step'=>'0.1',
      'id'=>'temperatura']
    ) !!}
  </div>
</div>

<div class="form-group col-sm-12">
  <label class="" for="peso">Presion Arterial (°Hg)</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
    </div>
    {!! Form::number(
      'sistole',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Sístole en °Hg',
      'min'=>'0.01',
      'step'=>'0.10',
      'id'=>'sistole']
    ) !!}
    {!! Form::number(
      'diastole',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Díastole en °Hg',
      'min'=>'0.01',
      'step'=>'0.10',
      'id'=>'diastole']
    ) !!}
  </div>
</div>

<div class="form-group col-sm-12">
  <label class="" for="pulso">Pulso (lpm)</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
    </div>
    {!! Form::number(
      'pulso',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Pulso en latidos por minuto',
      'min'=>'0',
      'step'=>'1',
      'id'=>'pulso']
    ) !!}
  </div>
</div>

<div class="form-group col-sm-12">
  <label class="" for="glucosa">Glucosa (mg / dl)</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
    </div>
    {!! Form::number(
      'glucosa',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Glucosa en miligramos por decilitro',
      'min'=>'0.0',
      'step'=>'0.1',
      'id'=>'glucosa']
    ) !!}
  </div>
</div>

<div class="form-group col-sm-12">
  <label class="" for="frecuencia_cardiaca">Frecuencia Cardiaca (lpm)</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
    </div>
    {!! Form::number(
      'frecuencia_cardiaca',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Frecuencia Cardiaca en latidos por minuto',
      'min'=>'0',
      'step'=>'1',
      'id'=>'frecuencia_cardiaca']
    ) !!}
  </div>
</div>

<div class="form-group col-sm-12">
  <label class="" for="frecuencia_respiratoria">Frecuencia Respiratoria (rpm)</label>
  <div class="input-group mb-2 mr-sm-2">
    <div class="input-group-prepend">
      <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
    </div>
    {!! Form::number(
      'frecuencia_respiratoria',
      null,
      ['class'=>'form-control form-control-sm',
      'placeholder'=>'Frecuencia Respiratoria en respiración por minuto',
      'min'=>'0',
      'step'=>'1',
      'id'=>'frecuencia_respiratoria']
    ) !!}
  </div>
</div>

