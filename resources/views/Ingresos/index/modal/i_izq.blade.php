<form action="" class="form-horizontal form-label-left input_mask">
  <div class="x_panel m_panel" style="height: auto" id="izq_interno">
    <div class="row">
      <input type="hidden" id="seleccion">
      <input type="hidden" id="cama" name="f_cama">
      <input type="hidden" id="tipo" name="tipo">
      <div class="form-group col-sm-12">
        <label class="" for="n_paciente">Paciente *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
          {!! Form::text(
            'n_paciente',
            null,
            ['id'=>'n_paciente',
              'class'=>'form-control form-control-sm',
              'placeholder'=>'Nombre del paciente',
              'disabled']
          ) !!}
          <div class="input-group-append">
            <div class="input-group-btn ">
              <div class="btn-group">
                <button type="button" name="button"  class="btn btn-primary btn-sm" onclick="input_seleccion('paciente');">
                  <i class="fa fa-search"></i>
                </button>
                <button type="button" name="button" class="btn btn-success btn-sm" id="nueva_paciente"  title="Nuevo paciente" onclick="input_seleccion('paciente',1);">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="f_paciente" id="f_paciente">
      </div>
      <div class="form-group col-sm-12">
        <center>
          <label>
            <input type="checkbox" name="c_responsable" id="c_responsable" class="js-switch" unchecked /> Añadir responsable
          </label>
        </center>
      </div>
      <div class="form-group col-sm-12" id="responsable_div" style="display: none">
        <label class="" for="n_responsable">Responsable *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-user"></i></div>
          </div>
          {!! Form::text(
            'n_responsable',
            null,
            ['id'=>'n_responsable',
              'class'=>'form-control form-control-sm',
              'placeholder'=>'Nombre del responsable',
              'disabled']
          ) !!}
          <div class="input-group-append">
            <div class="input-group-btn ">
              <div class="btn-group">
                <button type="button" name="button"  class="btn btn-primary btn-sm" onclick="input_seleccion('responsable');">
                  <i class="fa fa-search"></i>
                </button>
                <button type="button" name="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_persona" id="nueva"  title="Nuevo responsable" onclick="input_seleccion('responsable',1);">
                  <i class="fa fa-plus"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" name="f_responsable" id="f_responsable">
      </div>
      <div class="form-group col-sm-12">
        <label class="" for="medico">Médico *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-stethoscope"></i></div>
          </div>
          <select class="form-control form-control-sm" name="f_medico" id="f_medico">
            @foreach ($medicos as $medico)
              <option value={{$medico->id}}>{{(($medico->sexo)?'Dr. ':'Dra. ').$medico->apellido.', '.$medico->nombre}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group col-sm-12">
        <label class="" for="fecha_ingreso">Fecha de ingreso *</label>
        <div class="input-group mb-2 mr-sm-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
          </div>
          <input type="datetime-local" name="fecha_ingreso" id="fecha_ingreso" class="form-control form-control-sm" value={{$fecha->format('Y-m-d').'T'.$fecha->format('H:i')}} max={{$fecha->format('Y-m-d').'T'.$fecha->format('H:i')}}>
        </div>
			</div>
			<div class="form-group col-sm-12" id="tipo_ingreso_div" style="display:none">
				<label class="" for="nombre">Tipo de ingreso *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div id="radioBtn" class="btn-group col-sm-12">
						<a class="btn btn-primary btn-sm active col-sm-6" data-toggle="tipo_ingreso_i" data-title="1" onclick="tipo_ingreso(0)">Ingreso</a>
						<a class="btn btn-primary btn-sm notActive col-sm-6" data-toggle="tipo_ingreso_i" data-title="0" onclick="tipo_ingreso(1)">Medio ingreso</a>
					</div>
					<input type="hidden" name="tipo_ingreso_i" id="tipo_ingreso_i" value="1">
				</div>
			</div>
    </div>
  </div>
</form>

<script>
	function tipo_ingreso(valor){
		$("#tipo").val(valor);
	}
</script>