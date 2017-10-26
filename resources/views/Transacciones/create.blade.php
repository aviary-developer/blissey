@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'transacciones.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        @if ($tipo==1)
          <h2>Venta<small>Nueva</small></h2>
        @else
          <h2>Compra<small>Nueva</small></h2>
        @endif
        <div class="clearfix"></div>
      </div>
      @include('Transacciones.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
