<div class="flex-row">
  <center>
    <h5 class="">Buscar medicamento</h5>
  </center>
</div>
<form action="" class="form-horizontal input_mask">
  <div class="form-group col-sm-12">
    <label class="" for="nombre_producto">Medicamento *</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-prescription-bottle"></i></div>
      </div>
      <input type="text" class="form-control form-control-sm" placeholder="Medicamento" id="nombre_producto" list="productos">
      <datalist id="productos">
        @foreach ($lista_medicamentos as $lista)
          <option value="{{$lista->nombre}}"></option>
        @endforeach
      </datalist>
    </div>
  </div>

  <div class="form-group col-sm-12">
    <label class="" for="presentacion_selecta">Presentación: </label>
    <label class=""><i class="gray" id="presentacion-selecta">Buscando...</i></label>
  </div>

  <div class="form-group col-sm-12">
    <label class="" for="numero-dosis">Dosis</label>
    <div class="input-group mb-2 mr-sm-2">
      <input type="number" class="form-control form-control-sm" placeholder="Cant" id="numero-dosis" min="0" value="1"> 
      <select name="" id="forma-dosis" class="form-control form-control-sm">
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

  <div class="form-group col-sm-12">
    <label class="" for="numero-frec">Frecuencia</label>
    <div class="input-group mb-2 mr-sm-2">
      <input type="number" class="form-control form-control-sm" placeholder="Cant" id="numero-frec" min="0" value="1"> 
      <select name="" id="forma-frec" class="form-control form-control-sm">
        <option value="0">Minuto</option>
        <option value="1">Hora</option>
        <option value="2">Día</option>
        <option value="3">Semana</option>
        <option value="4">Mes</option>
      </select>
    </div>
  </div>

  <div class="form-group col-sm-12">
    <label class="" for="numero-duracion">Duración</label>
    <div class="input-group mb-2 mr-sm-2">
      <input type="number" class="form-control form-control-sm" placeholder="Cant" id="numero-duracion" min="0" value="1"> 
      <select name="" id="forma-duracion" class="form-control form-control-sm">
        <option value="0">Minuto</option>
        <option value="1">Hora</option>
        <option value="2">Día</option>
        <option value="3">Semana</option>
        <option value="4">Mes</option>
        <option value="5">Indefinido</option>
      </select>
    </div>
  </div>

  <div class="form-group col-sm-12">
    <div class="col-sm-12">
      <center>
          <div class="">
            <label>
              <input type="checkbox" name="checkObservacion" id="checkObservacion" class="js-switch"/> Añadir Observación
            </label>
          </div>
        </center>
    </div>
    <div class="col-sm-12" id="divObservacion" style="display: none">
      <textarea id="observacion-receta" rows="2" class="form-control form-control-sm" placeholder="Opcional"></textarea>
    </div>
  </div>
  <div class="flex-row">
    <center>
      <button type="button" class="btn btn-sm btn-primary" id="agregar-medicamento-receta"><i class="fa fa-plus" ></i> Agregar</button>
    </center>
  </div>
</form>