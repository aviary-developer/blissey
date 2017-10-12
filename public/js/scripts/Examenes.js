$('#agregarSeccionExamen').click(function(){
  $('.seccionesExamenes').append( "<div class='col-md-6 col-sm-6 col-xs-12'>"+
      "<div class='x_panel'>"+
      "<div class='x_title'>"+
        "<div class='col-md-9 col-sm-9 col-xs-12'>"+
          "<span class='fa fa-bars form-control-feedback left' aria-hidden='true'></span>"+
          "<input type='text' name='nombreSeccion[]' class='form-control has-feedback-left' placeholder='Nombre de sección...'></div>"+
        "<ul class='nav navbar-right panel_toolbox'>"+
          "<li><a class='collapse-link' ><i class='fa fa-chevron-up'></i></a></li>"+
          "<li><a class='close-link' onClick='cerrarSeccion(this);'><i class='fa fa-close'></i></a></li>"+
        "</ul><div class='clearfix'></div></div>"+
        "<div class='x_content'>"+
              "AQUI IRIAN LOS parametros"+
      "</div></div></div>" );
    });
function cerrarSeccion(seccion){
  var $BOX_PANEL=seccion.closest('.x_panel');
   $BOX_PANEL.remove();
}
