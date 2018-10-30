@extends('principal')
@section('layout')
  @php
    $tipo=0;
		$pantalla=2;//Confirmar
		$fecha = Carbon\Carbon::now();
	@endphp
	@include('Transacciones.Barra.confirmar')
  @include('DetalleCajas.comprobar2')
  {!! Form::model($transaccion,['route'=>['transacciones.update',$transaccion->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','id'=>'formVender','autocomplete'=>'off']) !!}
  <div class="col-sm-12">
		@include('Transacciones.Formularios.formConfirm')
	</div>
{!!Form::close()!!}
@endsection
