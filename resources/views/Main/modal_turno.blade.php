<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="turno" data-backdrop="static">
  <div class="modal-dialog modal-sm">
		<div class="row">
			<div class="x_panel m_panel text-danger">
				<center>
					<h4 class="mb-1">
						<i class="fas fa-file"></i>
						Reporte de turno
					</h4>
				</center>
			</div>
		</div>
		<div class="row" id="primary_panel">
			<div class="x_panel m_panel">
				<div class="form-group">
					<label class="" for="fecha">Fecha *</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-calendar-check"></i></div>
						</div>
						@php
							$fecha = Carbon\Carbon::now();
						@endphp
						{!! Form::date(
							'fecha',
							$fecha->format('Y-m-d'),
							['class'=>'form-control form-control-sm',
								'max'=>$fecha->format('Y-m-d'),
								'id'=>'fecha_turno']
						) !!}
					</div>
				</div>

				<div class="form-group">
					<label class="" for="fecha">Usuario *</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-user"></i></div>
						</div>
						@php
							$Recepcionistas = App\User::where('tipoUsuario','Recepción')->orderBy('apellido')->get();
						@endphp
						<select name="" id="usuario_turno" class="form-control form-control-sm">
							@foreach ($Recepcionistas as $recepcion)
								@if ($recepcion->id == Auth::user()->id)
									<option value="{{$recepcion->id}}" selected>{{$recepcion->nombre.' '.$recepcion->apellido}}</option>
								@else
									<option value="{{$recepcion->id}}">{{$recepcion->nombre.' '.$recepcion->apellido}}</option>
								@endif
							@endforeach
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" class="btn btn-primary btn-sm col-4" id="ok_turno">Generar</button>
				<button type="button" class="btn btn-sm col-4" onclick="location.reload()">Cerrar</button>
				<a href="#" class="hidden" target="_blank" id="a_turno"></a>
			</center>
		</div>
  </div>
</div>

<script>
	$("#ok_turno").click(function(e){
		e.preventDefault();

		let usuario = $("#usuario_turno").val();
		let fecha = $("#fecha_turno").val();

		$("#a_turno").prop('href', $('#guardarruta').val() + '/turno?fecha='+fecha+'&id='+usuario);
		document.getElementById('a_turno').click();
	});
</script>