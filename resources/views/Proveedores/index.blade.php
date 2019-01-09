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
  @include('Proveedores.Barra.index')
  <div class="col-12">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th style="width: 230px">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @php
          $correlativo = 1;
          @endphp
          @foreach ($proveedores as $proveedor)
            <tr>
              <td>{{ $correlativo + $pagina}}</td>
              <td>
                <a href={{asset('/proveedores/'.$proveedor->id)}}>
                  {{ $proveedor->nombre }}
                </a>
              </td>
              <td>{{ $proveedor->correo }}</td>
              <td>{{ $proveedor->telefono }}</td>
              <td>
                <center>
                  @if ($estadoOpuesto)
                    @include('Proveedores.Formularios.activate')
                  @else
                    @include('Proveedores.Formularios.desactivate')
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
