<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="verRadiografia">
  <div class="modal-dialog ">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Anexo de radiografía</h4>
      </div>
      @php
      $resultado=App\Resultado::where('f_solicitud',$solicitud->id)->first();
      $detalleRayox=App\DetalleRayox::where('f_resultado','=',$resultado->id)->first();
      @endphp
      <div class="modal-body">
        <div class="x_panel">
          <img style="height: 400px; width: 550px; object-fit: scale-down" src={{asset(Storage::url($detalleRayox->rayox))}}>
        </div>
      </div>
      <div class="modal-footer">
        <center>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </center>
      </div>

    </div>
  </div>
</div>
<script>
var ruta = "/blissey/public/llenarMuestrasExamenes";
$.get(ruta, function (res) {
  muestras.empty();
  $(res).each(function (key, value) {
    muestras.append("<option value='" + value.id + "'>" + value.nombre + "</option>");
  });
});
</script>
