<div class="row">
  <div class="col-xs-8">
    <h5 class="big-text">Signos Vitales</h5>
  </div>
  <div class="col-xs-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1)  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#signo_m" ><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_signo" id="evaluar_signo"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
@if ($count_sv24 > 0)    
  <div class="row" style="height: 100px;">
    @foreach($detalle_sv as $k => $signo)
      @php
        if($k != 0){
          break;
        }
      @endphp
      <input type="hidden" id="sid" value={{$signo->id}}>
      <div class="col-sm-7 col-xs-7">
        Temperatura:
      </div>
      <div class="col-sm-5 col-xs-5">
        @if ($signo->temperatura == null)
          <span class="label label-lg label-gray col-xs-12">
            Vacio
          </span>
        @elseif ($signo->temperatura > 37)
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->temperatura.' °C'}}
          </span>
        @else
          <span class="label label-lg label-success col-xs-12">
            {{$signo->temperatura.' °C'}}
          </span>
        @endif
      </div>
      <div class="col-sm-7 col-xs-7">
        Presión Arterial:
      </div>
      @php
        $edad = $ingreso->paciente->fechaNacimiento->age;
        $sistole = $signo->sistole;
        $diastole = $signo->diastole;
      @endphp
      <div class="col-sm-5 col-xs-5">
        @if ($signo->sistole == null || $signo->diastole == null)
          <span class="label label-lg label-gray col-xs-12">
            Vacio
          </span>
        @elseif (
          ($ingreso->paciente->sexo && 
          ((($edad >= 16 && $edad <= 18) && ($sistole >= 105 && $sistole <= 135) && ($diastole >= 60 && $diastole <= 86)) ||
          (($edad >= 19 && $edad <= 24) && ($sistole >= 105 && $sistole <= 139) && ($diastole >= 62 && $diastole <= 88)) ||
          (($edad >= 25 && $edad <= 29) && ($sistole >= 108 && $sistole <= 139) && ($diastole >= 65 && $diastole <= 89)) ||
          (($edad >= 30 && $edad <= 39) && ($sistole >= 110 && $sistole <= 145) && ($diastole >= 68 && $diastole <= 92)) ||
          (($edad >= 40 && $edad <= 49) && ($sistole >= 110 && $sistole <= 150) && ($diastole >= 70 && $diastole <= 96)) ||
          (($edad >= 50 && $edad <= 59) && ($sistole >= 115 && $sistole <= 155) && ($diastole >= 70 && $diastole <= 98)) ||
          (($edad >= 60) && ($sistole >= 115 && $sistole <= 160) && ($diastole >= 70 && $diastole <= 100)) )) ||
          (!$ingreso->paciente->sexo && 
          ((($edad >= 16 && $edad <= 18) && ($sistole >= 100 && $sistole <= 130) && ($diastole >= 60 && $diastole <= 85)) ||
          (($edad >= 19 && $edad <= 24) && ($sistole >= 100 && $sistole <= 130) && ($diastole >= 60 && $diastole <= 85)) ||
          (($edad >= 25 && $edad <= 29) && ($sistole >= 102 && $sistole <= 135) && ($diastole >= 60 && $diastole <= 86)) ||
          (($edad >= 30 && $edad <= 39) && ($sistole >= 105 && $sistole <= 139) && ($diastole >= 65 && $diastole <= 89)) ||
          (($edad >= 40 && $edad <= 49) && ($sistole >= 105 && $sistole <= 150) && ($diastole >= 65 && $diastole <= 96)) ||
          (($edad >= 50 && $edad <= 59) && ($sistole >= 110 && $sistole <= 155) && ($diastole >= 70 && $diastole <= 98)) ||
          (($edad >= 60) && ($sistole >= 115 && $sistole <= 160) && ($diastole >= 70 && $diastole <= 100)) ))
          )
          <span class="label label-lg label-success col-xs-12">
            {{$signo->sistole.' / '.$signo->diastole.' °Hg'}}
          </span>
        @elseif ($edad < 16)
          <span class="label label-lg label-white col-xs-12">
            {{$signo->sistole.' / '.$signo->diastole.' °Hg'}}
          </span>
        @else
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->sistole.' / '.$signo->diastole.' °Hg'}}
          </span>
        @endif
      </div>
      <div class="col-sm-7 col-xs-7">
        Pulso:
      </div>
      <div class="col-sm-5 col-xs-5">
        @if($signo->pulso == null)
          <span class="label label-lg label-gray col-xs-12">
            Vacio
          </span>
        @elseif ($signo->pulso > 59 && $signo->pulso < 121)
          <span class="label label-lg label-success col-xs-12">
            {{$signo->pulso.' lpm'}}
          </span>
        @else
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->pulso.' lpm'}}
          </span>
        @endif  
      </div>
      <div class="col-sm-7 col-xs-7">
        Frecuencia Cardiaca:
      </div>
      <div class="col-sm-5 col-xs-5">
        @if($signo->frecuencia_cardiaca == null)
          <span class="label label-lg label-gray col-xs-12">
            Vacio
          </span>
        @elseif ($signo->frecuencia_cardiaca > 59 && $signo->frecuencia_cardiaca < 101)
          <span class="label label-lg label-success col-xs-12">
            {{$signo->frecuencia_cardiaca.' lpm'}}
          </span>
        @else
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->frecuencia_cardiaca.' lpm'}}
          </span>
        @endif
      </div>
      <div class="col-sm-7 col-xs-7">
        Frecuencia Respiratoria:
      </div>
      <div class="col-sm-5 col-xs-5">
        @if($signo->frecuencia_respiratoria == null)
          <span class="label label-lg label-gray col-xs-12">
            Vacio
          </span>
        @elseif ($signo->frecuencia_respiratoria > 11 && $signo->frecuencia_respiratoria < 21)
          <span class="label label-lg label-success col-xs-12">
            {{$signo->frecuencia_respiratoria.' rpm'}}
          </span>
        @else
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->frecuencia_respiratoria.' rpm'}}
          </span>
        @endif
      </div>
    @endforeach
  </div>
@else
  <div class="row" style="height: 100px; padding: 10px">
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ningun signo vital al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.signos')
@include('Ingresos.dashboard.modales.ver_signos')