<div class="x_content">
  <center>
    <p>Los campos marcados con un * son de registro <b>obligatorio</b>.</p>
  </center>
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Area de examen</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
      <select class="form-control has-feedback-left" name="tipoSangre" id="" required>
      <option value="A+">A+</option>
      <option value="A-">A-</option>
      <option value="B+">B+</option>
      <option value="B-">B-</option>
      <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
      <option value="O+">O+</option>
      <option value="O-">O-</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Anticuerpos</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-check-circle-o form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('anticuerpos',null,['class'=>'form-control has-feedback-left','placeholder'=>'Describa anticuerpos']) !!}
    </div>
  </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Prueba cruzada</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-pencil form-control-feedback left" aria-hidden="true"></span>
        {!! Form::file('pruebaCruzada',['id'=>'','class'=>'form-control has-feedback-left']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de vencimiento</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
        @php
          $ahora = Carbon\Carbon::now();
        @endphp
        {!! Form::date('fechaVencimiento',$fecha,['id'=>'fecha_paciente','min'=>$ahora->addDay(1)->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
      </div>
    </div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/bancoSangre') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
