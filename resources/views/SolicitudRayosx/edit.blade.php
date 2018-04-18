@extends('dashboard')
@section('layout')
    {!!Form::model($solicitud,['class' =>'form-horizontal form-label-left input_mask','route' =>['solicitudex.update',$solicitud->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = false;
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Edición de evaluación</h2>
        <div class="clearfix"></div>
        <h4>{{$solicitud->paciente->nombre." ".$solicitud->paciente->apellido}} <span class="label label-lg label-default">{{$solicitud->rayox->nombre}}</span></h4>
      </div>
      <div class="col-xs-12">
        <input type="hidden" name="solicitud" value={{$solicitud->id}}>
        <input type="hidden" name="evaluar" value=false>
        <input type="hidden" name="idRadiografia" value={{$solicitud->f_rayox}}>
        <div class="x_content">
          <div class="col-md-7 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-4 col-sm-4 col-xs-12">Ultrasonografía:</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-camera form-control-feedback left" aria-hidden="true"></span>
            {!! Form::file('rayox',['id'=>'idRadiografia','class'=>'form-control has-feedback-left']) !!}
          </div>
        </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12">Observaciones:</label>
              <div class="col-md-12 col-sm-9 col-xs-12">
                <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
                {!! Form::textarea('observacion',$resultado->observacion,['class'=>'form-control has-feedback-left','placeholder'=>'Escriba la observación','rows'=>'10', 'required']) !!}
              </div>
            </div>
        </div>
        <div class="col-md-5 col-xs-12">
          <div class="">
            <center>
              <output id="listRadiografia" style="height:400px">
                @if ($create)
                  <img src={{asset(Storage::url('noImgen.jpg'))}} style="height: 300px; width: 300px; object-fit: scale-down">
                @else
                  <img src={{asset(Storage::url($detallesResultado->rayox))}} style="height: 300px; width: 300px; object-fit: scale-down">
                @endif
              </output>
            </center>
          </div>
        </div>
        </div>
  </div>
  <div class="clearfix"></div>
  <center>
    {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
    <button type="reset" name="button" class="btn btn-default">Limpiar</button>
    <a href={!! asset('/solicitudex') !!} class="btn btn-default">Cancelar</a>
  </center>
</div>
  {!!Form::close()!!}
  <script>
  function radiografia(evt){
    var files = evt.target.files;

    for(var i = 0, f; f = files[i]; i++){
      if(!f.type.match('image.*')){
        continue;
      }

      var reader = new FileReader();

      reader.onload = (function(theFile){
        return function(e){
          document.getElementById('listRadiografia').innerHTML = ['<img style="height: 400px; width: 400px; object-fit: scale-down" src = "', e.target.result,'"/>'].join('');
        };
      })(f);
      reader.readAsDataURL(f);
    }
  }
  document.getElementById('idRadiografia').addEventListener('change', radiografia, false);
</script>
@endsection
