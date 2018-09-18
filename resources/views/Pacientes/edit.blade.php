@extends('principal')
@section('layout')
  @include('Pacientes.Barra.create')
  {!!Form::model($pacientes,['class' =>'form-horizontal form-label-left input_mask','route' =>['pacientes.update',$pacientes->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  @php
    $fecha = $pacientes->fechaNacimiento;
    $create = false;
  @endphp
  <div class="col-xs-12">
    @include('Pacientes.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
