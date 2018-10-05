@extends('principal')
@section('layout')
  @include('SolicitudTAC.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'solicitudex.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  @php
    $create = true;
    $ruta = 'solicitudex?tipo=tac';
  @endphp
  <div class="col-md-8">
    @include('SolicitudTAC.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
