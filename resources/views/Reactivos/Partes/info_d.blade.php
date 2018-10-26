<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Nombre
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{$reactivo->nombre}}
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Fecha de vencimiento
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{Carbon\Carbon::parse($reactivo->fechaVencimiento)->format('d / m / Y')}}
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Existencias
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{$reactivo->contenidoPorEnvase}}
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
    @if ($reactivo->estado)
      <span class="badge text-success border border-success col-6">Activo</span>
    @else
      <span class="badge text-danger border border-danger col-6">En papelera</span>
    @endif
  </h6>
</div>