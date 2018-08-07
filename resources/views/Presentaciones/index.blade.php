
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
          <h3>Presentaciones
            @if ($estadoOpuesto)
              <small class="label-white badge red ">Papelera</small>
            @else
              <small class="label-white badge green ">Activas</small>
            @endif
          </h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li>
                <a href={!! asset('/presentaciones/create') !!}><i class="fa fa2 fa-plus"></i> Nuevo</a>
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
                    <a href={!! asset('/presentaciones?estado='.$estadoOpuesto) !!}>
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
              @foreach ($presentaciones as $presentacion)
                <tr>
                  <td>{{ $correlativo + $pagina}}</td>
                  <td>
                    <a href={{asset('/presentaciones/'.$presentacion->id)}}>
                      {{ $presentacion->nombre }}
                    </a>
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Presentaciones.Formularios.activate')
                    @else
                      @include('Presentaciones.Formularios.desactivate')
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
  </div>
  <!-- /page content -->
  {{-- Modal --}}
  <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            <span aria-hidden="true">x</span>
          </button>
          <h4 class="modal-title">Presentación <small>Nueva</small></h4>
        </div>
        <div class="modal-body">
          <div class="x_panel">
            <div class="form-group">
              <label class="control-label">Nombre *</label>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('nombre_presentacion',null,['id'=>'nombre_presentacion','class'=>'form-control has-feedback-left','placeholder'=>'Nombre presentación']) !!}
              </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" id="accion" value="">
          <input type="hidden" id="idEditar" value="">
          <button id="guardar_presentacion" class="btn btn-primary" type="button">Guardar</button>
          <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
@endsection
