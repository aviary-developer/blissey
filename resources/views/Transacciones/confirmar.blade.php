@extends('dashboard')
@section('layout')
  @php
    $tipo=0;
    $pantalla=2;//Confirmar
  @endphp
  {!! Form::model($transaccion,['route'=>['proveedores.update',$transaccion->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','autocomplete'=>'off']) !!}
  <div class="col-xs-12">
    @include('Transacciones.Formularios.form')
  <center>
  {!! Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
</center>
</div>
{!!Form::close()!!}
@endsection
