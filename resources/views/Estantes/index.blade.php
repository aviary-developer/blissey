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
  @include('Estantes.Barra.index')
  <div class="col-8">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Código</th>
            <th>N° de niveles</th>
            <th>Localización</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          @php
          $correlativo = 1;
          @endphp
          @foreach ($estantes as $estante)
            <tr>
              <td>{{ $correlativo + $pagina }}</td>
              <td>
                Estante {{ $estante->codigo}}
              </td>
              <td>{{ $estante->cantidad.' niveles'}}</td>
              <td>
                @if($estante->localizacion)
                  <span class="badge border border-danger  col-12 text-danger">Recepción</span>
                @else
                  <span class="badge border border-dark  col-12">Farmacia</span>
                @endif
              </td>
              <td>
                <center>
                  @if ($estadoOpuesto)
                    @include('Estantes.Formularios.activate')
                  @else
                    @include('Estantes.Formularios.desactivate')
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
