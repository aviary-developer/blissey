<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="laboratorio_m" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div class="col-sm-12">
        <div class="col-sm-12">
          <div class="x_panel m_panel text-danger">
            <center>
              <h4 class="mb-1">
                <i class="fas fa-microscope"></i>
                Laboratorio Clínico
              </h4>
            </center>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div role="tabpanel" data-example-id="togglable-tabs">
          <div class="col-sm-3">
            <div class="x_panel m_panel">
              @include('SolicitudExamenes.Formularios.opciones')
            </div>
          </div>
          <div class="col-sm-9">
            <div class="x_panel m_panel" style="height: 369px">
              @include('SolicitudExamenes.Formularios.contenido')
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="m_panel x_panel bg-transparent" style="border:0px !important">
      <center>
        <button type="button" id="guardarSolicitudModal" class="btn btn-primary btn-sm col-2">Guardar</button>
        <button type="button" class="btn btn-light col-2 btn-sm" onclick="location.reload()">Cerrar</button>
      </center>
    </div>
  </div>
</div>
<script type="text/javascript">
var solicitudes=0;
  function input_seleccion(e){
    document.getElementById('seleccion').value = e;
  }
  async function agregarExamenEnSolicitud(boton){
    if (boton.className==="btn col-12 btn-sm btn-defualt") {
      solicitudes=solicitudes+1;
      $("#totalSolicitudes").append('<li>'+boton.innerText+'</li>');
      swal({
        type: 'success',
        html: '<span class="text-uppercase font-weight-bold mb-1">Solicitud</span><br><strong>'+boton.innerText+'</strong> <i>¡Agregada!</i><br>Total solicitudes:'+solicitudes,
        toast: true,
        position: 'top-end',
        timer: '4000',
        showConfirmButton: false
      });
    } else if(boton.className==="btn col-12 btn-sm btn-success") {
      solicitudes=solicitudes-1;
      swal({
        type: 'warning',
        html: '<span class="text-uppercase font-weight-bold mb-1">Solicitud</span><br><strong>'+boton.innerText+'</strong> <i>¡Eliminada!</i><br>Total solicitudes:'+solicitudes,
        toast: true,
        position: 'top-end',
        timer: '4000',
        showConfirmButton: false
      });
    }
  }

  async function agregarExamenEnSolicitud2(boton){
    if (boton.className==="btn btn-sm col-sm-12 btn-defualt") {
      solicitudes=solicitudes+1;
      $("#totalSolicitudes").append('<li>'+boton.innerText+'</li>');
      swal({
        type: 'success',
        html: '<span class="text-uppercase font-weight-bold mb-1">Solicitud</span><br><strong>'+boton.innerText+'</strong> <i>¡Agregada!</i><br>Total solicitudes:'+solicitudes,
        toast: true,
        position: 'top-end',
        timer: '4000',
        showConfirmButton: false
      });

      var panel = $("#texto_receta_laboratorio");
      var texto_boton = $(boton).find('span').text();
      var selector = texto_boton.replace(/ /g,'-');

      var html = '<div class="row" id="' + selector + '" style="margin: 0px 10px 0px 15px">'+
        '<p style="font-size: medium">'+
          '<i class="fa fa-check text-primary"></i> '+
          'Realizarse un examen de <b class="text-primary">' + texto_boton + '</b>' +
        '</p>'+
        '</div>';
      
      panel.append(html);
    } else if(boton.className==="btn btn-sm col-sm-12 btn-success") {
      solicitudes=solicitudes-1;
      swal({
        type: 'warning',
        html: '<span class="text-uppercase font-weight-bold mb-1">Solicitud</span><br><strong>'+boton.innerText+'</strong> <i>¡Eliminada!</i><br>Total solicitudes:'+solicitudes,
        toast: true,
        position: 'top-end',
        timer: '4000',
        showConfirmButton: false
      });

      var texto_boton = $(boton).find('span').text();
      var selector = texto_boton.replace(/ /g,'-');
      $("#"+selector).remove();
    }
  }
</script>