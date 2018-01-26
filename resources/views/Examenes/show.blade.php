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
        Examen
        <small>
          {{$examen->nombreExamen}}
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          @include('Examenes.Formularios.activate')
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
              <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Secciones</a>
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
                  <td>{{ $examen->nombreExamen }}</td>
                </tr>
                <tr>
                  <th>Tipo de muestra</th>
                  <td>
                    <a href={{asset('/muestras/'.$examen->tipoMuestra)}}>
                      {{ $examen->nombreMuestra($examen->tipoMuestra) }}
                    </a>
                  </td>
                </tr>
                <tr>
                  <th>Área</th>
                  <td>
                    @if ($examen->area == "HEMATOLOGIA")
                      <span class="label label-lg label-danger col-xs-6">Hematológia</span>
                    @elseif($examen->area == "EXAMENES DE ORINA")
                      <span class="label label-lg label-warning col-xs-6">Exámenes de orina</span>
                    @elseif($examen->area == "EXAMENES DE HECES")
                      <span class="label label-lg label-default col-xs-6">Exámenes de heces</span>
                    @elseif($examen->area == "BACTERIOLOGIA")
                      <span class="label label-lg label-success col-xs-6">Bactereología</span>
                    @elseif($examen->area == "QUIMICA SANGUINEA")
                      <span class="label label-lg label-white red col-xs-6">Química sanguínea</span>
                    @elseif($examen->area == "INMUNOLOGIA")
                      <span class="label label-lg label-primary col-xs-6">Inmunología</span>
                    @elseif($examen->area == "ENZIMAS")
                      <span class="label label-lg label-purple col-xs-6">Enzimas</span>
                    @elseif($examen->area == "PRUEBAS ESPECIALES")
                      <span class="label label-lg label-info col-xs-6">Pruebas especiales</span>
                    @elseif($examen->area == "OTROS")
                      <span class="label label-lg label-dark-blue col-xs-6">Otros</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($examen->estado)
                      <span class="label label-lg label-success col-xs-6">Activo</span>
                    @else
                      <span class="label label-lg label-danger col-xs-6">En papelera</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $examen->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $examen->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
              </table>
            </div>
            {{-- Otra pestaña --}}
            <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
              <h3>Secciones</h3>
              <div class='col-md-9 col-sm-9 col-xs-6'>
                @for ($i=0; $i < count($secciones); $i++)
                  @php
                  $contadorParametros = 1;
                  @endphp
                  <h2>
                    <small>
                      <i class="fa fa-flask"></i>
                      {{$examen->nombreSeccion($secciones[$i])}}
                    </small>
                  </h2>
                  <table class="table">
                    <thead>
                      <th>#</th>
                      <th>Parametro</th>
                      <th>Reactivo</th>
                    </thead>
                    <tbody>
                      @if (count($e_s_p)>0)
                        @foreach ($e_s_p as $esp)
                          @if ($esp->f_seccion==$secciones[$i])
                            <tr>
                              <td>{{$contadorParametros}}</td>
                              <td>
                                <a href={{asset('/parametros/'.$esp->f_parametro)}}>
                                  {{$esp->nombreParametro($esp->f_parametro)}}
                                </a>
                              </td>
                              @if($esp->reactivo)
                                <td>
                                  <a href={{asset('/reactivos/'.$esp->reactivo->id)}}>
                                    {{$esp->reactivo->nombre}}
                                  </a>
                                </td>
                              @else
                                <td>-</td>
                              @endif
                            </tr>
                            @php
                              $contadorParametros++;
                            @endphp
                          @endif
                        @endforeach
                      @else
                        <tr>
                          <td colspan="4">
                            <center>
                              No hay registros
                            </center>
                          </td>
                        </tr>
                      @endif
                    </tbody>
                  </table>
                @endfor
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
