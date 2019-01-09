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
  @include('Pacientes.Barra.index')
  <div class="col-12">
    <div class="x_panel">
      <table class="table table-hover table-sm table-striped index-table">
        <thead>
          <th>#</th>
          <th>Apellido</th>
          <th>Nombre</th>
          <th>Sexo</th>
          <th>Edad</th>
          <th>Teléfono</th>
          <th>Opciones</th>
        </thead>
        <tbody>
          @if ($pacientes!=null)
            @php
            $correlativo = 1;
            @endphp
            @foreach ($pacientes as $paciente)
              @if ($paciente->completed($paciente->id)!=false)
                <tr class="table-warning">
              @else  
                <tr>
              @endif
                <td>{{ $correlativo }}</td>
                <td>
                  <a href={{asset('pacientes/'.$paciente->id)}}>
                    {{ $paciente->apellido }}
                  </a>
                </td>
                <td>
                  <a href={{asset('pacientes/'.$paciente->id)}}>
                    {{ $paciente->nombre }}
                  </a>
                </td>
                <td>
                  @if ($paciente->sexo)
                    <span class="badge text-primary border border-primary">Masculino</span>
                  @else
                    <span class="badge text-pink border border-pink">Femenino</span>
                  @endif
                </td>
                <td>{{ $paciente->fechaNacimiento->age.' años' }}</td>
                <td>
                  @if (strlen($paciente->telefono) != 9)
                    <span class="badge border border-danger text-danger">Sin télefono</span>
                  @else
                    {{ $paciente->telefono }}
                  @endif
                </td>
                <td>
                  <center>
                    @if ($estadoOpuesto)
                      @include('Pacientes.Formularios.activate')
                    @else
                      @include('Pacientes.Formularios.desactivate')
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

  {{-- Modal --}}
  @include('Pacientes.Formularios.modal_filtro')
@endsection
