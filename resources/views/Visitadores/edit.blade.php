<?php $bandera=2;
$id=$visitador->f_proveedor;
$estado=$visitador->estado;
?>{{--Indica que es editar --}}
@extends('principal')
@section('layout')
  @include('Visitadores.Barra.create')
    {!! Form::model($visitador,['route'=>['visitadores.update',$visitador->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','autocomplete'=>'off','id'=>'form']) !!}
  <div class="col-sm-6">
      @include('Visitadores.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
@section('agregarjs')
{!!Html::script('js/scripts/Visitadores.js')!!}
@endsection
