<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="informe_fin" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-xs-12">
        <div class="x_panel m_panel">
          @include('Ingresos.PDF.informe.ingreso')
        </div>
      </div>
    </div>
    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <a href={{asset('/informe_financiero/'.$ingreso->id)}} class="btn btn-sm btn-primary col-2" target="_blank">Ver PDF</a>
      <button type="button" class="btn btn-light btn-sm col-2" onclick="location.reload()">Cerrar</button>
      </center>
    </div>
  </div>
</div>