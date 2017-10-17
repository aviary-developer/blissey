@extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
    $valorEstado=($estante->estado)?"Activo":"En papelera";
  @endphp
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>
        Estante
        <small>
          Información
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          @include('Estantes.Formularios.activate')
        </div>
      </div>
      <br>
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información general</a>
          </li>
        </ul>
        {{-- Contenido del tab --}}
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
            <table class="table">
              <tr>
                <th>Código identificador</th>
                <td>{{ $estante->codigo}}</td>
              </tr>
              <tr>
                <th>N° de niveles</th>
                <td>{{ $estante->cantidad}}</td>
              </tr>
              <tr>
                <th>Localización</th>
                <td>
                  @if($estante->localizacion)
                    Recepción
                  @else
                    Farmacia
                  @endif
                </td>
              </tr>
              <tr>
                <th>Estado</th>
                <td>{{$valorEstado}}</td>
              </tr>
              <tr>
                <th>Fecha de creación</th>
                <td>{{ $estante->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
              </tr>
              <tr>
                <th>Fecha de modificación</th>
                <td>{{ $estante->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
