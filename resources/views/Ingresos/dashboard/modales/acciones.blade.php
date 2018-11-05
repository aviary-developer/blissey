<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="acciones" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <div class="row">
      <div class="col-xs-12">
        <div class="x_panel m_panel">
          <div class="row">
            <h4>Acciones</h4>
          </div>
          <div class="row">
            {{-- Total de la deuda para dar de alta al usuario --}}
            <input type="hidden" value={{number_format($total_deuda,2,'.','')}} id="deuda_para_alta">
            <button type="button" class="btn btn-lg btn-primary  col-xs-12" id="dar_alta">Dar de alta</button>
            <button type="button" class="btn btn-lg btn-primary  col-xs-12" data-target="#cambio_habitacion" data-toggle="modal" data-dismiss="modal">Cambiar de habitación</button>
            @if ($horas <= 6 || $ingreso->tipo != 0)  
              <button type="button" class="btn btn-lg btn-primary  col-xs-12" data-toggle="modal" data-target="#cambio_hospitalizacion" data-dismiss="modal">Cambiar tipo de hospitalización</button>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-sm btn-light" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>