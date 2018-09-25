@if ($tercero!=null)
<div>
  <h4>
    <a href="{{asset('/reactivos')}}">
      Reactivos por agotarse
    </a>
  </h4>
</div>
<div class="clearfix"></div>
<table class="table">
  <tbody>
      @foreach ($tercero as $reactivo)
        <tr>
          <td>{{$reactivo->nombre}}</td>
          <td>
              <span class="label label-danger col-xs-10 label-lg">
                {{$reactivo->contenidoPorEnvase}} en existencias
              </span>
          </td>
        </tr>
      @endforeach
  </tbody>
</table>
@endif
<div>
  <h4>
    <a href="{{asset('/reactivos')}}">
      Reactivos por vencer
    </a>
  </h4>
</div>
<div class="clearfix"></div>
@php
$date = \Carbon\Carbon::now()->format('Y-m-d 24:59:59');
@endphp
<table class="table">
  <tbody>
    @if ($proximosReactivosVencer!=null)
      @foreach ($proximosReactivosVencer as $aVencer)
        @php
        $aVencer->fechaVencimiento=$aVencer->fechaVencimiento."24:59:59";
        $fecha=\Carbon\Carbon::parse($aVencer->fechaVencimiento);
        $diasRestantes=($fecha->diffForHumans($date));
        $porciones = explode(" ",$diasRestantes);
      @endphp
        @if($porciones[1]=="días" || $porciones[1]=="día")
          @if($porciones[2]=="después")
        <tr>
          <td>{{$aVencer->nombre}}</td>
          <td>
              <span class="label label-warning col-xs-10 label-lg">
                {{$porciones[0]}} {{$porciones[1]}} restante
              </span>
          </td>
        </tr>
      @endif
      @endif
      @if($porciones[2]=="antes")
        @if($porciones[1]=="segundo")
          <tr>
            <td>{{$aVencer->nombre}}</td>
            <td>
                <span class="label label-danger col-xs-10 label-lg">
                  Vence Hoy
                </span>
            </td>
          </tr>
        @endif
        @if($porciones[1]!="segundo")
        <tr>
          <td>{{$aVencer->nombre}}</td>
          <td>
              <span class="label label-danger col-xs-10 label-lg">
                Hace {{$porciones[0]}} {{$porciones[1]}} vencido
              </span>
          </td>
        </tr>
        @endif
      @endif
      @endforeach
    @endif
  </tbody>
</table>
