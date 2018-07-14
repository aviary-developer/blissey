<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="laboratorio_m" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="row">
      <div role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-3">
          <div class="x_panel m_panel">
            @include('SolicitudExamenes.Formularios.opciones')
          </div>
        </div>
        <div class="col-xs-9">
          <div class="x_panel m_panel" style="height: 447px">
            @include('SolicitudExamenes.Formularios.contenido')
          </div>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" id="guardarSolicitudModal" class="btn btn-primary btn-sm">Guardar</button>
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal" onclick="location.reload();">Cerrar</button>
    </div>
  </div>
</div>
<script type="text/javascript">
var solicitudes=0;
  function input_seleccion(e){
    document.getElementById('seleccion').value = e;
  }
  async function agregarExamenEnSolicitud(boton){
        if (boton.className==="btn col-md-12 col-sm-12 col-xs-12 btn-defualt") {
          solicitudes=solicitudes+1;
          $("#totalSolicitudes").append('<li>'+boton.innerText+'</li>');
          new PNotify({
            title: 'Solicitud de:',
            type: 'success',
            text: '<strong>'+boton.innerText+'</strong> <i>¡Agregada!</i><br>Total solicitudes:'+solicitudes,
            nonblock: {
              nonblock: true
            },
            styling: 'bootstrap3',
            addclass: 'info'
          });
        } else if(boton.className==="btn col-md-12 col-sm-12 col-xs-12 btn-success") {
          solicitudes=solicitudes-1;
          new PNotify({
            title: 'Solicitud de:',
            type: 'warning',
            text:  '<strong>'+boton.innerText+'</strong> <i>¡Eliminada!</i><br>Total solicitudes:'+solicitudes,
            nonblock: {
              nonblock: true
            },
            styling: 'bootstrap3',
            addclass: 'info'
          });
        }
            }
</script>