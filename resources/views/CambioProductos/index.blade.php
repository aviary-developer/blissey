@extends('dashboard')
@section('layout')
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Estantes
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-plus"></i> Nuevo</a>
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-12">
            {!!Form::open(['route'=>'cambio_productos.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
              <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
              {!! Form::text('estado',null,['placeholder'=>'Buscar','class'=>'form-control has-feedback-left']) !!}
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Código</th>
              <th>N° de niveles</th>
              <th>Localización</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            @if (count($retirados)>0)
              <tr>
                
              </tr>
            @else
              <tr>
                <td colspan="5">
                  <center>
                    No hay registros que coincidan con los terminos de busqueda indicados
                  </center>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="ln_solid"></div>
        <center>
          {!! str_replace ('/?', '?', $retirados->appends(Request::only(['estado']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
