<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('Productos.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'productos.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $create = true;
  @endphp
  <div class="col-sm-12">
    @include('Productos.Formularios.form')
  </div>
  <input type="hidden" id="method" value="create">
  {!!Form::close()!!}
  {!!Html::script('js/scripts/Productos.js')!!}
@endsection
