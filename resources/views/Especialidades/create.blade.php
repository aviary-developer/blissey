@extends('principal')
@section('layout')
  @php
    $fecha = Carbon\Carbon::now();
    $ruta = '/especialidades';
    $create = true;
  @endphp
  @include('Especialidades.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'especialidades.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Especialidades.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
