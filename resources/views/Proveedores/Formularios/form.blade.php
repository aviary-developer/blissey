<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="x_panel">
  <center>
    <h5 class="mb-1">Datos del proveedor</h5>
  </center>
  <div class="ln_solid mb-1 mt-1"></div>
  <div class="form-group col-sm-4">
    <label class="" for="nombre">Nombre *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-industry"></i></div>
      </div>
      {!! Form::text(
        'nombre',
        null,
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Nombre del proveedor',
          'id'=>'nombre'
        ]
      ) !!}
    </div>
  </div>

  <div class="form-group col-sm-4">
    <label class="" for="correo">Correo *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-at"></i></div>
      </div>
      {!! Form::text(
        'correo',
        null,
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Correo electrónico del proveedor',
          'id'=>'correo'
        ]
      ) !!}
    </div>
  </div>

  <div class="form-group col-sm-4">
    <label class="" for="telefono">Teléfono *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-phone"></i></div>
      </div>
      {!! Form::text(
        'telefono',
        null,
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Correo electrónico del proveedor',
          'id'=>'telefono',
          'data-inputmask'=>"'mask' : '9999-9999'"]
      ) !!}
    </div>
  </div>
</div>

@if ($bandera)
        @include('Proveedores.Formularios.form2')
@endif

<div class="x_panel">
  <center>
    {!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset('/pacientes') !!} class="btn btn-light btn-sm">Cancelar</a>
  </center>
</div>
