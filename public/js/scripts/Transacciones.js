var radio=1;
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
      var laboratorio=$("#f_proveedor").val();
      var confirmar=$("#confirmar").val();
      if(laboratorio!=""){
        conteo=valor.length;
        if(conteo > 1 && (conteo%2)==0){
          if(confirmar==true||tipo==0){ //Venta a clientes
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
      if(valor.length<3){
        var tabla = $("#tablaBuscar");
        tabla.empty();
      }
      if(radio=='1' && valor.length>2){
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
      if(radio=='2' && valor.length>3){
        var ruta = "/blissey/public/buscarComponenteVenta/"+valor;
        var tabla = $("#tablaBuscar");
        $.get(ruta,function(res){
          tabla.empty();
          cab="<thead>"+
          "<th colspan='2'>Resultado</th>"+
          "<th>Existencias</th>"+
          "<th>Precio</th>"+
          "<th>Componente</th>"+
          "<th style='width : 80px'>Acción</th>"+
          "</thead>";
          tabla.append(cab);
          $(res).each(function(key,value){
            $(value.componente_producto).each(function(key2,value2){
              $(value2.producto.division_producto).each(function(key3,value3){
                if(parseFloat(value3.inventario)>0){
                if (value3.contenido!=null) {
                  var aux=value3.unidad.nombre;
                } else {
                  var aux=value2.producto.presentacion.nombre;
                }
                html="<tr>"+
                "<td id='cu"+value3.id+"'>"+value2.producto.nombre+"</td>"+
                "<td id='cd"+value3.id+"'>"+" "+value3.division.nombre+" "+value3.cantidad+" "+aux+"</td>"+
                "<td id='ct"+value3.id+"'>"+value3.inventario+"</td>"+
                "<td>$ <label id='cc"+value3.id+"'>"+parseFloat(value3.precio).toFixed(2)+"</label></td>"+
                "<td>"+value.nombre+"</td>"+
                "<td>"+
                "<button type='button' class='btn btn-xs btn-primary' onclick='registrarventa("+value3.id+");'>"+
                "<i class='fa fa-arrow-right'></i>"+
                "</button>"+
                "</td>"+
                "</tr>";
                tabla.append(html);
                }
            });
          });
        });
      });
      }
      if(radio=='3' && valor.length>2){
        var ruta = "/blissey/public/buscarServicios/"+valor;
        var tabla = $("#tablaBuscar");
        $.get(ruta,function(res){
           tabla.empty();
          cab="<thead>"+
          "<th colspan='2'>Resultado</th>"+
          "<th style='width : 80px'>Acción</th>"+
          "</thead>";
          tabla.append(cab);
          $(res).each(function(key,value){
                html="<tr>"+
                "<td id='cu"+value.id+"'>"+value.nombre+"</td>"+
                "<td>$ <label id='cd"+value.id+"'>"+parseFloat(value.precio).toFixed(2)+"</label></td>"+
                "<td>"+
                "<button type='button' class='btn btn-xs btn-primary' onclick='registrarventa("+value.id+");'>"+
                "<i class='fa fa-arrow-right'></i>"+
                "</button>"+
                "</td>"+
                "</tr>";
                tabla.append(html);
        });
      });
      }
    });
    $("#codigoBuscar").keyup(function(){
      codigo=$('#codigoBuscar').val();
      if(codigo!=""){
        conf=$('#tipo').val();
        ruta="/blissey/public/busquedaCodigo/"+codigo+"/"+conf;
        $.get(ruta,function(res){
          if(res!=0 && res!=1){
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
                $('#nomoculto').val(res4.nombre);
                $('#preoculto').val(res.precio);
                $('#exioculto').val(res.inventario);
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
      if (componentes_agregados.includes(f_producto)) {
        new PNotify({
          title: 'Error!',
          text: 'Ya fue agregado',
          type: 'error',
          styling: 'bootstrap3'
        });
      }
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
          "<td><input type='number' placeholder='cantidad' name='cantidad[]' class='form-control valu' value='"+cantidad+"'></td>"+
          "<td>"+division+"</td>"+
          "<td>"+nombre+"</td>"+
          "<td><input name='descuento[]' class='form-control vald' type='number' placeholder='%' value='0'></td>"+
          "<td><input name='fecha_vencimiento[]' class='form-control valt' type='date' placeholder=''></td>"+
          "<td><input name='precio[]' class='form-control valc' type='number' placeholder='Precio'></td>"+
          "<td><input name='lote[]' class='form-control vali' type='text' placeholder='N° de lote'></td>"+
          "<td><select name='f_estante[]' class='form-control vals' id='f_estante"+f_producto+"' onChange='cambioEstante("+f_producto+")'>"+$('#opciones').val()+"</select></td>"+
          "<td><select name='nivel[]' class='form-control' id='nivel"+f_producto+"'><option value=''>Nivel</option></select></td>"+
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
        new PNotify({
          title: 'Hecho!',
          text: 'Ha sido agregado en detalles',
          type: 'info',
          styling: 'bootstrap3'
        });
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
      if($("#cantidadp").val()==""){
        error[c]='El campo cantidad es requerido';
        c=c+1;
        valor=false;
      }if(parseFloat($("#cantidadp").val())<=0){
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
      gd=false;
      var v=validaciones();
      f_producto=$('#idoculto').val();
      if(v==true && !componentes_agregados.includes(f_producto)){
        var tabla = $("#tablaDetalle");
        var cantidad=parseFloat($("#cantidadp").val());
        if($("#confirmar").val()==false){
          if (parseFloat($("#exioculto").val())>=cantidad || $("#tipo").val()!='2') {
            gd=true;
            html="<tr>"+
            "<td>"+cantidad+"</td>"+
            "<td>"+$("#divoculto").val()+"</td>"+
            "<td>"+$("#nomoculto").val()+"</td>";
            if($('#tipo').val()=='2'){
              html=html+"<td>$ "+parseFloat($("#preoculto").val()).toFixed(2)+"</td>"+
              "<td>$ "+(cantidad*parseFloat($("#preoculto").val())).toFixed(2)+"</td>";
            }
            html=html+"<td>"+
            "<input type='hidden' name='tipo_detalle[]' value ='1'>"+
            "<input type='hidden' name='f_producto[]' value ='"+f_producto+"'>"+
            "<input type='hidden' name='cantidad[]' value ='"+cantidad+"'>";
            if($('#tipo').val()=='2'){
              html=html+"<input type='hidden' name='precio[]' value ='"+$("#preoculto").val()+"'>";
            }
            html=html+"<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>"+
            "<i class='fa fa-remove'></i>"+
            "</button>"+
            "</td>"+
            "</tr>";
            new PNotify({
              title: 'Hecho!',
              text: 'Ha sido agregado en detalles',
              type: 'info',
              styling: 'bootstrap3'
            });
          } else {
            new PNotify({
              title: '¡Error!',
              text: 'Cantidad supera las existencias',
              type: 'error',
              styling: 'bootstrap3'
            });
          }
      }else{
        gd=true;
        html="<tr>"+
        "<td><input type='number' placeholder='cantidad' name='cantidad[]' class='form-control valu' value='"+cantidad+"'></td>"+
        "<td>"+$("#divoculto").val()+"</td>"+
        "<td>"+$("#nomoculto").val()+"</td>"+
        "<td><input name='descuento[]' class='form-control vald' type='number' placeholder='%' value='0'></td>"+
        "<td><input name='fecha_vencimiento[]' class='form-control valt' type='date' placeholder=''></td>"+
        "<td><input name='precio[]' class='form-control valc' type='number' placeholder='Precio'></td>"+
        "<td><input name='lote[]' class='form-control vali' type='text' placeholder='N° de lote'></td>"+
        "<td><select name='f_estante[]' class='form-control vals' id='f_estante"+f_producto+"' onChange='cambioEstante("+f_producto+")'>"+$('#opciones').val()+"</select></td>"+
        "<td><select name='nivel[]' class='form-control' id='nivel"+f_producto+"'><option value=''>Nivel</option></select></td>"+
        "<td>"+
        "<input type='hidden' name='f_producto[]' value ='"+f_producto+"'>"+
        "<input type='hidden' name='estado[]' value ='nuevo'>"+
        "<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>"+
        "<i class='fa fa-remove'></i>"+
        "</button>"+
        "</td>"+
        "</tr>";
        new PNotify({
          title: 'Hecho!',
          text: 'Ha sido agregado en detalles',
          type: 'info',
          styling: 'bootstrap3'
        });
      }
      if(gd){  
        tabla.append(html);
        $('#idoculto').val("");
        $('#divoculto').val("");
        $('#nomoculto').val("");
        $('#codigoBuscar').val("");
        $('#producto').val("");
        $('#cantidadp').val("1");
        componentes_agregados.push(f_producto);
      }
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
    $('#confirmarPedido').on('click', function (e) {
      var error=0;
      v1=v2=v3=v4=v5=v6=v7=0;
      $('.valu').each(function(){ //Cantidad
        if($(this).val().trim()=="" || parseFloat($(this).val())<1){
          error++;
          v1=1;
        }
      });
      $('.vald').each(function(){ //Descuento
        if($(this).val().trim()=="" || parseFloat($(this).val())<0  || parseFloat($(this).val())>100){
          error++;
          v2=1;
        }
      });
      $('.valt').each(function(){ //Fecha
        cop=validarFechaMenorActual($(this).val());
        console.log(cop);
        if($(this).val().trim()==""){
          error++;
          v3=1;
        }else  if(cop){
          error++;
          v3=1;
        }
      });
      $('.valc').each(function(){ //Precio
        if($(this).val().trim()=="" || parseFloat($(this).val())<0){
          error++;
          v4=1;
        }
      });
      $('.vali').each(function(){ //Lote
        if($(this).val().trim()==""){
          error++;
          v5=1;
        }
      });
      if($('#fac').val().trim()==""){
        error++;
        v6=1;
      }
      $('.vals').each(function(){ //Lote
        if($(this).val().trim()==""){
          error++;
          v7=1;
        }
      });
      if(error==0){
        $('#formVender').submit();
      }else{
        if(v6==1){
          new PNotify({
            title: '¡Error!',
            text: 'El campo factura es obligatorio',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
        if(v1==1){
          new PNotify({
            title: '¡Error!',
            text: 'Cantidad debe ser un valor mayor a cero',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
        if(v2==1){
          new PNotify({
            title: '¡Error!',
            text: 'Descuento debe entre 0% a 100%',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
        if(v3==1){
          new PNotify({
            title: '¡Error!',
            text: 'Ingrese fecha de vencimiento valida',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
        if(v4==1){
          new PNotify({
            title: '¡Error!',
            text: 'El precio debe ser mayor que $0.00',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
        if(v5==1){
          new PNotify({
            title: '¡Error!',
            text: 'El número de lote es requerido',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
        if(v7==1){
          new PNotify({
            title: '¡Error!',
            text: 'Todos los productos deben asignarsea a un estante',
            type: 'error',
            styling: 'bootstrap3'
          });
        }
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
function limpiarTablaVenta(){
  $('#tablaBuscar').empty();
  $('#cantidad_resultado').val("1");
  $('#resultadoVenta').val("");
}
function cambioRadio(t){
  radio=t;
  limpiarTablaVenta();
}
function registrarventa(id){
  var cantidad= parseFloat($('#cantidad_resultado').val());
  var existencia=parseFloat($('#ct'+id).text());
  c1=$('#cu'+id).text();
  c2=$('#cd'+id).text();
  if (radio!=3) {
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
    c4=parseFloat($('#cc'+id).text()).toFixed(2);
    tabla=$('#tablaDetalle');
    html="<tr>"+
    "<td>"+cantidad+"</td>"+
    "<td>"+c2+"</td>"+
    "<td>"+c1+"</td>"+
    "<td>$ "+c4+"</td>"+
    "<td>$ "+parseFloat(cantidad*c4).toFixed(2)+"</td>"+
    "<td>"+
    "<input type='hidden' name='tipo_detalle[]' value='1'>"+
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
} else {
  c2=parseFloat(c2).toFixed(2);
  tabla=$('#tablaDetalle');
  html="<tr>"+
  "<td>"+cantidad+"</td>"+
  "<td>"+c1+"</td>"+
  "<td></td>"+
  "<td>$ "+c2+"</td>"+
  "<td>$ "+parseFloat(cantidad*c2).toFixed(2)+"</td>"+
  "<td>"+
  "<input type='hidden' name='tipo_detalle[]' value='2'>"+
  "<input type='hidden' name='f_producto[]' value='"+id+"'>"+
  "<input type='hidden' name='cantidad[]' value='"+cantidad+"'>"+
  "<input type='hidden' name='precio[]' value='"+c2+"'>"+
  "<button type='button' class='btn btn-xs btn-danger' id='eliminar_detalle'>"+
  "<i class='fa fa-remove'></i>"+
  "</button>"+
  "</td>"+
  "</tr>";
  tabla.append(html);
}
}
function validarFechaMenorActual(date){
  var f = new Date();
  actual= f.getFullYear() + "-" + (('0' + (f.getMonth()+1)).toString().slice(-2))+ "-" +'0' + (f.getDate()).toString().slice(-2) ;
      if (date > actual){
        return false;
        }
      else{
        return true;
      }
}
function limpiarCliente(){
  $('#f_cliente').val("");
  $('#f_clientea').val("");
}
