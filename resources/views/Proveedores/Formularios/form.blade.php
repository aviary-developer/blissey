
<div class="x_content">
  <h4>Datos del Proveedor</h4>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Drogería *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-industry form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo proveedor','id'=>'nombre']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Correo *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-at form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('correo',null,['class'=>'form-control has-feedback-left','placeholder'=>'Correo electrónico del nuevo proveedor','id'=>'correo']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('telefono',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número telefónico del nuevo proveedor','id'=>'telefono','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
    </div>
  </div>
<!-- Campos que se agregarán en tabla dependientes cuando se esta creando un nuevo proveedor-->
@if($bandera==1)
<h4>Datos del visitador</h4>
<div class="form-group"><!-- Temporal visitador nombre-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tvn',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo visitador','id'=>'tvn']) !!}
  </div>
</div>
<div class="form-group"><!-- Temporal visitador apellido-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tva',null,['class'=>'form-control has-feedback-left','placeholder'=>'Apellido del nuevo visitador','id'=>'tva']) !!}
  </div>
</div>
<div class="form-group"><!-- Temporal visitador teléfono-->
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono *</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('tvt',null,['class'=>'form-control has-feedback-left','placeholder'=>'Teléfono del nuevo visitador','id'=>'tvt','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
  </div>
</div>
<center>
  <button type="button" class="btn btn-sm btn-primary" onClick="agregarVisitador()" name="agregarVis" id="agregarVis">
    <i class="fa fa-plus"></i> Agregar Visitador
  </button>
</center>
</div>
@endif
