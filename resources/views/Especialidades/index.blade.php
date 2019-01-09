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
  @include('Especialidades.Barra.index')
  <div class="col-md-8 col-sm-8 col-xs-12">
    <div class="x_panel">
      <table class="table table-striped table-hover table-sm index-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th style="width: 200px">Opciones</th>
          </tr>
        </thead>
        <tbody>
          @if ($especialidades!=null)
            @php
            $correlativo = 1;
            @endphp
            @foreach ($especialidades as $especialidad)
              <tr>
                <td>{{ $correlativo + $pagina }}</td>
                <td>
                  <a href={{asset('/especialidades/'.$especialidad->id)}}>
                    {{ $especialidad->nombre }}
                  </a>
                </td>
                <td>
                  <center>
                    @if ($estadoOpuesto)
                      @include('Especialidades.Formularios.activate')
                    @else
                      @include('Especialidades.Formularios.desactivate')
                    @endif
                  </center>
                </td>
              </tr>
              @php
              $correlativo++;
              @endphp
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <!-- /page content -->
@endsection
