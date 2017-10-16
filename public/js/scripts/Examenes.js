var contadorSelectsParametros=0;
$('#agregarSeccionExamen').click(function(){
  $('.seccionesExamenes').append( "<div class='col-md-6 col-sm-6 col-xs-12'>"+
  "<div class='x_panel'>"+
  "<div class='x_title'>"+
  "<div class='col-md-9 col-sm-9 col-xs-12'>"+
  "<span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>"+
  "<input type='text' name='nombreSeccion[]' class='form-control has-feedback-left' placeholder='Nombre de sección...' required></div>"+
  "<ul class='nav navbar-right panel_toolbox'>"+
  "<li><a class='collapse-link' ><i class='fa fa-chevron-up'></i></a></li>"+
  "<li><a class='close-link' onClick='cerrarSeccion(this);'><i class='fa fa-close'></i></a></li>"+
  "</ul><div class='clearfix'></div></div>"+
  "<div class='x_content'>"+
  "<div class='col-md-9 col-sm-9 col-xs-6'><span class='fa fa-flask form-control-feedback left' aria-hidden='true'></span>"+
  "<select class='form-control has-feedback-left' name='selectParametrosExamenes"+contadorSelectsParametros+"' id='selectParametrosExamenes"+contadorSelectsParametros+"'>"+
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
