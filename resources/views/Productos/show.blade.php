@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Productos.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
          Divisiones
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
          Componentes
        </a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('Productos.Partes.datos_divisiones')
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @include('Productos.Partes.datos_componentes')
      </div>
    </div>
  </div>
</div>
<div class="col-sm-4">
  @include('Productos.Partes.datos_producto')
</div>
<input type="hidden" id="id-p" value={{$producto->id}}>
@endsection
