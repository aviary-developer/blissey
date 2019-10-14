@extends('principal')
@section('layout')
  {{-- Base del dashboard --}}
  {{-- Inicialización del formato para fechas--}}
  @php
    setlocale(LC_ALL,'es');
  @endphp
	@include('Ingresos.Barra.show')
	{{-- Determinar si es permitido que este en observacion o en medi ingreso --}}
    @if ($ingreso->tipo == 1 && $horas > 6 && $ingreso->estado != 2)
      <script>
        swal('¡Advertencia!','Este paciente ya excedio el tiempo recomendado en medi ingreso, por favor darle de alta o cambiar su tipo de hospitalización','warning');
      </script>
    @elseif($ingreso->tipo == 2 && $horas > 2 && $ingreso->estado != 2)
      <script>
        swal('¡Advertencia!','Este paciente ya excedio el tiempo recomendado en observación, por favor darle de alta o cambiar su tipo de hospitalización','warning');
      </script>
    @endif
  
  {{-- Condiconal de tipo de usuario, segun sea el tipo de usuario así sera el dashboard a mostrar --}}
  <div class="col-sm-12">
    <div class="flex-row">
      <div class="x_panel border border-secondary rounded">
        <div class="flex-row">
          <div class="col-sm-1">
            <center>
              <img src={{asset((($paciente->sexo)?'img/hombre.png':'img/mujer.png'))}} class="img-circle" style="width: 60px; height: 60px;">
            </center>
          </div>
  
          <div class="col-sm-7">
            <div class="row">
              <span class="font-weight-bold text-monospace">
                {{ $ingreso->hospitalizacion->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y') }}
              </span>
            </div>
            <div class="row">
              <span class="font-md">
                {{$paciente->nombre.' '}}
                <b>
                  {{$paciente->apellido}}
                </b>
                <span class="badge badge-pill badge-primary">
                  {{$paciente->fechaNacimiento->age.' años' }}
                </span>
              </span>
            </div>
          </div>
  
          <div class="col-sm-4">
            <div class="flex-row">
              <span class="font-weight-light text-monospace">
                Fecha de ingreso
              </span>
            </div>
            <div class="flex-row">
              <span class="font-weight-bold font-sm">
                <i class="far fa-calendar"></i>
                {{$ingreso->fecha_ingreso->formatLocalized('%d de %B del %Y a las %H:%M:%S')}}
              </span>
            </div>
            <div class="ln_solid mb-1 mt-1"></div>
            @if ($ingreso->estado == 2)
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Fecha de alta
                </span>
              </div>
              <div class="flex-row">
                <span class="font-weight-bold font-sm">
                  <i class="far fa-calendar"></i>
                  {{$ingreso->fecha_alta->formatLocalized('%d de %B del %Y a las %H:%M:%S')}}
                </span>
              </div>
            @elseif($ingreso->tipo < 3)
              <div class="flex-row">
                <span class="font-weight-light text-monospace">
                  Habitación
                </span>
              </div>
              <div class="flex-row">
                <span class="font-weight-bold font-md">
                  <span class="badge badge-light border border-dark text-dark col-sm-4">
                    {{$ingreso->habitacion->servicio->nombre}}
                  </span>
                </span>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    @include('Ingresos.dashboard.modales.datos_paciente')
    @if ($responsable != null)  
      @include('Ingresos.dashboard.modales.datos_responsable')
    @endif
    
    @if (Auth::user()->tipoUsuario == "Recepción" && $ingreso->tipo < 3)
      @include('Ingresos.dashboard.usuarios.recepcion')
    @elseif(Auth::user()->tipoUsuario == "Recepción" && $ingreso->tipo == 3)
      @include('Ingresos.dashboard.usuarios.recepcion_consulta')
    @elseif(Auth::user()->tipoUsuario == "Médico")
			@include('Ingresos.dashboard.usuarios.medico')
		@elseif(Auth::user()->tipoUsuario == "Enfermería" && $ingreso->tipo < 3)
			@include('Ingresos.dashboard.usuarios.enfermeria')
		@elseif(Auth::user()->tipoUsuario == "Enfermería" && $ingreso->tipo == 3)
			@include('Ingresos.dashboard.usuarios.enfermeria_consulta')
    @endif

  </div>
  {{-- Token a utilizar por cualquier elemento en esta pantalla --}}
  <input type="hidden" id="token" value="<?php echo csrf_token(); ?>">
  {{-- Id del ingreso --}}
  <input type="hidden" id="id" value={{$ingreso->id}}>
  {{-- Datos del usuario activo --}}
  <input type="hidden" id="tipo_usuario" value={{Auth::user()->tipoUsuario}}>
  <input type="hidden" id="id_u" value={{Auth::user()->id}}>
  {{-- Id de la transacción que usa el ingreso --}}
  @if ($ingreso->transaccion != null)
    <input type="hidden" id="id_t" value={{$ingreso->transaccion->id}}>
  @endif
  {{-- Id del paciente --}}
  <input type="hidden" id="id_p" value={{$ingreso->hospitalizacion->f_paciente}}>
@endsection