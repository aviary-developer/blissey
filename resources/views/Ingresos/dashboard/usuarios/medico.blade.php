@if ($ingreso->tipo < 3 && $ingreso->estado == 0)
  <div class="flex-row">
    <center>
      El paciente aún no ha firmado el acta de consentimiento
    </center>
  </div>
@else
  <div class="row">
    <div class="col-sm-6">
      <div class="x_panel border border-success rounded">
        @include('Ingresos.dashboard.partes.consulta_m')
      </div>
    </div>
    <div class="col-sm-6">
      <div class="x_panel border border-info rounded">
        @include('Ingresos.dashboard.partes.historial_m')
        @include('Ingresos.dashboard.partes.ver_consulta')
        @include('Ingresos.dashboard.partes.ver_ingresos')
        @include('Ingresos.dashboard.partes.acciones_ver_consulta')
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4">
      <div class="x_panel border border-danger rounded">
        @include('Ingresos.dashboard.partes.signos_r')
      </div>
    </div>
    <div class="col-sm-4">
      <div class="x_panel border border-primary rounded">
        @include('Ingresos.dashboard.partes.producto_r')
      </div>
    </div>
    <div class="col-sm-4">
      <div class="x_panel border border-purple rounded">
        @include('Ingresos.dashboard.partes.laboratorio_r')
      </div>
    </div>
  </div>
  <div class="row" style="margin-bottom: 30px">
    <div class="col-sm-4">
      <div class="x_panel border border-purple rounded">
        @include('Ingresos.dashboard.partes.rayos_x_r')
      </div>
    </div>
    <div class="col-sm-4">
      <div class="x_panel border border-purple rounded">
        @include('Ingresos.dashboard.partes.ultra_r')
      </div>
    </div>
    <div class="col-sm-4">
      <div class="x_panel border border-purple rounded">
        @include('Ingresos.dashboard.partes.tac_r')
      </div>
    </div>
  </div>
@endif