$(document).on('ready',function(){
  $("#resultadoRequisicion").keyup(function(){
    valor=$("#resultadoRequisicion").val();
    if(valor.length>2){
      var ruta = "/blissey/public/buscarProductoRequisicion/"+valor;
      var tabla = $("#tablaRequisicion");
      $.get(ruta,function(res){
        tabla.empty();
        head =
        "<thead>"+
        "<th>Código</th>"+
        "<th colspan='2'>Producto</th>"+
        "<th>Existencias</th>"+
        "<th>Acción</th>"+
        "</thead>";
        tabla.append(head);
        $(res).each(function(key,value){
          $(value.division_producto).each(function(key2,value2){
            if (value2.contenido!=null) {
              var aux=value2.unidad.nombre;
            } else {
              var aux=value.presentacion.nombre;
            }
            html="<tr>"+
            "<td id='cu"+value2.id+"'>"+value2.codigo+"</td>"+
            "<td id='cd"+value2.id+"'>"+value.nombre+"</td>"+
            "<td id='ct"+value2.id+"'>"+" "+value2.division.nombre+" "+value2.cantidad+" "+aux+"</td>"+
            "<td id='ca"+value2.id+"'>"+value2.inventario+"</td>"+
            "<td>"+
            "<button type='button' class='btn btn-xs btn-primary' onclick='registrarRequisicion("+value2.id+");'>"+
            "<i class='fa fa-arrow-right'></i>"+
            "</button>"+
            "</td>"+
            "</tr>";
            tabla.append(html);
          });
        });
    });
  }
  });
});

function registrarRequisicion(id){
  var cantidad= parseFloat($('#cantidad_resultado').val());
  var existencia=parseFloat($('#ca'+id).text());
  c1=$('#cu'+id).text();
  c2=$('#cd'+id).text();
  c3=$('#ct'+id).text();
  if(cantidad>existencia || componentes_agregados.includes(""+id+"")){
    if (cantidad>existencia) {
      new PNotify({
        title: 'Error!',
        text: "La cantidad solicitada supera las existencias",
        type: 'error',
        styling: 'bootstrap3'
      });
    } else {
      new PNotify({
        title: 'Error!',
        text: 'El producto ya se encuentra incluido',
        type: 'error',
        styling: 'bootstrap3'
      });
    }
  }else{
    tabla=$('#tablaDetalle');
    html="<tr>"+
    "<td>"+cantidad+"</td>"+
    "<td>"+c1+"</td>"+
    "<td>"+c2+"</td>"+
    "<td>"+c3+"</td>"+
    "<td>"+
    "<input type='hidden' name='f_producto[]' value='"+id+"'>"+
    "<input type='hidden' name='cantidad[]' value='"+cantidad+"'>"+
    "<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>"+
    "<i class='fa fa-remove'></i>"+
    "</button>"+
    "</td>"+
    "</tr>";
    tabla.append(html);
    componentes_agregados.push(""+id+"");
  }
}
