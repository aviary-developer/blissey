@extends('principal')
@section('layout')
  @if ($estado == 1 || $estado == null)
    @php
    $estadoOpuesto = 0;
    @endphp
  @else
    @php
    $estadoOpuesto = 1;
    @endphp
  @endif
  @php
  $index = true;
  @endphp
  @include('Visitadores.Barra.index')
  <div class="col-12">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th style="width: 200px">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @php
          $correlativo = 1;
          @endphp
          @foreach ($visitadores as $visitador)
            <tr>
              <td>{{ $correlativo + $pagina}}</td>
              <td>
                {{ $visitador->nombre }}
              </td>
              <td>
                {{ $visitador->apellido }}
              </td>
              <td>{{ $visitador->telefono }}</td>
              <td>
                <center>
                  @if ($estadoOpuesto)
                    @include('Visitadores.Formularios.activate')
                  @else
                    @include('Visitadores.Formularios.desactivate')
                  @endif
                </center>
              </td>
            </tr>
            @php
            $correlativo++;
            @endphp
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
