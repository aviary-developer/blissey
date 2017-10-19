var contadorSelectsParametros=0;
$('#agregarSeccionExamen').click(function(){
  $('.seccionesExamenes').append( "<div class='col-md-6 col-sm-6 col-xs-12'>"+
  "<div class='x_panel'>"+
  "<div class='x_title'>"+
  "<div class='col-md-9 col-sm-9 col-xs-12'>"+
  "<span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>"+
  "<input type='text' name='nombreSeccion[]' class='form-control has-feedback-left' placeholder='Nombre de sección...' required></div>"+
  "<ul class='nav navbar-right panel_toolbox'>"+
  "<li><a class='close-link' onClick='cerrarSeccion(this);'><i class='fa fa-close'></i></a></li>"+
  "</ul><div class='clearfix'></div></div>"+
  "<div class='x_content'>"+
  "<div class='col-md-9 col-sm-9 col-xs-6'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span>"+
  "<select class='form-control has-feedback-left' name='selectParametrosExamenes"+contadorSelectsParametros+"' id='selectParametrosExamenes"+contadorSelectsParametros+"' onChange='agregarParametro(this,"+contadorSelectsParametros+")';><option><strong>Cargando...</strong></option></select><hr>"+
  "<table class='table' id='tablaParametros"+contadorSelectsParametros+"'><thead><th>Parametros</th><th style='width : 80px'>Acción</th></thead>"+
  "<tbody></tbody></table>"+
  "</div></div></div></div>" );
  llenarParametros();
  contadorSelectsParametros++;
});
function cerrarSeccion(seccion){
  var $BOX_PANEL=seccion.closest('.x_panel');
  $BOX_PANEL.remove();
}
function llenarParametros(){
  var parametros=$("#selectParametrosExamenes"+contadorSelectsParametros);
  var ruta="/blissey/public/llenarParametrosExamenes";
  $.get(ruta,function(res){
    parametros.empty();
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
   var valorParametro=parametro.value;
   var textoParametro=parametro.options[parametro.selectedIndex].text;
   var tablaActual=$("#tablaParametros"+paso);
   var html_texto = "<tr>"+
   "<td>"+
   "<input type='hidden' name='parametrosEnTabla"+paso+"[]' value = '"+valorParametro+"'/>"+
   textoParametro+
   "</td>"+
   "<td>"+
     "<button type = 'button' name='button' class='btn btn-danger btn-xs' onClick='eliminarParametroEnTabla"+paso+"'>"+
       "<i class='fa fa-remove'></i>"+
     "</button>"+
   "</td>"+
   "</tr>";
   $(tablaActual).append(html_texto);
 }
