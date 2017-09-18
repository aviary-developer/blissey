<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br/>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Drogería *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-industry form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombreD',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo proveedor']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-at form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('correo',null,['class'=>'form-control has-feedback-left','placeholder'=>'Correo electrónico del nuevo proveedor']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('telefono',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número telefónico del nuevo proveedor']) !!}
    </div>
  </div>
  <div id='otroProv'><!-- div en el aparecen los inputs para los nuevos visitadores-->

  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Agregar otro visitador</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-at form-control-feedback left" aria-hidden="true"></span>
      <a href="#" onclick="otroProveedor();" class="form-control has-feedback-left">Otro<a/>
    </div>
  </div>
</div>
