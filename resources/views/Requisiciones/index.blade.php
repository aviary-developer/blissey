@extends('dashboard')
@section('layout')
  @php
  $index = true;
  setlocale(LC_ALL,'es');
  if ($tipo==4) {
    $estadoOpuesto=5;
  } else {
    $estadoOpuesto=4;
  }
  @endphp
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Requisiciones Enviadas
            @if ($tipo==4)
              <small class="label-white badge blue ">Pendientes</small>
            @endif
            @if($tipo==5)
              <small class="label-white badge green ">Atendidas</small>
            @endif
          </h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li>
                <a href={!! asset('/requisiciones/create') !!}><i class="fa fa2 fa-plus"></i> Nuevo</a>
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
                    <a href={!! asset('/requisiciones?tipo='.$estadoOpuesto) !!}>
                      @if ($estadoOpuesto==5)
                        Atendidas
                        <span class="label label-success">{{ App\Transacion::whereIn('tipo',[5,6])->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
                      @else
                        Pendientes
                        <span class="label label-warning">{{ App\Transacion::where('tipo',4)->where('localizacion',App\Transacion::tipoUsuario())->count() }}</span>
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
              <th>Fecha</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
              @php
              $correlativo = 1;
              @endphp
              @foreach ($transacciones as $transaccion)
                <tr>
                  <td>{{ $correlativo }}</td>
                  <td>{{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}</td>
                  <td>
                    @if ($transaccion->tipo==6 || $tipo==4)
                      <a href={!! asset('/requisiciones/'.$transaccion->id)!!} class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Ver">
                        <i class="fa fa-info-circle"></i>
                      </a>
                    @endif
                    @if ($tipo==4)
                      @include('Requisiciones.Formularios.eliminarRequisicion')
                    @endif
                    @if ($transaccion->tipo==5)
                      {!!Form::open(['url'=>['asignarRequisicion',$transaccion->id],'method'=>'POST'])!!}
                      <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Asignar ubicación"/>
                      <i class="fa fa-check"></i>
                    </button>
                    {!!Form::close()!!}
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
@endsection
