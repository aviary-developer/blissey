@extends('principal')
@section('layout')
  @include('Usuarios.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'usuarios.store','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
    if(!isset($validacion_activa)){
      $validacion_activa = false;
    }
  @endphp
  <div class="col-12">
    @include('Usuarios.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
