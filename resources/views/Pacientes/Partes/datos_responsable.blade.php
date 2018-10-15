<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Nombre Completo
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{$responsable->nombre.' '.$responsable->apellido}}
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Fecha de Nacimiento
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{ $responsable->fechaNacimiento->formatLocalized('%d de %B de %Y')}}
    <span class="badge badge-pill badge-primary">
      {{$responsable->fechaNacimiento->age.' años' }}
    </span>
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Sexo
  </span>
</div>
<div class="flex-row">
  <h6>
    @if ($responsable->sexo)
      <span class="badge border-primary text-primary border col-4">Masculino</span>
    @else
      <span class="badge border-pink text-pink border col-4">
        Femenino
      </span>
    @endif
  </h6>
</div>

@if ($responsable->fechaNacimiento->age >= 18)
  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Número de DUI
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      @if (strlen($responsable->dui) != 10)
        <span class="badge text-danger border border-danger col-4">Sin DUI</span>
      @else
        {{ $responsable->dui }}
      @endif
    </h6>
  </div>
@endif

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Número de Teléfono
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if (strlen($responsable->telefono) != 9)
      <span class="badge text-danger border border-danger col-4">Sin teléfono</span>
    @else
      {{ $responsable->telefono }}
    @endif
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Residencia
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if ($responsable->pais == null)
      <td>{{$responsable->municipio.', '.$responsable->departamento}}</td>
    @else
      <td>{{$responsable->pais}}</td>
    @endif
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Dirección
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if ($responsable->direccion == null)
      <span class="badge text-danger border border-danger col-4">Sin dirección</span>
    @else
      {{ $responsable->direccion }}
    @endif
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Alergias
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if ($responsable->alergia == null)
      <span class="badge text-secondary border border-secondary col-4">Ninguna</span>
    @else
      {{ $responsable->alergia }}
    @endif
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
    @if ($responsable->estado)
      <span class="badge text-success border border-success col-4">Activo</span>
    @else
      <span class="badge text-danger border border-danger col-4">En papelera</span>
    @endif
  </h6>
</div>