@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'habitaciones.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $create = true;
    $ruta = '/habitaciones';
  @endphp
  <div class="col-md-10 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Habitación <small class="label-white blue badge">Nuevo</small></h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li>
                <a href={!! asset('/habitaciones') !!}><i class="fa fa2 fa-arrow-left"></i> Atras</a>
              </li>
              <li>
                <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
              </li> 
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-5">
        <div class="x_panel" style="height:363px">
          @include('Habitaciones.Formularios.habitacion')
        </div>
      </div>
      <div class="col-xs-7">
        <div class="x_panel">
          @include('Habitaciones.Formularios.camas')
        </div>
      </div>
    </div>
    <div class="x_panel">
      <div class="row">
        <center>
          {!! Form::submit('Guardar',['class'=>'btn btn-primary btn-sm']) !!}
          <button type="reset" name="button" class="btn btn-default btn-sm">Limpiar</button>
          <a href={!! asset($ruta) !!} class="btn btn-default btn-sm">Cancelar</a>
        </center>
      </div>
    </div>
  </div>
  <input type="hidden" id="count_hi" value={{$count_hi}}>
  <input type="hidden" id="count_ho" value={{$count_ho}}>
  <input type="hidden" id="count_hm" value={{$count_hm}}>
  <input type="hidden" id="count_ci" value={{$count_ci}}>
  <input type="hidden" id="count_co" value={{$count_co}}>
  <input type="hidden" id="count_cm" value={{$count_cm}}>
  {!!Form::close()!!}
@endsection
