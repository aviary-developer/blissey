<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_paciente_mini" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-sm-12">

        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-user"></i>
              Paciente
            </h4>
          </center>
        </div>

        @include('Pacientes.Formularios.form_mini')
      </div>
    </div>

    <div class="m_panel x_panel bg-transparent" style="border: 0px !important">
      <center>
        <button type="button" class="btn btn-primary btn-sm col-2" id="save_paciente_mini">Guardar</button>
        <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>