@if (isset($estante)){{--Si se esta editando --}}
  @php $opcion = ($estante->localizacion) ? '1' : '0'; @endphp {{--1 para recepción y 0 para farmacia--}}
@else{{--Si se esta creando--}}
  @php $opcion=null;@endphp
@endif
<div class="x_panel">
<div class="x_content">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Localizacón *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      @php
      if(Auth::user()->administrador){
        $opciones=['0'=> 'Farmacia','1'=> 'Recepción'];
      }elseif(Auth::user()->tipoUsuario=='Farmacia'){
        $opciones=['0'=> 'Farmacia'];
      }elseif(Auth::user()->tipoUsuario=='Recepción'){
        $opciones=['1'=> 'Recepción'];
      }
      @endphp
        {!!Form::select('localizacion',$opciones,$opcion, ['class'=>'form-control has-feedback-left'])!!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Caja N° *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('numero',null,['class'=>'form-control has-feedback-left','placeholder'=>'Número identidicador de la caja']) !!}
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
      <a href={!! asset('/cajas') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
</div>
