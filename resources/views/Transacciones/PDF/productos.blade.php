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
        <table class="table-simple">
            <tbody>
                @foreach($proveedores as $proveedor)
                    <tr>
                        <td>{{$proveedor->nombre}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @php
                        $productos=$proveedor->productos($proveedor->id);
                        $contador=1;
                    @endphp
                    @foreach ($productos as $producto)
                        @if($contador%2!=0)
                        <tr>
                            <td></td>
                        @endif
                            <td>{{$producto->nombre}}</td>
                        @if($contador%2==0)
                        </tr>
                        @endif
                        @php
                        $contador++;
                        @endphp
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
  </div>
</body>
</html>