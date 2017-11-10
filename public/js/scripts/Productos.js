$(document).on('ready',function(){
  var division_agregada = [];
  var componentes_agregados = [];
  var codigos_agregados= [];
  var limite_divisiones = $("#contador_division").val();
  var limite_componente = $("#contador_componente").val();
  for (i = 0; i <= limite_divisiones; i++) {
    var division_tmp = $("#division"+i).val();
    division_agregada.push(division_tmp);
  }
  for(i=0;i <= limite_componente; i++){
    var componente_tmp = $("#componente"+i).val();
    componentes_agregados.push(componente_tmp);
  }
  $('#agregar_division').click(function(){
    var codigo = $('#codigo').val();
    var division = $('#division').find('option:selected').text();
    var valor = $('#division').find('option:selected').val();
    var cantidad = $('#cantidad').val();
    var precio = $('#precio').val();
    if(!codigos_agregados.includes(codigo) && !division_agregada.includes(valor)){
    var html_texto =
    "<tr>"+
    "<td>"+
      codigo+
    "</td>"+
      "<td>"+
        division+
      "</td>"+
      "<td>"+
        cantidad+
      "</td>"+
      "<td>"+
        "$ "+precio+
      "</td>"+
      "<td>"+
        "<input type='hidden' name='divisiones[]' value='"+valor+"'/>"+
        "<input type='hidden' name='codigos[]' value='"+codigo+"'/>"+
        "<input type='hidden' name='cantidades[]' value='"+cantidad+"'/>"+
        "<input type='hidden' name='precios[]' value='"+precio+"'/>"+
        "<button type='button' name='button' class='btn btn-xs btn-danger' id='eliminar_division'>"+
          "<i class='fa fa-remove'></i>"+
        "</button>"+
      "</td>"+
    "</tr>";

      division_agregada.push(valor);
      codigos_agregados.push(codigo);
      $("#tablaDivision").append(html_texto);
      $("#cantidad").val("1");
      $("#precio").val("0.00");
    }
  });

  $("#tablaDivision").on('click','#eliminar_division',function(e){
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var cod = $(this).parents('tr').find('input:eq(1)').val();
    var indice = division_agregada.indexOf(elemento);
    var indice2 = codigos_agregados.indexOf(cod);
    division_agregada.splice(indice);
    codigos_agregados.splice(indice2);
    $(this).parent('td').parent('tr').remove();
  });

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

  $("#tablaBuscarComponente").on('click','#agregar_componente',function(e){
    e.preventDefault();
    var nombre = $(this).parents('tr').find('input:eq(0)').val();
    var id = $(this).parents('tr').find('input:eq(1)').val();
    var tabla = $("#tablaComponente");
    var tabla_busqueda = $("#tablaBuscarComponente");
    var cantidad = $("#cantidad_componente").val();
    var unidad = $("#unidad").find("option:selected").text();
    var unidad_id = $("#unidad").find("option:selected").val();
    var html =
    "<tr>"+
      "<td>"+
        nombre+
      "</td>"+
      "<td>"+
        cantidad+" "+unidad+
      "</td>"+
      "<td>"+
        "<input type='hidden' name='componentes[]' value ='"+id+"'>"+
        "<input type='hidden' name='cantidades_componentes[]' value ='"+cantidad+"'>"+
        "<input type='hidden' name='unidades[]' value ='"+unidad_id+"'>"+
        "<button type='button' class='btn btn-xs btn-danger' id='eliminar_componente'>"+
          "<i class='fa fa-remove'></i>"+
        "</button>"+
      "</td>"+
    "</tr>";
    if(componentes_agregados.indexOf(id)==-1){
      componentes_agregados.push(id);
      tabla.append(html);

      tabla_busqueda.empty();
      head =
      "<thead>"+
        "<th>Componente</th>"+
        "<th style='width : 80px'>Acción</th>"+
      "</thead>";
      tabla_busqueda.append(head);

      $("#cantidad_componente").val("1");
      $("#componente").val("");

      $("#componente").focus();
    }
  });

  $("#tablaComponente").on('click','#eliminar_componente',function(e){
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var indice = componentes_agregados.indexOf(elemento);
    componentes_agregados.splice(indice);
    $(this).parent('td').parent('tr').remove();
  });

  $("#tablaDivision").on("click",'#eliminar_division_antigua',function(e){
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var indice = division_agregada.indexOf(elemento);
    division_agregada.splice(indice);

    var valores = $(this).parents('tr').find('input:eq(1)').val();
    $("#division_eliminada").val(valores);
    $(this).parent('td').parent('tr').remove();
  });

  $("#tablaComponente").on('click','#eliminar_componente_antiguo',function(e){
    e.preventDefault();
    var elemento = $(this).parents('tr').find('input:eq(0)').val();
    var indice = componentes_agregados.indexOf(elemento);
    componentes_agregados.splice(indice);

    var valores = $(this).parents('tr').find('input:eq(1)').val();
    $("#componente_eliminado").val(valores);
    $(this).parent('td').parent('tr').remove();
  });

  $("#codigo").keyup(function(){
    var codigo = $("#codigo").val();
    if(codigo!="")
    var ruta="/blissey/public/existeCodigoProducto/"+codigo;
    $.get(ruta,function(existe){
      if(existe==1){
        swal({
          type: 'error',
          title: '¡Ya existe una división con el código '+codigo+'!',
          showConfirmButton: false,
          timer: 2000,
          animation: false,
          customClass: 'animated tada'
        }).catch(swal.noop);
        $("#codigo").val("");
      }
    });
  });
});
