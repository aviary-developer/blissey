@extends('principal')
@section('layout')
@php
  $est = "solicitudes"
@endphp
@include('SolicitudExamenes.Barra.index')
  <div class="col-sm-8">
    <div class="x_content">
      <div class="row">
        <div class="col-sm-12">
          @if($vista == "paciente")
            @include('SolicitudExamenes.Partes.lista_paciente')
          @else
            @include('SolicitudExamenes.Partes.lista_examen')
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
