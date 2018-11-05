{{--  MODAL INICIO--}}
<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_datos_paciente" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Información</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">
          <h3>Datos del Paciente</h3>
          <table class="table">
            @include('Pacientes.Formularios.datos')
          </table>
        </div>
      </div>

      <div class="modal-footer">
        @if (Auth::user()->tipoUsuario == "Recepción")  
          <a href={{asset('/pacientes/'.$paciente->id)}} class="btn btn-primary">Ir a registro</a>
        @endif
        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  {{-- MODAL FINAL --}}
