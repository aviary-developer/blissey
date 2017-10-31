@extends('dashboard')
@section('layout')
  {!!Form::model($habitaciones,['class' =>'form-horizontal form-label-left input_mask','route' =>['habitaciones.update',$habitaciones->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  @php
    $ruta = '/habitaciones';
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Habitación<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Habitaciones.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
