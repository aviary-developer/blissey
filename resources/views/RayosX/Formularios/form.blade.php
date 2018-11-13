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
        <div class="input-group-text"><i class="fas fa-cube"></i></div>
      </div>
      {!! Form::text(
        'nombre',
        null,
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Nombre de la radiografía',
          'id'=>'nombre_ryx_field']
      ) !!}
    </div>
  </div>
  @php
    if($create){
      $valor = null;
    }else{
      $valor = $precio;
    }
  @endphp
  <div class="form-group">
    <label class="" for="precio">Precio ($)*</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-money-bill"></i></div>
      </div>
      {!! Form::number(
        'precio',
        $valor,
        ['class'=>'form-control form-control-sm',
          'placeholder'=>'Precio de la radiografía',
          'id'=>'precio_campo',
          'step'=>'0.01',
          'min'=>'0.00']
      ) !!}
    </div>
  </div>
</div>

<div class="x_panel">
  <center>
    <button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
    <button type="reset" name="button" class="btn btn-light btn-sm">Limpiar</button>
    <a href={!! asset('/rayosx') !!} class="btn btn-light btn-sm">Cancelar</a>
  </center>
</div>

<script>
  $("#save_me").click(function(){
    var valido = new Validated('nombre_ryx_field');
    valido.required();
    is_valid = valido.value(true);

    var valido = new Validated('precio_campo');
    valido.required();
    is_valid = valido.value(is_valid);

    if(is_valid){
      $('#form').submit();
    }
  });
</script>
