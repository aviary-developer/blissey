<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="x_panel">
  <center>
    <h5 class="mb-1">Datos del visitador</h5>
  </center>
  <div class="ln_solid mb-1 mt-1"></div>
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
          'placeholder'=>'Nombre del visitador',
          'id'=>'nombre'
        ]
      ) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="" for="nombre">Apellido *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-user"></i></div>
      </div>
      {!! Form::text(
        'apellido',
        null,
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Apellido del visitador',
          'id'=>'apellido'
        ]
      ) !!}
    </div>
  </div>

  <div class="form-group">
    <label class="" for="nombre">Teléfono *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-phone"></i></div>
      </div>
      {!! Form::text(
        'telefono',
        null,
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Teléfono del visitador',
          'id'=>'telefono',
          'data-inputmask'=>"'mask' : '9999-9999'"
        ]
      ) !!}
    </div>
  </div>

  @if ($bandera==1)
    <input type="hidden" name="f_proveedor" value="{{$id}}">
  @endif
</div>
<div class="x_panel">
  <center>
    {!! Form::button('Guardar',['class'=>'btn btn-primary','onClick'=>'save_visitador()']) !!}
    <button type="reset" name="button" class="btn btn-light">Limpiar</button>
    <a href={!! asset('/visitadores?estado='.$estado.'&id='.$id) !!} class="btn btn-light">Cancelar</a>
  </center>
</div>
