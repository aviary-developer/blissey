@extends('PDF.hoja')
@section('layout')
@php
  setlocale(LC_ALL,'es');
@endphp
<div class="row">
  <div>
    <center>
      <h3>Informe Financiero</h3>
    </center>
  </div>
  <div>
    <div class="col-xs-9">
      <div class="col-xs-2">
        <span>PACIENTE:</span>
      </div>
      <div class="col-xs-10 subrayar">
        <b>{{' '.$ingreso->hospitalizacion->paciente->nombre.' '.$ingreso->hospitalizacion->paciente->apellido}}</b>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="col-xs-6">
        <span>EDAD:</span>
      </div>
      <div class="col-xs-6 subrayar">
        <b>
          {{' '.$ingreso->hospitalizacion->paciente->fechaNacimiento->age.' años'}}
        </b>
      </div>
    </div>
  </div>
  <div>
    <div class="col-xs-9">
      <div class="col-xs-2">
        <span>DIRECCIÓN:</span>
      </div>
      <div class="col-xs-10 subrayar">
        @if ($ingreso->hospitalizacion->paciente->direccion != null)
          <b>{{$ingreso->hospitalizacion->paciente->direccion}}</b>
        @else
          <i><b class="red">Falta la dirección</b></i>
        @endif
      </div>
    </div>
    <div class="col-xs-3">
      <div class="col-xs-6">
        <span>TELÉFONO:</span>
      </div>
      <div class="col-xs-6 subrayar">
        @if ($ingreso->hospitalizacion->paciente->telefono != null)  
          <b>{{' '.$ingreso->hospitalizacion->paciente->telefono}}</b>
        @else
          <i><b class="red">Falta el tel.</b></i>
        @endif
      </div>
    </div>
  </div>
  <div>
    <div class="col-xs-7">
      <div class="col-xs-8 row">
        <div class="col-xs-4">
          FECHA:
        </div>
        <div class="col-xs-8 subrayar">
          <b>{{' '.$ingreso->fecha_ingreso->format('d / m / Y g:i a')}}</b>
        </div>
      </div>
      <div class="col-xs-4 row">
        <div class="col-xs-8">
          <span>
            HABITACIÓN:
          </span>
        </div>
        <div class="col-xs-3 subrayar">
          <b>{{' '.$ingreso->habitacion->numero}}</b>
        </div>
      </div>
    </div>
    <div class="col-xs-5">
      <div class="col-xs-6">
        <span>
          EXPEDIENTE NO.:
        </span>
      </div>
      <div class="col-xs-6 subrayar">
        <b>{{$ingreso->hospitalizacion->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y')}}</b>
      </div>
    </div>
  </div>
  <div>
    <div class="col-xs-12">
      <div class="col-xs-4">
        <span>
          MÉDICO QUE AUTORIZA EL INGRESO:
        </span>
      </div>
      <div class="col-xs-8  subrayar">
        <b>
          @if ($ingreso->hospitalizacion->medico->sexo)
            {{" Dr. "}}
          @else
            {{" Dra. "}}
          @endif
          {{$ingreso->hospitalizacion->medico->nombre.' '.$ingreso->hospitalizacion->medico->apellido}}
        </b>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="col-xs-2">
        <span>
          RECEPCIONISTA:
        </span>
      </div>
      <div class="col-xs-10 subrayar">
        <b>{{$ingreso->recepcion->nombre.' '.$ingreso->recepcion->apellido}}</b>
      </div>
    </div>
    <br>
  </div>
</div>
<br>
  @include('Ingresos.PDF.informe.ingreso_mini')
@endsection