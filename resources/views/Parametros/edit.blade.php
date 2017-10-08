@extends('dashboard')
@section('layout')
  {!!Form::model($parametros,['class' =>'form-horizontal form-label-left input_mask','route' =>['parametros.update',$parametros->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  @php
    $fecha = $parametros->fechaNacimiento;
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Parametro<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Parametros.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
