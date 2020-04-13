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
					<h4>Datos instucionales</h4>
				</center>
			</div>
			<div class="flex-row">
				<center>
					<p>Datos correspondientes a las diferentes áreas que conforman Grupo Promesa, éstos son necesarios para su funcionamiento.</p>
				</center>
			</div>
			<div class="ln_solid"></div>
			<div class="tab-content" id="myTabContent">

				<div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="one-tab">
					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Configuración inicial datos de la institución
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/grupoPromesa/GrupoPromesa/GrupoPromesa_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>
				</div>

				<div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Editar datos de la institución
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/grupoPromesa/EditarGrupoPromesa/EditarGrupoPromesa_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>
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
					<a class="nav-link active active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="one" aria-selected="true">
						Configuración inicial
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link active" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="false">
						Editar configuración
					</a>
				</li>
			</ul>
		</div>
	</div>
	

@endsection