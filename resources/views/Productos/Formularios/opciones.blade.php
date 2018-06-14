<div>
  <div class="">
    Opciones:
    &nbsp; &nbsp;
    <div class="btn-group">
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal_presentacion">
        <i class="fa fa-plus"></i>
        Presentación
      </button>
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal_categoria">
        <i class="fa fa-plus"></i>
        Categoría
      </button>
    </div>
  </div>
  <div class="ln_solid"></div>
</div>

{{--Modales  --}}
@include('Productos.Formularios.modales.modal_p')
@include('Productos.Formularios.modales.modal_c')
