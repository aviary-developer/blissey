<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br/>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Drogería *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-industry form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo proveedor']) !!}
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
<!-- Campos que se agregarán en tabla dependientes-->
<center>
<p>Datos del visitador.</p>
</center>
<div class="form-group"><!-- Temporal visitador nombre-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tvn',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo visitador','id'=>'tvn']) !!}
  </div>
</div>
<div class="form-group"><!-- Temporal visitador apellido-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tva',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo visitador','id'=>'tva']) !!}
  </div>
</div>
<div class="form-group"><!-- Temporal visitador teléfono-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tvt',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo visitador','id'=>'tvt']) !!}
  </div>
</div>
<center>
<input name="agregarVis" id="agregarVis" type="button" value="Agregar" onClick="agregarVisitador()" class="btn btn-primary"/>
</center>
</div>
