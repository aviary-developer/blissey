@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Unidades.Barra.show')
<div class="col-sm-4">
  @include('Unidades.Partes.datos_unidad')
</div>
<input type="hidden" id="id-p" value={{$unidad->id}}>
@endsection
