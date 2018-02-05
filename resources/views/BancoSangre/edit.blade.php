@extends('dashboard')
@section('layout')
  {!!Form::model($donacion,['class' =>'form-horizontal form-label-left input_mask','route' =>['bancosangre.update',$donacion->id],'method' =>'PUT','autocomplete'=>'off','enctype'=>'multipart/form-data'])!!}
  @php
    $fecha = $donacion->fechaVencimiento;
    $create = false;
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Donación<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('BancoSangre.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
