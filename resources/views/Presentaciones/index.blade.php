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
  @include('Presentaciones.Barra.index')
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
          @foreach ($presentaciones as $presentacion)
            <tr>
              <td>{{ $correlativo + $pagina }}</td>
              <td>
                <a href={{asset('/presentaciones/'.$presentacion->id)}}>
                  {{ $presentacion->nombre}}
                </a>
              </td>
              <td>
                <center>
                  @if ($estadoOpuesto)
                    @include('Presentaciones.Formularios.activate')
                  @else
                    @include('Presentaciones.Formularios.desactivate')
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
