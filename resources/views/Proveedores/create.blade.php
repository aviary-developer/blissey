@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'proveedores.store','method' =>'POST'])!!}
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Proveedor<small>Nuevo</small></h2>
        <div class="clearfix"></div>
      </div>
      <?php $bandera=1;?>{{--Indica que es ingresar --}}
      <div class="col-sm-6 col-xs-12">
        @include('Proveedores.Formularios.form')
      </div>
      <div class="col-sm-6 col-xs-12">
        @include('Proveedores.Formularios.form2')
      </div>
    </div>
  </div>
  {!!Form::close()!!}
@endsection
