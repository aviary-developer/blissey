<div>
  <h4 class="StepTitle">Datos Personales</h4>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre *</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('nombre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo usuario']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido *</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('apellido',null,['class'=>'form-control has-feedback-left','placeholder'=>'Apellido del nuevo usuario']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo *</label>
      &nbsp;&nbsp;&nbsp;
      @if(isset($sexo))
        @if($sexo)
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
      @else
        @if (isset($usuarios))
          @if ($usuarios->sexo)
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
        @else    
          {{--  Radios button   --}}
          <div id="radioBtn" class="btn-group">
            <a class="btn btn-primary btn-sm active" data-toggle="sexo" data-title="1">Masculino</a>
            <a class="btn btn-primary btn-sm notActive" data-toggle="sexo" data-title="0">Femenino</a>
          </div>
          <input type="hidden" name="sexo" id="sexo" value="1">
        @endif
      @endif
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de nacimiento *</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
        @php
          $ahora = Carbon\Carbon::now();
          $ahora = $ahora->subYears(12);
          if($create){
            $fecha = $fecha->subYears(12);
          }
        @endphp
        {!! Form::date('fechaNacimiento',$fecha,['max'=>$ahora->format('Y-m-d'),'class'=>'form-control has-feedback-left']) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">DUI *</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('dui',null,['class'=>'form-control has-feedback-left','placeholder'=>'Ej. 00000000-0','data-inputmask'=>"'mask' : '99999999-9'"]) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Dirección *</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <span class="fa fa-map-marker form-control-feedback left" aria-hidden="true"></span>
        {!! Form::textarea('direccion',null,['class'=>'form-control has-feedback-left','placeholder'=>'Dirección del nuevo usuario','rows'=>'3']) !!}
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="input-group">
          {!! Form::text('telefonoInput',null,['id'=>'telefono_usuario','class'=>'form-control has-feedback-left','placeholder'=>'Ej. 0000-0000','data-inputmask'=>"'mask' : '9999-9999'"]) !!}
          <span class="input-group-btn">
            <button type="button" name="button" class="btn btn-primary" id="agregar_telefono" data-toggle="tooltip" data-placement="top" title="Guardar teléfono">
              <i class="fa fa-save"></i>
            </button>
          </span>
        </div>
      </div>
    </div>
    <table class="table" id='tablaTelefono'>
      <thead>
        <th>Teléfono</th>
        <th style="width : 80px">Acción</th>
      </thead>
      <tbody>
        @if (!$create && !$validacion_activa)
          <input type="hidden" name="deletes[]" value="ninguno" id="deletes">
          @foreach ($telefono_usuarios as $key => $telefono)
            <tr>
              <td>{{$telefono->telefono}}</td>
              <td>
                <input type="hidden" id={{"telefono".$key}} value={{ $telefono->id }} name="tel_id[]">
                <input type="hidden" value={{ $telefono->telefono }} name="tel_tel[]">
                <button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_telefono_antiguo">
                  <i class="fa fa-remove"></i>
                </button>
              </td>
            </tr>
          @endforeach
        @elseif($validacion_activa)
          @foreach($deletes as $telefonos_eliminados)
            <input type="hidden" name="deletes[]" value={{$telefonos_eliminados}} id="deletes">
          @endforeach
          @if(isset($telefono_telefono))    
            @foreach ($telefono_telefono as $key => $telefono)
              <tr>
                <td>{{$telefono}}</td>
                <td>
                  <input type="hidden" id={{"telefono".$key}} value={{ $telefono_id[$key] }} name="tel_id[]">
                  <input type="hidden" value={{ $telefono }} name="tel_tel[]">
                  <button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_telefono_antiguo">
                    <i class="fa fa-remove"></i>
                  </button>
                </td>
              </tr>
            @endforeach
          @endif
        @endif
        @if(isset($telefonos))
          @foreach($telefonos as $k => $telefono)
            <tr>
              <td>{{$telefono}}</td>
              <td>
                <input type="hidden" name="telefono[]" value={{ $telefono }}>
                <button type="button" name="button" class="btn btn-danger btn-xs" id="eliminar_telefono">
                  <i class="fa fa-remove"></i>
                </button>
              </td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <center>
      <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
    </center>
  </div>
</div>