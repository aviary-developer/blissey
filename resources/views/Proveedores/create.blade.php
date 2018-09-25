@extends('principal')
@section('layout')
  @include('Proveedores.Barra.create')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'proveedores.store','method' =>'POST','autocomplete'=>'off'])!!}
      <?php $bandera=1;?>{{--Indica que es ingresar --}}
      <div class="col-sm-12">
        @include('Proveedores.Formularios.form')
      </div>
  {!!Form::close()!!}
@endsection
