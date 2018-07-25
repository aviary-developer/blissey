<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="signo_m" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-xs-12">
        <div class="m_panel x_panel">
          <div class="row">
              <h4>Signos Vitales</h4>
          </div>
          <div class="row">
            @include('Signos.Formularios.form')
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-primary btn-sm" id="guardarSignoModal">Guardar</button>
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>