<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal_persona" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Crear persona</h4>
      </div>

      <div class="modal-body">
        <div class="x_panel">
          <div class="col-sm-6 col-xs-12">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('nombre',null,['id'=>'nombre_paciente','class'=>'form-control has-feedback-left','placeholder'=>'Nombre de la persona']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('apellido',null,['id'=>'apellido_paciente','class'=>'form-control has-feedback-left','placeholder'=>'Apellido de la persona']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo *</label>
              &nbsp;&nbsp;&nbsp;
              <div id="radioBtn" class="btn-group">
                <a class="btn btn-primary btn-sm active" data-toggle="sexo" data-title="1">Masculino</a>
                <a class="btn btn-primary btn-sm notActive" data-toggle="sexo" data-title="0">Femenino</a>
              </div>
              <input type="hidden" name="sexo" id="sexo" value="1">
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de nacimiento *</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                @php
                  $ahora = Carbon\Carbon::now();
                @endphp
                {!! Form::date('fechaNacimiento',$fecha,['id'=>'fecha_paciente','max'=>$ahora->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
              </div>
            </div>
            <div class="form-group" id="dui_paciente" style="display: none;">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('dui',null,['id'=>'dui_paciente_campo','class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('telefono',null,['id'=>'telefono_paciente','class'=>'form-control has-feedback-left','placeholder'=>'Ej. 7000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xs-12">           
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Residencia </label>
              &nbsp;&nbsp;&nbsp;
              <div id="radioBtn" class="btn-group">
                <a class="btn btn-info btn-sm active radio-pais" data-toggle="residencia_paciente" data-title="1" style="color: black">Nacional</a>
                <a class="btn btn-info btn-sm notActive radio-pais" data-toggle="residencia_paciente" data-title="0" style="color: black">Extranjera</a>
              </div>
              <input type="hidden" name="residencia_paciente" id="residencia_paciente" value="1">
            </div>
            <div class="form-group" id="pais_div" style="display:none;">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">País</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-flag form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('pais',null,['id'=>'pais_paciente','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del país']) !!}
              </div>
            </div>
            <div id="departamento_div" class='form-group'>
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Departamento </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class='fa fa-map-marker form-control-feedback left' aria-hidden='true'></span>
                <select class='form-control has-feedback-left' id="departamento_select" name="departamento">
                  
                  <option value="San Salvador">San Salvador</option>
                  <option value="Santa Ana">Santa Ana</option>
                  <option value="San Miguel">San Miguel</option>
                  <option value="La Libertad">La Libertad</option>
                  <option value="Usulután">Usulután</option>
                  <option value="Sonsonate">Sonsonate</option>
                  <option value="La Unión">La Unión</option>
                  <option value="La Paz">La Paz</option>
                  <option value="Chalatenango">Chalatenango</option>
                  <option value="Cuscatlán">Cuscatlán</option>
                  <option value="Ahuachapán">Ahuachapán</option>
                  <option value="Morazán">Morazán</option>
                  <option value="San Vicente" selected>San Vicente</option>  
                  <option value="Cabañas">Cabañas</option>
                </select>
              </div>
            </div>
            <div id="municipio_div" class='form-group'>
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Municipio </label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class='fa fa-map-marker form-control-feedback left' aria-hidden='true'></span>
                <select class='form-control has-feedback-left' id="municipio_select" name="municipio">
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
                {!! Form::textarea('direccion',null,['id'=>'direccion_paciente','class'=>'form-control has-feedback-left','placeholder'=>'Dirección del nuevo paciente','rows'=>'3']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Alergia a</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-medkit form-control-feedback left" aria-hidden="true"></span>
                {!! Form::textarea('alergia',null,['id'=>'alergia_paciente','class'=>'form-control has-feedback-left','placeholder'=>'Alergias del paciente','rows'=>'2']) !!}
              </div>
            </div>
          </div>
          <center class="col-xs-12">
            <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
          </center>
        </div>
        <input type="hidden" id="tokenPaciente" name="tokenPaciente" value="<?php echo csrf_token(); ?>">
        <div class="clearfix"></div>
      </div>

      <div class="modal-footer">
        <button type="button" id="guardarPaciente" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>