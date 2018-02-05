<div class="x_content">
  <div class="col-md-6 col-xs-12">
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
        {!! Form::file('pruebaCruzada',['id'=>'pruebaCruzada','class'=>'form-control has-feedback-left']) !!}
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
<div class="col-md-6 col-xs-12">
  <div class="">
    <center>
      <output id="listPC" style="height:400px">
        @if ($create)
          <img src={{asset(Storage::url('noImgen.jpg'))}} style="height : 400px">
        @else
          <img src={{asset(Storage::url($donacion->pruebaCruzada))}} style="height : 400px">
        @endif
      </output>
    </center>
  </div>
</div>
</div>
<script>
function pruebaCruzada(evt){
  var files = evt.target.files;

  for(var i = 0, f; f = files[i]; i++){
    if(!f.type.match('image.*')){
      continue;
    }

    var reader = new FileReader();

    reader.onload = (function(theFile){
      return function(e){
        document.getElementById('listPC').innerHTML = ['<img style="height: 400px" src = "', e.target.result,'"/>'].join('');
      };
    })(f);
    reader.readAsDataURL(f);
  }
}
document.getElementById('pruebaCruzada').addEventListener('change', pruebaCruzada, false);
</script>
