  $("#resultado").keyup(function(){
    var valor = $("#resultado").val();
    var tipo  = $("#tipo").val();
    var usuario= $("#tipoUsuario").val();
    var laboratorio=$("#f_proveedor").val();
    if(valor.length > 2){
      if(tipo==0 && usuario=="Farmacia"){ //Venta a clientes
        var ruta = "/blissey/public/buscarProductoTransaccion/"+laboratorio+"/"+valor;
        var tabla = $("#tablaBuscar");
        $.get(ruta,function(res){
            $(res).each(function(key,value){
              alert(value.nombre);
            });
        });

      }else{      //Compra a proveedores

      }
    }
});
