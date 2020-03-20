@extends('PDF.hoja')
@section('layout')
	@php
    setlocale(LC_ALL,'es');
  @endphp
	<div class="row">
		<!--Borde izquierdo. No se imprime nada acá-->
		<div class="col-xs-2"></div>
		<!--Borde derecho. Todo se imprime desde acá-->
		<div class="col-xs-10">
			<div class="row">
				<div style="height:0px"></div>
			</div>

			<div class="row">
				<div style="height:85px">
					<div class="row">
						<img src={{'data:image/png;base64,' . DNS1D::getBarcodePNG($consulta->recetas->barcode, "C128",2,30,array(1,1,1),true)}} alt="barcode" />
					</div>
					<div class="row">
						{{$consulta->recetas->barcode}}
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-xs-2"></div>
				<div class="col-xs-7">
					<b class="">
						{{$consulta->ingreso->hospitalizacion->paciente->nombre.' '.$consulta->ingreso->hospitalizacion->paciente->apellido}}
					</b>
				</div>
				<div class="col-xs-2" style="margin-left: 5px;">
					{{$consulta->created_at->format('d m y')}}
				</div>
			</div>

			<!--Cuerpo de la receta-->
			<div class="row">
				@if ($consulta->recetas->detalle->where('nombre_producto','!=',null)->count() > 0)
					<div class="row">
						<span><b>Medicamentos</b></span>
					</div>
					@foreach ($consulta->recetas->detalle->where('nombre_producto','!=',null) as $receta)
						<div class="row">
							<div class="col-xs-12">
								<p style="margin: 0px">
									<i class="fa fa-check"></i> {{$receta->cantidad_dosis}} 
									@if ($receta->forma_dosis == 0 && $receta->f_producto != null )
										{{$receta->producto->presentacion->nombre}}
									@else
										{{$consulta->dosis($receta->forma_dosis)}}
									@endif
									de <b class="">{{$receta->nombre_producto}}</b> cada {{$consulta->tiempos($receta->cantidad_frecuencia,$receta->forma_frecuencia)}} durante 
									{{$consulta->tiempos($receta->cantidad_duracion,$receta->forma_duracion)}}
									@if ($receta->observacion != null)
										<i>Nota: {{$receta->observacion}}</i>
									@endif
								</p>
							</div>
						</div>
					@endforeach
				@endif

				@if ($consulta->recetas->detalle->where('f_examen','!=',null)->count() > 0)
					<div class="row">
						<span><b>Laboratorio clínico</b></span>
					</div>
					@foreach ($consulta->recetas->detalle->where('f_examen','!=',null) as $receta)
						<div class="row">
							<div class="col-xs-12">
								<p style="margin:0px">
									<i class="fa fa-check"></i> Realizarse un examen de 
									<b class="">
										{{$receta->examen->nombreExamen}}
									</b>
								</p>
							</div>
						</div>
					@endforeach
				@endif

				@if ($consulta->recetas->detalle->where('f_ultrasonografia','!=',null)->count() > 0)
					<div class="row">
						<span><b>Ultrasonografía</b></span>
					</div>
					@foreach ($consulta->recetas->detalle->where('f_ultrasonografia','!=',null) as $receta)
						<div class="row">
							<div class="col-xs-12">
								<p style="margin:0px">
									<i class="fa fa-check"></i> Realizarse una ultrasonografía 
									{{$consulta->articulo($receta->ultrasonografia->nombre)}} 
									<b class="">
										{{$receta->ultrasonografia->nombre}}
									</b>
								</p>
							</div>
						</div>
					@endforeach
				@endif

				@if ($consulta->recetas->detalle->where('f_rayox','!=',null)->count() > 0)
					<div class="row">
						<span><b>Rayos X</b></span>
					</div>
					@foreach ($consulta->recetas->detalle->where('f_rayox','!=',null) as $receta)
						<div class="row">
							<div class="col-xs-12">
								<p style="margin:0px;">
									<i class="fa fa-check"></i> Realizarse una radiografía  
									{{$consulta->articulo($receta->rayox->nombre)}} 
									<b class="">
										{{$receta->rayox->nombre}}
									</b>
								</p>
							</div>
						</div>
					@endforeach
				@endif

				@if ($consulta->recetas->detalle->where('f_tac','!=',null)->count() > 0)
					<div class="row">
						<span><b>Tomografía Axial Computarizada (TAC)</b></span>
					</div>
					@foreach ($consulta->recetas->detalle->where('f_tac','!=',null) as $receta)
						<div class="row">
							<div class="col-xs-12">
								<p style="margin:0px">
									<i class="fa fa-check"></i> Realizarse una ultrasonografía 
									{{$consulta->articulo($receta->tac->nombre)}} 
									<b class="">
										{{$receta->tac->nombre}}
									</b>
								</p>
							</div>
						</div>
					@endforeach
				@endif
				@if ($consulta->recetas->detalle->where('Texto','!=',null)->count() > 0)
					<div class="row">
						<span><b>Tratamiento</b></span>
					</div>
					<div class="row">
						<div class="col-xs-12">
							@php
								$receta = $consulta->recetas->detalle->where('Texto','!=',null)->first();
							@endphp
							{!! $receta->Texto !!}
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
@endsection