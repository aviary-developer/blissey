@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'examenes.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-xs-10">
    <div class="x_panel">
      <div class="x_title">
        <h2>Examen<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Examenes.Formularios.form2')
    </div>
  </div>
  {!!Form::close()!!}
@endsection