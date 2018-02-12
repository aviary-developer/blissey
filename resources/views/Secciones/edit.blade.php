@extends('dashboard')
@section('layout')
  {!!Form::model($secciones,['class' =>'form-horizontal form-label-left input_mask','route' =>['secciones.update',$secciones->id],'method' =>'PUT','autocomplete'=>'off'])!!}
  @php
    $fecha = $secciones->fechaNacimiento;
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Tipo de sección<small>Editar</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Secciones.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
