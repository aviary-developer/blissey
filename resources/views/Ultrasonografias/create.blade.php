@extends('principal')
@section('layout')
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
  @endphp
  @include('Ultrasonografias.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'ultrasonografias.store','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Ultrasonografias.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
