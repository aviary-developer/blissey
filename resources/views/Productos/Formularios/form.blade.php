<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
@if($create)
<div id="smartwizard">
@else
<div id="smartwizarde">
@endif
  {{-- Encabezado del wizard --}}
  <ul>
    <li>
      <a href="#step-1">
        Paso 1 <br>
        <small>Datos del producto</small>
      </a>
    </li>
    <li>
      <a href="#step-2">
        Paso 2 <br>
        <small>Datos de los componentes</small>
      </a>
    </li>
  </ul>
  {{-- Contenido del wizard --}}
  <div>
    <div id="step-1">
      @include('Productos.Formularios.pasos.paso1')
    </div>
    <div id="step-2">
      @include('Productos.Formularios.pasos.paso2')
    </div>
  </div>
</div>
