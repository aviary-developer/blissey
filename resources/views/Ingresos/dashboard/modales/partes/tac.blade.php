<div class="flex-row">
  <center>
    <h5>Solicitud de TAC</h5>
  </center>
</div>
<div class="row">
  <div class="form-group col-sm-12">
    <label class="" for="evaluacion">TAC</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-desktop"></i></div>
      </div>
      <select class="form-control form-control-sm" id="f_tac_receta">
        @if ($rayosx==null)
            <option value="0" disabled>No hay examenes de tac registrados</option>
        @else
          @foreach ($tacs as $tac)
            <option value={{$tac->id}}>{{$tac->nombre}}</option>
          @endforeach
        @endif
      </select>
      <div class="input-group-append">
        <div class="input-group-btn">
          <button type="button" class="btn btn-sm btn-primary" id="agregar_tac_receta"><i class="fa fa-plus"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
