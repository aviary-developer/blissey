@php
if(Auth::user()->tipoUsuario=='Farmacia'){
  $opciones=['0'=> 'Farmacia'];
}elseif(Auth::user()->tipoUsuario=='Recepción'){
  $opciones=['1'=> 'Recepción'];
}
$num=App\Caja::correlativo();
@endphp
<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="x_panel">
  <div class="ln_solid mb-1 mt-1"></div>

  <div class="form-group">
    <label class="" for="localizacion">Localización *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-user"></i></div>
      </div>
      {!!Form::select('localizacion',$opciones,null, ['class'=>'form-control form-control-sm'])!!}
    </div>
  </div>

  <div class="form-group">
    <label class="" for="localizacion">Caja N° *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-user"></i></div>
      </div>
      {!! Form::number('nombre',$num,['class'=>'form-control form-control-sm','readonly'=>'readonly']) !!}
    </div>
  </div>

</div>
<div class="x_panel">
  <center>
    {!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset('/cajas') !!} class="btn btn-light btn-sm">Cancelar</a>
  </center>
</div>
