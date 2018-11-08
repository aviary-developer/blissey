@if (isset($estante)){{--Si se esta editando --}}
  @php $opcion = ($estante->localizacion) ? '1' : '0'; @endphp {{--1 para recepción y 0 para farmacia--}}
@else{{--Si se esta creando--}}
  @php $opcion=null;@endphp
@endif
@php
if(Auth::user()->tipoUsuario=='Farmacia'){
  $opciones=['0'=> 'Farmacia'];
}elseif(Auth::user()->tipoUsuario=='Recepción'){
  $opciones=['1'=> 'Recepción'];
}
if(isset($estante)){
  $num=$estante->codigo;
}else{
  $num=App\Estante::correlativo();
}
@endphp
<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="x_panel">
  <div class="form-group">
    <label class="" for="nombre">Localización *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
      </div>
      {!!Form::select('localizacion',$opciones,null, ['class'=>'form-control form-control-sm'])!!}
    </div>
  </div>

  <div class="form-group">
    <label class="" for="nombre">Código identificador *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
      </div>
      {!! Form::number('codigo',$num,['class'=>'form-control form-control-sm','readonly'=>'readonly']) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="" for="nombre">Número de niveles *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-list-alt"></i></div>
      </div>
      {!!Form::selectRange('cantidad', 1, 9,null,['class'=>'form-control form-control-sm'])!!}
    </div>
  </div>

</div>
<div class="x_panel">
  <center>
    {!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset('/estantes') !!} class="btn btn-light btn-sm">Cancelar</a>
  </center>
</div>
