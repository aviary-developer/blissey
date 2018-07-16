@extends('dashboard')
@section('layout')
  {{-- Base del dashboard --}}
  {{-- Inicialización del formato para fechas--}}
  @php
    setlocale(LC_ALL,'es');
  @endphp

  {{-- Condiconal de tipo de usuario, segun sea el tipo de usuario así sera el dashboard a mostrar --}}
  <div class="col-xs-12">
    <div class="x_panel">

      {{-- Encabezado con los datos del usuario y configuraciones --}}
      
      <div class="row bg-gray" style="padding: 5px;">
        <div class="col-xs-1">

          {{-- Imagen de perfil segun el sexo --}}

          <div class="row">
            <center>
              <img src={{asset((($paciente->sexo)?'img/hombre.png':'img/mujer.png'))}} class="img-circle" style="width: 60px; height: 60px;">
            </center>
          </div>
        </div>

        {{-- Datos personales del usuario --}}
        
        <div class="col-xs-10">
          <div class="row black">
            <h4>
              {{$paciente->nombre.' '}}
              <b>
                {{$paciente->apellido}}
              </b>
              <small>
                {{ $ingreso->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y') }}
              </small>
            </h4>
          </div>
          <div class="row">
            <span class="label label-lg label-default col-xs-1" style="margin-right: 5px;">
              {{$paciente->fechaNacimiento->age.' años'}}
            </span>
            @if ($ingreso->tipo < 3)
              @if ($ingreso->estado==1)
                <span class="label label-lg label-primary col-xs-2">{{($ingreso->paciente->sexo)?"Hospitalizado":"Hospitalizada"}}</span>
              @elseif($ingreso->estado == 0)
                <span class="label label-lg label-warning col-xs-2">Pendiente de acta</span>
              @else
                <span class="label label-lg label-success col-xs-2">Con alta</span>
              @endif
            @else
              @if ($ingreso->estado == 0)
                <span class="label label-lg label-primary col-xs-2">{{($ingreso->paciente->sexo)?"Activo":"Activa"}}</span>
              @else
                <span class="label label-lg label-success col-xs-2">Con alta</span>
              @endif
            @endif
          </div>
        </div>

        {{-- Estado del ingreso del paciente y configuracion --}}
        
        <div class="col-xs-1">
          <div class="row">
            @if ($ingreso->estado == 1)  
              <button type="button" class="btn btn-xs btn-dark col-xs-12" data-toggle="modal" data-target="#acciones"><i class="fa fa-cog"></i> Acciones</button>
            @endif
          </div>
          <div class="row">
            <button type="button" class="btn btn-dark btn-xs col-xs-12" data-target="#datos_paciente" data-toggle="modal"><i class="fa fa-user"></i> Paciente</button>
          </div>
        </div>
      </div>

      @if ($ingreso->estado == 0)
        <div class="row bg-blue">
      @elseif($ingreso->estado == 1)
        <div class="row bg-green">
      @else
        <div class="row bg-danger">
      @endif
        <div class="col-xs-1">
          @if ($ingreso->estado > 1)
            @php
              $regreso = "?estado=2";
            @endphp
          @else
            @php
              $regreso = "";
            @endphp
          @endif
          <div class="row">

            <a href={!! asset('/ingresos'.$regreso)!!} class="btn btn-dark btn-xs col-xs-12" style="margin-bottom: 0px; margin-right: 0px;">
              <i class="fa fa-arrow-left"></i> Atras
            </a>
          </div>
        </div>
        <div class="col-xs-3">
          <center>
            <span>
              <i class="fa fa-arrow-down"></i> {{$ingreso->fecha_ingreso->formatLocalized('%d / %b / %Y a las %H:%M:%S')}}
            </span>
          </center>
        </div>
        <div class="col-xs-4">
          <center>
            <span>
              {{'Habitación '.$ingreso->habitacion->numero}}
            </span>
          </center>
        </div>
        <div class="col-xs-3">
          <center>
            @if ($ingreso->fecha_alta != null)
              <span>
                <i class="fa fa-arrow-up"></i> {{$ingreso->fecha_alta->formatLocalized('%d / %b / %Y a las %H:%M:%S')}}
              </span>
            @endif
          </center>
        </div>
        <div class="col-xs-1">
          <div class="row">
            <button type="button" class="btn btn-primary btn-xs col-xs-12" style="margin-bottom: 0px; margin-right: 0px;"><i class="fa fa-question-circle"></i> Ayuda</button>
          </div>
        </div>
      </div>

      @include('Ingresos.dashboard.modales.datos_paciente')
      
      
      @if (Auth::user()->tipoUsuario == "Recepción")
        @include('Ingresos.dashboard.usuarios.recepcion')
      @endif

    </div>
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
  <input type="hidden" id="id_p" value={{$ingreso->f_paciente}}>
@endsection