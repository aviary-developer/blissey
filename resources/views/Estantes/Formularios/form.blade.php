@if (isset($estante)){{--Si se esta editando --}}
  @php $opcion = ($estante->localizacion) ? '1' : '0'; @endphp {{--1 para recepción y 0 para farmacia--}}
@else{{--Si se esta creando--}}
  @php $opcion=null;@endphp
@endif
<div class="x_panel">
<div class="x_content">
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Localizacón *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      @php
      // if(Auth::user()->administrador){
      //   $opciones=['0'=> 'Farmacia','1'=> 'Recepción'];
      // }else
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
        {!!Form::select('localizacion',$opciones,null, ['class'=>'form-control has-feedback-left'])!!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Código identificador *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('codigo',$num,['class'=>'form-control has-feedback-left','readonly'=>'readonly']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Número de niveles *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      {!!Form::selectRange('cantidad', 1, 9,null,['class'=>'form-control has-feedback-left'])!!}
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
      <a href={!! asset('/estantes') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
</div>
