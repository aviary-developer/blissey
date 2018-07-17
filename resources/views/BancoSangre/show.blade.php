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
          Donación
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
                    <th>Tipo de Sangre</th>
                      <td>
                      @if ($donacion->tipoSangre == "A+")
                        <span class="label label-lg label-cian col-xs-4">
                          {{$donacion->tipoSangre}}
                        </span>
                      @elseif ($donacion->tipoSangre == "A-")
                        <span class="label label-lg label-danger col-xs-4">
                          {{$donacion->tipoSangre}}
                        </span>
                      @elseif ($donacion->tipoSangre == "B+")
                        <span class="label label-lg label-info col-xs-4">
                          {{$donacion->tipoSangre}}
                        </span>
                      @elseif ($donacion->tipoSangre == "B-")
                        <span class="label label-lg label-default col-xs-4">
                          {{$donacion->tipoSangre}}
                        </span>
                      @elseif ($donacion->tipoSangre == "AB+")
                        <span class="label label-lg label-pink col-xs-4">
                          {{$donacion->tipoSangre}}
                        </span>
                      @elseif ($donacion->tipoSangre == "AB-")
                        <span class="label label-lg label-primary col-xs-4">
                          {{$donacion->tipoSangre}}
                        </span>
                      @elseif ($donacion->tipoSangre == "O+")
                        <span class="label label-lg label-success col-xs-4">
                          {{$donacion->tipoSangre}}
                        </span>
                      @else
                        <span class="label label-lg label-warning col-xs-4">
                          {{$donacion->tipoSangre}}
                        </span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <th>Prueba Cruzada</th>
                    <td>
                    <button type="button" class="btn btn-xs btn-success col-xs-4" data-toggle="modal" data-target="#modalPruebaCruzada">
                      <i class="fa fa-eye"></i>
                      Ver imagen
                    </button></td>
                  </tr>
                  <tr>
                    <th>Fecha de Vencimiento</th>
                    
                   <td>{{ $donacion->fechaVencimiento->formatLocalized('%d de %B de %Y').' (En '.$donacion->fechaVencimiento->diffInDays($hoy).' días)' }}</td>
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
  </div>
@include('BancoSangre.pruebaCruzada')
@endsection
