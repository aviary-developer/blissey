<div class="row">
  <div class="col-xs-8">
    <div class="x_panel">
      @include('Ingresos.dashboard.partes.signos_r')
    </div>
  </div>
  <div class="col-xs-4">
    <div class="x_panel">
      <div class="row">
        <div class="col-xs-8">
          <h5 class="big-text">Acción</h5>
        </div>
        <div class="col-xs-4"></div>
      </div>
      @if ($ingreso->estado == 2)
      <div class="row">
        <div style="height: 80px">
          <center style="margin-top: 20px">
            No hay ninguna acción disponible
          </center>
        </div>
      </div>
      @else
        <div class="row">
          <div style="height: 80px">
            <center style="margin-top: 20px">
              <input type="hidden" id="precio_consulta" value={{floatval($ingreso->medico->servicio->precio)}}>
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