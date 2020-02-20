{{-- Ayuda para la pantalla de solicitud de exámenes clínicos --}}
@extends('ayuda')
@section('layout')
	{{-- Barra de menu --}}
	<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href={!! asset('/grupo_promesa') !!}>
			Grupo Promesa
			<span class="badge border-info border text-info">
				Ayuda
			</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav mr-auto">
			</ul>
			@include('Dashboard.boton_salir')
		</div>
	</nav>

	{{-- Contenido --}}
	<div class="col-sm-10">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h4>Transacciones</h4>
				</center>
			</div>
			<div class="flex-row">
				<center>
					<p>Las transacciones involucran todos los movimientos de inventario.</p>
				</center>
			</div>
			<div class="ln_solid"></div>
			<div class="tab-content" id="myTabContent">

				<div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="one-tab">
					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Inventario
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/transacciones/inventario/inventario_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>
				</div>
				<div class="tab-pane fade show active" id="two" role="tabpanel" aria-labelledby="one-tab">
					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Nuevo pedido
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/transacciones/NuevoPedido/NuevoPedido_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>
				</div>

				<div class="tab-pane fade" id="three" role="tabpanel" aria-labelledby="two-tab">
					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Confirmar pedido (compra)
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/transacciones/ConfirmarPedido/ConfirmarPedido_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>
				</div>	

			</div>
		</div>
	</div>
	<div class="col-sm-2">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h5>Opciones</h5>
				</center>
			</div>
			<ul class="nav flex-column nav-pills" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="one" aria-selected="true">
						Inventario
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" id="one-tab" data-toggle="tab" href="#two" role="tab" aria-controls="one" aria-selected="true">
						Nuevo pedido
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" id="two-tab" data-toggle="tab" href="#three" role="tab" aria-controls="two" aria-selected="false">
						Confirmar pedido
					</a>
				</li>

			</ul>
		</div>
	</div>
	

@endsection