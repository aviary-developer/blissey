@extends('principal')
@section('layout')
@include('Main.barra')
<div class="col-sm-8" >
  <div class="x_panel border border-primary rounded">
    @include('widget.calendario')
  </div>
	@if (Auth::user()->tipoUsuario == "Laboaratorio")
		<div class="x_panel border border-danger rounded">
			@include('widget.reactivos')
		</div>
    <div class="x_panel border border-success rounded">
      @include('widget.solicitudes')
    </div>
  @elseif(Auth::user()->tipoUsuario == "Recepción")
    <div class="x_panel border border-purple rounded">
      @include('widget.ingreso')
    </div>
    <div class="x_panel border border-success rounded">
      @include('widget.solicitudes')
    </div>
  @endif
</div>

<div class="col-sm-4">
  <div class="x_panel rounded">
    <div class="flex-row">
      <center>
        @if (isset($empresa))
          <img src={{asset(Storage::url($empresa->logo_hospital))}} class="img-responsive avatar-view smallperfil">
          <h3 class="text-uppercase text-info">Grupo Promesa
            <br><small>Divino Niño</small>
          </h3>
        @else
          <img src={{asset(Storage::url("NoImgen.jpg"))}} class="img-responsive avatar-view smallperfil">
          <h3>Grupo Promesa
            <br><small>Divino Niño</small>
          </h3>
        @endif
      </center>
    </div>
  </div>
  <div class="x_panel rounded">
    <div class="flex-row">
      <center>
        <h5>
          @if (Auth::user()->tipoUsuario == "Laboaratorio")
            Exámenes realizados
          @endif
        </h5>
      </center>
    </div>
    <canvas id = "chart_home" style="width: 100%; height: 350px;"></canvas>
  </div>
</div>

@if (Auth::user()->tipoUsuario == "Laboaratorio")
  <script>
    $(document).ready(function(){
      function chart_home(){
        $.ajax({
          type: 'get',
          url: $('#guardarruta').val() + '/graficar_examenes',
          success: function(r){
            var datos = [];
            var tags = [];
            var colors = [];

            $(r.etiquetas).each(function(k, v){
              datos.push(r.datos[k]);
              tags.push(v);
              colors.push(r.colores[k]);
            });

            var canva = $("#chart_home");

            var chart = new Chart(canva,{
              type: 'doughnut',
              data: {
              labels: tags,
              datasets: [
                {
                  data: datos,
                  backgroundColor: colors,
                }]
              },
              options: {
                legend: {
                  display: true,
                  position: 'bottom',
                  labels: {
                    fontSize: 10
                  }
                }
              }
            });
          }
        });
      }

      chart_home();
    });
  </script>
@endif

{!!Html::script('js/scripts/Calendario_main.js')!!}
@stop
