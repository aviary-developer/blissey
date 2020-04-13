@extends('ayuda')
@section('layout')
	{{-- Barra de menu --}}
	<nav class="navbar navbar-expand-lg navbar-light  sticky-top mb-2" style="background-color: #e3f2fd;">
		<a class="navbar-brand" href={!! asset('/general?tipo='.$tipo) !!}>
			{{$titulo}}
			<span class="badge badge-info">
				Ayuda
			</span>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav mr-auto">
			</ul>
		</div>
	</nav>

	{{-- Contenido --}}
	<div class="col-sm-10">
		<div class="x_panel">
			<div class="flex-row">
				<center>
					<h4>{{$titulo}}</h4>
				</center>
			</div>
			<div class="flex-row">
				<center>
					<p>{{$desc}}</p>
				</center>
			</div>
		</div>
		<div class="x_panel">			
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="one-tab">

					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Crear nuevo registro
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/general/Guardar/Guardar_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>

				</div>
				<div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">

					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Editar un registro
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/general/Editar/Editar_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>

				</div>
				<div class="tab-pane fade" id="three" role="tabpanel" aria-labelledby="three-tab">

					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Ver la información detallada de un registro
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/general/Ver/Ver_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>

				</div>
				<div class="tab-pane fade" id="four" role="tabpanel" aria-labelledby="four-tab">

					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Enviar a papelera un registro
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/general/Papelera/Papelera_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>

				</div>
				<div class="tab-pane fade" id="five" role="tabpanel" aria-labelledby="five-tab">

					<div class="flex-row">
						<center>
							<h5 class="text-info">
								<i class="fas fa-film"></i>
								Restaurar un registro en papelera
							</h5>
						</center>
					</div>
					<iframe src={{asset('help/general/Restaurar/Restaurar_player.html')}} frameborder="0" scrolling="no" width="100%" height="430px"></iframe>

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
						Nuevo
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="two" aria-selected="false">
						Editar
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="three" aria-selected="false">
						Ver información
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="four" aria-selected="false">
						Enviar a papelera
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="five-tab" data-toggle="tab" href="#five" role="tab" aria-controls="five" aria-selected="false">
						Restaurar
					</a>
				</li>
			</ul>
		</div>
	</div>
	

@endsection