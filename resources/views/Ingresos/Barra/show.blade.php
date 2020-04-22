<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href={!! asset('/ingresos') !!}>
    @if ($ingreso->tipo == 0)
      <span class="badge badge-success">Ingreso</span>
    @elseif($ingreso->tipo == 1)
      <span class="badge badge-purple">Medio ingreso</span>
    @elseif($ingreso->tipo == 2)
      <span class="badge badge-primary">Observación</span>
    @elseif($ingreso->tipo == 3)
      <span class="badge badge-pink">Consulta Médica</span>
    @endif

    @if ($ingreso->tipo < 3)
      @if ($ingreso->estado==1)
        <span class="badge border border-primary text-primary">{{($ingreso->hospitalizacion->paciente->sexo)?"Hospitalizado":"Hospitalizada"}}</span>
      @elseif($ingreso->estado == 0)
        <span class="badge border border-warning text-warning">Pendiente de acta</span>
      @else
        <span class="badge border border-success text-success">Con alta</span>
      @endif
    @else
      @if ($ingreso->estado == 0 && $ingreso->tipo == 3)
        <span class="badge border border-primary text-primary">En consulta</span>
      @else
        <span class="badge border border-success text-success">Con alta</span>
      @endif
    @endif
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Ver
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#" data-target="#datos_paciente" data-toggle="modal">
            Datos de paciente
          </a>
          @if ($responsable != null)  
            <a class="dropdown-item" href="#" data-target="#datos_responsable" data-toggle="modal">
              Datos de responsable
            </a>  
          @endif
          <a class="dropdown-item" href={!!asset('/acta/'.$ingreso->id)!!} target="_blank">
            Acta de consentimiento
          </a>  
        </div>
      </li>

      @if (Auth::user()->tipoUsuario == "Recepción" && $ingreso->estado == 1) 
        <li class="nav-item dropdown">
          <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Acciones
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#" id="dar_alta">
              Dar de alta
            </a>  
            <a class="dropdown-item" href="#" data-target="#cambio_habitacion" data-toggle="modal">
              Cambiar de habitación
            </a>  
            @if (($horas <= 6 && $ingreso->tipo == 0) || $ingreso->tipo != 0)
              <a class="dropdown-item" href="#" data-target="#cambio_hospitalizacion" data-toggle="modal">
                Cambiar tipo de hospitalización
              </a>
						@endif
						<a class="dropdown-item" href="#" id="cambiar_estado_iva">
							IVA
							@if ($ingreso->iva)
								<span class="badge badge-pill badge-success float-right">Activo</span>
							@else
							 	<span class="badge badge-pill badge-danger float-right">Inactivo</span>
							@endif
            </a>  
          </div>
        </li>
      @endif
    </ul>
    @include('Dashboard.boton_salir')
  </div>
</nav>

<input type="hidden" value={{number_format($total_deuda,2,'.','')}} id="deuda_para_alta">
<input type="hidden" value="{{$ingreso->iva}}" id="estado_iva">