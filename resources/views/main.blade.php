@extends('dashboard')
@section('layout')
<!-- page content -->
<!--Panel-->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="row">
      <center>
        @if (isset($empresa))
          <img src={{asset(Storage::url($empresa->logo_hospital))}} class="img-responsive avatar-view smallperfil">
          <h3>Grupo Promesa
            <br><small>Divino Niño</small>
          </h3>
        @else
          <img src={{asset(Storage::url("NoImgen.jpg"))}} class="img-responsive avatar-view smallperfil">
          <h3>Grupo Promesa
            <br><small>Divino Niño</small>
          </h3>
        @endif
      </center>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-1">
      <div class="x_panel">
        @if (Auth::user()->tipoUsuario == "Recepción")
          @include('widget.ingreso')
        @elseif (Auth::user()->tipoUsuario == "Laboaratorio")
          @include('widget.reactivos')
        @endif
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-1">
      <div class="x_panel">
        @if (Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Laboaratorio")
          @include('widget.solicitudes')
        @endif
      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@stop
