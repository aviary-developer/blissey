<center>
  <p>Si no desea aplicar un filtro a un campo, dejelo vacio</p>
</center>
<br />
<div class="form-group col-sm-6 col-xs-12">
  <label class="control-label col-sm-3 col-xs-3">Nombre</label>
  <div class="col-sm-9 col-xs-12">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('nombre',null,['id'=>'nombre','placeholder'=>'Buscar por nombre','class'=>'form-control has-feedback-left']) !!}
  </div>
</div>
<div class="form-group col-sm-6 col-xs-12">
  <label class="control-label col-sm-3 col-xs-3">Apellido</label>
  <div class="col-sm-9 col-xs-12">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('apellido',null,['id'=>'apellido','placeholder'=>'Buscar por apellido','class'=>'form-control has-feedback-left']) !!}
  </div>
</div>
<div class="form-group col-sm-6 col-xs-12">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo </label>
  <label>
    {!!Form :: radio ( "sexo",2,true,['id'=>'sexo1','class'=>'flat'])!!} Ambos
  </label>
  &nbsp;
  <label>
    {!!Form :: radio ( "sexo",1,false,['id'=>'sexo2','class'=>'flat'])!!} Masculino
  </label>
  &nbsp;
  <label>
    {!!Form :: radio ( "sexo",0,false,['id'=>'sexo3','class'=>'flat'])!!} Femenino
  </label>
</div>
<div class="form-group col-sm-6 col-xs-12">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('telefono',null,['id'=>'telefono','class'=>'form-control has-feedback-left','placeholder'=>'Ej. 7000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
  </div>
</div>
<div class="form-group col-sm-6 col-xs-12">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('dui',null,['id'=>'dui','class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
  </div>
</div>
<div class="form-group col-sm-6 col-xs-12">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección</label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
    {!! Form::textarea('direccion',null,['id'=>'direccion','class'=>'form-control has-feedback-left','placeholder'=>'Buscar por dirección','rows'=>'3']) !!}
  </div>
</div>
<div class="form-group col-sm-12 col-xs-12">
  <label class="control-label col-md-1 col-sm-1 col-xs-12">Edad</label>
  <div class="col-md-11 col-sm-11 col-xs-12 grid_slider" >
    <input type="text" id="range_paciente_edad" name="edad"/>
  </div>
</div>
<input type="hidden" id="from" value={{$fin}}>
<input type="hidden" id="to" value={{$inicio}}>
