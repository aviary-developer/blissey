<div class="modal fade" tabindex="-1" role="dialog" id="modal_inventario" data-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel text-danger">
          <center>
            <h4 class="mb-1">
              <i class="fas fa-th-list"></i>
              Producto
            </h4>
          </center>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="x_panel m_panel">
          <div class="ln_solid mb-1 mt-1"></div>
          <div class="row">
            <table class="table table-striped table-sm" id="inventario">
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="m_panel x_panel bg-transparent" style="border:0px !important">
          <center>
            <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
          </center>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function llenarmodal(id){
  var tabla = $("#inventario");
  ruta=$('#guardarruta').val() + "/inventarios/"+id;
  $.get(ruta,function(res){
    tabla.empty();
    head =
    "<thead>"+
    "<th>Cantidad</th>"+
    "<th>Lote</th>"+
    "<th>Estante</th>"+
    "<th>Nivel</th>"+
    "<th>Fecha de vencimiento</th>"+
    "<th>Opción</th>"+
    "</thead>";
    tabla.append(head); 
    $(res).each(function(key,value){
      console.log(value);
      html="<tr>"+
      "<td>"+value.cantidad+"</td>"+
      "<td>"+value.lote+"</td>"+
      "<td>"+value.estante+"</td>"+
      "<td>"+value.nivel+"</td>"+
      "<td>"+value.fecha_vencimiento.split('-').reverse().join('/')+"</td>"+
      "<td><button class='btn btn-sm btn-danger' title='Salida de inventario' data-toggle='modal' data-target='#modal_salida' onclick='guardar("+value.id+","+value.cantidad+");'><i class='fas fa-exclamation-triangle'></i></button></td>"+
      "</tr>";
      tabla.append(html);
    });
  });
}
function guardar(id,cantidad){
$('#idTr').val(id);
$('#limiteCantidad').val(cantidad);
}

</script>
