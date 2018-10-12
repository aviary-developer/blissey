@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Divisiones.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
          Productos
        </a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('Divisiones.Partes.datos_productos')
      </div>
    </div>
  </div>
</div>
<div class="col-sm-4">
  @include('Divisiones.Partes.datos_division')
</div>
<input type="hidden" id="id-p" value={{$division->id}}>
@endsection
