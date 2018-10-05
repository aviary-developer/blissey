@extends('principal')
@section('layout')
  @include('SolicitudRayosx.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'solicitudex.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  @php
    $create = true;
    $ruta = 'solicitudex?tipo=rayosx';
  @endphp
  <div class="col-md-8">
    @include('SolicitudRayosx.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
