@if ($tercero!=null)
<div class="flex-row">
  <center>
    <h5>
      <a href="{{asset('/reactivos')}}" class="text-danger">
        Reactivos
      </a>
    </h5>
  </center>
</div>

<div class="flex-row border border-danger"></div>

<div class="flex-row">
  <table class="table table-striped table-sm">
    <tbody>
      @foreach ($tercero as $reactivo)
        <tr>
          <td>
            <i class="fas fa-arrow-circle-down text-danger" title="Por agotarse"></i> &nbsp;
            {{$reactivo->nombre}}
          </td>
          <td class="w-50">
              <span class="badge border-danger border text-danger float-right col-6">
                {{$reactivo->contenidoPorEnvase}} en existencias
              </span>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endif

@php
$date = \Carbon\Carbon::now()->format('Y-m-d 24:59:59');
@endphp
<div class="flex-row">

  <table class="table table-striped table-sm">
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
            <td class="w-50">
              <i class="far fa-calendar text-warning" title="Por vencer"></i> &nbsp;
              {{$aVencer->nombre}}
            </td>
            <td>
                <span class="badge border border-warning text-warning col-6 float-right">
                  {{$porciones[0]}} {{$porciones[1]}} restante
                </span>
            </td>
          </tr>
        @endif
        @endif
        @if($porciones[2]=="antes")
          @if($porciones[1]=="segundo")
            <tr>
              <td class="w-50">
                <i class="far fa-calendar text-danger" title="Por vencer"></i> &nbsp;
                {{$aVencer->nombre}}
              </td>
              <td>
                  <span class="badge border border-danger text-danger col-6 float-right">
                    Vence Hoy
                  </span>
              </td>
            </tr>
          @endif
          @if($porciones[1]!="segundo")
          <tr>
            <td class="w-50">
              <i class="far fa-calendar-times text-danger" title="Por vencer"></i> &nbsp;
              {{$aVencer->nombre}}
            </td>
            <td>
                <span class="badge border border-danger text-danger col-6 float-right">
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
</div>
