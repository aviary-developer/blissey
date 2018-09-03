@extends('dashboard')
@section('layout')
  {!!Form::open(['class' =>'form-horizontal form-label-left input_mask','route' =>'solicitudex.store','method' =>'POST','autocomplete'=>'off'])!!}
  @php
    $create = true;
    $ruta = 'solicitudex?tipo=examenes';
  @endphp
  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Solicitud de Examen <small class="label-white blue badge">Nueva</small></h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li>
                <a href={!! asset('/solicitudex?tipo=examenes') !!}><i class="fa fa2 fa-arrow-left"></i> Atras</a>
              </li>
              <li>
                <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
              </li> 
            </ul>
          </div>
        </nav>
      </div>
    </div>
    @include('SolicitudExamenes.Formularios.form')
  </div>
  {!!Form::close()!!}
@endsection