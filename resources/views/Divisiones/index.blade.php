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
  @include('Divisiones.Barra.index')
  <div class="col-8">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th style="width: 30%">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @php
          $correlativo = 1;
          @endphp
          @foreach ($divisiones as $division)
            <tr>
              <td>{{ $correlativo + $pagina }}</td>
              <td>
                <a href={{asset('/divisiones/'.$division->id)}}>
                  {{ $division->nombre}}
                </a>
              </td>
              <td>
                <center>
                  @if ($estadoOpuesto)
                    @include('Divisiones.Formularios.activate')
                  @else
                    @include('Divisiones.Formularios.desactivate')
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
  <!-- /page content -->
@endsection
