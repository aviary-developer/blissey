@extends('dashboard')
@section('layout')
  {!!Form::model($usuarios,['class' =>'form-horizontal form-label-left input_mask','route' =>['usuarios.update',$usuarios->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $fecha = $usuarios->fechaNacimiento;
    $create = false;
    if(!isset($validacion_activa)){
      $validacion_activa = false;
    }
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Usuario<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Usuarios.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
