$(document).on('ready',function(){
  var componentes_agregados = [];
  var contador = $("#contador").val();
  for (i = 0; i <= contador; i++) {
    var prod_tmp = $("#f_prod"+i).val();
    componentes_agregados.push(prod_tmp);
  }
  console.log(componentes_agregados);
    $("#resultado").keyup(function(){
      var valor = $("#resultado").val();
      var tipo  = $("#tipo").val();
      var usuario= $("#tipoUsuario").val();
      var laboratorio=$("#f_proveedor").val();
      var confirmar=$("#confirmar").val();
      if(laboratorio!=""){
        conteo=valor.length;
        if(conteo > 1 && (conteo%2)==0){
          if(confirmar==true||tipo==0 && usuario=="Farmacia"){ //Venta a clientes
            var ruta = "/blissey/public/buscarProductoTransaccion/"+laboratorio+"/"+valor;
            var tabla = $("#tablaBuscar");
            $.get(ruta,function(res){
              tabla.empty();
              head =
              "<thead>"+
              "<th colspan='2'>Resultado</th>"+
              "<th style='width : 80px'>Acción</th>"+
              "</thead>";
              tabla.append(head);
              $(res).each(function(key,value){
                var ruta2= "/blissey/public/buscarDivisionTransaccion/"+value.id;
                $.get(ruta2,function(res2){
                  $(res2).each(function(key2,value2){
                      n_division=value2.division.nombre+" "+value2.cantidad+" "+value.presentacion.nombre;
                      html =
                      "<tr>"+
                      "<td>"+
                      value.nombre+
                      "</td>"+
                      "<td>"+
                      n_division+
                      "</td>"+
                      "<td>"+
                      "<input type='hidden' name='producto_division[]' value ='"+n_division+"'>"+
                      "<input type='hidden' name='nombre_producto[]' value ='"+value.nombre+"'>"+
                      "<input type='hidden' name='id_producto[]' value ='"+value2.id+"'>"+
                      "<button type='button' class='btn btn-xs btn-primary' id='agregar_resultado'>"+
                      "<i class='fa fa-arrow-right'></i>"+
                      "</button>"+
                      "</td>"+
                      "</tr>";
                      tabla.append(html);
                  });
                });
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
        }).catch(swal.noop);
      }
    });
    $("#codigoBuscar").keyup(function(){
      codigo=$('#codigoBuscar').val();
      if(codigo!=""){
        ruta="/blissey/public/busquedaCodigo/"+codigo;
        $.get(ruta,function(res){
          if(res!=0){
            var ruta3="/blissey/public/buscarNombreDivision/"+res.f_division;
            $.get(ruta3,function(res3){
              var ruta4="/blissey/public/buscarNombrePresentacion/"+res.f_producto+"/2";
              $.get(ruta4,function(res4){
                n_division=res3+" "+res.cantidad+" "+res4.presentacion.nombre+" "+res4.nombre;
                $('#producto').val(n_division);
                $('#idoculto').val(res.id);
                $('#divoculto').val(res3+" "+res.cantidad+" "+res4.presentacion.nombre);
                $('#nomoculto').val(res4.nombre);
              });
            });
          }else{
            $('#producto').val("");
          }
        });
      }
    });
    $("#tablaBuscar").on('click',"#agregar_resultado",function(e){
      var v=validarCantidad();
      var f_producto = $(this).parents('tr').find('input:eq(2)').val();
      if(v==true && !componentes_agregados.includes(f_producto)){
        var division=$(this).parents('tr').find('input:eq(0)').val();
        var nombre = $(this).parents('tr').find('input:eq(1)').val();
        var tabla = $("#tablaDetalle");
        var cantidad=parseFloat($("#cantidad_resultado").val());
        if($("#confirmar").val()==false){
            html="<tr>"+
            "<td>"+cantidad+"</td>"+
            "<td>"+division+"</td>"+
            "<td>"+nombre+"</td>"+
            "<td>"+
            "<input type='hidden' name='f_producto[]' value ='"+f_producto+"'>"+
            "<input type='hidden' name='cantidad[]' value ='"+cantidad+"'>"+
            "<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>"+
            "<i class='fa fa-remove'></i>"+
            "</button>"+
            "</td>"+
            "</tr>";
        }else{
          html="<tr>"+
          "<td style='width: 10%'><input type='number' placeholder='cantidad' name='cantidad[]' class='form-control' value='"+cantidad+"'></td>"+
          "<td style='width: 20%'>"+division+"</td>"+
          "<td style='width: 15%'>"+nombre+"</td>"+
          "<td style='width: 10%'><input class='form-control' type='number' placeholder='%' value='0'></td>"+
          "<td style='width: 10%'><input class='form-control' type='date' placeholder=''></td>"+
          "<td style='width: 10%'><input class='form-control' type='number' placeholder='Precio'></td>"+
          "<td style='width: 10%'><input class='form-control' type='text' placeholder='N° de lote'></td>"+
          "<td>"+
          "<input type='hidden' name='f_producto[]' value ='"+f_producto+"'>"+
          "<input type='hidden' name='estado[]' value ='nuevo'>"+
          "<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>"+
          "<i class='fa fa-remove'></i>"+
          "</button>"+
          "</td>"+
          "</tr>";
        }

        tabla.append(html);
        componentes_agregados.push(f_producto);
        console.log(componentes_agregados);
      }
    });
    $("#tablaDetalle").on('click','#eliminar_detalle',function(e){
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
      var indice = componentes_agregados.indexOf(elemento);
      componentes_agregados.splice(indice,1);
      $(this).parent('td').parent('tr').remove();
    });
    $("#tablaDetalle").on('click','#eliminar_fila_pedido',function(e){
    var elemento = $(this).parents('tr').find('input:eq(5)').val();
    var estado = $(this).parents('tr').find('input:eq(6)').val();
      var indice = componentes_agregados.indexOf(elemento);
      componentes_agregados.splice(indice,1);
      $(this).parent('td').parent('tr').remove();
      if(estado!='nuevo'){
        var eliminado ="<input type='hidden' name='eliminado[]' value='"+estado+"'>";
        $('#eliminados').append(eliminado);
      }
      console.log(componentes_agregados);
    });
    function validarCantidad(){ //Campo cantidad_resultado
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
    function validaciones(){ //campo cantidad
      c=0;
      var error =[];
      valor=true;
      if($("#cantidad").val()==""){
        error[c]='El campo cantidad es requerido';
        c=c+1;
        valor=false;
      }if(parseFloat($("#cantidad").val())<=0){
        error[c]='La cantidad debe ser mayor a cero';
        c=c+1;
        valor=false;
      }
      if($('#producto').val()==""){
        error[c]='No ha ingresado un código de producto válido';
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
    $("#agregar").on("click",function(){
      var v=validaciones();
      f_producto=$('#idoculto').val();
      if(v==true && !componentes_agregados.includes(f_producto)){
        var tabla = $("#tablaDetalle");
        var cantidad=parseFloat($("#cantidad").val());
        html="<tr>"+
        "<td>"+cantidad+"</td>"+
        "<td>"+$("#divoculto").val()+"</td>"+
        "<td>"+$("#nomoculto").val()+"</td>"+
        "<td>"+
        "<input type='hidden' name='f_producto[]' value ='"+f_producto+"'>"+
        "<input type='hidden' name='cantidad[]' value ='"+cantidad+"'>"+
        "<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>"+
        "<i class='fa fa-remove'></i>"+
        "</button>"+
        "</td>"+
        "</tr>";
        tabla.append(html);
        $('#idoculto').val("");
        $('#divoculto').val("");
        $('#nomoculto').val("");
        $('#codigoBuscar').val("");
        $('#producto').val("");
        $('#cantidad').val("1");
        componentes_agregados.push(f_producto);
      }
    });

});
function entero(obj,e,valor){
  val = (document.all) ? e.keyCode : e.which;
  if(val > 47 && val < 58){
    return true;
  }else{
    return false;
  }
}
