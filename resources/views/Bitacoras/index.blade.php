@extends('principal')
@section('layout')
  @include('Bitacoras.Barra.index')
  <div class="col-12">
    <div class="x_panel">
      @include('Bitacoras.form.tabla')
    </div>
  </div>

  {{-- Modal --}}
  @include('Bitacoras.form.modal_busqueda')
@endsection
