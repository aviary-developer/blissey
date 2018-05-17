@extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
<div class="col-md-10 col-sm-10 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      @php
        $dv=$retirado->transaccion->divisionProducto;
      @endphp
      <h2>
        Producto
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          <div class="btn-group">
            <a href={!! asset('/cambio_productos')!!} class="btn btn-dark btn-sm"><i class="fa fa-arrow-left"></i> Atras</a>
            <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
          </div>
        </div>
      </div>
      <br>
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-2">
          <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información General</a>
            </li>
            <li role="presentation" class="">
              <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Otros</a>
            </li>
          </ul>
        </div>
        {{-- Contenido del tab --}}
        <div class="col-xs-10">
          <div id="myTabContent" class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
              <h3>Información General</h3>
              <table class="table">
                <tr>
                  <th>Código</th>
                  <td>{{$dv->codigo}}</td>
                </tr>
                <tr>
                  <th>Nombre</th>
                  <td>
                    {{$dv->producto->nombre." ".$dv->division->nombre." "}}
                    @if ($dv->contenido!=null)
                      {{$dv->cantidad." ".$dv->unidad->nombre}}
                    @else
                      {{$dv->cantidad." ".$dv->producto->Presentacion->nombre}}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Cantidad</th>
                  <td>{{$retirado->cantidad}}</td>
                </tr>
                <tr>
                  <th>Lote</th>
                  <td>{{$retirado->transaccion->lote}}</td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($retirado->estado==0)
                      <span class="label label-danger label-lg col-xs-8">
                        Falta retirar del estante
                      </span>
                    @elseif($retirado->estado==1)
                      <span class="label label-dark-blue label-lg col-xs-8">
                        Retirado del estante sin cambio
                      </span>
                    @else
                      <span class="label label-success label-lg col-xs-8">
                        Producto cambiado por el proveedor
                      </span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>@if ($retirado->estado==0)
                    Ubicación
                  @else
                    Retirado de
                  @endif</th>
                  <td>Estante: {{$retirado->transaccion->estante->codigo}} Nivel: {{$retirado->transaccion->nivel}}</td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $retirado->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $retirado->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
              </table>
            </div>
            {{-- Otra pestaña --}}
            <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
              Otra cosa
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection