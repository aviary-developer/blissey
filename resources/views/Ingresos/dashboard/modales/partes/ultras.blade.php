<div class="flex-row">
  <center>
    <h5>Solicitud de Ultrasonografía</h5>
  </center>
</div>
<div class="row">
  <div class="form-group col-sm-12">
    <label class="" for="evaluacion">Ultrasonografía</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-file-medical-alt"></i></div>
      </div>
      <select class="form-control form-control-sm" id="f_ultra_receta">
        @if ($ultras==null)
            <option value="0" disabled>No hay examenes de Ultrasonografía registrados</option>
        @else
          @foreach ($ultras as $rayox)
            <option value={{$rayox->id}}>{{$rayox->nombre}}</option>
          @endforeach
        @endif
      </select>
      <div class="input-group-append">
        <div class="input-group-btn">
          <button type="button" class="btn btn-sm btn-primary" id="agregar_ultra_receta"><i class="fa fa-plus"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>