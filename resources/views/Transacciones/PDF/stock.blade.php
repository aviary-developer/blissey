<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reporte</title>
    <!-- Bootstrap -->
    {!!Html::style('assets/bootstrap/dist/css/bootstrap.css')!!}
    <!-- Font Awesome -->
    {!!Html::style('assets/font-awesome/css/font-awesome.min.css')!!}


    {!!Html::style('assets/build/css/custom.css')!!}
    {!!Html::style('css/pdf.css')!!}

    <style type="text/css">
      div.page
      {
          page-break-after: always;
          page-break-inside: avoid;
      }
    </style>
  </head>

  <body class="bg-white">
  <div class="row">
    <div class="col-xs-12">
        @php
        $contador=1;

        @endphp
        <center>
        <h3>STOCK DE INVENTARIO BAJO</h3>
      </center>
        @foreach ($divisiones as $division)
        @php
        $unidad=App\Unidad::find($division->contenido);
        $div=App\Division::find($division->f_division);
        $presentacion=App\Presentacion::find($division->f_presentacion);
        @endphp
        @if(($contador-1)%22==0)
        <div class="page">
        <table class="table table-hover table-sm table-striped index-table">
            <thead>
                <th>#</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Existencias</th>
                <th>Stock</th>
            </thead>
            <tbody>             
              @endif
              <tr>
                <td>{{$contador}}</td>
                <td>{{$division->codigo}}</td>
                <td>{{$division->nombre}}--
                  @if ($unidad==null)
                      {{"--".$div->nombre." ".$division->cantidad." ".$presentacion->nombre}}
                    @else
                      {{"--".$div->nombre." ".$division->cantidad." ".$unidad->nombre}}
                    @endif
                  </td>
                @if ($division->inventario==0)
                  <td style="color:red;">
                @else
                  <td>
                @endif
                  {{$division->inventario}}</td>
                <td>{{$division->stock}}</td>
                </tr>
                @php
                $contador++;
                @endphp
                @if(($contador-1)%22==0)
            </tbody>
        </table>
        </div>
        @endif
        @endforeach
    </div>
  </div>
</body>
</html>