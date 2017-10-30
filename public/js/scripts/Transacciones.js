  $("#resultado").keyup(function(){
    var valor = $("#resultado").val();
    var tipo  = $("#tipo").val();
    var usuario= $("#tipoUsuario").val();
    var laboratorio=$("#f_proveedor").val();
    if(laboratorio!=null){
    if(valor.length > 2){
      if(tipo==0 && usuario=="Farmacia"){ //Venta a clientes
        var ruta = "/blissey/public/buscarProductoTransaccion/"+laboratorio+"/"+valor;
        var tabla = $("#tablaBuscar");
        $.get(ruta,function(res){
            tabla.empty();
            head =
            "<thead>"+
            "<th>Resultado</th>"+
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
          "<input type='hidden' name='nombre_producto[]' value ='"+value.nombre+"'>"+
          "<input type='hidden' name='id_producto[]' value ='"+value.id+"'>"+
          "<button type='button' class='btn btn-xs btn-primary' id='agregar_resultado'>"+
          "<i class='fa fa-arrow-right'></i>"+
          "</button>"+
          "</td>"+
          "</tr>";
          tabla.append(html);
            });
        });

      }else{      //Compra a proveedores
      }
    }
  }else{
    swal({
 type: 'error',
 title: '¡No ha seleccionado ningún proveedor!',
 showConfirmButton: false,
 timer: 1500,
 animation: false,
 customClass: 'animated tada'
});
  }
});
$("#tablaBuscar").on('click',"#agregar_resultado",function(e){
  var nombre = $(this).parents('tr').find('input:eq(0)').val();
  var f_producto = $(this).parents('tr').find('input:eq(1)').val();
  var tabla = $("#tablaDetalle");
  var precio=parseFloat($("#precio_resultado").val());
  var descuento=$("#descuento_resultado").val();
  var cantidad=parseFloat($("#cantidad_resultado").val());
  var fecha_vencimiento=$("#fecha_resultado").val();
  var lote=$("#lote_resultado").val();
  html="<tr>"+
  "<td>"+nombre+"</td>"+
  "<td>"+precio+"</td>"+
  "<td>"+descuento+"</td>"+
  "<td>"+cantidad+"</td>"+
  "<td>"+precio*cantidad+"</td>"+
  "</tr>";
  tabla.append(html);
});
