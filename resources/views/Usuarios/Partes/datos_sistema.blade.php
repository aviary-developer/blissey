@if (Auth::user()->id == $id)
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Nombre de Usuario
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      {{$usuario->name}}
    </h6>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Rol de usuario
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      @if ($usuario->administrador)
        <span class="badge border border-primary text-primary col-4">Administrador</span>
      @else
        <span class="badge border border-secondary text-secondary col-4">Ninguno</span>
      @endif
    </h6>
  </div>
  <div class="ln_solid mb-1 mt-1"></div>
@endif

<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Tipo de usuario
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    @if($usuario->tipoUsuario == "Gerencia")
      <span class="badge border border-secondary text-secondary  col-4">Gerencia</span>
    @elseif ($usuario->tipoUsuario == "Médico")
      <span class="badge border border-primary  col-4 text-primary">Médico</span>
    @elseif ($usuario->tipoUsuario == "Laboaratorio")
      <span class="badge border border-success  col-4 text-success">Laboratorio</span>
    @elseif ($usuario->tipoUsuario == "Ultrasonografía")
      <span class="badge border border-warning  col-4 text-warning">Ultrasonografía</span>
    @elseif ($usuario->tipoUsuario == "Rayos X")
      <span class="badge border border-info  col-4 text-info">Rayos X</span>
    @elseif ($usuario->tipoUsuario == "Recepción")
      <span class="badge border border-danger  col-4 text-danger">Recepción</span>
    @elseif ($usuario->tipoUsuario == "Enfermería")
      <span class="badge border border-purple  col-4 text-purple">Enfermería</span>
    @elseif ($usuario->tipoUsuario == "Farmacia")
      <span class="badge border border-dark  col-4">Farmacia</span>
    @elseif ($usuario->tipoUsuario == "TAC")
      <span class="badge border border-pink  col-4 text-pink">TAC</span>
    @endif
  </h6>
</div>

<div class="ln_solid mb-1 mt-1"></div>
<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Correo Electrónico
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{$usuario->email}}
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
    @if ($usuario->estado)
      <span class="badge text-success border border-success col-4">Activo</span>
    @else
      <span class="badge text-danger border border-danger col-4">En papelera</span>
    @endif
  </h6>
</div>