@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'productos.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Producto<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Productos.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
