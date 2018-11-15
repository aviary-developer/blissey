@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Transacciones.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
        @include('Transacciones.Partes.datos_productos')
  </div>
</div>
<div class="col-sm-4">
  @include('Transacciones.Partes.datos_transaccion')
</div>
@endsection