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
  <body onload="subst()">
    <div class="numero-pagina">
			<div class="row">
				<div class="col-xs-12">
					<div class="col-xs-6">
						<p style="text-align: left !important">
								Fecha de impresión: {{date('d/m/Y h:i a')}}
						</p>
					</div>
					<div class="col-xs-6">
						<p class="right">
							Página <span class="page"></span> de <spa class="topage"></spa>
						</p>
					</div>
				</div>
			</div>
    </div>
  </body>
</html>