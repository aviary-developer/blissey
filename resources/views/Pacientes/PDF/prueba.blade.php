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
        @for ($i=0; $i < 500; $i++)
          <tr>
            <td>{{$i}}</td>
            <td>Francisco Fernando</td>
            <td>Fernandez Hernandez</td>
            <td>20 años</td>
            <td>9999-9999</td>
            <td>99999999-9</td>
          </tr>
        @endfor
      </tbody>
    </table>
  </body>
</html>
