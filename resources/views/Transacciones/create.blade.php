@include('DetalleCajas.comprobar')
@php
  $tipoUsuario=Auth::user()->tipoUsuario;
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
      <div class="x_panel">
        <div class="row bg-blue">
          <center>
            <h3>
              @if ($tipo==2)Venta
                <small class="label-white badge blue ">Nueva</small>
              @endif
              @if($tipo==0)Compra
                <small class="label-white badge blue ">Nuevo pedido</small>
              @endif
            </h3>
          </center>
        </div>
      </div>
    </div>
    <div class="x_panel">
      @include('Transacciones.Formularios.form')
      <input type="hidden"  id="tipoUsuario" value="{{$tipoUsuario}}">
    </div>
  </div>
  {!!Form::close()!!}
@endsection
