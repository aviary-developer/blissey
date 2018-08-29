<div class="row">
  <center>
    <h5 class="big-text">Buscar medicamento</h5>
  </center>
</div>
<form action="" class="form-horizontal input_mask">
  <div class="form-group col-xs-12">
    <label class="control-label col-md-3">Medicamento:</label>
    <div class="col-md-9">
      <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
      <input type="text" class="form-control has-feedback-left" placeholder="Medicamento" id="nombre_producto" list="productos">
      <datalist id="productos">
        @foreach ($lista_medicamentos as $lista)
          <option value="{{$lista->nombre}}"></option>
        @endforeach
      </datalist>
    </div>
  </div>
  <div class="form-group col-xs-12">
    <label class="control-label col-md-3">Presentación: </label>
    <div class="col-md-9">
      <label class="control-label"><i class="gray" id="presentacion-selecta">Buscando...</i></label>
    </div>
  </div>
  <div class="form-group col-xs-12">
    <label class="control-label col-md-3">Dosis:</label>
    <div class="col-xs-3">
      <input type="number" class="form-control col-xs-4" placeholder="Cant" id="numero-dosis" min="0" value="1"> 
    </div>
    <div class="col-xs-6">
      <select name="" id="forma-dosis" class="form-control">
        <option value="0">Unidad</option>
        <option value="1">Cucharadita</option>
        <option value="2">Cucharada</option>
        <option value="3">Mililitro</option>
        <option value="4">Gota</option>
        <option value="5">Cuarta parte</option>
        <option value="6">Media parte</option>
        <option value="7">Aplicación</option>
        <option value="8">UI</option>
        <option value="9">Inhalaciones</option>
      </select>
    </div>
  </div>
  <div class="form-group col-xs-12">
    <label class="control-label col-md-3">Frecuencia:</label>
    <div class="col-xs-3">
      <input type="number" class="form-control col-xs-4" placeholder="Cant" id="numero-frec" min="0" value="1"> 
    </div>
    <div class="col-xs-6">
      <select name="" id="forma-frec" class="form-control">
        <option value="0">Minuto</option>
        <option value="1">Hora</option>
        <option value="2">Día</option>
        <option value="3">Semana</option>
        <option value="4">Mes</option>
      </select>
    </div>
  </div>
  <div class="form-group col-xs-12">
    <label class="control-label col-md-3">Duración:</label>
    <div class="col-xs-3">
      <input type="number" class="form-control col-xs-4" placeholder="Cant" id="numero-duracion" min="0" value="1"> 
    </div>
    <div class="col-xs-6">
      <select name="" id="forma-duracion" class="form-control">
        <option value="0">Minuto</option>
        <option value="1">Hora</option>
        <option value="2">Día</option>
        <option value="3">Semana</option>
        <option value="4">Mes</option>
        <option value="5">Indefinido</option>
      </select>
    </div>
  </div>
  <div class="form-group col-xs-12">
    <div class="col-xs-12">
      <center>
          <div class="">
            <label>
              <input type="checkbox" name="checkObservacion" id="checkObservacion" class="js-switch"/> Añadir Observación
            </label>
          </div>
        </center>
    </div>
    <div class="col-xs-12" id="divObservacion" hidden>
      <textarea id="observacion-receta" rows="3" class="form-control" placeholder="Opcional"></textarea>
    </div>
  </div>
  <div class="row">
    <center>
      <button type="button" class="btn btn-sm btn-primary" id="agregar-medicamento-receta"><i class="fa fa-plus" ></i> Agregar</button>
    </center>
  </div>
</form>