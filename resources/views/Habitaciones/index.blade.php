@extends('dashboard')
@section('layout')
  @if(Session::has('mensaje'))
    <?php $mensaje = Session::get('mensaje');
    echo "<script>swal('$mensaje', 'Acción realizada satisfactorimente', 'success')</script>";?>
  @endif
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
  <div class="col-md-9 col-sm-9 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Habitaciones
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
                  @if ($tipo > -1)
                    <li><a href={!! asset('/habitaciones?estado='.(!$estadoOpuesto)) !!}>Todos</a></li>    
                  @endif
                  <li><a href={!! asset('/habitaciones?estado='.(!$estadoOpuesto).'&tipo=1') !!}>Ingreso</a></li>
                  <li><a href={!! asset('/habitaciones?estado='.(!$estadoOpuesto).'&tipo=0') !!}>Observación</a></li>
                  <li><a href={!! asset('/habitaciones?estado='.(!$estadoOpuesto).'&tipo=2') !!}>Medi ingreso</a></li> 
                  <li class="divider"></li>
                  <li>
                    <a href={!! asset('/habitaciones?estado='.$estadoOpuesto) !!}>
                      @if ($estadoOpuesto)
                        Activas
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
                <th>Numero</th>
                <th>Camas</th>
                <th>Área</th>
                <th>Disponibilidad</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              @php
              $correlativo = 1;
              @endphp
              @foreach ($habitaciones as $habitacion)
                <tr>
                  <td>{{ $correlativo + $pagina }}</td>
                  <td>
                    <a href={{asset('/habitaciones/'.$habitacion->id)}}>
                      {{ 'Habitación '.$habitacion->numero }}
                    </a>
                  </td>
                  <td>{{ $habitacion->camas->count().' camas'}}</td>
                  <td>
                    @if ($habitacion->tipo == 1)
                      <span class="label label-lg label-white borde green col-xs-10">Ingreso</span>
                    @elseif($habitacion->tipo == 2)
                      <span class="label label-lg label-white borde purple col-xs-10">Medi ingreso</span>
                    @else
                      <span class="label label-lg label-white blue borde col-xs-10">Observación</span>
                    @endif
                  </td>
                  <td>
                    @if ($habitacion->ocupado)
                      <span class="label label-danger col-md-10 col-sm-10 col-xs-10 label-lg">Ocupada</span>
                    @else
                      <span class="label label-success col-md-10 col-sm-10 col-xs-10 label-lg">Disponible</span>
                    @endif
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Habitaciones.Formularios.activate')
                    @else
                      @include('Habitaciones.Formularios.desactivate')
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
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
