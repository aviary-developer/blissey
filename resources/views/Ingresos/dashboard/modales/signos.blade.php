<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="signo_m" data-backdrop="static">
  <div class="modal-dialog">
    <div class="x_panel m_panel text-danger">
      <center>
        <h4 class="mb-1">
          <i class="fas fa-heartbeat"></i>
          Signos Vitales
        </h4>
      </center>
    </div>

    <div class="m_panel x_panel">
      @include('Signos.Formularios.form')
    </div>

    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" class="btn btn-primary btn-sm col-2" id="guardarSignoModal">Guardar</button>
      <button type="button" class="btn btn-sm btn-light col-2" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>