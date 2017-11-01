$(document).on('ready',function(){
    var componentes_agregados = [];
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
        $("#resultado").val("");
        swal({
          type: 'error',
          title: '¡Proveedor no seleccionado!',
          showConfirmButton: false,
          timer: 2000,
          animation: false,
          customClass: 'animated tada'
        });
      }
    });
    $("#tablaBuscar").on('click',"#agregar_resultado",function(e){
      var v=validarCantidad();
      var f_producto = $(this).parents('tr').find('input:eq(1)').val();
      if(v==true && !componentes_agregados.includes(f_producto)){
        var nombre = $(this).parents('tr').find('input:eq(0)').val();
        var tabla = $("#tablaDetalle");
        var cantidad=parseFloat($("#cantidad_resultado").val());
        html="<tr>"+
        "<td>"+cantidad+"</td>"+
        "<td>"+nombre+"</td>"+
        "<td>"+
        "<input type='hidden' name='cantidad[]' value ='"+cantidad+"'>"+
        "<input type='hidden' name='f_producto[]' value ='"+f_producto+"'>"+
        "<button type='button' class='btn btn-xs btn-primary' id='eliminar_detalle'>"+
        "<i class='fa fa-arrow-right'></i>"+
        "</button>"+
        "</td>"+
        "</tr>";
        tabla.append(html);
        componentes_agregados.push(f_producto);
      }
    });
    $("#tablaDetalle").on('click','#eliminar_detalle',function(e){
    var elemento = $(this).parents('tr').find('input:eq(1)').val();
      var indice = componentes_agregados.indexOf(elemento);
      componentes_agregados.splice(indice,1);
      $(this).parent('td').parent('tr').remove();
    });
    function validarCantidad(){
      c=0;
      var error =[];
      valor=true;
      if($("#cantidad_resultado").val()==""){
        error[c]='El campo cantidad es requerido';
        c=c+1;
        valor=false;
      }if(parseFloat($("#cantidad_resultado").val())<=0){
        error[c]='La cantidad debe ser mayor a cero';
        c=c+1;
        valor=false;
      }
      for (var i = 0; i < c; i++) {
        new PNotify({
          title: 'Error!',
          text: error[i],
          type: 'error',
          styling: 'bootstrap3'
        });
      }
      return valor;
    }
});
function entero(obj,e,valor){
  val = (document.all) ? e.keyCode : e.which;
  if(val > 47 && val < 58){
    return true;
  }else{
    return false;
  }
}
