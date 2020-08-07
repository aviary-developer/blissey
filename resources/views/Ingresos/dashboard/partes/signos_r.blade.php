<div class="row">
  <div class="col-sm-8">
    <h5 class="text-danger">Signos Vitales</h5>
  </div>
  <div class="col-sm-4">
    <div class="btn-group alignright">
      @if ($ingreso->estado == 1 || ($ingreso->tipo == 3 && $ingreso->estado == 0))  
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#signo_m" ><i class="fa fa-plus"></i></button>
      @endif
      <button type="button" class="btn-sm btn btn-dark" data-toggle="modal" data-target="#ver_signo" id="evaluar_signo"><i class="fa fa-eye"></i></button>
    </div>
  </div>
</div>
@if ($detalle_sv != null )
  <input type="hidden" id="sid" value={{$detalle_sv[0]->id}}>
@endif
@if ($count_sv24 > 0)    
  @if (Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería")
    <div class="flex-row" style="height: 184px;">
  @else
    <div class="flex-row" style="height: 122px;">
  @endif
    @foreach($detalle_sv as $k => $signo)
      @php
        if($k != 0){
          break;
        }
      @endphp
      <div class="col-sm-7 col-sm-7 font-weight-bold">
        Temperatura:
      </div>
      <div class="col-sm-5 col-sm-5">
        @if ($signo->temperatura == null)
          <span class="font-sm mb-1 badge badge-secondary col-sm-12">
            Vacio
          </span>
        @elseif ($signo->temperatura > 37)
          <span class="font-sm mb-1 badge badge-danger col-sm-12">
            {{$signo->temperatura.' °C'}}
          </span>
        @else
          <span class="font-sm mb-1 badge badge-success col-sm-12">
            {{$signo->temperatura.' °C'}}
          </span>
        @endif
      </div>
      <div class="col-sm-7 col-sm-7 font-weight-bold">
        Presión Arterial:
      </div>
      @php
        $edad = $ingreso->hospitalizacion->paciente->fechaNacimiento->age;
        $sistole = $signo->sistole;
        $diastole = $signo->diastole;
      @endphp
      <div class="col-sm-5 col-sm-5">
        @if ($signo->sistole == null || $signo->diastole == null)
          <span class="font-sm mb-1 badge badge-secondary col-sm-12">
            Vacio
          </span>
        @elseif (
          ($ingreso->hospitalizacion->paciente->sexo && 
          ((($edad >= 16 && $edad <= 18) && ($sistole >= 105 && $sistole <= 135) && ($diastole >= 60 && $diastole <= 86)) ||
          (($edad >= 19 && $edad <= 24) && ($sistole >= 105 && $sistole <= 139) && ($diastole >= 62 && $diastole <= 88)) ||
          (($edad >= 25 && $edad <= 29) && ($sistole >= 108 && $sistole <= 139) && ($diastole >= 65 && $diastole <= 89)) ||
          (($edad >= 30 && $edad <= 39) && ($sistole >= 110 && $sistole <= 145) && ($diastole >= 68 && $diastole <= 92)) ||
          (($edad >= 40 && $edad <= 49) && ($sistole >= 110 && $sistole <= 150) && ($diastole >= 70 && $diastole <= 96)) ||
          (($edad >= 50 && $edad <= 59) && ($sistole >= 115 && $sistole <= 155) && ($diastole >= 70 && $diastole <= 98)) ||
          (($edad >= 60) && ($sistole >= 115 && $sistole <= 160) && ($diastole >= 70 && $diastole <= 100)) )) ||
          (!$ingreso->hospitalizacion->paciente->sexo && 
          ((($edad >= 16 && $edad <= 18) && ($sistole >= 100 && $sistole <= 130) && ($diastole >= 60 && $diastole <= 85)) ||
          (($edad >= 19 && $edad <= 24) && ($sistole >= 100 && $sistole <= 130) && ($diastole >= 60 && $diastole <= 85)) ||
          (($edad >= 25 && $edad <= 29) && ($sistole >= 102 && $sistole <= 135) && ($diastole >= 60 && $diastole <= 86)) ||
          (($edad >= 30 && $edad <= 39) && ($sistole >= 105 && $sistole <= 139) && ($diastole >= 65 && $diastole <= 89)) ||
          (($edad >= 40 && $edad <= 49) && ($sistole >= 105 && $sistole <= 150) && ($diastole >= 65 && $diastole <= 96)) ||
          (($edad >= 50 && $edad <= 59) && ($sistole >= 110 && $sistole <= 155) && ($diastole >= 70 && $diastole <= 98)) ||
          (($edad >= 60) && ($sistole >= 115 && $sistole <= 160) && ($diastole >= 70 && $diastole <= 100)) ))
          )
          <span class="font-sm mb-1 badge badge-success col-sm-12">
            {{$signo->sistole.' / '.$signo->diastole.' °Hg'}}
          </span>
        @elseif ($edad < 16)
          <span class="font-sm mb-1 badge badge-white col-sm-12">
            {{$signo->sistole.' / '.$signo->diastole.' °Hg'}}
          </span>
        @else
          <span class="font-sm mb-1 badge badge-danger col-sm-12">
            {{$signo->sistole.' / '.$signo->diastole.' °Hg'}}
          </span>
        @endif
      </div>
      <div class="col-sm-7 col-sm-7 font-weight-bold">
        Pulso:
      </div>
      <div class="col-sm-5 col-sm-5">
        @if($signo->pulso == null)
          <span class="font-sm mb-1 badge badge-secondary col-sm-12">
            Vacio
          </span>
        @elseif ($signo->pulso > 59 && $signo->pulso < 121)
          <span class="font-sm mb-1 badge badge-success col-sm-12">
            {{$signo->pulso.' lpm'}}
          </span>
        @else
          <span class="font-sm mb-1 badge badge-danger col-sm-12">
            {{$signo->pulso.' lpm'}}
          </span>
        @endif  
      </div>
      <div class="col-sm-7 col-sm-7 font-weight-bold">
        Frecuencia Cardiaca:
      </div>
      <div class="col-sm-5 col-sm-5">
        @if($signo->frecuencia_cardiaca == null)
          <span class="font-sm mb-1 badge badge-secondary col-sm-12">
            Vacio
          </span>
        @elseif ($signo->frecuencia_cardiaca > 59 && $signo->frecuencia_cardiaca < 101)
          <span class="font-sm mb-1 badge badge-success col-sm-12">
            {{$signo->frecuencia_cardiaca.' lpm'}}
          </span>
        @else
          <span class="font-sm mb-1 badge badge-danger col-sm-12">
            {{$signo->frecuencia_cardiaca.' lpm'}}
          </span>
        @endif
      </div>
      <div class="col-sm-7 col-sm-7 font-weight-bold">
        Frecuencia Respiratoria:
      </div>
      <div class="col-sm-5 col-sm-5">
        @if($signo->frecuencia_respiratoria == null)
          <span class="font-sm mb-1 badge badge-secondary col-sm-12">
            Vacio
          </span>
        @elseif ($signo->frecuencia_respiratoria > 11 && $signo->frecuencia_respiratoria < 21)
          <span class="font-sm mb-1 badge badge-success col-sm-12">
            {{$signo->frecuencia_respiratoria.' rpm'}}
          </span>
        @else
          <span class="font-sm mb-1 badge badge-danger col-sm-12">
            {{$signo->frecuencia_respiratoria.' rpm'}}
          </span>
        @endif
      </div>
      @if (Auth::user()->tipoUsuario == "Médico")
        <div class="col-sm-7 col-sm-7 font-weight-bold">
          Glucosa:
        </div>
        <div class="col-sm-5 col-sm-5">
          @if($signo->glucosa == null)
            <span class="font-sm mb-1 badge badge-secondary col-sm-12">
              Vacio
            </span>
          @elseif ($signo->glucosa >= 70 && $signo->glucosa <= 110)
            <span class="font-sm mb-1 badge badge-success col-sm-12">
              {{$signo->glucosa.' mg / dl'}}
            </span>
          @else
            <span class="font-sm mb-1 badge badge-danger col-sm-12">
              {{$signo->glucosa.' mg / dl'}}
            </span>
          @endif
        </div>
        <div class="col-sm-7 col-sm-7 font-weight-bold">
          Peso:
        </div>
        <div class="col-sm-5 col-sm-5">
          @if ($signo->peso == null)
            <span class="font-sm mb-1 badge badge-secondary col-sm-12">
              Vacio
            </span>
          @else
            <span class="font-sm mb-1 badge badge-white col-sm-12">
              {{$signo->peso.(($signo->medida)?' Kg':' lb')}}
            </span>
          @endif
        </div>
        <div class="col-sm-7 col-sm-7 font-weight-bold">
          Altura:
        </div>
        <div class="col-sm-5 col-sm-5">
          @if ($signo->altura == null)
            <span class="font-sm mb-1 badge badge-secondary col-sm-12">
              Vacio
            </span>
          @else
            <span class="font-sm mb-1 badge badge-white col-sm-12">
              {{$signo->altura.' cm'}}
            </span>
          @endif
        </div>
        <div class="col-sm-7 col-sm-7 font-weight-bold">
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
        <div class="col-sm-5 col-sm-5">
          @if($nulo)
            <span class="font-sm mb-1 badge badge-secondary col-sm-12">
              Vacio
            </span>
          @elseif ($imc < 18.5)
            <span class="font-sm mb-1 badge badge-warning col-sm-12">
              Bajo peso
            </span>
          @elseif($imc >= 18.5 && $imc < 25)
            <span class="font-sm mb-1 badge badge-success col-sm-12">
              Peso normal
            </span>
          @elseif($imc >= 25 && $imc < 30)
            <span class="font-sm mb-1 badge badge-warning col-sm-12">
              Sobrepeso
            </span>
          @elseif($imc >= 30 && $imc < 35)
            <span class="font-sm mb-1 badge badge-danger col-sm-12">
              Obesidad I
            </span>
          @elseif($imc >= 35 && $imc < 40)
            <span class="font-sm mb-1 badge badge-danger col-sm-12">
              Obesidad II
            </span>
          @elseif($imc >= 40 && $imc < 50)
            <span class="font-sm mb-1 badge badge-danger col-sm-12">
              Obesidad III
            </span>
          @else
            <span class="font-sm mb-1 badge badge-danger col-sm-12">
              Obesidad IV
            </span>
          @endif
        </div> 
      @endif
    @endforeach
  </div>
@else
  @if (Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Enfermería")
    <div class="flex-row" style="height: 184px; padding: 20px">
  @else
    <div class="flex-row" style="height: 122px; padding: 10px">
  @endif
    <center>
      <h4 class="gray">Información</h4>
    </center>
    <center>
      <span>No se ha registrado ningún signo vital al paciente en las últimas 24 horas</span>
    </center>
  </div>
@endif
@include('Ingresos.dashboard.modales.signos')
@include('Ingresos.dashboard.modales.ver_signos')