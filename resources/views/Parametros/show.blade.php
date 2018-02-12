@extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
<div class="col-md-10 col-sm-10 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>
        Parametro
        <small>
          {{ $parametro->nombreParametro}}
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          @include('Parametros.Formularios.activate')
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
                  <th>Nombre</th>
                  <td>{{ $parametro->nombreParametro }}</td>
                </tr>
                <tr>
                  <th>Unidad de medición</th>
                  @if($parametro->unidad!=null)
                  <td>{{ $parametro->nombreUnidad($parametro->unidad)}}</td>
                  @else
                    <td>
                      <span class="label label-lg label-gray col-xs-4">Ninguna</span>
                    </td>
                  @endif
                </tr>
                <tr>
                  <th>Valor mínimo</th>
                  @if($parametro->valorMinimo!=null)
                  <td>
                    <span class="label label-lg label-cian col-xs-4">
                      {{number_format($parametro->valorMinimo, 2, '.', ',')}}
                    </span>
                  </td>
                  @else
                    <td>
                      <span class="label label-lg label-gray col-xs-4">Ninguno</span>
                    </td>
                  @endif
                </tr>
                <tr>
                  <th>Valor máximo</th>
                  @if($parametro->valorMaximo!=null)
                  <td>
                    <span class="label label-lg label-danger col-xs-4">{{number_format($parametro->valorMaximo, 2, '.', ',')}}</span>
                  </td>
                  @else
                    <td>
                      <span class="label label-lg label-gray col-xs-4">Ninguno</span>
                    </td>
                  @endif
                </tr>
                <tr>
                  <th>Valor predeterminado</th>
                  @if($parametro->valorPredeterminado!=null)
                    @if (!is_numeric($parametro->valorPredeterminado))
                      <td>
                        <span class="label label-lg label-default col-xs-4">{{$parametro->valorPredeterminado}}</span>
                      </td>
                    @else
                      <td>
                        <span class="label label-lg label-default col-xs-4">{{number_format($parametro->valorPredeterminado, 2, '.', ',')}}</span>
                      </td>
                    @endif
                  @else
                    <td>
                      <span class="label label-lg label-gray col-xs-4">Ninguno</span>
                    </td>
                  @endif
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($parametro->estado)
                      <span class="label label-lg label-success col-xs-4">Activo</span>
                    @else
                      <span class="label label-lg label-danger col-xs-4">En papelera</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $parametro->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $parametro->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
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
