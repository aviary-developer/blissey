@php
  $tipoUsuario=Auth::user()->tipoUsuario;
  $tipo=0;
@endphp
@extends('principal')
@section('layout')
  @include('Transacciones.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'transacciones.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    if(!isset($fecha)){
    $fecha = Carbon\Carbon::now();
    }
    $pantalla=1;//Crear
  @endphp
      @include('Transacciones.Formularios.formproveedor')
      <input type="hidden"  id="tipoUsuario" value="{{$tipoUsuario}}">
  {!!Form::close()!!}
  {!!Html::script('js/scripts/StockProveedor.js')!!}
@endsection
