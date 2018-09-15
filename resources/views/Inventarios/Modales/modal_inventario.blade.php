<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal_inventario">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Categoría <span class="label label-lg label-primary">Nueva</span></h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">
          <table class="table table-striped" id="inventario">
          </table>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript">
function llenarmodal(id){
  var tabla = $("#inventario");
  ruta="/blissey/public/inventarios/"+id;
  $.get(ruta,function(res){
    tabla.empty();
    head =
    "<thead>"+
    "<th>Cantidad</th>"+
    "<th>Lote</th>"+
    "<th>Fecha de vencimiento</th>"+
    "</thead>";
    tabla.append(head);
    $(res).each(function(key,value){
      html="<tr>"+
      "<td>"+value.cantidad+"</td>"+
      "<td>"+value.lote+"</td>"+
      "<td>"+value.fecha_vencimiento.split('-').reverse().join('/');+"</td>"+
      "</tr>";
      tabla.append(html);
    });
  });
}

</script>
