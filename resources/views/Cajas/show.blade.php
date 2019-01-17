@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Cajas.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
    @include('Cajas.Partes.datos_aperturas')
  </div>
</div>
<div class="col-sm-4">
  @include('Cajas.Partes.datos_caja')
</div>
<input type="hidden" id="id-p" value={{$caja->id}}>
@endsection