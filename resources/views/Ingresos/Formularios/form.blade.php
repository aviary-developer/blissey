<div class="x_content">
  <br />
  <input type="hidden" id="seleccion">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Paciente *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="input-group">
        {!! Form::text('n_paciente',null,['id'=>'n_paciente','class'=>'form-control','placeholder'=>'Nombre del paciente','disabled']) !!}
        <span class="input-group-btn">
          <button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-primary" id="agregar_paciente" onclick="input_seleccion('paciente');">
            <i class="fa fa-search"></i>
          </button>
          <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target="#modal_persona" id="nueva_especialidad"  data-placement="top" title="Nuevo paciente" onclick="input_seleccion('paciente');">
            <i class="fa fa-plus"></i>
          </button>
        </span>
      </div>
      <input type="hidden" name="f_paciente" id="f_paciente">
    </div>
  </div>
  <input type="hidden" name="precio" id="precio" value="-1">
  <div class="form-group">
    <center>
      <label>
        <input type="checkbox" name="c_responsable" id="c_responsable" class="js-switch" unchecked /> Añadir responsable
      </label>
    </center>
  </div>
  <div class="form-group" id="responsable_div" style="display: none">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Responsable *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <div class="input-group">
        {!! Form::text('n_responsable',null,['id'=>'n_responsable','class'=>'form-control','placeholder'=>'Nombre del responsable','disabled']) !!}
        <span class="input-group-btn">
          <button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-primary" id="agregar_paciente" onclick="input_seleccion('responsable');">
            <i class="fa fa-search"></i>
          </button>
          <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target="#modal_persona" id="nueva_especialidad"  data-placement="top" title="Nuevo paciente" onclick="input_seleccion('responsable');">
            <i class="fa fa-plus"></i>
          </button>
        </span>
      </div>
      <input type="hidden" name="f_responsable" id="f_responsable">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-xs-12">Médico *</label>
    <div class="col-md-9 col-xs-12">
      <select class="form-control" name="f_medico">
        @foreach ($medicos as $medico)
          <option value={{$medico->id}}>{{(($medico->sexo)?'Dr. ':'Dra. ').$medico->apellido.', '.$medico->nombre}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-xs-12">Tipo de servicio médico *</label>
    <div class="col-md-9 col-xs-12">
      <select class="form-control" name="tipo" id="tipo_ingreso">
        <option value="3">Consulta médica</option>
        <option value="0">Ingreso</option>
        <option value="1">Observación</option>
        <option value="2">Medio ingreso</option>
        <option value="4">Cumplimiento</option>
      </select>
    </div>
  </div>
  <div class="form-group" id="observaciones_form_ingreso" style="display:none">
    <label class="control-label col-md-3 col-xs-12">Habitación *</label>
    <div class="col-md-9 col-xs-12">
      <select class="form-control" name="f_habitacion">
        @if ($observaciones==null)
            <option value="0" disabled>No hay habitaciones disponibles</option>
        @else
          @foreach ($observaciones as $habitacion)
            <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
          @endforeach
        @endif
      </select>
    </div>
  </div>
  <div class="form-group" id="habitacion_form_ingreso" style="display:none">
    <label class="control-label col-md-3 col-xs-12">Habitación *</label>
    <div class="col-md-9 col-xs-12">
      <select class="form-control" name="f_habitacion">
        @if ($habitaciones==null)
            <option value="0" disabled>No hay habitaciones disponibles</option>
        @else
          @foreach ($habitaciones as $habitacion)
            <option value={{$habitacion->id}}>{{'Habitación '.$habitacion->numero}}</option>
          @endforeach
        @endif
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de ingreso *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
      <input type="datetime-local" name="fecha_ingreso" class="form-control has-feedback-left" value={{$fecha->format('Y-m-d').'T'.$fecha->format('H:i')}} max={{$fecha->format('Y-m-d').'T'.$fecha->format('H:i')}}>
    </div>
  </div>
  <center>
    <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      <button type="button" class="btn btn-primary" id="guardar_ingreso">Guardar</button>
      <button type="reset" name="button" class="btn btn-light">Limpiar</button>
      <a href={!! asset($ruta) !!} class="btn btn-light">Cancelar</a>
    </center>
  </div>
</div>

@include('Ingresos.Formularios.modal_paciente')

<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
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
                  <th style="width: 80px">Acción</th>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function input_seleccion(e){
    document.getElementById('seleccion').value = e;
  }
</script>
