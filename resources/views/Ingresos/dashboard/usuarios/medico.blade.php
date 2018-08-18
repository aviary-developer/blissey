@if ($ingreso->tipo < 3 && $ingreso->estado == 0)
  <div class="row">
    <center>
      El paciente aún no ha firmado el acta de consentimiento
    </center>
  </div>
@else
  <div class="row">
    <div class="col-xs-6">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.consulta_m')
      </div>
    </div>
    <div class="col-xs-6">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.historial_m')
        @include('Ingresos.dashboard.partes.ver_consulta')
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-4">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.signos_r')
      </div>
    </div>
    <div class="col-xs-4">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.producto_r')
      </div>
    </div>
    <div class="col-xs-4">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.laboratorio_r')
      </div>
    </div>
  </div>
  <div class="row" style="margin-bottom: 30px">
    <div class="col-xs-4">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.rayos_x_r')
      </div>
    </div>
    <div class="col-xs-4">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.ultra_r')
      </div>
    </div>
    <div class="col-xs-4">
      <div class="x_panel">
        TAC
      </div>
    </div>
  </div>
@endif