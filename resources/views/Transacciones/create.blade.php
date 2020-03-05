@include('DetalleCajas.comprobar')
@php
  $tipoUsuario=Auth::user()->tipoUsuario;
@endphp
@extends('principal')
@section('layout')
  @include('Transacciones.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'transacciones.store','method' =>'POST','autocomplete'=>'off','id'=>'formVenta'])!!}
  @php
    if(!isset($fecha)){
    $fecha = Carbon\Carbon::now();
    }
    $pantalla=1;//Crear
  @endphp
      @include('Transacciones.Formularios.form')
      <input type="hidden"  id="tipoUsuario" value="{{$tipoUsuario}}">
  {!!Form::close()!!}
@endsection
