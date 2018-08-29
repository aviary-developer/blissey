<div class="row">
  <center>
    <h4>Solicitud de TAC</h4>
  </center>
</div>
<div class="row">
  <div class="form-group">
    <label class="control-label col-xs-3">Examen *</label>
    <div class="col-xs-9">
      <select class="form-control" id="f_tac">
        @if (count($rayosx)==0)
            <option value="0" disabled>No hay examenes de tac registrados</option>
        @else
          @foreach ($tacs as $tac)
            <option value={{$tac->id}}>{{$tac->nombre}}</option>
          @endforeach
        @endif
      </select>
    </div>
  </div>
</div>
<div class="row">
  <center>
    <button type="button" class="btn btn-sm btn-primary" id="agregar_tac_receta"><i class="fa fa-plus"></i> Agregar</button>
  </center>
</div>