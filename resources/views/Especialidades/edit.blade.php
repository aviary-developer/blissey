@extends('principal')
@section('layout')
  @php
    $ruta = '/especialidades';
    $create = false;
  @endphp
  @include('Especialidades.Barra.create')
  {!!Form::model($especialidades,['class' =>'form-horizontal form-label-left input_mask','route' =>['especialidades.update',$especialidades->id],'method' =>'PUT','autocomplete'=>'off','id'=>'form'])!!}
  <div class="col-sm-6">
    @include('Especialidades.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
