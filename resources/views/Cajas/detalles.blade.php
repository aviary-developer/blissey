@extends('dashboard')
@section('layout')
  @php
    $apertura=App\DetalleCaja::cajaApertura();
  @endphp
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Apertura de Caja
            <small>

              @if ($apertura)
                Aperturada
              @else
                No aperturada
              @endif
            </small>
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('/cajas/create') !!} class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              {{-- <a href={!! asset('/cajas?nombre='.$nombre.'&estado='.$estadoOpuesto) !!} class="btn btn-dark btn-sm"> --}}
              </a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-12">
            {!!Form::open(['route'=>'cajas.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('nombre',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Estado</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($cajas)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($cajas as $caja)
                <tr>
                  <td>{{ $correlativo + $pagina }}</td>
                  <td>
                    <a href={{asset('/cajas/'.$caja->id)}}>
                      {{ $caja->nombre}}
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
                      <button type="button" class="btn btn-sm btn-danger disabled" data-toggle="tooltip" data-placement="top" title="Esta utilizada por otro usuario">
                        <i class="fa fa-warning"></i>
                      </button>
                    @else
                      {!!Form::open(['method'=>'POST','id'=>'formulario'])!!}
                      <a href={!! asset('/detalleCajas/'.$caja->id)!!} class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Aperturar">
                        <i class="fa fa-check"></i>
                      </a>
                      {!!Form::close()!!}
                    @endif
                  </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
            @else
              <tr>
                <td colspan="5">
                  <center>
                    No hay registros que coincidan con los términos de búsqueda indicados
                  </center>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="ln_solid"></div>
        <center>
          {!! str_replace ('/?', '?', $cajas->appends(Request::only(['nombre','estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
