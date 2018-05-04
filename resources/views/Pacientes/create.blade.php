@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'pacientes.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
  @endphp
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Paciente<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Pacientes.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
