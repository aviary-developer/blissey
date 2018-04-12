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
        <h2>Solicitud de Ultrasonografías<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('SolicitudUltras.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
