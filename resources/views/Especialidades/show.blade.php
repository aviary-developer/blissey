@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
  @endphp
  @include('Especialidades.Barra.show')

  <div class="col-sm-8">
    <div class="x_panel">
      <div class="flex-row">
        <center>
          <h5 class="mb-1">Médicos</h5>
        </center>
      </div>
      
      <center>
        <p class="mt-1 mb-2">Listado de médicos que poseen la especialidad de <b>{{$especialidad->nombre}}</b>.</p>
      </center>
      <table class="table table-sm table-hover table-striped index-table">
        <thead>
          <th>#</th>
          <th>Apellido</th>
          <th>Nombre</th>
          <th>Tipo</th>
        </thead>
        <tbody>
          @if ($especialidad->usuario_especialidad!=null)
            @php
              $correlativo = 1;
            @endphp
            @foreach ($especialidad->usuario_especialidad as $medico)
              <tr>
                <td>{{$correlativo}}</td>
                <td>
                  <a href={{asset('/usuarios/'.$medico->f_usuario)}}>
                    {{$medico->usuario->apellido}}
                  </a>
                </td>
                <td>
                  <a href={{asset('/usuarios/'.$medico->f_usuario)}}>
                    {{$medico->usuario->nombre}}
                  </a>
                </td>
                <td>
                  @if ($medico->principal)
                    <span class="badge border border-success text-success col-8">Especialidad</span>
                  @else
                    <span class="badge border border-primary text-primary col-8">Subespecialidad</span>
                  @endif
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

  <div class="col-sm-4">
    <div class="x_panel">
      <div class="flex-row">
        <center>
          <h5 class="mb-1">Información</h5>
        </center>
      </div>

      <div class="ln_solid mb-1 mt-1"></div>
      <div class="flex-row">
        <span class="font-weight-light text-monospace">
          Nombre
        </span>
      </div>
      <div class="flex-row">
        <h6 class="font-weight-bold">
          {{$especialidad->nombre}}
        </h6>
      </div>

      <div class="ln_solid mb-1 mt-1"></div>
      <div class="flex-row">
        <span class="font-weight-light text-monospace">
          Estado
        </span>
      </div>
      <div class="flex-row">
        <h6 class="font-weight-bold">
          @if ($especialidad->estado)
            <span class="badge text-success border border-success col-4">Activo</span>
          @else
            <span class="badge text-danger border border-danger col-4">En papelera</span>
          @endif
        </h6>
      </div>
    </div>
  </div>
@endsection
