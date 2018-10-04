<?php $bandera=2;?>{{--Indica que es editar --}}
@extends('principal')
@section('layout')
  @include('Proveedores.Barra.create')
  {!! Form::model($proveedor,['route'=>['proveedores.update',$proveedor->id],'method'=>'PUT','class'=>'form-horizontal form-label-left input_mask','autocomplete'=>'off','id'=>'form']) !!}
    <div class="col-sm-12">
        @include('Proveedores.Formularios.form')
    </div>
  {!!Form::close()!!}
@endsection
@section('agregarjs')
{!!Html::script('js/scripts/Proveedores.js')!!}
@endsection
