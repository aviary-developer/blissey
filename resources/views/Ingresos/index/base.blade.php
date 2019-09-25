@extends('principal')
@section('layout')
  @include('Ingresos.Barra.index')
  <div class="col-sm-12">
    <div class="flex-row">
      <div class="col-sm-7">
        <div class="x_panel rounded border border-success">
          @include('Ingresos.index.panel.ingreso')
        </div>
      </div>
      <div class="col-sm-5">
        <div class="flex-row">
          <div class="x_panel rounded border border-pink">
            @include('Ingresos.index.panel.consulta')
          </div>
          <div class="x_panel rounded border border-primary">
            @include('Ingresos.index.panel.observacion')
          </div>
          {{--  <div class="x_panel rounded border border-purple">
            @include('Ingresos.index.panel.mediingreso')
          </div>  --}}
        </div>
      </div>
    </div>
  </div>
@endsection