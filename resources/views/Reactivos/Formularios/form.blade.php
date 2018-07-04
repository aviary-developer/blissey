<div class="x_content">
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-flask form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo reactivo','required']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-edit form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('descripcion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Descripción del nuevo reactivo','required']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Contenido por envase</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('contenidoPorEnvase',null,['min'=>0,'class'=>'form-control has-feedback-left','placeholder'=>'Contenido en unidades','required']) !!}
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
      <a href={!! asset('/reactivos') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
