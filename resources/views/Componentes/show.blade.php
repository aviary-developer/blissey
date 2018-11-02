@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Componentes.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
        @include('Componentes.Partes.datos_productos')
  </div>
</div>
<div class="col-sm-4">
  @include('Componentes.Partes.datos_componente')
</div>
<input type="hidden" id="id-p" value={{$componente->id}}>
@endsection
