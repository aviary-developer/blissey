<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
    @include('Estantes.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'estantes.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Estantes.Formularios.form')
  </div>
  <input type="hidden" id="method" value="create">
  {!!Form::close()!!}
@endsection
