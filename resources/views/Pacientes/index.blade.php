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
  <div class="col-md-10 col-sm-10 col-xs-12">
    <div class="x_panel">
      <table class="table" id="index-table">
        <thead>
          <th style="width: 15px"></th>
          <th>#</th>
          <th>Apellido</th>
          <th>Nombre</th>
          <th>Sexo</th>
          <th>Edad</th>
          <th>Teléfono</th>
          <th>Opciones</th>
        </thead>
        <tbody>
          @if (count($pacientes)>0)
            @php
            $correlativo = 1;
            @endphp
            @foreach ($pacientes as $paciente)
              <tr>
                <td>
                  @if ($paciente->completed($paciente->id)!=false)
                    <a href={{asset('pacientes/'.$paciente->id.'/edit')}} data-tooltip="tooltip" title="Registro incompleto" class="btn btn-outline-warning btn-sm">
                      <i class="fas fa-exclamation-triangle"></i>
                    </a>
                  @endif
                </td>
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
                    <span class="label-lg label label-cian">Masculino</span>
                  @else
                    <span class="label-lg label label-pink">Femenino</span>
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
                  @if ($estadoOpuesto)
                    @include('Pacientes.Formularios.activate')
                  @else
                    @include('Pacientes.Formularios.desactivate')
                  @endif
                </td>
              </tr>
              @php
              $correlativo++;
              @endphp
            @endforeach
          @else
            <tr>
              <td colspan="8">
                <center>
                  No hay registros que coincidan con los términos de búsqueda indicados
                </center>
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
  <!-- /page content -->

  {{-- Modal --}}
  <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    {!!Form::open(['route'=>'pacientes.index','method'=>'GET','role'=>'search','autocomplete'=>'off'])!!}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Buscar</h4>
        </div>
        <div class="modal-body">
          <div class="x_panel">
            @include('Pacientes.Formularios.filtro')
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Buscar</button>
          <button type="button" class="btn btn-default" id="limpiar_paciente_filtro">Limpiar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
    {!!Form::close()!!}
  </div>
@endsection
