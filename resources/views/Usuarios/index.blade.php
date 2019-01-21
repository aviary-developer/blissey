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
  @include('Usuarios.Barra.index')
  <div class="col-12">
    <div class="x_panel">
      <table class="table table-striped index-table table-sm table-hover">
        <thead>
          <th>#</th>
          <th>Apellido</th>
          <th>Nombre</th>
          <th>Sexo</th>
          <th>Teléfono</th>
          <th>Tipo</th>
          <th>Opciones</th>
        </thead>
        <tbody>
          @if ($usuarios!=null)
            @php
            $correlativo = 1;
            @endphp
            @foreach ($usuarios as $usuario)
              @if ($usuario->completed($usuario->id)!=false)
                <tr class="table-warning">
              @else
                <tr>
              @endif
                <td>{{ $correlativo }}</td>
                <td>
                  <a href={{asset('usuarios/'.$usuario->id)}}>
                    {{ $usuario->apellido }}
                  </a>
                </td>
                <td>
                  <a href={{asset('usuarios/'.$usuario->id)}}>
                    {{ $usuario->nombre }}
                  </a>
                </td>
                <td>
                  @if ($usuario->sexo)
                    <span class=" badge border border-primary text-primary col-12">Masculino</span>
                  @else
                    <span class=" badge border border-pink text-pink col-12">Femenino</span>
                  @endif
                </td>
                <td>

                  @if ($usuario->telephone->count()!=0)
                  <center>
                    {{$usuario->telephone->first()->telefono}}
                  </center>
                  @else
                    <span class="badge border border-danger text-danger col-12">Sin télefono</span>
                  @endif
                </td>
                <td>
                  @if($usuario->tipoUsuario == "Gerencia")
                    <span class="badge border border-secondary text-secondary  col-12">Gerencia</span>
                  @elseif ($usuario->tipoUsuario == "Médico")
                    <span class="badge border border-primary  col-12 text-primary">Médico</span>
                  @elseif ($usuario->tipoUsuario == "Laboaratorio")
                    <span class="badge border border-success  col-12 text-success">Laboratorio</span>
                  @elseif ($usuario->tipoUsuario == "Ultrasonografía")
                    <span class="badge border border-warning  col-12 text-warning">Ultrasonografía</span>
                  @elseif ($usuario->tipoUsuario == "Rayos X")
                    <span class="badge border border-info  col-12 text-info">Rayos X</span>
                  @elseif ($usuario->tipoUsuario == "Recepción")
                    <span class="badge border border-danger  col-12 text-danger">Recepción</span>
                  @elseif ($usuario->tipoUsuario == "Enfermería")
                    <span class="badge border border-purple  col-12 text-purple">Enfermería</span>
                  @elseif ($usuario->tipoUsuario == "Farmacia")
                    <span class="badge border border-dark  col-12">Farmacia</span>
                  @elseif ($usuario->tipoUsuario == "TAC")
                    <span class="badge border border-pink  col-12 text-pink">TAC</span>
                  @endif
                </td>
                <td>
                  <center>
                    @if ($estadoOpuesto)
                      @include('Usuarios.Formularios.activate')
                    @else
                      @include('Usuarios.Formularios.desactivate')
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
@endsection
