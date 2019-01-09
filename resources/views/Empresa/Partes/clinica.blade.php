<div class="row">
	<div class="col-sm-4">
		<div class="image view view-first">
			<center>
				<img src={{asset(Storage::url($empresa->logo_clinica))}} class="img-responsive miniperfil">
				<div class="mask" style="height:100%">
					<div class="tools tools-bottom" style="margin-top: 105px;">
						<a href={{asset('/grupo_promesa/'.$empresa->id.'-5/edit')}}>
							<i class="fa fa-edit"></i>
						</a>
					</div>
				</div>
			</center>
		</div>
	</div>
	<div class="col-sm-8">
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Código
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				{{ $empresa->codigo_clinica }}
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Nombre
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				{{ $empresa->nombre_clinica }}
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Correo Electrónico
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				@if ($empresa->correo_clinica == null)
					<span class="badge text-danger border border-danger col-4">Sin correo</span>
				@else
					{{ $empresa->correo_clinica }}
				@endif
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Teléfono
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				@if ($count_telefono_h == 0)
					<span class="badge text-danger border border-danger col-4">Sin teléfono</span>
				@else
					@foreach($telefonos as $telefono)
						@if ($telefono->tipo == 'clinica')
							<i class="fas fa-phone"></i>
							{{$telefono->telefono}}
							@if($telefono!=null)
								@if (count($telefonos)>1)
									<br>
								@endif
							@endif
						@endif
					@endforeach
				@endif
			</h6>
		</div>

		<div class="ln_solid mb-1 mt-1"></div>
		<div class="flex-row">
			<span class="font-weight-light text-monospace">
				Dirección
			</span>
		</div>
		<div class="flex-row">
			<h6 class="font-weight-bold">
				{{ $empresa->direccion_clinica }}
			</h6>
		</div>
	</div>
</div>