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
        Examen
        <small>
          Información
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
        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
          <li role="presentation" class="active">
            <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Información general</a>
          </li>
          <li role="presentation" class="">
            <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Secciones</a>
          </li>
        </ul>
        {{-- Contenido del tab --}}
        <div id="myTabContent" class="tab-content">
          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
            <table class="table">
              <tr>
                <th>Nombre</th>
                <td>{{ $examen->nombreExamen }}</td>
              </tr>
              <tr>
                <th>Tipo de muestra</th>
                <td>{{ $examen->tipoMuestra}}</td>
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
            <div class='col-md-9 col-sm-9 col-xs-6'>
              @for ($i=0; $i < count($secciones); $i++)
                @php
                $contadorParametros = 1;
                @endphp
              <table class="table">
                <div class="x_title">
                  <h2>
                    <small>{{$examen->nombreSeccion($secciones[$i])}}</small>
                  </h2>
                  <div class="clearfix"></div>
                </div>
                <thead>
                  <th>#</th>
                  <th>Parametro</th>
                </thead>
                <tbody>
                  @if (count($e_s_p)>0)
                    @foreach ($e_s_p as $esp)
                      @if ($esp->f_seccion==$secciones[$i])
                      <tr>
                        <td>{{$contadorParametros}}</td>
                        <td>{{$esp->nombreParametro($esp->f_parametro)}}</td>
                      </tr>
                    @endif
                      @php
                        $contadorParametros++;
                      @endphp
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
@endsection
