@extends('principal')
@section('layout')
  @include('SolicitudExamenes.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'solicitudex.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  @php
    $create = true;
    $ruta = 'solicitudex?tipo=examenes';
  @endphp
  <div class="col-md-12 col-xs-12">
    @include('SolicitudExamenes.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection