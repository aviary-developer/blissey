var contadorSelectsParametros=0;
$('#agregarSeccionExamen').click(function(){
  $('.seccionesExamenes').append( "<div class='col-md-6 col-sm-6 col-xs-12'>"+
  "<div class='x_panel'>"+
  "<div class='x_title'>"+
  "<div class='col-md-9 col-sm-9 col-xs-12'>"+
  "<span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>"+
  "<select class='form-control has-feedback-left' name='selectSeccion"+contadorSelectsParametros+"' id='selectSeccion"+contadorSelectsParametros+"'><option><strong>Cargando...</strong></option></select></div>"+
  "<ul class='nav navbar-right panel_toolbox'>"+
  "<li><a class='close-link' onClick='cerrarSeccion(this);'><i class='fa fa-close'></i></a></li>"+
  "</ul><div class='clearfix'></div></div>"+
  "<div class='x_content'>"+
  "<div class='col-md-9 col-sm-9 col-xs-6'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span>"+
  "<select class='form-control has-feedback-left' name='selectParametrosExamenes"+contadorSelectsParametros+"' id='selectParametrosExamenes"+contadorSelectsParametros+"' onChange='agregarParametro(this,"+contadorSelectsParametros+")';><option><strong>Cargando...</strong></option></select><hr>"+
  "<table class='table' id='tablaParametros"+contadorSelectsParametros+"'><thead><th>Parametros</th><th style='width : 80px'>Acción</th></thead>"+
  "<tbody></tbody></table>"+
  "</div></div></div></div>" );
  llenarSecciones();
  llenarParametros();
  contadorSelectsParametros++;
  $("#totalSecciones").val(contadorSelectsParametros);
});
function cerrarSeccion(seccion){
  var $BOX_PANEL=seccion.closest('.x_panel');
  $BOX_PANEL.remove();
  contadorSelectsParametros--;
  $("#totalSecciones").val(contadorSelectsParametros);
}
function llenarSecciones(){
  var secciones=$("#selectSeccion"+contadorSelectsParametros);
  var ruta="/blissey/public/llenarSeccionExamenes";
  $.get(ruta,function(res){
    secciones.empty();
    secciones.append("<option value='0' readonly='readonly'>[Seleccione sección]</option>");
    $(res).each(function(key,value){
      secciones.append("<option value='"+value.id+"'>"+value.nombre+"</option>");
    });
  });
}
function llenarParametros(){
  var parametros=$("#selectParametrosExamenes"+contadorSelectsParametros);
  var ruta="/blissey/public/llenarParametrosExamenes";
  $.get(ruta,function(res){
    parametros.empty();
    //parametros.append("<option value='-1' readonly='readonly'>[Seleccione parametros]</option>");
    $(res).each(function(key,value){
      parametros.append("<option value='"+value.id+"'>"+value.nombreParametro+"</option>");
    });
  });
}
$('#guardarParametroModal').click(function(){
  var nombre = $("#nombreParametroModal").val();
  var unidad = $("#unidadModal").val();
  var valorMinimo= $('#valorMinimoModal').val();
  var valorMaximo= $('#valorMaximoModal').val();
  var valorPredeterminado= $('#valorPredeterminadoModal').val();
  var ruta="/blissey/public/ingresoParametro";
  var token=$('#tokenParametroModal').val();
  $.ajax({
    url:ruta,
    headers:{'X-CSRF-TOKEN':token},
    type:'POST',
    dataType:'json',
    data:{nombreParametro:nombre,unidad:unidad,valorMinimo:valorMinimo,valorMaximo:valorMaximo,valorPredeterminado:valorPredeterminado},
    success: function(){
      $(".modal").modal('toggle');
    }
  });
  var paso=-1;
  swal({
    title: 'Parametro registrado!',
    text: 'Cargando información',
    timer: 3000,
    onOpen: function () {
      swal.showLoading()
    }
  }).then(
    function () {},
    function (dismiss) {
      if (dismiss === 'timer') {
        console.log('cerrado timer de parametros en examenes')
      }
    }
  )
  for (paso = -1; paso < contadorSelectsParametros; paso++) {
    rellenarCombosParametros(paso);
  }
  $("#nombreParametroModal").val("");
  $('#valorMinimoModal').val("");
  $('#valorMaximoModal').val("");
  $('#valorPredeterminadoModal').val("");
});
function rellenarCombosParametros(paso){
  var parametros=$("#selectParametrosExamenes"+paso);
  var ruta="/blissey/public/llenarParametrosExamenes";
  $.get(ruta,function(res){
    parametros.empty();
    $(res).each(function(key,value){
      parametros.append("<option value='"+value.id+"'>"+value.nombreParametro+"</option>");
    });
  });
}
 function agregarParametro(parametro,paso){
   console.log("PASo: "+paso);
   var valorParametro=parametro.value;
   var textoParametro=parametro.options[parametro.selectedIndex].text;
   var tablaActual=$("#tablaParametros"+paso);
   var tablaAVerificar=$("#tablaParametros"+paso+" tbody tr");
   var html_texto = "<tr>"+
   "<td>"+
   "<input type='hidden' id='parametrosEnTabla"+paso+"[]' name='parametrosEnTabla"+paso+"[]' value = '"+valorParametro+"'/>"+
   textoParametro+
   "</td>"+
   "<td>"+
     "<button type = 'button' name='button' class='btn btn-danger btn-xs' onClick='eliminarParametroEnTabla(this);'>"+
       "<i class='fa fa-remove'></i>"+
     "</button>"+
   "</td>"+
   "<select class='form-control has-feedback-left' name='selectReactivos"+contadorSelectsParametros+"' id='selectReactivos"+contadorSelectsParametros+"' onChange='agregarParametro(this,"+contadorSelectsParametros+")';><option><strong>Cargando...</strong></option></select>"+
   "</tr>";
   if(verificarParametroEnTabla(tablaAVerificar,textoParametro)==true){
   $(tablaActual).append(html_texto);}else{
     swal({
  type: 'error',
  title: '¡Ya esta agregado!',
  showConfirmButton: false,
  timer: 1500,
  animation: false,
  customClass: 'animated tada'
}).catch(swal.noop);
   }
 }
 function verificarParametroEnTabla(tabla,nombreParametro){
   var bandera=true;
   $(tabla).each(function(key,value){
     if($(this).text().trim()==nombreParametro){
       bandera=false;
       console.log($(this).text().trim()+" IGUALES "+nombreParametro);
     }
 });
 return bandera;
 }
 function eliminarParametroEnTabla(tabla){
   $(tabla).parent('td').parent('tr').remove();
 }

 ////////////////////////////////////SCRIPTS DE EDITAR
 var contadorEnEditar=$("#contadorEnEdit").val();
 $('#agregarSeccionExamenEditar').click(function(){
   if(!contadorEnEditar){
     contadorEnEditar=0;
   }
   console.log(contadorEnEditar);
   $('.seccionesExamenes').append( "<div class='col-md-6 col-sm-6 col-xs-12'>"+
   "<div class='x_panel'>"+
   "<div class='x_title'>"+
   "<div class='col-md-9 col-sm-9 col-xs-12'>"+
   "<span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>"+
   "<select class='form-control has-feedback-left' name='selectSeccion"+contadorEnEditar+"' id='selectSeccion"+contadorEnEditar+"'><option><strong>Cargando...</strong></option></select></div>"+
   "<ul class='nav navbar-right panel_toolbox'>"+
   "<li><a class='close-link' onClick='cerrarSeccionEditar(this,contadorEnEditar);'><i class='fa fa-close'></i></a></li>"+
   "</ul><div class='clearfix'></div></div>"+
   "<div class='x_content'>"+
   "<div class='col-md-9 col-sm-9 col-xs-6'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span>"+
   "<select class='form-control has-feedback-left' name='selectParametrosExamenes"+contadorEnEditar+"' id='selectParametrosExamenes"+contadorEnEditar+"' onChange='agregarParametro(this,"+contadorEnEditar+")';><option><strong>Cargando...</strong></option></select><hr>"+
   "<table class='table' id='tablaParametros"+contadorEnEditar+"'><thead><th>Parametros</th><th style='width : 80px'>Acción</th></thead>"+
   "<tbody></tbody></table>"+
   "</div></div></div></div>" );
   llenarSeccionesEditar();
   llenarParametrosEditar();
   contadorEnEditar++;
   $("#contadorEnEdit").val(contadorEnEditar);
   $("#contadorTotal").val(contadorEnEditar);
   alert($("#contadorTotal").val());
 });
 function cerrarSeccionEditar(seccion,paso){
   disminuiContadorSeccionesEnEditar(paso);
   var $BOX_PANEL=seccion.closest('.x_panel');
   $BOX_PANEL.remove();
 }
 function disminuiContadorSeccionesEnEditar(paso){
   contadorEnEditar--;
   $("#contadorEnEdit").val(contadorEnEditar);
 }
 function llenarSeccionesEditar(){
   var secciones=$("#selectSeccion"+contadorEnEditar);
   var ruta="/blissey/public/llenarSeccionExamenes";
   $.get(ruta,function(res){
     secciones.empty();
     secciones.append("<option value='0' readonly='readonly'>[Seleccione sección]</option>");
     $(res).each(function(key,value){
       secciones.append("<option value='"+value.id+"'>"+value.nombre+"</option>");
     });
   });
 }
 function llenarParametrosEditar(){
   var parametros=$("#selectParametrosExamenes"+contadorEnEditar);
   var ruta="/blissey/public/llenarParametrosExamenes";
   $.get(ruta,function(res){
     parametros.empty();
     //parametros.append("<option value='-1' readonly='readonly'>[Seleccione parametros]</option>");
     $(res).each(function(key,value){
       parametros.append("<option value='"+value.id+"'>"+value.nombreParametro+"</option>");
     });
   });
 }
