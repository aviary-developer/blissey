@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Presentaciones.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
    @include('Presentaciones.Partes.datos_productos')
  </div>
</div>
<div class="col-sm-4">
  @include('Presentaciones.Partes.datos_presentacion')
</div>
<input type="hidden" id="id-p" value={{$presentacion->id}}>
@endsection
