<div class="flex-row">
  <span class="font-weight-light text-monospace">
    Número de Junta de Vigilancia
  </span>
</div>
<div class="flex-row">
  <h6 class="font-weight-bold">
    {{$usuario->juntaVigilancia}}
  </h6>
</div>

@if ($usuario->tipoUsuario == "Médico" || $usuario->tipoUsuario == "Gerencia")
  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Especialidad médica
    </span>
  </div>
  <div class="flex-row">
    <h6 class="font-weight-bold">
      @if (isset($especialidad_principal))
        <i class="fas fa-stethoscope"></i>
        {{$especialidad_principal->nombreEspecialidad($especialidad_principal->f_especialidad)}}
      @else
        <span class="badge border border-secondary text-secondary col-4">Ninguno</span>
      @endif
    </h6>
  </div>

  @if ($especialidades!=null)
    <div class="ln_solid mb-1 mt-1"></div>
    <div class="flex-row">
      <span class="font-weight-light text-monospace">
        Subespecialidades médicas
      </span>
    </div>
    <div class="flex-row">
      <h6 class="font-weight-bold">
        @foreach ($especialidades as $especialidad)
          <i class="fas fa-stethoscope"></i>
          {{$especialidad->nombreEspecialidad($especialidad->f_especialidad)}}
          @if (count($especialidades) > 1)
            <br>
          @endif
        @endforeach
      </h6>
    </div>
  @endif
@endif

@if (Auth::user()->id == $id)
  <div class="ln_solid mb-1 mt-1"></div>
  <div class="flex-row">
    <span class="font-weight-light text-monospace">
      Firma y Sello
    </span>
  </div>
  <div class="flex-row">
    <img src={{asset(Storage::url($usuario->firma))}} alt="" class="miniperfil">
    <img src={{asset(Storage::url($usuario->sello))}} class="miniperfil">
  </div>
@endif
