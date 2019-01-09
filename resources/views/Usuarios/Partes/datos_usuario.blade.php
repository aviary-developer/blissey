<div class="flex-row">
  <img src={{asset(Storage::url($usuario->foto))}} alt="" class="image-porfile">
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Nombre Completo
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{$usuario->nombre.' '.$usuario->apellido}}
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
    {{ $usuario->fechaNacimiento->formatLocalized('%d de %B de %Y')}}
    <span class="badge badge-pill badge-primary">
      {{$usuario->fechaNacimiento->age.' años' }}
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
    @if ($usuario->sexo)
      <span class="badge border-primary text-primary border col-4">Masculino</span>
    @else
      <span class="badge border-pink text-pink border col-4">
        Femenino
      </span>
    @endif
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Número de DUI
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if (strlen($usuario->dui) != 10)
      <span class="badge text-danger border border-danger col-4">Sin DUI</span>
    @else
      {{ $usuario->dui }}
    @endif
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Número de Teléfono
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if ($telefonos!=null)
      @foreach ($telefonos as $telefono)
        <i class="fas fa-phone"></i>
        {{$telefono->telefono}}
        @if (count($telefonos)>1)
          <br>
        @endif
      @endforeach
    @else
      <span class="badge text-danger border border-danger col-4">Sin teléfono</span>
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
    @if ($usuario->direccion == null)
      <span class="badge text-danger border border-danger col-4">Sin dirección</span>
    @else
      {{ $usuario->direccion }}
    @endif
  </h6>
</div>