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
      {{$visitador->nombre}}
    </h6>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Apellido
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      {{$visitador->apellido}}
    </h6>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      teléfono
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      {{$visitador->telefono}}
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
      @if ($visitador->estado)
        <span class="badge text-success border border-success col-4">Activo</span>
      @else
        <span class="badge text-danger border border-danger col-4">En papelera</span>
      @endif
    </h6>
  </div>
</div>
