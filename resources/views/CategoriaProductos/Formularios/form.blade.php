<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="x_panel">
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
          'placeholder'=>'Nombre de la categoría',
          'id'=>'nombre'
        ]
      ) !!}
    </div>
  </div>

</div>
<div class="x_panel">
  <center>
    {!! Form::button('Guardar',['class'=>'btn btn-primary btn-sm','onClick'=>'save_categoriaProducto()']) !!}
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset('/categoria_productos') !!} class="btn btn-light btn-sm">Cancelar</a>
  </center>
</div>
