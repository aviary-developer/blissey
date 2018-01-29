<div class="x_content">
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo paciente']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('apellido',null,['class'=>'form-control has-feedback-left','placeholder'=>'Apellido del nuevo paciente']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo *</label>
    &nbsp;&nbsp;&nbsp;
    <div id="radioBtn" class="btn-group">
      <a class="btn btn-primary btn-sm active" data-toggle="sexo" data-title="1">Masculino</a>
      <a class="btn btn-primary btn-sm notActive" data-toggle="sexo" data-title="0">Femenino</a>
    </div>
    <input type="hidden" name="sexo" id="sexo" value="1">
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de nacimiento *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
      @php
        $ahora = Carbon\Carbon::now();
      @endphp
      {!! Form::date('fechaNacimiento',$fecha,['id'=>'fecha_paciente','max'=>$ahora->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
    </div>
  </div>
  <div class="form-group" id="dui_paciente" style="display: none;">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('dui',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('telefono',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 7000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
      {!! Form::textarea('direccion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección del nuevo paciente','rows'=>'3']) !!}
    </div>
  </div>
  <center>
    <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/pacientes') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
