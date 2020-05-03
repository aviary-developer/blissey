<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div class="x_panel">
  <div class="flex-row">
    <div class="col-sm-2"></div>
    <input type="hidden" id="seleccion">
    <div class="form-group col-sm-6">
      <label class="" for="n_paciente">Paciente *</label>
      <div class="input-group mb-2 mr-sm-2 ">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-user"></i></div>
        </div>
        {!! Form::text(
          'n_paciente',
          null,
          ['id'=>'n_paciente',
          'class'=>'form-control form-control-sm',
          'placeholder'=>'Nombre del paciente', 
          'disabled']) !!}
        <div class="input-group-append">
          <div class="input-group-btn">
            <div class="btn-group">
              <button type="button" name="button" data-toggle="modal" data-target="#modal_" class="btn btn-primary btn-sm" id="agregar_paciente" onclick="input_seleccion('solicitud');" title="Buscar Paciente">
                <i class="fa fa-search"></i>
              </button>
              <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#solicitud_m" title="Buscar Receta">
                <i class="fa fa-medkit"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="f_paciente" id="f_paciente">
    <div class="form-group col-sm-4">
        <label class="" for="n_paciente">Total</label>
        <div class="input-group mb-2 mr-sm-2 ">
            <div class="card text-white bg-success mb-3">
                <strong><span style="font-size: x-large">$ </span><span style="font-size: x-large" id="totalPrecio">0.00</span></strong>
        </div>
    </div>
  </div>
  {{-- <div class="form-group col-sm-4">
  <div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" id="customCheck1">
    <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
  </div>
  </div> --}}
</div>

<div class="row">
  @include('SolicitudExamenes.Formularios.examenes')
  <input type="hidden" id="seleccion" value="solicitud">
  <input type="hidden" id="enviarClinica" name="enviarClinica" value=0>
  <input type="hidden" name="tipo" value="examenes">
</div>

<div class="x_panel" style="">
  <div class="flex-row">
    <center>
      <button type="button" class="btn btn-primary btn-sm" id="save_me">Guardar</button>
      <a href={!! asset($ruta) !!} class="btn btn-light btn-sm">Cancelar</a>
    </center>
  </div>
</div>

@include('Recetas.modal.solicitud')
@include('SolicitudExamenes.Formularios.buscar_paciente')
@include('SolicitudExamenes.Partes.modal_nuevo_paciente')

<script type="text/javascript">
var solicitudes=0;

  $("#save_me").click(function(){
    var totalPrecio=parseFloat($("#totalPrecio").text());
    var valido = new Validated('n_paciente');
    valido.required();
    is_valid = valido.value(true);
    if(is_valid){
      if(totalPrecio>0.00){
      swal({
    title: '¿Se enviarán los resultados a clínica?',
    html: 'Para seguir agregando solicitudes presione la tecla <u><strong>ESC</strong></u>',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si, ¡Se enviarán!',
    cancelButtonText: 'No, ¡No se enviarán!',
    confirmButtonClass: 'btn btn-primary',
    cancelButtonClass: 'btn btn-light',
    buttonsStyling: false,
    closeOnClickOutside: false,
  closeOnEsc: true,
  allowOutsideClick: false,
  }).then((result) => {
    if (result.value) {
      $('#enviarClinica').val(1);
      Swal.fire(
      'Listo',
      'Notificación agregada',
      'info'
    )
    $('#form').submit();
    }else{
      $('#enviarClinica').val(0);
      $('#form').submit();
    }
  });
      }else{
        swal({
            type: 'error',
            html: '<span class="text-uppercase font-weight-bold mb-1">Seleccione al menos un examen</span>',
            toast: true,
            position: 'top-end',
            timer: '4000',
            showConfirmButton: false
          });
      }
    }
  });

  function input_seleccion(e){
    document.getElementById('seleccion').value = e;
  }
  async function agregarExamenEnSolicitud(boton){
    var totalPrecio=parseFloat($("#totalPrecio").text());
    var precioExamen=parseFloat(boton.value);
        if (boton.className==="btn col-12 btn-sm btn-defualt") {
          solicitudes=solicitudes+1;
          var total=(totalPrecio+precioExamen);
          $("#totalPrecio").text(total.toFixed(2));
          $("#totalSolicitudes").append('<li>'+boton.innerText+'</li>');
          swal({
            type: 'success',
            html: '<span class="text-uppercase font-weight-bold mb-1">Solicitud</span><br><strong>'+boton.innerText+'</strong> <i>¡Agregada!</i><br>Total solicitudes:'+solicitudes,
            toast: true,
            position: 'top-end',
            timer: '4000',
            showConfirmButton: false
          });
        } else if(boton.className==="btn col-12 btn-sm btn-success") {
          solicitudes=solicitudes-1;
          totalPrecio=totalPrecio-precioExamen;
          $("#totalPrecio").text(totalPrecio.toFixed(2));
          swal({
            type: 'warning',
            html: '<span class="text-uppercase font-weight-bold mb-1">Solicitud</span><br><strong>'+boton.innerText+'</strong> <i>¡Eliminada!</i><br>Total solicitudes:'+solicitudes,
            toast: true,
            position: 'top-end',
            timer: '4000',
            showConfirmButton: false
          });
        }
            }
</script>
