@extends('dashboard')
@section('layout')
  <div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Inventario
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-5 col-xs-12">
            <div class="btn-group">
              <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
              <button class="btn btn-primary btn-ms" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
          <div class="col-md-3 col-xs-12"></div>
          <div class="col-md-4 col-xs-12">
            {!!Form::open(['route'=>'componentes.index','method'=>'GET','role'=>'search','class'=>'form-inline'])!!}
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
              <th>Presentación</th>
              <th>Existencias</th>
            </tr>
          </thead>
          <tbody>
            @php
            $contador=1;

            @endphp
            @foreach ($division_productos as $div)
              <tr>
                <td>{{$contador}}</td>
                <td>{{$div->producto->nombre}}</td>
                <td>
                  @if ($div->unidad==null)
                    {{$div->division->nombre." ".$div->cantidad." ".$div->producto->presentacion->nombre}}
                  @else
                    {{$div->division->nombre." ".$div->cantidad." ".$div->unidad->nombre}}
                  @endif
                </td>
                @php
                  $aux=$div->inventarioFarmaciaUltimo->last();
                @endphp
                <td>
                  @if (count($aux)>0)
                        {{$aux->existencia_nueva}}
                  @else
                    0
                  @endif
                </td>
              </tr>
              @php
                $contador++;
              @endphp
            @endforeach
          </tbody>
        </table>
        <div class="ln_solid"></div>

      </div>
    </div>
  </div>
  <!-- /page content -->
@endsection
