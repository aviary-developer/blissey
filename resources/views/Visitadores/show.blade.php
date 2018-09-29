@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Visitadores.Barra.show')
  <div class="col-sm-6">
    <div class="x_panel">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
            Visitadores
          </a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          @include('Visitadores.Partes.datos_visitadores')
        </div>
      </div>
    </div>
  </div>
@endsection
