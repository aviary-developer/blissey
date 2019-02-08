@extends('principal')
@section('layout')
{!! Form::model($transaccion,['route'=>['requisiciones.update',$transaccion->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','id'=>'formAsignar','autocomplete'=>'off']) !!}
	@include('Requisiciones.Barra.asignar')
  <div class="col-sm-12">
		@include('Requisiciones.Formularios.formAsignar')
</div>
{!!Form::close()!!}
@endsection