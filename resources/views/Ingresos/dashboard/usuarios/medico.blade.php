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
				<div class="col-sm-12" style="height: 450px; overflow-x:hidden; overflow-y:scroll; display:none" id="ver_seguimiento">
					@include('Ingresos.dashboard.partes.ver_seguimiento')
				</div>
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
    <div class="col-sm-3">
      <div class="x_panel border border-purple rounded">
        @include('Ingresos.dashboard.partes.rayos_x_r')
      </div>
    </div>
    <div class="col-sm-3">
      <div class="x_panel border border-purple rounded">
        @include('Ingresos.dashboard.partes.ultra_r')
      </div>
    </div>
    <div class="col-sm-3">
      <div class="x_panel border border-purple rounded">
        @include('Ingresos.dashboard.partes.tac_r')
      </div>
    </div>
    <div class="col-sm-3">
      <div class="x_panel border border-success rounded">
        <div class="row">
          <div class="col-sm-8">
            <h5 class="text-success">Acción</h5>
          </div>
          <div class="col-sm-4"></div>
        </div>
        @if ($ingreso->estado == 2)
        <div class="flex-row">
          <div style="height: 106px">
            <center style="margin-top: 20px">
              No hay ninguna acción disponible
            </center>
          </div>
        </div>
        @else
          <div class="flex-row">
            <div style="height: 106px">
              <center style="margin-top: 20px">
                <input type="hidden" id="precio_consulta" value={{floatval(0)}}>{{-- QUITE PRECIO, QUE PASE 0.00 --}}
                <button type="button" class="btn-lg btn btn-success" id="fin_consulta">
                  <i class="fa fa-arrow-right"></i> Finalizar consulta
                </button>
              </center>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
@endif