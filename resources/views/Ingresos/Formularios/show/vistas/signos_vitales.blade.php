<div class="row">
  <div class="col-xs-9">
    <h3>Signos Vitales	</h3>
  </div>
  <div class="col-xs-2 alignright">
    @if ($ingreso->estado != 2)
      <button type="button" name="button" class="btn btn-primary btn-sm alignright" data-toggle="modal" data-target="#modal_signos"
        <i class="fa fa-plus"></i> Nuevo
      </button>
    @endif
  </div>
</div>
<br>
<input type="hidden" id="signos_count" value={{count($ingreso->signos)}}>
@if (count($ingreso->signos) > 0)
  @foreach ($ingreso->signos as $signo)
      
  @endforeach
  <div class="row borde" style="border-radius: 3px; margin: 5px; paddign: 5px;">
    <div class="row bg-danger" style="margin: 5px;">
      <center>
        <h4><i class="fa fa-heartbeat"></i> {{$signo->created_at->formatLocalized('%d de %B de %Y a las %H:%M')}}</h4>
      </center>
    </div>
    <div class="row" style="margin: 5px;">
      <div class="col-sm-2 col-xs-4">
        Temperatura:
      </div>
      <div class="col-sm-2 col-xs-2">
        @if ($signo->temperatura > 37)
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->temperatura.' °C'}}
          </span>
        @else
          <span class="label label-lg label-success col-xs-12">
            {{$signo->temperatura.' °C'}}
          </span>
        @endif
      </div>
      <div class="col-sm-2 col-xs-4">
        Peso:
      </div>
      <div class="col-sm-2 col-xs-2">
        <span class="label label-lg label-white col-xs-12">
          {{$signo->peso.(($signo->medida)?' Kg':' lb')}}
        </span>
      </div>
      <div class="col-sm-2 col-xs-4">
        Presión Arterial:
      </div>
      <div class="col-sm-2 col-xs-2">
        {{$signo->sistole.' / '.$signo->diastole.' °Hg'}}
      </div>
    </div>
    <div class="row" style="margin: 5px">
      <div class="col-sm-2 col-xs-4">
        Pulso:
      </div>
      <div class="col-sm-2 col-xs-2">
        @if ($signo->pulso > 59 && $signo->pulso < 121)
          <span class="label label-lg label-success col-xs-12">
            {{$signo->pulso.' lpm'}}
          </span>
        @else
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->pulso.' lpm'}}
          </span>
        @endif  
      </div>
      <div class="col-sm-2 col-xs-4">
        Altura:
      </div>
      <div class="col-sm-2 col-xs-2">
        <span class="label label-lg label-white col-xs-12">
          {{$signo->altura.' cm'}}
        </span>
      </div>
      <div class="col-sm-2 col-xs-4">
        Frecuencia Cardiaca:
      </div>
      <div class="col-sm-2 col-xs-2">
        @if ($signo->frecuencia_cardiaca > 59 && $signo->frecuencia_cardiaca < 101)
          <span class="label label-lg label-success col-xs-12">
            {{$signo->frecuencia_cardiaca.' lpm'}}
          </span>
        @else
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->frecuencia_cardiaca.' lpm'}}
          </span>
        @endif
      </div>
    </div>
    <div class="row" style="margin: 5px">
      <div class="col-sm-2 col-xs-4">
        Frecuencia Respiratoria:
      </div>
      <div class="col-sm-2 col-xs-2">
        @if ($signo->frecuencia_respiratoria > 11 && $signo->frecuencia_respiratoria < 21)
          <span class="label label-lg label-success col-xs-12">
            {{$signo->frecuencia_respiratoria.' rpm'}}
          </span>
        @else
          <span class="label label-lg label-danger col-xs-12">
            {{$signo->frecuencia_respiratoria.' rpm'}}
          </span>
        @endif
      </div>
    </div>
  </div>
@else
  <div class="row" id="msj_signo">
    <p>No hay signos vitales asociados a este paciente</p>
  </div>
@endif