<center>
  <p>Si no desea aplicar un filtro a un campo, dejelo vacio</p>
  <p id="texto_usuario"></p>
</center>
<br>
<div class="form-group col-sm-6 col-xs-12">
  <label class="control-label col-sm-3 col-xs-3">Nombre</label>
  <div class="col-sm-9 col-xs-12">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('nombre',null,['id'=>'nombre_usuario_filtro','placeholder'=>'Buscar por nombre','class'=>'form-control has-feedback-left']) !!}
  </div>
</div>
<div class="form-group col-sm-6 col-xs-12">
  <label class="control-label col-sm-3 col-xs-3">Apellido</label>
  <div class="col-sm-9 col-xs-12">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
    {!! Form::text('apellido',null,['id'=>'apellido_usuario_filtro','placeholder'=>'Buscar por nombre','class'=>'form-control has-feedback-left']) !!}
  </div>
</div>