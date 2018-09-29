<?php $bandera=1;?>{{--Indica que es ingresar --}}
@extends('principal')
@section('layout')
    @include('Visitadores.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'visitadores.store','method' =>'POST','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Visitador<small>Nuevo para: {{App\Proveedor::buscarNombre($id)}}</small></h2>
        <div class="clearfix"></div>
      </div>
      @include('Visitadores.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
