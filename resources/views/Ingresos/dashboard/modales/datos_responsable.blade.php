<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="datos_responsable" data-backdrop="static">
  <div class="modal-dialog">

    <div class="x_panel m_panel text-danger">
      <center>
        <h4 class="mb-1">
          <i class="fas fa-user"></i>
          Datos del Responsable
        </h4>
      </center>
    </div>

    <div class="x_panel m_panel">
      @include('Pacientes.Partes.datos_responsable')
    </div>

    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        @if (Auth::user()->tipoUsuario == "Recepción")  
          <a href={{asset('/pacientes/'.$responsable->id)}} class="btn btn-primary btn-sm col-4">Ir a registro</a>
        @endif
        <button type="button" class="btn btn-light col-4 btn-sm" data-dismiss="modal">Cerrar</button>
      </center>
    </div>
  </div>
</div>