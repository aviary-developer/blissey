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
                    <a href={{asset('/estantes/'.$estante->id)}}>
                      Estante {{ $estante->codigo}}
                    </a>
                  </td>
                  <td>{{ $estante->cantidad.' niveles'}}</td>
                  <td>
                    @if($estante->localizacion)
                      <span class="label label-primary label-lg col-xs-8">Recepción</span>
                    @else
                      <span class="label label-success label-lg col-xs-8">Farmacia</span>
                    @endif
                  </td>
                  <td>
                    @if ($estadoOpuesto)
                      @include('Estantes.Formularios.activate')
                    @else
                      @include('Estantes.Formularios.desactivate')
                    @endif
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
