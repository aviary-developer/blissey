@php
  $tipoUsuario=Auth::user()->tipoUsuario;
  $tipo=0;
@endphp
@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'transacciones.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    if(!isset($fecha)){
    $fecha = Carbon\Carbon::now();
    }
    $pantalla=1;//Crear
  @endphp
  <div class="col-xs-12">
    <div class="x_panel">
      <div class="x_title">
          <h2>Compra<small>Nuevo pedido</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Transacciones.Formularios.formproveedor')
      <input type="hidden"  id="tipoUsuario" value="{{$tipoUsuario}}">
    </div>
  </div>
  {!!Form::close()!!}
@endsection
