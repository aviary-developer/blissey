<div class="x_content">
  <br />
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo paciente']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('apellido',null,['class'=>'form-control has-feedback-left','placeholder'=>'Apellido del nuevo paciente']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo *</label>
    &nbsp;&nbsp;&nbsp;
    @if ($create)    
      <div id="radioBtn" class="btn-group">
        <a class="btn btn-primary btn-sm active" data-toggle="sexo" data-title="1">Masculino</a>
        <a class="btn btn-primary btn-sm notActive" data-toggle="sexo" data-title="0">Femenino</a>
      </div>
      <input type="hidden" name="sexo" id="sexo" value="1">
    @else
      @if ($pacientes->sexo)
        <div id="radioBtn" class="btn-group">
          <a class="btn btn-primary btn-sm active" data-toggle="sexo" data-title="1">Masculino</a>
          <a class="btn btn-primary btn-sm notActive" data-toggle="sexo" data-title="0">Femenino</a>
        </div>
        <input type="hidden" name="sexo" id="sexo" value="1">
      @else
        <div id="radioBtn" class="btn-group">
          <a class="btn btn-primary btn-sm notActive" data-toggle="sexo" data-title="1">Masculino</a>
          <a class="btn btn-primary btn-sm active" data-toggle="sexo" data-title="0">Femenino</a>
        </div>
        <input type="hidden" name="sexo" id="sexo" value="0">
      @endif
    @endif
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
  @if ($create)
    <div class="form-group" id="dui_paciente" style="display: none;">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('dui',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
      </div>
    </div>
  @else
    @if ($pacientes->fechaNacimiento->age >= 18)
        <div class="form-group" id="dui_paciente">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('dui',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
          </div>
        </div>
    @else
        <div class="form-group" id="dui_paciente" style="display: none;">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI</label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <span class="fa fa-credit-card form-control-feedback left" aria-hidden="true"></span>
            {!! Form::text('dui',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
          </div>
        </div>
    @endif
  @endif
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('telefono',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 7000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Residencia </label>
    &nbsp;&nbsp;&nbsp;
    @if ($create)
      <div id="radioBtn" class="btn-group">
        <a class="btn btn-info btn-sm active radio-pais" data-toggle="residencia_paciente" data-title="1" style="color: black">Nacional</a>
        <a class="btn btn-info btn-sm notActive radio-pais" data-toggle="residencia_paciente" data-title="0" style="color: black">Extranjera</a>
      </div>
      <input type="hidden" name="residencia_paciente" id="residencia_paciente" value="1">
    @else
      @if ($pacientes->pais != null)
        <div id="radioBtn" class="btn-group">
          <a class="btn btn-info btn-sm notActive radio-pais" data-toggle="residencia_paciente" data-title="1" style="color: black">Nacional</a>
          <a class="btn btn-info btn-sm Active radio-pais" data-toggle="residencia_paciente" data-title="0" style="color: black">Extranjera</a>
        </div>
        <input type="hidden" name="residencia_paciente" id="residencia_paciente" value="0">
      @else
        <div id="radioBtn" class="btn-group">
          <a class="btn btn-info btn-sm active radio-pais" data-toggle="residencia_paciente" data-title="1" style="color: black">Nacional</a>
          <a class="btn btn-info btn-sm notActive radio-pais" data-toggle="residencia_paciente" data-title="0" style="color: black">Extranjera</a>
        </div>
        <input type="hidden" name="residencia_paciente" id="residencia_paciente" value="1">
      @endif
        
    @endif
  </div>
  <div class="form-group" id="pais_div" style="display:none;">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">País</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-flag form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('pais',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del país']) !!}
    </div>
  </div>
  <div id="departamento_div" class='form-group'>
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Departamento </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class='fa fa-map-marker form-control-feedback left' aria-hidden='true'></span>
      <select class='form-control has-feedback-left' id="departamento_select" name="departamento">
        @if (!$create && $pacientes->departamento == "San Salvador")
          <option value="San Salvador" selected>San Salvador</option>  
        @else
          <option value="San Salvador">San Salvador</option>
        @endif
        @if (!$create && $pacientes->departamento == "Santa Ana")
          <option value="Santa Ana" selected>Santa Ana</option>  
        @else
          <option value="Santa Ana">Santa Ana</option>
        @endif
        @if (!$create && $pacientes->departamento == "San Miguel")
          <option value="San Miguel" selected>San Miguel</option>  
        @else
          <option value="San Miguel">San Miguel</option>
        @endif
        @if (!$create && $pacientes->departamento == "La Libertad")
          <option value="La Libertad" selected>La Libertad</option>  
        @else
          <option value="La Libertad">La Libertad</option>
        @endif
        @if (!$create && $pacientes->departamento == "Usulután")
          <option value="Usulután" selected>Usulután</option>  
        @else
          <option value="Usulután">Usulután</option>
        @endif
        @if (!$create && $pacientes->departamento == "Sonsonate")
          <option value="Sonsonate" selected>Sonsonate</option>  
        @else
          <option value="Sonsonate">Sonsonate</option>
        @endif
        @if (!$create && $pacientes->departamento == "La Unión")
          <option value="La Unión" selected>La Unión</option>  
        @else
          <option value="La Unión">La Unión</option>
        @endif
        @if (!$create && $pacientes->departamento == "La Paz")
          <option value="La Paz" selected>La Paz</option>  
        @else
          <option value="La Paz">La Paz</option>
        @endif
        @if (!$create && $pacientes->departamento == "Chalatenango")
          <option value="Chalatenango" selected>Chalatenango</option>  
        @else
          <option value="Chalatenango">Chalatenango</option>
        @endif
        @if (!$create && $pacientes->departamento == "Cuscatlán")
          <option value="Cuscatlán" selected>Cuscatlán</option>  
        @else
          <option value="Cuscatlán">Cuscatlán</option>
        @endif
        @if (!$create && $pacientes->departamento == "Ahuachapán")
          <option value="Ahuachapán" selected>Ahuachapán</option>  
        @else
          <option value="Ahuachapán">Ahuachapán</option>
        @endif
        @if (!$create && $pacientes->departamento == "Morazán")
          <option value="Morazán" selected>Morazán</option>  
        @else
          <option value="Morazán">Morazán</option>
        @endif
        @if (!$create && $pacientes->departamento == "San Vicente")
          <option value="San Vicente" selected>San Vicente</option>  
        @elseif(!$create)
          <option value="San Vicente">San Vicente</option>
        @else
          <option value="San Vicente" selected>San Vicente</option>  
        @endif
        @if (!$create && $pacientes->departamento == "Cabañas")
          <option value="Cabañas" selected>Cabañas</option>  
        @else
          <option value="Cabañas">Cabañas</option>
        @endif
      </select>
    </div>
  </div>
  <div id="municipio_div" class='form-group'>
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Municipio </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class='fa fa-map-marker form-control-feedback left' aria-hidden='true'></span>
      <select class='form-control has-feedback-left' id="municipio_select" name="municipio">
      </select>
      @if (!$create)
        <input type="hidden" value="{{$pacientes->municipio}}" id="municipio_edit">
      @endif
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
      {!! Form::textarea('direccion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección del nuevo paciente','rows'=>'3']) !!}
    </div>
  </div>
  <center>
    <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/pacientes') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
