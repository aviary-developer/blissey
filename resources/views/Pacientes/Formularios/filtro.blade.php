<div class="x_panel m_panel text-danger">
  <center>
    <h4 class="mb-1">
      <i class="fas fa-search"></i>
      Buscar Paciente
    </h4>
  </center>
</div>

<div class="x_panel m_panel">
  <center>  
    <p id="texto">Hola mundo</p>
  </center>
  <div class="form-group col-sm-6">
    <label class="" for="nombre">Nombre</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-user"></i></div>
      </div>
      <input type="text" class="form-control form-control-sm" name="nombre" id="nombreFiltrar" placeholder="Buscar por nombre">
    </div>
  </div>
  
  <div class="form-group col-sm-6">
    <label class="" for="apellido">Apellido</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-user"></i></div>
      </div>
      <input type="text" class="form-control form-control-sm" name="apellido" id="apellido" placeholder="Buscar por apellido">
    </div>
  </div>
  
  <div class="form-group col-sm-6 col-xs-12">
    <label class="" for="sexo">Sexo</label>
    <div class="input-group mb-2 mr-sm-2">
      <div id="radioBtn" class="btn-group col-sm-12">
        <a class="btn btn-primary btn-sm active col-sm-4" data-toggle="sexo" data-title="2" id="sexo1">Ambos</a>
        <a class="btn btn-primary btn-sm notActive col-sm-4" data-toggle="sexo" data-title="1" id="sexo2">Masculino</a>
        <a class="btn btn-primary btn-sm notActive col-sm-4" data-toggle="sexo" data-title="0" id="sexo3">Femenino</a>
      </div>
      <input type="hidden" name="sexo" id="sexo" value="2">
    </div>
  </div>
  
  <div class="form-group col-sm-6">
    <label class="" for="telefono">Teléfono</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-phone"></i></div>
      </div>
      <input type="text" class="form-control form-control-sm" name="telefono" id="telefono" placeholder="Buscar por teléfono" data-inputmask = "'mask' : '9999-9999'">
    </div>
  </div>
  
  <div class="form-group col-sm-6">
    <label class="" for="direccion">Dirección</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-map-marked"></i></div>
      </div>
      <textarea class="form-control form-control-sm" name="direccion" id="direccion" placeholder="Buscar por dirección" rows="3"></textarea>
    </div>
  </div>
  
  <div class="form-group col-sm-6">
    <label class="" for="dui">DUI</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text"><i class="fas fa-credit-card"></i></div>
      </div>
      <input type="text" class="form-control form-control-sm" name="dui" id="dui" placeholder="Buscar por DUI" data-inputmask = "'mask' : '99999999-9'">
    </div>
  </div>
  
  <div class="form-group col-sm-12">
    <label class="">Edad</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="col-sm-12" >
        <input type="text" id="range_paciente_edad" name="edad"/>
      </div>
    </div>
  </div>
  <input type="hidden" id="min" value={{$fin}}>
  <input type="hidden" id="max" value={{$inicio}}>
  <input type="hidden" id="from" value={{$desde}}>
  <input type="hidden" id="to" value={{$hasta}}>
  @if ($estadoOpuesto)
    <input type="hidden" name="estado" value="0" id="estado">
  @else
    <input type="hidden" name="estado" value="1" id="estado">
  @endif
</div>

<div class="m_panel x_panel bg-transparent" style="border:0px !important">
  <center>
    <button type="submit" class="btn btn-primary btn-sm col-2">Buscar</button>
    <button type="button" class="btn btn-light btn-sm col-2" id="limpiar_paciente_filtro">Limpiar</button>
    <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
  </center>
</div>