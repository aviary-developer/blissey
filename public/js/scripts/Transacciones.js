var radio=3;
var componentes_agregados = [];
$(document).on('ready',function(){
  var contador = $("#contador").val();
  $("#codigoBuscar").val("");
  $("#producto").val("");
  $("#cantidad").val("1");
  for (i = 0; i <= contador; i++) {
    var prod_tmp = $("#f_prod"+i).val();
    componentes_agregados.push(prod_tmp);
  }
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
                    if (value2.unidad==null) {
                      n_division=value2.division.nombre+" "+value2.cantidad+" "+value.presentacion.nombre;
                    } else {
                      n_division=value2.division.nombre+" "+value2.cantidad+" "+value2.unidad.nombre;
                    }
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
    $("#resultadoVenta").keyup(function(){
      var valor = $("#resultadoVenta").val();
      if(radio=='1' && valor.length>0){
        var ruta = "/blissey/public/buscarProductoVenta/"+valor;
        var tabla = $("#tablaBuscar");
        $.get(ruta,function(res){
          tabla.empty();
          cab="<thead>"+
          "<th colspan='2'>Resultado</th>"+
          "<th>Existencias</th>"+
          "<th>Precio</th>"+
          "<th style='width : 80px'>Acción</th>"+
          "</thead>";
          tabla.append(cab);
          $(res).each(function(key,value){
            $(value.division_producto).each(function(key2,value2){
              if(parseFloat(value2.inventario)>0){
              if (value2.contenido!=null) {
                var aux=value2.unidad.nombre;
              } else {
                var aux=value.presentacion.nombre;
              }
              html="<tr>"+
              "<td id='cu"+value2.id+"'>"+value.nombre+"</td>"+
              "<td id='cd"+value2.id+"'>"+" "+value2.division.nombre+" "+value2.cantidad+" "+aux+"</td>"+
              "<td id='ct"+value2.id+"'>"+value2.inventario+"</td>"+
              "<td>$ <label id='cc"+value2.id+"'>"+parseFloat(value2.precio).toFixed(2)+"</label></td>"+
              "<td>"+
              "<button type='button' class='btn btn-xs btn-primary' onclick='registrarventa("+value2.id+");'>"+
              "<i class='fa fa-arrow-right'></i>"+
              "</button>"+
              "</td>"+
              "</tr>";
              tabla.append(html);
              }
            });
          });
        });
      }
      if(radio=='2' && valor.length>0){
        var ruta = "/blissey/public/buscarComponenteVenta/"+valor;
        var tabla = $("#tablaBuscar");
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
                if (res.unidad==null) {
                  n_division=res3+" "+res.cantidad+" "+res4.presentacion.nombre;
                } else {
                  n_division=res3+" "+res.cantidad+" "+res.unidad.nombre;
                }
                $('#producto').val(n_division+" "+res4.nombre);
                $('#idoculto').val(res.id);
                $('#divoculto').val(n_division);

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
          "<td style='width: 10%'><input name='descuento[]' class='form-control' type='number' placeholder='%' value='0'></td>"+
          "<td style='width: 10%'><input name='fecha_vencimiento[]' class='form-control' type='date' placeholder=''></td>"+
          "<td style='width: 10%'><input name='precio[]' class='form-control' type='number' placeholder='Precio'></td>"+
          "<td style='width: 10%'><input name='lote[]' class='form-control' type='text' placeholder='N° de lote'></td>"+
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
        var cantidad=parseFloat($("#cantidadp").val());
        if($("#confirmar").val()==false){
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
      }else{
        html="<tr>"+
        "<td style='width: 10%'><input type='number' placeholder='cantidad' name='cantidad[]' class='form-control' value='"+cantidad+"'></td>"+
        "<td style='width: 20%'>"+$("#divoculto").val()+"</td>"+
        "<td style='width: 15%'>"+$("#nomoculto").val()+"</td>"+
        "<td style='width: 10%'><input name='descuento[]' class='form-control' type='number' placeholder='%' value='0'></td>"+
        "<td style='width: 10%'><input name='fecha_vencimiento[]' class='form-control' type='date' placeholder=''></td>"+
        "<td style='width: 10%'><input name='precio[]' class='form-control' type='number' placeholder='Precio'></td>"+
        "<td style='width: 10%'><input name='lote[]' class='form-control' type='text' placeholder='N° de lote'></td>"+
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
        $('#idoculto').val("");
        $('#divoculto').val("");
        $('#nomoculto').val("");
        $('#codigoBuscar').val("");
        $('#producto').val("");
        $('#cantidadp').val("1");
        componentes_agregados.push(f_producto);
      }
    });
    $("#resultadoCliente").keyup(function(){
      var valor = $("#resultadoCliente").val();
      conteo=valor.length;
      var tabla = $("#tablaBuscarCliente");
      if(conteo >1){
        var ruta = "/blissey/public/buscarCliente/"+valor;
        $.get(ruta,function(res){
          tabla.empty();
          html="<thead><th>Nombre</th><th>Apellido</th><th>Teléfono</th><th>DUI</th><th style='width : 80px'>Acción</th></thead>";
          tabla.append(html);
          $(res).each(function(key,value){
              cadena="<tr>"+
              "<td id='tbcn"+value.id+"'>"+value.nombre+"</td>"+
              "<td id='tbca"+value.id+"'>"+value.apellido+"</td>"+
              "<td>"+value.telefono+"</td>"+
              "<td>"+value.dui+"</td>"+
              "<td>"+
              "<button type='button' class='btn btn-xs btn-primary' onclick='agregarCliente("+value.id+");' data-dismiss='modal'>"+
              "<i class='fa fa-arrow-right'></i>"+
              "</button>"+
              "</td>"+
              "</tr>";
              tabla.append(cadena);
          });
        });
      }else{
        tabla.empty();
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
function agregarCliente(id){
  nombre=$('#tbcn'+id).text();
  apellido=$('#tbca'+id).text();
  $('#f_clientea').val(nombre+" "+apellido);
  $('#f_cliente').val(id);
}

function limpiarTabla(){
  $('#tablaBuscarCliente').empty();
  $('#resultadoCliente').val("");
}
function cambioRadio(t){
  radio=t;
}
function registrarventa(id){
  var cantidad= parseFloat($('#cantidad_resultado').val());
  var existencia=parseFloat($('#ct'+id).text());
  if(cantidad>existencia || componentes_agregados.includes(""+id+"")){
    alert("existencia superada o producto ya agregado");
  }else{
    c1=$('#cu'+id).text();
    c2=$('#cd'+id).text();
    c4=parseFloat($('#cc'+id).text()).toFixed(2);
    tabla=$('#tablaDetalle');
    html="<tr>"+
    "<td>"+cantidad+"</td>"+
    "<td>"+c1+"</td>"+
    "<td>"+c2+"</td>"+
    "<td>"+c4+"</td>"+
    "<td>"+parseFloat(cantidad*c4).toFixed(2)+"</td>"+
    "<td>"+
    "<input type='hidden' name='f_producto[]' value='"+id+"'>"+
    "<input type='hidden' name='cantidad[]' value='"+cantidad+"'>"+
    "<input type='hidden' name='precio[]' value='"+c4+"'>"+
    "<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>"+
    "<i class='fa fa-remove'></i>"+
    "</button>"+
    "</td>"+
    "</tr>";
    tabla.append(html);
    componentes_agregados.push(""+id+"");
  }
}
