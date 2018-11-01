<div class="col-sm-4">
	<div class="x_panel">
		<div class="form-group">
			<label class="" for="nombre">Fecha *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-calendar"></i></div>
				</div>
				{!! Form::date('fecha',$fecha,['class'=>'form-control form-control-sm','id'=>'campo']) !!}
			</div>
		</div>
		<div class="flex-row">
			<center>
				<button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-outline-success btn-sm">
					<i class="fas fa-search"></i>
					Buscar
				</button>
			</center>
		</div>
	</div>
	<div class="x_panel">
		<center>
			<button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
			<a href={!! asset("/requisiciones?tipo=4") !!} class="btn btn-light btn-sm">Cancelar</a>
		</center>
	</div>
</div>
<div class="col-sm-8">
	<div class="x_panel">
		<div class="flex-row">
			<center>
				<h5>Detalle</h5>
			</center>
		</div>
		<table class="table table-sm table-hover table-striped" id="tablaDetalle">
      <thead>
        <tr>
          <th>Cantidad</th>
          <th>Código</th>
          <th colspan="2">Producto</th>
          <th>Opciones</th>
        </tr>
      </thead>
    </table>
	</div>
</div>

@include('Requisiciones.Formularios.modalRequisicion')

<script>
	$(document).ready(function(){
		$("#save_me").click(function(e){
			e.preventDefault();
	
			var valido = new Validated('campo');
			valido.required();
			bandera = valido.value(true);
	
			var detalle = false;
	
			$('[name="f_producto[]"]').each(function(k,v){
				detalle = true;
			});

			
			if(bandera && detalle){
				$("#form").submit();
			}else if(detalle == false){
				swal({
					type: 'error',
					title: '¡Error!',
					text: 'Debe agregar al menos un producto a la requisición',
					toast: true,
					timer: 4000,
					showConfirmButton: false
				});
			}
		});
	});
</script>