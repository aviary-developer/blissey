<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {!!Html::style('assets/bootstrap/dist/css/bootstrap.css')!!}
    {!!Html::style('css/pdf.css')!!}
    <script> 
    function subst() {
      var vars = {};
      var query_strings_from_url = document.location.search.substring(1).split('&');
      for (var query_string in query_strings_from_url) 
      {
        if (query_strings_from_url.hasOwnProperty(query_string))
        {
          var temp_var = query_strings_from_url[query_string].split('=', 2);
          vars[temp_var[0]] = decodeURI(temp_var[1]);
        }
      }
      var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
      for (var css_class in css_selector_classes) 
      {
        if (css_selector_classes.hasOwnProperty(css_class)) 
        {
          var element = document.getElementsByClassName(css_selector_classes[css_class]);
          for (var j = 0; j < element.length; ++j) 
          {
              element[j].textContent = vars[css_selector_classes[css_class]];
          }
        }
      }
    }
  </script>
  </head>
  <body>
    @php
      $empresa = App\Empresa::first();
      $telefonos = App\TelefonoEmpresa::where('tipo','hospital')->get();
    @endphp
    <div class="row corte-abajo">
      <div class="col-xs-1"></div>
      <div class="col-xs-2">
        <img src={{asset(Storage::url($empresa->logo_hospital))}} class="logo-pdf">
      </div>
      <div class="col-xs-6">
        <center>
          <h1 class="vivaldi">{{$empresa->nombre_hospital}}</h1>
          <span><i>{{"C.S.S.P. ".$empresa->codigo_hospital}}</i></span>
          <h4 class="vivaldi font-plus">{{"Dirección: ".$empresa->direccion_hospital}}</h4>
          <h4 class="vivaldi font-plus">
            @if($telefonos!=null)
              @if (count($telefonos)>1)
                {{"Teléfonos: "}}
              @elseif (count($telefonos) == 1)
                {{"Teléfono: "}}
              @endif
              @if (count($telefonos)>0)
                @foreach ($telefonos as $k => $telefono)
                  {{$telefono->telefono}}
                  @if ($k > 0)
                    {{', '}}
                  @endif
                @endforeach
              @endif
            @else
            {{"Teléfono: "}}
            @endif
            </h4>
        </center>
      </div>
    </div>
  </body>
</html>