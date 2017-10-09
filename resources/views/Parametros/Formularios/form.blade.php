<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-pencil-square-o form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombreParametro',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo parametro']) !!}
    </div>
  </div>
  <div class="form-group" id="grupoUnidadParametro">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidad de medición</label>
    <div class="col-md-9 col-sm-9 col-xs-12" id="unidadParametro">
      <span class="fa fa-tasks form-control-feedback left" aria-hidden="true"></span>
        <select class="form-control has-feedback-left" name="unidad">
          @foreach ($unidades as $unidad)
            <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
          @endforeach
        </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor mínimo *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-arrow-circle-o-down form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('valorMinimo',null,['class'=>'form-control has-feedback-left','placeholder'=>'Valor mínimo','step'=>'any']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor máximo *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-arrow-circle-o-up form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('valorMaximo',null,['class'=>'form-control has-feedback-left','placeholder'=>'Valor máximo','step'=>'any']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor predeterminado</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-check-circle-o form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('valorPredeterminado',null,['class'=>'form-control has-feedback-left','placeholder'=>'Valor fijo','step'=>'any']) !!}
    </div>
  </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/reactivos') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
