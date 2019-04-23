@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('DetalleCajas.Barra.arqueo')
  <div class="col-sm-8">
    <div class="x_panel">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        @include('DetalleCajas.Partes.movimientos_caja')
      </div>
    </div>
  </div>
<div class="col-sm-4">
  @include('DetalleCajas.Partes.datos_caja')
</div>
@include('DetalleCajas.Partes.modal_efectivo')
@endsection