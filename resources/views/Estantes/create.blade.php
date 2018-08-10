@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'estantes.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $fecha = Carbon\Carbon::now();
  @endphp
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Estante
              <small class="label-white badge blue ">Nuevo</small>
          </h3>
        </center>
      </div>
    </div>
    @include('Estantes.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection
