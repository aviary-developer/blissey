<?php
$bandera=1;
$estado=1;
?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
    @include('Visitadores.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'visitadores.store','method' =>'POST','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
      @include('Visitadores.Formularios.form')
  </div>
  <input type="hidden" id="method" value="create">
  {!!Form::close()!!}
@endsection
@section('agregarjs')
{!!Html::script('js/scripts/Visitadores.js')!!}
@endsection
