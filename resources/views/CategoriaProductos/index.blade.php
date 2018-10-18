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
  @include('CategoriaProductos.Barra.index')
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
          @foreach ($categorias as $categoria)
            <tr>
              <td>{{ $correlativo + $pagina }}</td>
              <td>
                <a href={{asset('/categoria_productos/'.$categoria->id)}}>
                  {{ $categoria->nombre}}
                </a>
              </td>
              <td>
                <center>
                  @if ($estadoOpuesto)
                    @include('CategoriaProductos.Formularios.activate')
                  @else
                    @include('CategoriaProductos.Formularios.desactivate')
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
