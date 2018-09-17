@extends('dashboard')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
<div class="col-md-10 col-sm-10 col-xs-12">
  <div class="x_panel">
    <div class="row bg-blue">
      <center>
        <h3>Caja
            <small class="label-white badge blue ">{{ $caja->nombre}}</small>
        </h3>
      </center>
    </div>
    @include('Cajas.Formularios.activate')
</div>
<div class="x_panel">
    <div class="x_content">
      <div class="row">
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-2">
          <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información General</a>
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
                  <th>nombre</th>
                  <td>Caja {{ $caja->nombre}}</td>
                </tr>
                <tr>
                  <th>Localización</th>
                  <td>
                    @if($caja->localizacion)
                      <span class="label label-lg label-primary col-xs-4">Recepción</span>
                    @else
                      <span class="label label-lg label-success col-xs-4">Farmacia</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($caja->estado)
                      <span class="label label-lg label-success col-xs-4">Activo</span>
                    @else
                      <span class="label label-lg label-danger col-xs-4">En papelera</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $caja->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $caja->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
