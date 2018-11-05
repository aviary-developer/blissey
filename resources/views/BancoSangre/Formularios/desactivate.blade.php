{!!Form::open(['url'=>['desactivateBancoSangre',$donacion->id],'method'=>'POST'])!!}
<div class="btn-group">

	<a href="#" class="btn btn-sm btn-dark" data-value={{asset(Storage::url($donacion->pruebaCruzada))}} title="Prueba cruzada" id="p_cruzada" data-target="#modalPruebaCruzada" data-toggle="modal">
		<i class="fa fa-image"></i>
	</a>
	<a href={!! asset('/bancosangre/'.$donacion->id.'/edit')!!} class="btn btn-sm btn-primary"  title="Editar">
		<i class="fa fa-edit"></i>
	</a>
	<button type="button" class="btn btn-danger btn-sm"  title="Enviar a papelera" onclick="
		return swal({
        title: 'Enviar registro a papelera',
        text: '¿Está seguro? ¡Ya no estara disponible!',
        type: 'question',
        showCancelButton: true,
        confirmButtonText: 'Si, ¡Enviar!',
        cancelButtonText: 'No, ¡Cancelar!',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-light',
        buttonsStyling: false
      }).then((result) => {
        if (result.value) {
          localStorage.setItem('msg','yes');
          submit();
        }
      });"/>
			<i class="fa fa-trash"></i>
	</button>
</div>
<script>
	$(".index-table").on('click','#p_cruzada',function(e){
		e.preventDefault();
		{{--  $("#modalPruebaCruzada").modal('show');  --}}
		$("#img-cruzada").attr('src',$(this).data('value'));
	});
</script>
{!!Form::close()!!}
