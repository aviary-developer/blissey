<div class="x_panel">
  <div class="flex-row">
    <center>
      <h5 class="mb-1">Información General</h5>
    </center>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Nombre
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      {{$producto->nombre}}
    </h6>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Categoría
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      {{$producto->categoriaProducto->nombre}}
    </h6>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Fabricante
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      {{$producto->nombreProveedor($producto->f_proveedor)}}
    </h6>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Presentación
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      {{$producto->nombrePresentacion($producto->f_presentacion)}}
    </h6>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Estado
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      @if ($producto->estado)
        <span class="badge text-success border border-success col-4">Activo</span>
      @else
        <span class="badge text-danger border border-danger col-4">En papelera</span>
      @endif
    </h6>
  </div>
</div>
