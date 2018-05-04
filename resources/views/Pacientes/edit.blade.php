@extends('dashboard')
@section('layout')
  {!!Form::model($pacientes,['class' =>'form-horizontal form-label-left input_mask','route' =>['pacientes.update',$pacientes->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  @php
    $fecha = $pacientes->fechaNacimiento;
    $create = false;
  @endphp
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Paciente<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Pacientes.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
