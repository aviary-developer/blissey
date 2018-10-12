@extends('principal')
@section('layout')
  @include('Ingresos.Barra.index')
  <div class="col-sm-12">
    <div class="flex-row">
      <div class="col-sm-8">
        <div class="x_panel">
          @include('Ingresos.index.panel.ingreso')
        </div>
      </div>
      <div class="col-sm-4">
        <div class="flex-row">
          <div class="x_panel">
            @include('Ingresos.index.panel.consulta')
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection