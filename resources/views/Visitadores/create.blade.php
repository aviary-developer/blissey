@php
  use App\Proveedor;
@endphp
@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'visitadores.store','method' =>'POST','autocomplete'=>'off'])!!}
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Visitador<small>Nuevo para: {{Proveedor::buscarNombre($id)}}</small></h2>
        <div class="clearfix"></div>
      </div>
      <?php $bandera=1;?>{{--Indica que es ingresar --}}
      @include('Visitadores.Formularios.form')
    </div>
  </div>
  {!!Form::close()!!}
@endsection
