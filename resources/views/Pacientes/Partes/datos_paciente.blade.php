<div class="x_panel">
  <div class="flex-row">
    <center>
      <h5 class="mb-1">Datos Personales</h5>
    </center>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Nombre Completo
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      {{$paciente->nombre.' '.$paciente->apellido}}
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
      {{ $paciente->fechaNacimiento->formatLocalized('%d de %B de %Y')}}
      <span class="badge badge-pill badge-primary">
        {{$paciente->fechaNacimiento->age.' años' }}
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
      @if ($paciente->sexo)
        <span class="badge border-primary text-primary border col-4">Masculino</span>
      @else
        <span class="badge border-pink text-pink border col-4">
          Femenino
        </span>
      @endif
    </h6>
  </div>

  @if ($paciente->fechaNacimiento->age >= 18)
    <div class="ln_solid mb-1 mt-1"></div>
    <div class="flex-row">
      <span class="font-weight-light text-monospace">
        Número de DUI
      </span>
    </div>
    <div class="flex-row">
      <h6 class="font-weight-bold">
        @if (strlen($paciente->dui) != 10)
          <span class="badge text-danger border border-danger col-4">Sin DUI</span>
        @else
          {{ $paciente->dui }}
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
      @if (strlen($paciente->telefono) != 9)
        <span class="badge text-danger border border-danger col-4">Sin teléfono</span>
      @else
        {{ $paciente->telefono }}
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
      @if ($paciente->pais == null)
        <td>{{$paciente->municipio.', '.$paciente->departamento}}</td>
      @else
        <td>{{$paciente->pais}}</td>
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
      @if ($paciente->direccion == null)
        <span class="badge text-danger border border-danger col-4">Sin dirección</span>
      @else
        {{ $paciente->direccion }}
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
      @if ($paciente->alergia == null)
        <span class="badge text-secondary border border-secondary col-4">Ninguna</span>
      @else
        {{ $paciente->alergia }}
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
      @if ($paciente->estado)
        <span class="badge text-success border border-success col-4">Activo</span>
      @else
        <span class="badge text-danger border border-danger col-4">En papelera</span>
      @endif
    </h6>
  </div>
</div>