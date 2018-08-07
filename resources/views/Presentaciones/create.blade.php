@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'presentaciones.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
    $ruta = '/presentaciones';
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>presentación
              <small class="label-white badge blue ">Nueva</small>
          </h3>
        </center>
      </div>
    </div>
    @include('Presentaciones.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
