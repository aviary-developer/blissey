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
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal_division">
        <i class="fa fa-plus"></i>
        División
      </button>
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal_unidad">
        <i class="fa fa-plus"></i>
        Unidad
      </button>
      <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal_componente">
        <i class="fa fa-plus"></i>
        Componente
      </button>
    </div>
  </div>
  <div class="ln_solid"></div>
</div>

{{--Modales  --}}
@include('Productos.Formularios.modales.modal_p')
@include('Productos.Formularios.modales.modal_c')
@include('Productos.Formularios.modales.modal_d')
@include('Productos.Formularios.modales.modal_u')
@include('Productos.Formularios.modales.modal_co')
