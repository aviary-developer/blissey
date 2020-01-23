<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="modal2">
	<div class="modal-dialog">
		<div class="x_panel m_panel text-danger">
			<center>
				<h4 class="mb-1">
					Parámetro
					<span class="badge badge-danger">Nuevo</span>
				</h4>
			</center>
		</div>

		<div class="x_panel m_panel">
			<div class="form-group col-sm-12">
				<label class="" for="seccion_select">Nombre *</label>
				<div class="input-group mb-2 mr-sm-2">
					<div class="input-group-prepend">
						<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
					</div>
					{!! Form::text(
						'nombreParametro',
						null,
						['id'=>'nombreParametro',
						'class'=>'form-control form-control-sm',
						'placeholder'=>'Nombre del parámetro']) !!}
				</div>
			</div>

			<div class="form-group">
        <center>
          <div class="">
            <label>
              <input type="checkbox"name="checkValores" id="checkValores" class="js-switch" unchecked /> Información avanzada
            </label>
          </div>
        </center>
			</div>
			
			<div id="divValoresNormales" style="display:none;">
				<div class="form-group col-sm-12">
					<label class="" for="seccion_select">Unidad de medida</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-weight"></i></div>
						</div>
						<select class="form-control form-control-sm" id="selectUnidadParametro" name="unidad">
							<option value=""></option>
							@foreach ($unidades as $unidad)
								<option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="flex-row">
					<div class="col-sm-1"></div>
					<span class="badge font-sm border border-primary text-primary col-sm-4">Masculino</span>
					<div class="col-sm-2"></div>
					<span class="badge font-sm border border-pink text-pink col-sm-4">Femenino</span>
				</div>

				<div class="form-group col-sm-6">
					<label class="" for="seccion_select">Valor mínimo</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="far fa-minus-square text-primary"></i></div>
						</div>
						{!! Form::number(
							'valorMinimo',
							null,
							['id'=>'valorMinimo',
							'class'=>'form-control form-control-sm',
							'placeholder'=>'0',
							'step'=>'any']) !!}
					</div>
				</div>

				<div class="form-group col-sm-6">
					<label class="" for="seccion_select">Valor mínimo</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="far fa-minus-square text-pink"></i></div>
						</div>
						{!! Form::number(
							'valorMinimoFemenino',
							null,
							['id'=>'valorMinimoFemenino',
							'class'=>'form-control form-control-sm',
							'placeholder'=>'0',
							'step'=>'any']) !!}
					</div>
				</div>

				<div class="form-group col-sm-6">
					<label class="" for="seccion_select">Valor máximo</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="far fa-plus-square text-primary"></i></div>
						</div>
						{!! Form::number(
							'valorMaximo',
							null,
							['id'=>'valorMaximo',
							'class'=>'form-control form-control-sm',
							'placeholder'=>'0',
							'step'=>'any']) !!}
					</div>
				</div>

				<div class="form-group col-sm-6">
					<label class="" for="seccion_select">Valor máximo</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="far fa-plus-square text-pink"></i></div>
						</div>
						{!! Form::number(
							'valorMaximoFemenino',
							null,[
								'id'=>'valorMaximoFemenino',
								'class'=>'form-control form-control-sm',
								'placeholder'=>'0',
								'step'=>'any']) !!}
					</div>
				</div>

			</div>

			<div class="form-group col-sm-12">
					<label class="" for="seccion_select">Valor predeterminado</label>
					<div class="input-group mb-2 mr-sm-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-list-alt"></i></div>
						</div>
						{!! Form::text(
							'valorPredeterminado',
							null,
							['id'=>'valorPredeterminado',
							'class'=>'form-control form-control-sm',
							'placeholder'=>'Valor predeterminado']) !!}
					</div>
				</div>
		</div>

		<div class="m_panel x_panel bg-transparent" style="border:0px !important">
			<center>
				<button type="button" id="guardarParametroModal" class="btn btn-primary btn-sm col-2">Guardar</button>
        <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
			</center>
		</div>

	</div>
</div>
<script>

	$("#guardarParametroModal").click(async function(e){
		e.preventDefault();
		var nombre = $("#nombreParametro").val();
		var unidad = $("#selectUnidadParametro").val();
		var valorMinimo= $('#valorMinimo').val();
		var valorMaximo= $('#valorMaximo').val();
		var valorMinimoF= $('#valorMinimoFemenino').val();
		var valorMaximoF= $('#valorMaximoFemenino').val();
		var valorPredeterminado= $('#valorPredeterminado').val();
		var ruta=$('#guardarruta').val() + "/ingresoParametro";

		var valido = new Validated('nombreParametro');
		valido.required();
		bandera = valido.value(true);

		if(bandera){
			await $.ajax({
				url:ruta,
				type:'POST',
				data: {
					nombreParametro: nombre,
					unidad: unidad,
					valorMinimo: valorMinimo,
					valorMaximo: valorMaximo,
					valorMinimoFemenino: valorMinimoF,
					valorMaximoFemenino: valorMaximoF,
					valorPredeterminado: valorPredeterminado
				},
				success: function(){
					swal({
						type: 'success',
						toast: true,
						title: '¡Acción exitosa!',
						position: 'top-end',
						showConfirmButton: false,
						timer: 4000
					});
				}
			});
			var paso=-1;
			// for (paso = -1; paso < contadorSelectsParametros; paso++) {
			//   rellenarCombosParametros(paso);
			// }
			rellenarCombosParametros();
			$("#nombreParametro").val("");
			$('#valorMinimo').val("");
			$('#valorMaximo').val("");
			$('#selectUnidadParametro').val("");
			$('#valorMinimoFemenino').val("");
			$('#valorMaximoFemenino').val("");
			$('#valorPredeterminado').val("");
			$("#modal2").modal('hide');
		}
	});

function rellenarCombosParametros(){
  var parametros = $("#parametro_select");
  var ruta=$('#guardarruta').val() + "/llenarParametrosExamenes";
  $.get(ruta,function(res){
    parametros.empty();
    $(res).each(function(key,value){
      parametros.append("<option value='"+value.id+"'>"+value.nombreParametro+"</option>");
    });
  });
}
</script>
