<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="col-sm-4">
	<div class="x_panel">
		{{-- Inputs hidden --}}
		<input type="hidden" value="" id="idoculto">
		<input type="hidden" value="" id="divoculto">
		<input type="hidden" value="" id="nomoculto">
		<input type="hidden" id="tipo" name="tipo" value="{{$tipo}}">
		{{-- Llenar el select de estantes --}}
		@php
			$estantes=App\Estante::arrayEstante();
			$cadena="<option value=''>Seleccione un estante</option>";
			foreach ($estantes as $key => $e) {
				$cadena=$cadena."<option value='".$key."'>".$e."</option>";
			}
		@endphp
		<input type="hidden" id="opciones" value="{{$cadena}}">
		<input type="hidden" id="confirmar" name="confirmar" value="{{true}}">
		
		<div class="form-group">
			<label class="" for="cantidad_resultado">Fecha de ingreso *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="far fa-calendar"></i></div>
				</div>
				{!! Form::date('fecha',date('Y').'-'.date('m').'-'.date('d'),['class'=>'form-control form-control-sm']) !!}
			</div>
		</div>

		<div class="form-group">
			<label class="" for="cantidad_resultado">Proveedor *</label>
			<div class="input-group mb-2 mr-sm-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="fas fa-users"></i></div>
				</div>
				{!!Form::select('f_proveedor',
          App\Transacion::arrayProveedores()
          ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control form-control-sm','id'=>'f_proveedor'])!!}
			</div>
		</div>

		<div class="form-group">
			<label class="" for="cantidad_resultado">Razón del ingreso</label>
			<div class="input-group mb-2 mr-sm-2">
				{!! Form::textarea('comentario',null,['class'=>'form-control form-control-sm','id'=>'comentario']) !!}
			</div>
		</div>

	</div>

	<div class="x_panel">
		<center>
			<button type="button" name="button" data-toggle="modal" data-target="#modal" class="btn btn-outline-success btn-sm" id="agregar_paciente">
        <i class="fas fa-search"></i>
			</button>
			{!!Form::button('Guardar',['class'=>'btn btn-primary btn-sm','id'=>'confirmarIngreso'])!!}
			<a href={{asset("/entradas")}} class="btn btn-light btn-sm">Cancelar</a>
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

		<table class="table table-sm" id="tablaDetalle">
			<thead>
				<th style="width: 80px;">Cantidad</th>
				<th>Detalle</th>
				<th>Opciones</th>
			</thead>
		</table>
	</div>

</div>

@include('Transacciones.Formularios.modalBuscarProducto')
@include('Entradas.Formularios.modal_almacenar')

<script type="text/javascript">
	function cambioEstante(){
    idEstante=$('#f_estante').find('option:selected').val();
		$('#nivel').empty();
		if(idEstante!=""){
			var ruta = $('#guardarruta').val() + "/niveles/"+idEstante;
			$.get(ruta,function(res){
        cantidad=parseFloat(res);
        console.log(cantidad+"Hola");
				for(i=1;i<=cantidad;i++){
					$('#nivel').append("<option value="+i+">"+i+"</option>");
				}
			});
		}
	}
	function cambio(){
		texto=$('#iva').text();
		if(texto=="No"){
			$('#iva').text("Si");
			$('#ivaincluido').val("1");
		}else{
			$('#iva').text("No");
			$('#ivaincluido').val("0");
		}
	}

	$(document).ready(function(){
		var fila;

		$("#tablaDetalle").on('click','#almacen',async function(e){
			e.preventDefault();
			fila = $(this);
			var estado_de = $(this).parent('center').parent('td').parent('tr').find('#state-of').val();
			if(estado_de == "true"){
				var fecha = $(this).parent('center').parent('td').parent('tr').find('#fecha_vencimiento_h').val();
				var lote = $(this).parent('center').parent('td').parent('tr').find('#lote_h').val();
				var estante = $(this).parent('center').parent('td').parent('tr').find('#estante_h').val();
				var nivel = $(this).parent('center').parent('td').parent('tr').find('#nivel_h').val();

				var ruta = $('#guardarruta').val() + "/niveles/"+estante;
				$("select[name='niveles']").empty();
				await $.get(ruta,function(res){
					cantidad=parseFloat(res);
					for(i=1;i<=cantidad;i++){
						$("select[name='niveles']").append("<option value="+i+">"+i+"</option>");
					}
				});

				$("#fecha_vencimiento_i").val(fecha);
				$("#lote_i").val(lote);
				$("select[name='f_estantes']").val(estante);
				$("select[name='niveles']").val(nivel);
			}
		});

		$("#guardar_almacen").click(function(e){
			e.preventDefault();
			var fecha = $("#fecha_vencimiento_i").val();
			var lote = $("#lote_i").val();
			var estante = $("select[name='f_estantes']").val();
			var nivel = $('select[name="niveles"]').val();

			if(fecha != null && lote.length > 0 && estante != ""){
				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth()+1;
				var yyyy = hoy.getFullYear();

				if(dd<10) {
					dd='0'+dd;
				} 

				if(mm<10) {
					mm='0'+mm;
				} 
				actual=yyyy+"-"+mm+"-"+dd;

				if(fecha>actual){
					fila.parent('center').parent('td').parent('tr').find('#fecha_vencimiento_h').val(fecha);
					fila.parent('center').parent('td').parent('tr').find('#lote_h').val(lote);
					fila.parent('center').parent('td').parent('tr').find('#estante_h').val(estante);
					fila.parent('center').parent('td').parent('tr').find('#nivel_h').val(nivel);
					fila.parent('center').parent('td').parent('tr').find('#state-of').val("true");
		
					$("#lote_i").val("");
		
					fila.removeClass('btn-success').addClass("btn-info");
					fila.empty().append('<i class="fa fa-search"></i>');
		
					$("#almacenar").modal('hide');

				}else{
					swal({
						type: 'error',
						title: '¡Error!',
						text: 'Ingrese una fecha válida',
						toast: true,
						timer: 4000,
						showConfirmButton: false
					});	
				}
			}else{
				swal({
					type: 'error',
					title: '¡Error!',
					text: 'Debe llenar los campos para poder guardar',
					toast: true,
					timer: 4000,
					showConfirmButton: false
				});
			}

		});

		$("#cerrar_m").click(function(e){
			e.preventDefault();
			$("#lote_i").val("");
			$("#precio_i").val("");
			$("#descuento_i").val("0");
    });
    
    $('#confirmarIngreso').on('click', function (e) {
      var bandera = true;

      var valido = new Validated('comentario');
	  valido.required();
	  valido.min('5');
	  bandera = valido.value(bandera);
	
		var valido = new Validated('f_proveedor');
		valido.required();
		bandera = valido.value(bandera);

		contador=0;
      $("input[name='state-of[]']").each(function (k, v) {
		  contador++;
        if ($(v).val() == "false") {
          bandera = false;
        }
      });

      if (bandera && contador>0) {
        $('#formIngreso').submit();
      } else if(contador==0){
        notaError('No hay detalles o no han sido confirmados');
      }else{
		notaError('Complete todos los campos');  
	  }
    });
	});
</script>
