<div class="x_panel">
  <input type="hidden" id="seleccion">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Paciente *</label>
    <div class="col-md-7 col-sm-7 col-xs-12">
      <div class="input-group">
        {!! Form::text('n_paciente',null,['id'=>'n_paciente','class'=>'form-control','placeholder'=>'Nombre del paciente', 'disabled']) !!}
        <span class="input-group-btn">
          <button type="button" name="button" data-toggle="modal" data-target="#modal_" class="btn btn-primary" id="agregar_paciente" onclick="input_seleccion('solicitud');" data-tooltip="tooltip" title="Buscar Paciente">
            <i class="fa fa-search"></i>
          </button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#solicitud_m" data-tooltip="tooltip" title="Buscar Receta">
            <i class="fa fa-medkit"></i>
          </button>
        </span>
      </div>
      <input type="hidden" name="f_paciente" id="f_paciente">
    </div>
  </div>
</div>

<div class="row">
  @include('SolicitudExamenes.Formularios.examenes')
  <input type="hidden" id="seleccion" value="solicitud">
  <input type="hidden" name="tipo" value="examenes">
</div>

<div class="x_panel" style="margin-bottom: 50px;">
  <div class="row">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-sm btn-primary']) !!}
      <a href={!! asset($ruta) !!} class="btn btn-default btn-sm">Cancelar</a>
    </center>
  </div>
</div>

@include('Recetas.modal.solicitud')
@include('SolicitudExamenes.Formularios.buscar_paciente')

{{--  <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Buscar</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel" style="height:300px">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
            <div class="col-md-7 col-sm-7 col-xs-12">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('busqueda',null,['id'=>'busqueda','class'=>'form-control has-feedback-left','placeholder'=>'Nombre o apellido del usuario']) !!}
            </div>
          </div>
          <div class="row">
            <div class="col-md-2 col-xs-12"></div>
            <div class="col-md-8 col-xs-12">
              <table class="table" id="tablaPaciente">
                <thead>
                  <th>Nombre</th>
                  <th style="width: 80px">Opciones</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>  --}}

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
