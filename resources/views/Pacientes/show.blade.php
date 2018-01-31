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
        Paciente
        <small>
          {{ $paciente->nombre.' '.$paciente->apellido }}
        </small>
      </h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="col-md-6 col-xs-12">
          @include('Pacientes.Formularios.activate')
        </div>
      </div>
      <br>
      {{-- Incio de tab --}}
      <div class="" role="tabpanel" data-example-id="togglable-tabs">
        <div class="col-xs-2">
          <ul id="myTab" class="nav nav-tabs tabs-left" role="tablist">
            <li role="presentation" class="active">
              <a href="#tab_content1" id="datos-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos Personales</a>
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
              <h3>Datos Personales</h3>
              <table class="table">
                <tr>
                  <th>Nombre</th>
                  <td>{{ $paciente->nombre }}</td>
                </tr>
                <tr>
                  <th>Apellido</th>
                  <td>{{ $paciente->apellido }}</td>
                </tr>
                <tr>
                  <th>Fecha de nacimiento</th>
                  <td>{{ $paciente->fechaNacimiento->formatLocalized('%d de %B de %Y').' ('.$paciente->fechaNacimiento->age.' años)' }}</td>
                </tr>
                <tr>
                  <th>Sexo</th>
                  <td>
                    @if ($paciente->sexo)
                      <span class="label-lg label label-cian col-xs-4">Masculino</span>
                    @else
                      <span class="label-lg label label-pink col-xs-4">Femenino</span>
                    @endif
                  </td>
                </tr>
                @if ($paciente->fechaNacimiento->age >= 18)
                  <tr>
                    <th>DUI</th>
                    <td>
                      @if (strlen($paciente->dui) != 10)
                        <i style="color:red">Sin DUI</i>
                      @else
                        {{ $paciente->dui }}
                      @endif
                    </td>
                  </tr>
                @endif
                <tr>
                  <th>Teléfono</th>
                  <td>
                    @if (strlen($paciente->telefono) != 9)
                      <i style="color:red">Sin teléfono</i>
                    @else
                      {{ $paciente->telefono }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Residencia</th>
                  @if ($paciente->pais == null)
                    <td>{{$paciente->municipio.', '.$paciente->departamento}}</td>
                  @else
                    <td>{{$paciente->pais}}</td>
                  @endif
                </tr>
                <tr>
                  <th>Dirección</th>
                  <td>
                    @if ($paciente->direccion == null)
                      <i style="color:red">Sin dirección</i>
                    @else
                      {{ $paciente->direccion }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Estado</th>
                  <td>
                    @if ($paciente->estado)
                      <span class="label label-lg label-success col-xs-4">Activo</span>
                    @else
                      <span class="label label-lg label-danger col-xs-4">En papelera</span>
                    @endif
                  </td>
                </tr>
                <tr>
                  <th>Fecha de creación</th>
                  <td>{{ $paciente->created_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
                </tr>
                <tr>
                  <th>Fecha de modificación</th>
                  <td>{{ $paciente->updated_at->formatLocalized('%d de %B de %Y a las %H:%M:%S') }}</td>
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
