<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombreExamen',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo examen']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de muestra *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
      <select class="form-control has-feedback-left" name="tipoMuestra" id="tipoUsuario">
        <option value="Sangre">Sangre</option>
        <option value="Heces">Heces</option>
        <option value="Orina">Orina</option>
        <option value="Secreción">Secreción</option>
      </select>
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
