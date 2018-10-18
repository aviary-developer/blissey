@extends('PDF.hoja')
@section('layout')
@php
  setlocale(LC_ALL,'es');
@endphp
<div class="row">
  <div>
    <center>
      <h3>INFORME</h3>
    </center>
  </div>
  <div>
    <div class="col-xs-9">
      <div class="col-xs-2">
        <span>PACIENTE:</span>
      </div>
      <div class="col-xs-10 subrayar">
        <b>{{' '.$ingreso->paciente->nombre.' '.$ingreso->paciente->apellido}}</b>
      </div>
    </div>
    <div class="col-xs-3">
      <div class="col-xs-6">
        <span>EDAD:</span>
      </div>
      <div class="col-xs-6 subrayar">
        <b>
          {{' '.$ingreso->paciente->fechaNacimiento->age.' años'}}
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
        @if ($ingreso->paciente->direccion != null)
          <b>{{$ingreso->paciente->direccion}}</b>
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
        @if ($ingreso->paciente->telefono != null)  
          <b>{{' '.$ingreso->paciente->telefono}}</b>
        @else
          <i><b class="red">Falta el tel.</b></i>
        @endif
      </div>
    </div>
  </div>
  <div>
    <div class="col-xs-7">
      <div class="col-xs-5 row">
        <div class="col-xs-5">
          FECHA:
        </div>
        <div class="col-xs-7 subrayar">
          <b>{{' '.$ingreso->fecha_ingreso->format('d / m / Y')}}</b>
        </div>
      </div>
      <div class="col-xs-4 row">
        <div class="col-xs-5">
          <span>
            HORA:
          </span>
        </div>
        <div class="col-xs-7 subrayar">
          <b>{{' '.$ingreso->fecha_ingreso->format('g:i a')}}</b>
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
      <div class="col-xs-5">
        <span>
          EXPEDIENTE NO.:
        </span>
      </div>
      <div class="col-xs-7 subrayar">
        <b>{{$ingreso->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y')}}</b>
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
          @if ($ingreso->medico->sexo)
            {{" Dr. "}}
          @else
            {{" Dra. "}}
          @endif
          {{$ingreso->medico->nombre.' '.$ingreso->medico->apellido}}
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