@extends('dashboard')
@section('layout')
  @php
    $tipo=0;
    $pantalla=2;//Confirmar
  @endphp
  {!! Form::model($transaccion,['route'=>['transacciones.update',$transaccion->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','autocomplete'=>'off']) !!}
  <div class="col-xs-12">
      <div class="x_panel">
        <div class="x_title">
            <h2>Pedido<small>Confirmar</small></h2>
          <div class="clearfix"></div>
        </div>
        @include('Transacciones.Formularios.formConfirm')
      </div>
  <center>
</center>
</div>
{!!Form::close()!!}
@endsection
