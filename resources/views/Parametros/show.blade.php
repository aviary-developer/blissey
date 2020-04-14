@extends('principal')
@section('layout')
  @php
    $index = false;
    setlocale(LC_ALL,'es');
	@endphp
	@include('Parametros.Barra.show')
<div class="col-sm-4">
	<div class="x_panel">
		<div class="flex-row">
			<center>
				<h5>Información General</h5>
			</center>
		</div>

		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Nombre
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				{{$parametro->nombreParametro}}
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Unidad de medida
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				@if($parametro->unidad!=null)
					{{ $parametro->nombreUnidad($parametro->unidad)}}
				@else
					<span class="badge border border-secondary text-secondary col-4">Ninguna</span>
				@endif
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Valor Normal Mínimo
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				@if($parametro->valorMinimo != null || $parametro->valorMinimo == 0)
					<span class="badge border border-primary text-primary col-4">
						<i class="fas fa-male float-left"></i>
						{{number_format($parametro->valorMinimo, 2, '.', ',')}}
					</span>
				@else
					<span class="badge border border-secondary text-secondary col-4">Ninguno</span>
				@endif

				@if($parametro->valorMinimoFemenino != null || $parametro->valorMinimoFemenino == 0)
					<span class="badge border border-pink text-pink col-4">
						<i class="fas fa-female float-left"></i>
						{{number_format($parametro->valorMinimoFemenino, 2, '.', ',')}}
					</span>
				@else
					<span class="badge border border-secondary text-secondary col-4">Ninguno</span>
				@endif
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Valor Normal Máximo
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				@if($parametro->valorMaximo != null)
					<span class="badge border border-primary text-primary col-4">
						<i class="fas fa-male float-left"></i>
						{{number_format($parametro->valorMaximo, 2, '.', ',')}}
					</span>
				@else
					<span class="badge border border-secondary text-secondary col-4">Ninguno</span>
				@endif

				@if($parametro->valorMaximoFemenino != null)
					<span class="badge border border-pink text-pink col-4">
						<i class="fas fa-female float-left"></i>
						{{number_format($parametro->valorMaximoFemenino, 2, '.', ',')}}
					</span>
				@else
					<span class="badge border border-secondary text-secondary col-4">Ninguno</span>
				@endif
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Valor Normal Predeterminado
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				@if($parametro->valorPredeterminado!=null)
					@if (!is_numeric($parametro->valorPredeterminado))
						<span class="badge border border-dark text-dark col-4">{{$parametro->valorPredeterminado}}</span>
					@else
						<span class="badge border border-dark text-dark col-4">{{number_format($parametro->valorPredeterminado, 2, '.', ',')}}</span>
					@endif
				@else
					<span class="badge border border-secondary text-secondary col-4">Ninguno</span>
				@endif
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Estado
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				@if ($parametro->estado)
					<span class="badge text-success border border-success col-4">Activo</span>
				@else
					<span class="badge text-danger border border-danger col-4">En papelera</span>
				@endif
			</h6>
		</div>
	</div>
</div>

@endsection
