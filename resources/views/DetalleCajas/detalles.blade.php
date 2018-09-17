@extends('dashboard')
@section('layout')
  @php
    $apertura=App\DetalleCaja::cajaApertura();
  @endphp
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="row bg-blue">
        <center>
          <h3>Apertura de Caja
            @if ($apertura)
              <small class="label-white badge green ">Abierta</small>
            @else
              <small class="label-white badge red ">Cerrada</small>
            @endif
          </h3>
        </center>
      </div>
      <div class="row">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li>
                <a href={!! asset('/cajas/create') !!}><i class="fa fa2 fa-plus"></i> Nuevo</a>
              </li>
              <li>
                <a href={!! asset('#') !!}><i class="fa fa2 fa-file"></i> Reporte</a>
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
        <table class="table table-striped " id="index-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Estado</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
              @php
              $correlativo = 1;
              @endphp
              @foreach ($cajas as $caja)
                <tr>
                  <td>{{ $correlativo + $pagina }}</td>
                  <td>
                    <a href={{asset('/cajas/'.$caja->id)}}>
                      Caja {{ $caja->nombre}}
                    </a>
                  </td>
                  <td>
                    @if($caja->localizacion)
                      <span class="label label-primary label-lg col-xs-8">Recepción</span>
                    @else
                      <span class="label label-success label-lg col-xs-8">Farmacia</span>
                    @endif
                  </td>
                  <td>
                    @if (App\DetalleCaja::verificacionCaja($caja->id))
                      @if (App\DetalleCaja::usuario($caja->id)->f_usuario==Auth::user()->id)
                        <a href={!! asset('/cerrar/'.$caja->id)!!} class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Efectuar cierre">
                          <i class="fa fa-check-circle"></i>
                        </a>
                      @else
                        <button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="top" title="En uso por otro usuario">
                          <i class="fa fa-warning"></i>
                        </button>
                      @endif
                    @else
                      @if ($apertura)
                        <button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="top" title="No disponible">
                          <i class="fa fa-warning"></i>
                        </button>
                      @else
                        {{-- {!!Form::open(['method'=>'POST','id'=>'formulario'])!!} --}}
                        <a href={!! asset('/aperturar/'.$caja->id)!!} class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Aperturar">
                          <i class="fa fa-check"></i>
                        </a>
                        {{-- {!!Form::close()!!} --}}
                      @endif
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
