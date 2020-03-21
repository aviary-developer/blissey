<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="receta" data-backdrop="static">
  <div class="modal-dialog modal-lg">
		<!--MAR20.20: Nuevo formulario para buscar recetas que han sido almacenadas-->
		<div id="buscar_receta_div">
			@include('Ingresos.dashboard.modales.partes.buscar_receta_div')
		</div>
		<div id="nueva_receta_div" style="display: none">
			@include('Ingresos.dashboard.modales.partes.nueva_receta_div')
		</div>
  </div>
</div>