@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'secciones.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Sección<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Secciones.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
