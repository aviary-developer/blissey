@extends('principal')
@section('layout')
@php
  $est = "solicitudes"
@endphp
  @include('SolicitudTAC.Barra.index')
  <div class="col-sm-8">
    <div class="x_content">
      <div class="col-sm-12">
        @if($vista == "paciente")
          @include('SolicitudTAC.Partes.lista_paciente')
        @else
          @include('SolicitudTAC.Partes.lista_tac')
        @endif
      </div>
    </div>
  </div>
@endsection
