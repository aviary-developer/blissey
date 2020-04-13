@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Pacientes.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
          Servicios Médicos
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
          Evaluaciones
        </a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('Pacientes.Partes.datos_ingreso')
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('Pacientes.Partes.datos_solicitudes')
      </div>
    </div>
  </div>
</div>
<div class="col-sm-4">
  <div class="x_panel">
  <div class="flex-row">
    <center>
      <h5 class="mb-1">Datos Personales</h5>
    </center>
  </div>

  <div class="ln_solid mb-1 mt-1"></div>
  @include('Pacientes.Partes.datos_paciente')
</div>
</div>
<input type="hidden" id="id-p" value={{$paciente->id}}>
@include('Pacientes.Partes.modal_ingreso')
@endsection
