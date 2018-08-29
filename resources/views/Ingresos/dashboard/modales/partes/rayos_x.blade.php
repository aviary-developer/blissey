<div class="row">
  <center>
    <h4>Solicitud de Rayos X</h4>
  </center>
</div>
<div class="row">
  <div class="form-group">
    <label class="control-label col-xs-3">Examen *</label>
    <div class="col-xs-9">
      <select class="form-control" id="f_rayo_receta">
        @if (count($rayosx)==0)
            <option value="0" disabled>No hay examenes de rayos X registrados</option>
        @else
          @foreach ($rayosx as $rayox)
            <option value={{$rayox->id}}>{{$rayox->nombre}}</option>
          @endforeach
        @endif
      </select>
    </div>
  </div>
</div>
<div class="row">
  <center>
    <button type="button" class="btn btn-sm btn-primary" id="agregar_rayo_receta"><i class="fa fa-plus"></i> Agregar</button>
  </center>
</div>