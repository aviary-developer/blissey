@extends('dashboard')
@section('layout')
  @if ($estado == 1 || $estado == null)
    @php
    $estadoOpuesto = 0;
    @endphp
  @else
    @php
    $estadoOpuesto = 1;
    @endphp
  @endif
  @php
  $index = true;
  @endphp
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Componentes
            @if ($estadoOpuesto)
              <small class="label-white badge red ">Papelera</small>
            @else
              <small class="label-white badge green ">Activos</small>
            @endif
          </h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li>
                <a href={!! asset('/componentes/create') !!}><i class="fa fa2 fa-plus"></i> Nuevo</a>
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
                  <li>
                    <a href={!! asset('/componentes?estado='.$estadoOpuesto) !!}>
                      @if ($estadoOpuesto)
                        Activos
                        <span class="label label-success">{{ $activos }}</span>
                      @else
                        Papelera
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
    <div class="x_panel">
      <div class="x_content">
        <div class="row">
          <table class="table table-striped" id="index-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th style="width: 200px">Opciones</th>
            </tr>
          </thead>
          <tbody>
              @php
              $correlativo = 1;
              @endphp
              @foreach ($componentes as $componente)
                <tr>
                  <td>{{ $correlativo+$pagina }}</td>
                  <td>
                    <a href={{asset('/componentes/'.$componente->id)}}>
                      {{ $componente->nombre}}
                    </a>
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Componentes.Formularios.activate')
                    @else
                      @include('Componentes.Formularios.desactivate')
                    @endif
                  </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
          </tbody>
        </table>
      </div>
        <div class="ln_solid"></div>
    </div>
  </div>
  <!-- /page content -->
@endsection
