@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('CategoriaProductos.Barra.show')
<div class="col-sm-8">
  <div class="x_panel">
    @include('CategoriaProductos.Partes.datos_productos')
  </div>
</div>
<div class="col-sm-4">
  @include('CategoriaProductos.Partes.datos_categoria')
</div>
<input type="hidden" id="id-p" value={{$categoria->id}}>
@endsection
