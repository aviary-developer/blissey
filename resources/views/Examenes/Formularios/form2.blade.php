<div>
  <div class="">
    Opciones:
    &nbsp; &nbsp;
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal4">
        <i class="fa fa-plus"></i>
        Tipo de muestra
      </button>
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal5">
        <i class="fa fa-plus"></i>
        Tipo de sección
      </button>
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal2">
        <i class="fa fa-plus"></i>
        Parametro
      </button>
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal3">
        <i class="fa fa-plus"></i>
        Reactivo
      </button>
    </div>
  </div>
  <div class="ln_solid"></div>
  <div>
    <div class="form-group col-xs-12 col-sm-6">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre *</label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
        {!! Form::text('nombreExamen',null,['id'=>'nombre_examen','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del nuevo examen','']) !!}
      </div>
    </div>
    <div class="form-group col-sm-6 col-xs-12">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">Area de examen *</label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
        <select class="form-control has-feedback-left" name="area" id="area_select" required>
        <option value="HEMATOLOGIA">Hematología</option>
        <option value="EXAMENES DE ORINA">Exámenes de orina</option>
        <option value="EXAMENES DE HECES">Exámenes de heces</option>
        <option value="BACTERIOLOGIA">Bacteriología</option>
        <option value="QUIMICA SANGUINEA">Química sanguínea</option>
        <option value="INMUNOLOGIA">Inmunología</option>
        <option value="ENZIMAS">Enzimas</option>
        <option value="PRUEBAS ESPECIALES">Pruebas especiales</option>
        <option value="OTROS">Otros</option>
        </select>
      </div>
    </div>
    <div class="form-group col-sm-6 col-xs-12">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">Tipo de muestra *</label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <span class="fa fa-tint form-control-feedback left" aria-hidden="true"></span>
        <select class="form-control has-feedback-left" name="tipoMuestra" id="tipo_muestra_select" >
          @foreach ($muestras as $muestra)
            <option value={{ $muestra->id }}>{{ $muestra->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div class="form-group col-xs-12 col-sm-6">
    <label class="control-label col-md-4 col-sm-4 col-xs-12">Precio ($)*</label>
    <div class="col-md-8 col-sm-8 col-xs-12">
      <span class="fa fa-money form-control-feedback left" aria-hidden="true"></span>
      {!! Form::number('precio',null,['id'=>'precio_campo','class'=>'form-control has-feedback-left','placeholder'=>'Precio del examen','step'=>'0.01']) !!}
    </div>
  </div>
  <center>
    <div class="">
      <label>
        <input type="checkbox" name="checkImagenExamen" id="checkImagenExamen" class="js-switch" unchecked /> ¿Almacenará imagen?
      </label>
    </div>
  </center>
  <div class="x_panel" id="panel_seccion">
    <div class="btn-success col-xs-3 btn" style="height: 130px; margin: 0px;" id="agregar_seccion_x" data-toggle="modal" data-target="#modal1" >
      <center>
        <i class="fa fa-plus-circle" style="font-size: 450%; margin: 15px;"></i>
        <div style="margin-bottom: 10px;">
          <span class="label label-lg label-white green col-xs-12" >
            Agregar sección
          </span>
        </div>
      </center>
    </div>
  </div>
  <center>
    <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
  <div class="clearfix"></div>
  <div class="ln_solid"></div>
  <div class="form-group">
    <center>
      <button type="button" name="" class="btn btn-primary" id="guardar_examen">Guardar</button>
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/examenes') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>

{{-- Modal --}}
@include('Examenes.Formularios.modales.modal_i')
@include('Examenes.Formularios.modales.modal_p')
@include('Examenes.Formularios.modales.modal_r')
@include('Examenes.Formularios.modales.modal_m')
@include('Examenes.Formularios.modales.modal_s')
