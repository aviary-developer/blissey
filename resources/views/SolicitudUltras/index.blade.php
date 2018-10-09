@extends('principal')
@section('layout')
@php
  $est = "solicitudes";
@endphp
@include('SolicitudUltras.Barra.index')
  <div class="col-sm-8">
    <div class="x_content">
      <div class="col-sm-12">
        @if($vista == "paciente")
          @include('SolicitudUltras.Partes.lista_paciente')
        @else
          @include('SolicitudUltras.Partes.lista_ultras')
        @endif
      </div>
    </div>
  </div>
@endsection
