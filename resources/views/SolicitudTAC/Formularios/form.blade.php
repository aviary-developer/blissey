<div class="x_panel">
  <input type="hidden" id="seleccion">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Paciente *</label>
    <div class="col-md-7 col-sm-7 col-xs-12">
      <div class="input-group">
        {!! Form::text('n_paciente',null,['id'=>'n_paciente','class'=>'form-control','placeholder'=>'Nombre del paciente', 'disabled']) !!}
        <span class="input-group-btn">
          <button type="button" name="button" data-toggle="modal" data-target="#modal_" class="btn btn-primary" id="agregar_paciente" onclick="input_seleccion('solicitud');">
            <i class="fa fa-search"></i>
          </button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#solicitud_m" data-tooltip="tooltip" title="Buscar Receta">
            <i class="fa fa-medkit"></i>
          </button>
        </span>
      </div>
      <input type="hidden" name="f_paciente" id="f_paciente">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tomografías *</label>
    <div class="col-md-7 col-sm-7 col-xs-12">
      <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
      <select class="form-control has-feedback-left" name="tac">
        @foreach($tacs as $item)
          <option value="{{$item->id}}">{{$item->nombre}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <input type="hidden" name="tipo" value="tac">
  <input type="hidden" id="seleccion" value="solicitud">
</div>

<div class="alert alert-danger" id="mout">
  <center>
    <p>El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>

<div class="x_panel" style="margin-bottom: 50px;">
  <div class="row">
    <center>
      {!! Form::submit('Guardar',['class'=>'btn btn-sm btn-primary']) !!}
      <a href={!! asset($ruta) !!} class="btn btn-default btn-sm">Cancelar</a>
    </center>
  </div>
</div>

@include('Recetas.modal.solicitud')
@include('SolicitudExamenes.Formularios.buscar_paciente')
<script type="text/javascript">
  function input_seleccion(e){
    document.getElementById('seleccion').value = e;
  }
</script>
