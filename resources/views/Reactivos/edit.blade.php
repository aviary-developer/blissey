@extends('dashboard')
@section('layout')
  {!!Form::model($reactivos,['class' =>'form-horizontal form-label-left input_mask','route' =>['reactivos.update',$reactivos->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  @php
    $fecha = $reactivos->fechaNacimiento;
    $create=false;
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Reactivo<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Reactivos.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
