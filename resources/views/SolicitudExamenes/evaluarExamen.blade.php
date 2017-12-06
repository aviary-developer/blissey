@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'examenes.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Examen<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Examenes.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
