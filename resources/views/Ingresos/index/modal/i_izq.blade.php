<form action="" class="form-horizontal form-label-left input_mask">
  <div class="x_panel m_panel" style="height: auto" id="izq_interno">
    <div class="row">
      <h4>Registro</h4>
    </div>
    <div class="row">
      <input type="hidden" id="seleccion">
      <input type="hidden" id="cama" name="f_cama">
      <input type="hidden" id="tipo" name="tipo">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Paciente *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <div class="input-group">
            {!! Form::text('n_paciente',null,['id'=>'n_paciente','class'=>'form-control','placeholder'=>'Nombre del paciente','disabled']) !!}
            <span class="input-group-btn">
              <button type="button" name="button"  class="btn btn-primary" onclick="input_seleccion('paciente');">
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
      <div class="form-group">
        <center>
          <label>
            <input type="checkbox" name="c_responsable" id="c_responsable" class="js-switch" unchecked /> Añadir responsable
          </label>
        </center>
      </div>
      <div class="form-group" id="responsable_div" style="display: none">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Responsable </label>
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
          <select class="form-control" name="f_medico" id="f_medico">
            @foreach ($medicos as $medico)
              <option value={{$medico->id}}>{{(($medico->sexo)?'Dr. ':'Dra. ').$medico->apellido.', '.$medico->nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de ingreso *</label>
        <div class="col-md-9 col-sm-9 col-xs-12">
          <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
          <input type="datetime-local" name="fecha_ingreso" id="fecha_ingreso" class="form-control has-feedback-left" value={{$fecha->format('Y-m-d').'T'.$fecha->format('H:i')}} max={{$fecha->format('Y-m-d').'T'.$fecha->format('H:i')}}>
        </div>
      </div>
    </div>
    <div class="row">
      <center>
        <button type="button" class="btn btn-sm btn-primary" id="guardar_i">Guardar</button>
      </center>
    </div>
  </div>
</form>