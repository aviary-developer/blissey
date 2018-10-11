<?php $bandera=2;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('Productos.Barra.create')
  {!!Form::model($productos,['class' =>'form-horizontal form-label-left input_mask','route' =>['productos.update',$productos->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  @php
  $create = false;
  @endphp
<div class="col-sm-12">
  @include('Productos.Formularios.form')
</div>
{!!Form::close()!!}
{!!Html::script('js/scripts/Productos.js')!!}
@include('Productos.Formularios.modalDivision')
@endsection
