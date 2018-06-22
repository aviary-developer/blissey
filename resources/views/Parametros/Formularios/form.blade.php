<div class="x_content">
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombreParametro',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo parametro','required']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
    <div class="col-md-9 col-sm-9 col-xs-12">
  <div class="">
    <label>
      <input type="checkbox"name="checkValores" id="checkValores" class="js-switch" unchecked /> Valores Normales
    </label>
  </div>
  </div>
  </div>
  <div id="divValoresNormales" style="display:none;">
  <div class="form-group" id="grupoUnidadParametro">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidad de medición</label>
    <div class="col-md-9 col-sm-9 col-xs-12" id="unidadParametro">
      <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
        <select class="form-control has-feedback-left" id="selectUnidadParametro" name="unidad" required disabled>
          <option value=""></option>
          @foreach ($unidades as $unidad)
            <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
          @endforeach
        </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-md-2 col-sm-2 col-xs-2">
    </div>
    <span class="label-lg label label-cian col-xs-4">Masculino</span>
    <div class="col-md-2 col-sm-2 col-xs-2">
    </div>
    <span class="label-lg label label-pink col-xs-4">Femenino</span>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Mínimo</label>
    <div class="col-md-3 col-sm-3 col-xs-12">
      <span class="fa fa-arrow-circle-o-down form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('valorMinimo',null,['id'=>'valorMinimo','class'=>'form-control has-feedback-left','placeholder'=>'0','step'=>'any','readonly']) !!}
    </div>
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Mínimo</label>
    <div class="col-md-3 col-sm-3 col-xs-12">
      <span class="fa fa-arrow-circle-o-down form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('valorMinimoFemenino',null,['id'=>'valorMinimoFemenino','class'=>'form-control has-feedback-left','placeholder'=>'0','step'=>'any','readonly']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Máximo</label>
    <div class="col-md-3 col-sm-3 col-xs-12">
      <span class="fa fa-arrow-circle-o-up form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('valorMaximo',null,['id'=>'valorMaximo','class'=>'form-control has-feedback-left','placeholder'=>'0','step'=>'any','readonly']) !!}
    </div>
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Máximo</label>
    <div class="col-md-3 col-sm-3 col-xs-12">
      <span class="fa fa-arrow-circle-o-up form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('valorMaximoFemenino',null,['id'=>'valorMaximoFemenino','class'=>'form-control has-feedback-left','placeholder'=>'0','step'=>'any','readonly']) !!}
    </div>
  </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor predeterminado</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-check-circle-o form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('valorPredeterminado',null,['class'=>'form-control has-feedback-left','placeholder'=>'']) !!}
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
      <a href={!! asset('/parametros') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
