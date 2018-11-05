{{--  MODAL INICIO--}}
<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_informe" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Informe</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">
          <center>
            <h3>Informe</h3>
          </center>
          @include('Ingresos.PDF.informe.ingreso')
        </div>
      </div>

      <div class="modal-footer">
        <a href={{asset('/informe_financiero/'.$ingreso->id)}} class="btn btn-primary" target="_blank">Ir a registro</a>
        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  {{-- MODAL FINAL --}}
