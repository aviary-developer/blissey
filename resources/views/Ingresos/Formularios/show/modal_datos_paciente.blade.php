{{--  MODAL INICIO--}}
<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_datos_paciente">
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
        <a href={{asset('/pacientes/'.$paciente->id)}} class="btn btn-primary">Ir a registro</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  {{-- MODAL FINAL --}}