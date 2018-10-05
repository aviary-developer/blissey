<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="x_panel">
  <div class="flex-row">
    <div class="form-group">
      <label class="" for="n_paciente">Paciente *</label>
      <div class="input-group mb-2 mr-sm-2 ">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-user"></i></div>
        </div>
        {!! Form::text(
          'n_paciente',
          null,
          ['id'=>'n_paciente',
          'class'=>'form-control form-control-sm',
          'placeholder'=>'Nombre del paciente', 
          'disabled']) !!}
        <div class="input-group-append">
          <div class="input-group-btn">
            <div class="btn-group">
              <button type="button" name="button" data-toggle="modal" data-target="#modal_" class="btn btn-primary btn-sm" id="agregar_paciente" onclick="input_seleccion('solicitud');" title="Buscar Paciente">
                <i class="fa fa-search"></i>
              </button>
              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#solicitud_m" title="Buscar Receta">
                <i class="fa fa-medkit"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="f_paciente" id="f_paciente">

    <div class="form-group">
      <label class="" for="apellido">Ultrasonografía *</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-tint"></i></div>
        </div>
        <select class="form-control form-control-sm" name="ultrasonografia">
          @foreach($ultras as $item)
            <option value="{{$item->id}}">{{$item->nombre}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <input type="hidden" name="tipo" value="ultras">
    <input type="hidden" id="seleccion" value="solicitud">
  </div>
</div>

<div class="x_panel" style="">
  <div class="flex-row">
    <center>
      <button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
      <a href={!! asset($ruta) !!} class="btn btn-light btn-sm">Cancelar</a>
    </center>
  </div>
</div>

@include('Recetas.modal.solicitud')
@include('SolicitudExamenes.Formularios.buscar_paciente')
@include('SolicitudExamenes.Partes.modal_nuevo_paciente')

<script type="text/javascript">
  $("#save_me").click(function(){
    var valido = new Validated('n_paciente');
    valido.required();
    is_valid = valido.value(true);

    if(is_valid){
      $('#form').submit();
    }
  });

  function input_seleccion(e){
    document.getElementById('seleccion').value = e;
  }
</script>
