@extends('principal')
@section('layout')
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
  @endphp
  @include('Usuarios.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'usuarios.store','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="col-12">
    @include('Usuarios.Formularios.form')
  </div>
  <input type="hidden" id="method" value="create">
  {!!Form::close()!!}
@endsection
