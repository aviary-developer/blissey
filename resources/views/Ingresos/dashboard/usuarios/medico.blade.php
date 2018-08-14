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
        Consulta
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <div class="x_panel">
        Signos vitales
      </div>
    </div>
    <div class="col-xs-6">
      <div class="x_panel">
        Laboratorio clínico
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-4">
      <div class="x_panel">
        Rayos X
      </div>
    </div>
    <div class="col-xs-4">
      <div class="x_panel">
        Ultra
      </div>
    </div>
    <div class="col-xs-4">
      <div class="x_panel">
        TAC
      </div>
    </div>
  </div>
@endif