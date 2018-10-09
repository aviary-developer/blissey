@extends('principal')
@section('layout')
@php
  $est = "solicitudes";
@endphp
@include('SolicitudRayosx.Barra.index')
  <div class="col-sm-8">
    <div class="x_content">
      <div class="col-sm-12">
        @if($vista == "paciente")
          @include('SolicitudRayosx.Partes.lista_paciente')
        @else
          @include('SolicitudRayosx.Partes.lista_rayos')
        @endif
      </div>
    </div>
  </div>
@endsection
