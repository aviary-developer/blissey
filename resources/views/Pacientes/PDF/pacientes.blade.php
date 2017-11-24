<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Listado de pacientes</title>
    <link rel="stylesheet" href="css/pdf.css">
  </head>
  <body>
    <h4>Listado de Pacientes</h4>
    <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Teléfono</th>
            <th>DUI</th>
          </tr>
        </thead>
      <tbody>
        @php
          $correlativo = 1;
        @endphp
        @foreach ($pacientes as $paciente)
          <tr>
            <td>{{$correlativo++}}</td>
            <td>{{$paciente->nombre}}</td>
            <td>{{$paciente->apellido}}</td>
            <td>{{$paciente->fechaNacimiento->age.' años'}}</td>
            <td>
              @if (strlen($paciente->telefono)!=9)
                <i>Sin Telefono</i>
              @else
                {{$paciente->telefono}}
              @endif
            </td>
            <td>
              @if ($paciente->fechaNacimiento->age < 18)
                <i>Menor de edad</i>
              @elseif (strlen($paciente->dui) != 10)
                <i>Sin DUI</i>
              @else
                {{$paciente->dui}}
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>