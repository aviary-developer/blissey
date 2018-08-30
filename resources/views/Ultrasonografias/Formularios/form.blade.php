<div class="x_content">
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','required','placeholder'=>'Nombre de nueva ultrasonografía']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Precio ($)*</label>
    <div class="col-md-4 col-sm-4 col-xs-12">
      <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('precio',null,['id'=>'precio_campo','class'=>'form-control has-feedback-left','placeholder'=>'Precio','step'=>'0.01']) !!}
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
      <a href={!! asset('/ultrasonografias') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
