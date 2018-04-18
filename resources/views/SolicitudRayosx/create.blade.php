@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'solicitudex.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $create = true;
    $ruta = 'solicitudex';
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Solicitud de Radiografías<small>Nueva</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('SolicitudRayosx.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
