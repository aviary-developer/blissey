@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'transacciones.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Transacción<small>Nueva</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Transacciones.Formularios.transacciones_form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
