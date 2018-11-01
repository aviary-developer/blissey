@extends('principal')
@section('layout')
{{-- {!! Form::model($transaccion,['route'=>['requisiciones.update',$transaccion->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','id'=>'formVender','autocomplete'=>'off']) !!} --}}
	@include('Requisiciones.Barra.create_f')
  <div class="col-sm-8">
		@include('Requisiciones.Formularios.formConfirm')
</div>
{{-- {!!Form::close()!!} --}}
@endsection
