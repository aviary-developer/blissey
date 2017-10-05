@extends('dashboard')
@section('layout')
  {!!Form::model($examenes,['class' =>'form-horizontal form-label-left input_mask','route' =>['examenes.update',$examenes->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  @php
    $fecha = $examenes->fechaNacimiento;
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Examen<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Examenes.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
