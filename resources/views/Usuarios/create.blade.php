@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'usuarios.store','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
    if(!isset($validacion_activa)){
      $validacion_activa = false;
    }
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Usuario<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Usuarios.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
