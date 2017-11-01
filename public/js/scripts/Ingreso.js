$(document).on('ready',function(){
  $("#componente").keyup(function(){
    var valor = $("#componente").val();
    if(valor.length > 2){
      var ruta = "/blissey/public/buscarComponenteProducto/"+valor;
      var tabla = $("#tablaBuscarComponente");
      $.get(ruta,function(res){
        tabla.empty();
        head =
        "<thead>"+
        "<th>Componente</th>"+
        "<th style='width : 80px'>Acción</th>"+
        "</thead>";
        tabla.append(head);
        $(res).each(function(key,value){
          html =
          "<tr>"+
          "<td>"+
          value.nombre+
          "</td>"+
          "<td>"+
          "<input type='hidden' name='nombre_componente[]' value ='"+value.nombre+"'>"+
          "<input type='hidden' name='id_componente[]' value ='"+value.id+"'>"+
          "<button type='button' class='btn btn-xs btn-primary' id='agregar_componente'>"+
          "<i class='fa fa-arrow-right'></i>"+
          "</button>"+
          "</td>"+
          "</tr>";
          tabla.append(html);
        });
      });
    }
  });
});
