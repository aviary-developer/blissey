@extends('dashboard')
@section('layout')
  @if ($estado != 2 || $estado == null)
    @php
      $estadoOpuesto = 2;
    @endphp
  @else
    @php
      $estadoOpuesto = 0;
    @endphp
  @endif

  @php
    $index = true;
  @endphp

  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          @if ($tipo == 0)
            Ingresos
          @elseif($tipo == 1)
            Observaciones
          @elseif($tipo == 2)
            Medi Ingresos
          @elseif($tipo == 3)
            Consultas Médicas
          @else
            Curaciones
          @endif
          @if ($estadoOpuesto != 2)
            <small>Alta médica</small>
          @else
            <small>Actuales</small>
          @endif
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-12">
            <div class="btn-group">
              @if (Auth::user()->tipoUsuario == "Recepción")    
                <a href={{asset('/ingresos/create')}} class="btn btn-sm btn-dark">
                  <i class="fa fa-plus"></i> Nuevo
                </a>
                <a href={{asset('#')}} class="btn btn-sm btn-dark">
                  <i class="fa fa-file"></i> Reporte
                </a>
              @endif
              @if (Auth::user()->tipoUsuario == "Recepción" || Auth::user()->tipoUsuario == "Médico" || Auth::user()->tipoUsuario == "Gerencía")
                  
                <a href={{asset('/ingresos?estado='.$estadoOpuesto.'&tipo='.$tipo)}} class="btn btn-sm btn-dark">
                  @if ($estadoOpuesto != 2)
                    <i class="fa fa-medkit"></i> Actuales
                    <span class="label label-success">{{$activos}}</span>
                  @else
                    <i class="fa fa-check"></i> En alta
                  @endif
                </a>
                <div class="btn-group">
                  <button type="button" class="btn btn-dark btn-sm">
                  <i class="fa fa-eye"></i> Ver
                  </button>
                  <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href={{asset("/ingresos")}}>Ingresos</a>
                    </li>
                    <li><a href={{asset("/ingresos?tipo=3")}}>Consultas Médicas</a>
                    </li>
                    <li><a href={{asset("/ingresos?tipo=1")}}>Observaciones</a>
                    </li>
                    <li><a href={{asset("/ingresos?tipo=2")}}>Medi ingresos</a>
                    </li>
                    <li><a href={{asset("/ingresos?tipo=4")}}>Curaciones</a>
                    </li>
                  </ul>
                </div>
              @endif
              <a href={{'#'}} class="btn btn-primary btn-sm">
                <i class="fa fa-question"></i> Ayuda
              </a>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <table class="table table-striped">
            <thead>
              <th>#</th>
              @if ($tipo != 3)  
                <th>Expediente</th>
              @endif
              <th>Paciente</th>
              <th>Médico</th>
              @if ($tipo != 3)  
                <th>Habitación</th>
              @endif
              <th>Opciones</th>
            </thead>
            <tbody>
              @if (count($ingresos)>0)
                @php
                  $correlativo = 1;
                @endphp
                @foreach ($ingresos as $ingreso)
                  <tr>
                    <td>{{$correlativo + $pagina}}</td>
                    @if ($tipo != 3) 
                      <td>
                        <a href={{asset('/ingresos/'.$ingreso->id)}}>
                          {{$ingreso->expediente.'-PTEHDN-'.$ingreso->fecha_ingreso->format('Y')}}
                        </a>
                      </td>
                    @endif
                    <td>
                      <a href={{asset('/pacientes/'.$ingreso->f_paciente)}}>
                        {{$ingreso->paciente->apellido.', '.$ingreso->paciente->nombre}}
                      </a>
                    </td>
                    <td>
                      @if (Auth::user()->administrador)
                        <a href={{asset('/usuarios/'.$ingreso->f_medico)}}>
                          @if ($ingreso->medico->sexo)
                            {{'Dr. '.$ingreso->medico->apellido.' '.$ingreso->medico->nombre}}
                          @else
                            {{'Dra. '.$ingreso->medico->apellido.' '.$ingreso->medico->nombre}}
                          @endif
                        </a>
                      @else
                        @if ($ingreso->medico->sexo)
                          {{'Dr. '.$ingreso->medico->apellido.' '.$ingreso->medico->nombre}}
                        @else
                          {{'Dra. '.$ingreso->medico->apellido.' '.$ingreso->medico->nombre}}
                        @endif
                      @endif
                      
                    </td>
                    @if ($ingreso->f_habitacion != null)  
                      <td>
                        @if (Auth::user()->tipoUsuario == "Recepción")
                          <a href={{asset('/habitaciones/'.$ingreso->f_habitacion)}}>
                          {{'Habitación '.$ingreso->habitacion->numero}}
                          </a>
                        @else
                          {{'Habitación '.$ingreso->habitacion->numero}}
                        @endif
                      </td>
                    @endif
                    <td>
                      @include('Ingresos.Formularios.desactivate')
                    </td>
                  </tr>
                  @php
                    $correlativo++;
                  @endphp
                @endforeach
              @else
                <tr>
                  <td colspan="6">
                    <center>
                      No hay registros que coincidan con los términos de búsqueda indicados
                    </center>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
          <div class="ln_solid"></div>
          {!!str_replace('/?', '?', $ingresos->appends(Request::only(['estado','tipo']))->render())!!}
        </div>
      </div>
    </div>
  </div>
@endsection
