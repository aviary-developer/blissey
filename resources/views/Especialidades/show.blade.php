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
        Especialidad
        <small>
          {{ $especialidad->nombre }}
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          @include('Especialidades.Formularios.activate')
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
              <a href="#tab_content2" id="otros-tab2" role="tab" data-toggle="tab" aria-expanded="false">Médicos</a>
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
                  <td>{{ $especialidad->nombre }}</td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>{{ ($especialidad->estado)?"Activo":"En Papelera" }}</td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $especialidad->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $especialidad->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
              </table>
            </div>
            {{-- Otra pestaña --}}
            <div class="tab-pane fade" role="tabpanel" id="tab_content2" aria-labelledby="otros-tab2">
              <h3>Medícos</h3>
              <p>Listado de médicos que poseen la especialidad de <b>{{$especialidad->nombre}}</b>.</p>
              <table class="table">
                <thead>
                  <th>#</th>
                  <th>Apellido</th>
                  <th>Nombre</th>
                  <th>Tipo</th>
                </thead>
                <tbody>
                  @if (count($especialidad->usuario_especialidad)>0)
                    @php
                      $correlativo = 1;
                    @endphp
                    @foreach ($especialidad->usuario_especialidad as $medico)
                      <tr>
                        <td>{{$correlativo}}</td>
                        <td>
                          <a href={{asset('/usuarios/'.$medico->f_usuario)}}>
                            {{$medico->usuario->apellido}}
                          </a>
                        </td>
                        <td>
                          <a href={{asset('/usuarios/'.$medico->f_usuario)}}>
                            {{$medico->usuario->nombre}}
                          </a>
                        </td>
                        <td>
                          @if ($medico->principal)
                            <span class="label label-success">Especialidad</span>
                          @else
                            <span class="label label-primary">Subespecialida</span>
                          @endif
                        </td>
                      </tr>
                      @php
                        $correlativo++;
                      @endphp
                    @endforeach
                  @else
                    <tr>
                      <td colspan="4">
                        <center>
                          No hay ningún médico registrado con la especialidad de <b>{{$especialidad->nombre}}</b>.
                        </center>
                      </td>
                    </tr>  
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
