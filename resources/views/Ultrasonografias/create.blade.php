@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'ultrasonografias.store','method' =>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
  @endphp
  <div class="col-md-7 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Ultrasonografía<small>Nueva</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Ultrasonografias.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
