<div class="row">
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li>
          <a href="#" data-toggle="modal" data-target="#modal_presentacion"><i class="fa fa2 fa-plus"></i> Presentación</a>
        </li>
        <li>
          <a href="#" data-toggle="modal" data-target="#modal_categoria"><i class="fa fa2 fa-plus"></i> Categoría</a>
        </li>
        <li>
          <a href="#" data-toggle="modal" data-target="#modal_proveedor"><i class="fa fa2 fa-plus"></i> Proveedor</a>
        </li>
        <li>
          <a href="#" data-toggle="modal" data-target="#modal_division"><i class="fa fa2 fa-plus"></i> División</a>
        </li>
        <li>
          <a href="#" data-toggle="modal" data-target="#modal_unidad"><i class="fa fa2 fa-plus"></i> Unidad</a>
        </li>
        <li>
          <a href="#" data-toggle="modal" data-target="#modal_componente"><i class="fa fa2 fa-plus"></i> Componente</a>
        </li>
      </ul>
    </div>
  </nav>
</div>

{{--Modales  --}}
@include('Productos.Formularios.modales.modal_p')
@include('Productos.Formularios.modales.modal_c')
@include('Productos.Formularios.modales.modal_d')
@include('Productos.Formularios.modales.modal_u')
@include('Productos.Formularios.modales.modal_co')
@include('Productos.Formularios.modales.modal_pr')
