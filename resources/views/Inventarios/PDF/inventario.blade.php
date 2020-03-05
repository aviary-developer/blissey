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
        <h3>INVENTARIO</h3>
      </center>
        @foreach ($dp as $div)
        @if(($contador-1)%22==0)
        <div class="page">
        <table class="table table-hover table-sm table-striped index-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Existencias</th>
              </tr>
            </thead>
            <tbody>             
              @endif
                <tr>
                  <td>{{$contador}}</td>
                  <td>{{$div->codigo}}</td>
                  <td>{{$div->nombre}}
                    @php
                    $unidad=App\Unidad::find($div->contenido);
                    $division=App\Division::find($div->f_division);
                    $presentacion=App\Presentacion::find($div->f_presentacion);
                    $invetario=App\DivisionProducto::inventario($div->id,1);
                    @endphp
                    @if ($unidad==null)
                      {{"--".$division->nombre." ".$div->cantidad." ".$presentacion->nombre}}
                    @else
                      {{"--".$division->nombre." ".$div->cantidad." ".$unidad->nombre}}
                    @endif
                  </td>
                  <td>
                      {{$invetario}}
                  </td>
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