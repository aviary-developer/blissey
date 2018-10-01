@extends('principal')
@section('layout')
  @php
    $fecha = $usuarios->fechaNacimiento;
    $create = false;
  @endphp
  @include('Usuarios.Barra.create')
  {!!Form::model($usuarios,['class' =>'form-horizontal form-label-left input_mask','route' =>['usuarios.update',$usuarios->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data','id'=>'form'])!!}
  <div class="col-12">
    @include('Usuarios.Formularios.form')
  </div>
  <input type="hidden" id="method" value="edit">
  {!!Form::close()!!}
@endsection
