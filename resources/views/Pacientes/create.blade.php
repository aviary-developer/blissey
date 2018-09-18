@extends('principal')
@section('layout')
  @include('Pacientes.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'pacientes.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
  @endphp
  <div class="col-xs-12">
    @include('Pacientes.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
