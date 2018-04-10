<div class="form-group col-xs-12">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">Peso</label>
  <div class="col-md-4 col-sm-4 col-xs-6">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('peso',null,['class'=>'form-control has-feedback-left','placeholder'=>'Peso','min'=>'0.01','step'=>'0.10','id'=>'peso']) !!}
  </div>
  <div class="col-md-4 col-sm-4 col-xs-6">
    <select name="medida" id="medida" class="form-control">
      <option value="true">Kilogramos</option>
      <option value="false">Libras</option>
    </select>
  </div>
</div>
<div class="form-group col-xs-12">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">Altura (cm)</label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('altura',null,['class'=>'form-control has-feedback-left','placeholder'=>'Altura en centimetros','min'=>'1','step'=>'1','id'=>'altura']) !!}
  </div>
</div>
<div class="form-group col-xs-12">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">Presión Arterial (°Hg)</label>
  <div class="col-md-4 col-sm-4 col-xs-6">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('sistole',null,['class'=>'form-control has-feedback-left','placeholder'=>'Sístole','min'=>'0','step'=>'1','id'=>'sistole']) !!}
  </div>
  <div class="col-md-4 col-sm-4 col-xs-6">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('diastole',null,['class'=>'form-control has-feedback-left','placeholder'=>'Díastole','min'=>'0','step'=>'1','id'=>'diastole']) !!}
  </div>
</div>
<div class="form-group col-xs-12">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">Temperatura (°C)</label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('temperatura',null,['class'=>'form-control has-feedback-left','placeholder'=>'Temperatura en grados Celsius','min'=>'0.0','step'=>'0.1','id'=>'temperatura']) !!}
  </div>
</div>
<div class="form-group col-xs-12">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">Pulso (lpm)</label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('pulso',null,['class'=>'form-control has-feedback-left','placeholder'=>'Presión en latidos por minuto','min'=>'0','step'=>'1','id'=>'pulso']) !!}
  </div>
</div>
<div class="form-group col-xs-12">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">Glucosa (mg / dl)</label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('glucosa',null,['class'=>'form-control has-feedback-left','placeholder'=>'Glucosa en miligramo por decilitro','min'=>'0.0','step'=>'0.1','id'=>'glucosa']) !!}
  </div>
</div>
<div class="form-group col-xs-12">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">Frecuencia Cardiaca (lpm)</label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('frecuencia_cardiaca',null,['class'=>'form-control has-feedback-left','placeholder'=>'Frecuencia cardiaca en latidos por minuto','min'=>'0','step'=>'1','id'=>'frecuencia_cardiaca']) !!}
  </div>
</div>
<div class="form-group col-xs-12">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">Frecuencia Respiratoria (rpm)</label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
    {!! Form::number('frecuencia_respiratoria',null,['class'=>'form-control has-feedback-left','placeholder'=>'Frecuencia respiratoria en respiración por minuto','min'=>'0','step'=>'1','id'=>'frecuencia_respiratoria']) !!}
  </div>
</div>
