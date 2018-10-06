{{-- <div class="x_panel">
<div class="x_content">
  <div class="form_wizard wizard_horizontal" id="wizard">
    <ul class="wizard_steps">
      <li>
        <a href="#step-1">
          <span class="step_no"><i class="fa fa-list-alt"></i></span>
          <span class="step_descr">
            Paso 1 <br>
            <small>Datos del producto</small>
          </span>
        </a>
      </li>
      <li>
        <a href="#step-2">
          <span class="step_no"><i class="fa fa-cubes"></i></span>
          <span class="step_descr">
            Paso 2 <br>
            <small>Datos de los componentes</small>
          </span>
        </a>
      </li>
    </ul>
    <div id="step-1">
      @include('Productos.Formularios.pasos.paso1')
      <div class="clearfix"></div>
      <center>
        <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
      </center>
    </div>
    <div id="step-2">
      <div style="height:500px">
        @include('Productos.Formularios.pasos.paso2')
      </div>
      <div class="clearfix"></div>
      <center>
        <p style="color:red;">El campo marcado con un * es <b>obligatorio</b>.</p>
      </center>
    </div>
  </div>
</div>
</div> --}}
<div class="alert alert-danger" id="mout">
  <center>
    <p class="mb-1">El campo marcado con un * es <b>obligatorio</b>.</p>
  </center>
</div>
<div id="smartwizard">
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
