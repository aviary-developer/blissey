@extends('dashboard')
@section('layout')
<div class="co-xs-12">
  <div class="x_panel">
    <div class="row bg-blue">
      <center>
        <h3>Calendario</h3>
      </center>
    </div>
    <div class="row">
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li>
              <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
            </li> 
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="x_panel">
    <div id="calendar"></div>
  </div>
  
  @include('Calendario.create')
  @include('Calendario.update')
</div>
@endsection