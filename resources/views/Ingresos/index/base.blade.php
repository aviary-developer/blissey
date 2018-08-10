@extends('dashboard')
@section('layout')
  <div class="col-xs-12">
    <div class="row">
      <div class="x_panel">
        <div class="row bg-blue">
          <center>
            <h3>Hospital
              @if ($estadoOpuesto != 2)
                <small class="label-white badge blue ">Alta médica</small>
              @else
                <small class="label-white badge green ">Actuales</small>
              @endif
            </h3>
          </center>
        </div>
        
        <div class="row">
          <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <ul class="nav navbar-nav">
                <li>
                  <a href={!! asset('/habitaciones/create') !!}><i class="fa fa2 fa-plus"></i> Nuevo</a>
                </li>
                <li>
                  <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa2 fa-eye"></i> Ver
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="li-title">Tipo</li>
                    <li><a href={!! asset('#') !!}>Ingreso</a></li>
                    <li><a href={!! asset('#') !!}>Observación</a></li>
                    <li><a href={!! asset('#') !!}>Medi ingreso</a></li> 
                    <li class="divider"></li>
                    <li>
                      <a href={!! asset('#') !!}>
                        @if ($estadoOpuesto)
                          Actuales
                          <span class="label label-success">{{ $activos }}</span>
                        @else
                          Alta médica
                          <span class="label label-warning">{{ $inactivos }}</span>
                        @endif
                      </a>
                    </li> 
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa2 fa-question"></i> Ayuda</a>
                </li> 
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-8">
        <div class="x_panel" style="margin-left: -9px;">
          @include('Ingresos.index.panel.ingreso')
        </div>
      </div>
      <div class="col-xs-4">
        <div class="row">
          <div class="x_panel">
            Mundo
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection