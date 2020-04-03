<div class="row">
  <div class="col-sm-8">
    <div class="x_panel border border-info rounded">
      @include('Ingresos.dashboard.partes.medico_cr')
    </div>
  </div>
  <div class="col-sm-4">
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
              <input type="hidden" id="precio_consulta" value={{floatval($detalle_hc->precio)}}>
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