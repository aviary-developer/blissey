<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
    @include('Cajas.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'cajas.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Cajas.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
