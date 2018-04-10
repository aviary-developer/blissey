@extends('dashboard')
@section('layout')
  @php
  $index = false;
  $show= true;
  setlocale(LC_ALL,'es');
  $hoy = Carbon\Carbon::now();
  @endphp
  <div class="col-md-10 col-sm-10 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>
          Ultrasonografia
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            @include('Ultrasonografias.Formularios.activate')
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
            </ul>
          </div>
          {{-- Contenido del tab --}}
          <div class="col-xs-10">
            <div id="myTabContent" class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
                <h3>Información General</h3>
                <table class="table">
                  <tr>
                    <th>Tipo de Sangre</th>
                      <td>
                          {{$ultrasonografia->nombre}}
                    </td>
                  </tr>
                  <tr>
                    <th>Fecha de creación</th>
                    <td>{{ $ultrasonografia->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                  </tr>
                  <tr>
                    <th>Fecha de modificación</th>
                    <td>{{ $ultrasonografia->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
