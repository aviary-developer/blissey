<div class="x_content">
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Número *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('numero',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número de la nueva habitación']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio ($)*</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('precio',null,['class'=>'form-control has-feedback-left','placeholder'=>'Precio de la habitacion','step'=>'0.01']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3 col-xs-12">Área *</label>
    &nbsp;&nbsp;&nbsp;
    @if (isset($habitaciones))
      @if ($habitaciones->tipo)
        <div id="radioBtn" class="btn-group">
          <a class="btn btn-primary btn-sm active" data-toggle="tipo" data-title="1">Hospital</a>
          <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="0">Observación</a>
        </div>
        <input type="hidden" name="tipo" id="tipo" value="1">  
      @else
        <div id="radioBtn" class="btn-group">
          <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="1">Hospital</a>
          <a class="btn btn-primary btn-sm active" data-toggle="tipo" data-title="0">Observación</a>
        </div>
        <input type="hidden" name="tipo" id="tipo" value="0">
      @endif
    @else    
      <div id="radioBtn" class="btn-group">
        <a class="btn btn-primary btn-sm active" data-toggle="tipo" data-title="1">Hospital</a>
        <a class="btn btn-primary btn-sm notActive" data-toggle="tipo" data-title="0">Observación</a>
      </div>
      <input type="hidden" name="tipo" id="tipo" value="1">
    @endif
  </div>
  <center>
    <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-light">Limpiar</button>
      <a href={!! asset($ruta) !!} class="btn btn-light">Cancelar</a>
    </center>
  </div>
</div>
