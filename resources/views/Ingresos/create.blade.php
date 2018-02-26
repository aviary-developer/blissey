@extends('dashboard')
@section('layout')
  {{Form::open(['class'=>'form-horizontal form-label-left input_mask', 'route'=>'ingresos.store', 'method'=>'POST', 'autocomplete'=>'off','id'=>'ingreso_form'])}}
  @php
    $ruta = '/ingresos';
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-7 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Hospitalización <small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Ingresos.Formularios.form')
    </div>
  </div>
  {{Form::close()}}
@endsection
