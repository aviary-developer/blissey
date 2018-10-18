<div class="flex-row">
  <center>
    <h5>Datos Personales</h5>
  </center>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label class="" for="nombre">Nombre *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-user"></i></div>
        </div>
        {!! Form::text(
          'nombre',
          null,
          ['class'=>'form-control form-control-sm',
            'placeholder'=>'Nombre del usuario',
            'id'=>'nombre_usuario_field']
        ) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="" for="apellido">Apellido *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-user"></i></div>
        </div>
        {!! Form::text(
          'apellido',
          null,
          ['class'=>'form-control form-control-sm',
            'placeholder'=>'Apellido del usuario',
            'id'=>'apellido_usuario_field']
        ) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="" for="nombre">Sexo *</label>
      <div class="input-group mb-2 mr-sm-2">
        @if(isset($sexo))
          @if($sexo)
            <div id="radioBtn" class="btn-group col-sm-12">
              <a class="btn col-sm-6 btn-primary btn-sm active" data-toggle="sexo" data-title="1">Masculino</a>
              <a class="btn col-sm-6 btn-primary btn-sm notActive" data-toggle="sexo" data-title="0">Femenino</a>
            </div>
            <input type="hidden" name="sexo" id="sexo" value="1"> 
          @else
            <div id="radioBtn" class="btn-group col-sm-12">
              <a class="btn col-sm-6 btn-primary btn-sm notActive" data-toggle="sexo" data-title="1">Masculino</a>
              <a class="btn col-sm-6 btn-primary btn-sm active" data-toggle="sexo" data-title="0">Femenino</a>
            </div>
            <input type="hidden" name="sexo" id="sexo" value="0">
          @endif  
        @else
          @if (isset($usuarios))
            @if ($usuarios->sexo)
              <div id="radioBtn" class="btn-group col-sm-12">
                <a class="btn col-sm-6 btn-primary btn-sm active" data-toggle="sexo" data-title="1">Masculino</a>
                <a class="btn col-sm-6 btn-primary btn-sm notActive" data-toggle="sexo" data-title="0">Femenino</a>
              </div>
              <input type="hidden" name="sexo" id="sexo" value="1">
            @else
              <div id="radioBtn" class="btn-group col-sm-12">
                <a class="btn col-sm-6 btn-primary btn-sm notActive" data-toggle="sexo" data-title="1">Masculino</a>
                <a class="btn col-sm-6 btn-primary btn-sm active" data-toggle="sexo" data-title="0">Femenino</a>
              </div>
              <input type="hidden" name="sexo" id="sexo" value="0">    
            @endif
          @else    
            {{--  Radios button   --}}
            <div id="radioBtn" class="btn-group col-sm-12">
              <a class="btn col-sm-6 btn-primary btn-sm active" data-toggle="sexo" data-title="1">Masculino</a>
              <a class="btn col-sm-6 btn-primary btn-sm notActive" data-toggle="sexo" data-title="0">Femenino</a>
            </div>
            <input type="hidden" name="sexo" id="sexo" value="1">
          @endif
        @endif
      </div>
    </div>
    <div class="form-group">
      <label class="" for="fechaNacimiento">Fecha de nacimiento *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-calendar"></i></div>
      </div>
      @php
        $ahora = Carbon\Carbon::now();
        $ahora = $ahora->subYears(12);
        if($create){
          $fecha = $fecha->subYears(12);
        }
      @endphp
      {!! Form::date(
        'fechaNacimiento',
        $fecha,
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Nombre del paciente',
          'max'=>$ahora->format('Y-m-d'),
          'id' => 'fecha_paciente']
      ) !!}
    </div>
    </div>
    
    <div class="form-group">
      <label class="" for="dui">DUI *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-credit-card"></i></div>
        </div>
        {!! Form::text(
          'dui',
          null,
          ['class'=>'form-control form-control-sm',
            'placeholder'=>'DUI del usuario',
            'data-inputmask'=>"'mask' : '99999999-9'"]
        ) !!}
      </div>
    </div>
    <div class="form-group">
      <label class="" for="direccion">Dirección *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-map-marked"></i></div>
        </div>
        {!! Form::textarea(
          'direccion',
          null,
          ['class'=>'form-control form-control-sm',
            'placeholder'=>'Dirección del usuario',
            'rows'=>'2',
            'id'=>'direccion_usuario_field']
        ) !!}
      </div>
    </div>
  </div>

  <div class="col-sm-6">
    <div class="form-group">
      <label class="" for="telefono">Teléfono </label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-phone"></i></div>
        </div>
        {!! Form::text(
          'telefono_input',
          null,
          ['id'=>'telefono_usuario',
            'class'=>'form-control form-control-sm',
            'placeholder'=>'Teléfono del usuario',
            'data-inputmask'=>"'mask' : '9999-9999'"]
        ) !!}
        <div class="input-group-append">
          <div class="input-group-btn ">
            <button type="button" name="button" class="btn btn-primary btn-sm pr-4 pl-4" id="agregar_telefono" data-toggle="tooltip" data-placement="top" title="Guardar teléfono">
              <i class="fa fa-save"></i>
            </button>
          </div>
        </div>
      </div>
      <small class="form-text text-muted">
        Solamente los números de teléfono agregados a la tabla serán almacenados.
      </small>
    </div>

    <div id="telefono_hidden" hidden="hidden">
      <input type="hidden" name="deletes[]" value="ninguno" id="deletes">
    </div>

    <table class="table table-hover table-sm table-striped" id='tablaTelefono'>
      <thead>
        <th>Teléfono</th>
        <th style="width : 80px">Acción</th>
      </thead>
      <tbody>
        @if (!$create)
          @foreach ($telefono_usuarios as $key => $telefono)
            <tr>
              <td>{{$telefono->telefono}}</td>
              <td>
                <input type="hidden" id={{"telefono".$key}} value={{ $telefono->id }} name="tel_id[]">
                <input type="hidden" value={{ $telefono->telefono }} name="tel_tel[]">
                <button type="button" name="button" class="btn btn-danger btn-sm" id="eliminar_telefono_antiguo">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>