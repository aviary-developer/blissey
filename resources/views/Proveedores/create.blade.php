<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
  @include('Proveedores.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'proveedores.store','method' =>'POST','autocomplete'=>'off'])!!}
      <div class="col-sm-12">
        @include('Proveedores.Formularios.form')
      </div>
  {!!Form::close()!!}
@endsection
@section('agregarjs')
{!!Html::script('js/scripts/Proveedores.js')!!}
@endsection
