@extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>
        Donación
        <small>
          {{ $donacion->id}}
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          @include('BancoSangre.Formularios.activate')
        </div>
      </div>
      <br>
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información general</a>
          </li>
          <li role="presentation" class="">
            <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Otros</a>
          </li>
        </ul>
        {{-- Contenido del tab --}}
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
            <table class="table">
              <tr>
                <th>Tipo de Sangre</th>
                <td>{{ $donacion->tipoSangre }}</td>
              </tr>
              <tr>
                <th>Anticuerpos</th>
                <td>{{ $donacion->anticuerpos }}</td>
              </tr>
              <tr>
                <img src={{asset(Storage::url($donacion->pruebaCruzada))}} class="img-responsive miniperfil">
                <center>Prueba Cruzada</center>
            </tr>
            <tr>
              <th>Fecha de Vencimiento</th>
              <td>{{Carbon\Carbon::parse($donacion->fechaVencimiento)->format('d-m-Y')}}</td>
            </tr>
              <tr>
                <th>Fecha de creación</th>
                <td>{{ $donacion->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
              </tr>
              <tr>
                <th>Fecha de modificación</th>
                <td>{{ $donacion->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
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
@endsection
