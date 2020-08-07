<div class="row">
  <div class="col-xs-9">
    <h3>Signos Vitales	</h3>
  </div>
  <div class="col-xs-2 alignright">
    @if ($ingreso->estado != 2)
      <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_signos">
        <i class="fa fa-plus"></i> Nuevo
      </button>
    @endif
  </div>
</div>
<br>
<input type="hidden" id="signos_count" value={{count($ingreso->signos)}}>
@if ($ingreso->signos!=null)
  @foreach ($ingreso->signos as $k => $signo)
    <div class="row borde" style="border-radius: 3px; margin: 5px; paddign: 5px;">
      <div class="row bg-blue" style="margin: 5px;">
        <center>
          <h4><i class="fa fa-heartbeat"></i> {{$signo->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</h4>
        </center>
      </div>
      <div class="row" style="margin: 5px;">
        <div class="col-m-4 col-xs-4">
          Temperatura:
        </div>
        <div class="col-sm-2 col-xs-2">
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
        <div class="col-m-4 col-xs-4">
          Peso:
        </div>
        <div class="col-sm-2 col-xs-2">
          @if ($signo->peso == null)
            <span class="label label-lg label-gray col-xs-12">
              Vacio
            </span>
          @else
            <span class="label label-lg label-white col-xs-12">
              {{$signo->peso.(($signo->medida)?' Kg':' lb')}}
            </span>
          @endif
        </div>
        <div class="col-m-4 col-xs-4">
          Presión Arterial:
        </div>
        @php
          $edad = $ingreso->paciente->fechaNacimiento->age;
          $sistole = $signo->sistole;
          $diastole = $signo->diastole;
        @endphp
        <div class="col-sm-2 col-xs-2">
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
        <div class="col-m-4 col-xs-4">
          Pulso:
        </div>
        <div class="col-sm-2 col-xs-2">
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
        <div class="col-m-4 col-xs-4">
          Glucosa:
        </div>
        <div class="col-sm-2 col-xs-2">
          @if($signo->glucosa == null)
            <span class="label label-lg label-gray col-xs-12">
              Vacio
            </span>
          @elseif ($signo->glucosa >= 70 && $signo->glucosa <= 110)
            <span class="label label-lg label-success col-xs-12">
              {{$signo->glucosa.' mg / dl'}}
            </span>
          @else
            <span class="label label-lg label-danger col-xs-12">
              {{$signo->glucosa.' mg / dl'}}
            </span>
          @endif
        </div>
        <div class="col-m-4 col-xs-4">
          Altura:
        </div>
        <div class="col-sm-2 col-xs-2">
          @if ($signo->altura == null)
            <span class="label label-lg label-gray col-xs-12">
              Vacio
            </span>
          @else
            <span class="label label-lg label-white col-xs-12">
              {{$signo->altura.' cm'}}
            </span>
          @endif
        </div>  
        <div class="col-m-4 col-xs-4">
          Frecuencia Cardiaca:
        </div>
        <div class="col-sm-2 col-xs-2">
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
        <div class="col-m-4 col-xs-4">
          Frecuencia Respiratoria:
        </div>
        <div class="col-sm-2 col-xs-2">
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
        <div class="col-m-4 col-xs-4">
          Índice de Masa Corporal:
        </div>
        @php
          if($signo->altura!=null || $signo->peso != null){
          $peso = number_format($signo->peso * (($signo->medida) ? 1 : 0.453592),2,'.',',');
          $altura = number_format(($signo->altura / 100),2,'.',',');
          if($signo->altura==0.00){
              $imc=null;
          }else{
            $imc = number_format(($peso/($altura*$altura)) ,2,'.',',');
          }
        }else{
          $altura=null;
          $peso=null;
          $imc=null;
        }
          $nulo = ($signo->altura == null || $signo->peso == null)
        @endphp
        <div class="col-sm-2 col-xs-2">
          @if($nulo)
            <span class="label label-lg label-gray col-xs-12">
              Vacio
            </span>
          @elseif ($imc < 18.5)
            <span class="label label-lg label-warning col-xs-12">
              Bajo peso
            </span>
          @elseif($imc >= 18.5 && $imc < 25)
            <span class="label label-lg label-success col-xs-12">
              Peso normal
            </span>
          @elseif($imc >= 25 && $imc < 30)
            <span class="label label-lg label-warning col-xs-12">
              Sobrepeso
            </span>
          @elseif($imc >= 30 && $imc < 35)
            <span class="label label-lg label-danger col-xs-12">
              Obesidad I
            </span>
          @elseif($imc >= 35 && $imc < 40)
            <span class="label label-lg label-danger col-xs-12">
              Obesidad II
            </span>
          @elseif($imc >= 40 && $imc < 50)
            <span class="label label-lg label-danger col-xs-12">
              Obesidad III
            </span>
          @else
            <span class="label label-lg label-danger col-xs-12">
              Obesidad IV
            </span>
          @endif
        </div>
      </div>
      @if($ingreso->signos!=null)
        @if (count($ingreso->signos) > 1 && $k == 0)
          <div class="row" style="margin: 10px;">
            <center>
              <button type="button" id="evaluar_signo" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modal_signos_graficos">
                <i class="fa-bar-chart fa"></i> Evolución
              </button>
            </center>
          </div>
        @endif
      @endif
    </div>
  @endforeach
@else
  <div class="row" id="msj_signo">
    <p>No hay signos vitales asociados a este paciente</p>
  </div>
@endif