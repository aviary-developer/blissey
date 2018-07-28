@if ($ingreso->estado == 0)
  <div class="row">
    <center>
      {!!Form::open(['id' => 'formulario' ,'method'=>'POST'])!!}
        <h4>¡Bienvenido!</h4>
        <span>Antes que nada recuerda que debes confirmar el ingreso o eliminarlo, también puedes generar el acta de consentimiento</span>
        <br><br>
        <div class="btn-group">
          <button type="button" class="btn btn-success btn-sm" onclick={!!"'confirmar_ingreso(".$ingreso->id.");'"!!}/>
            <i class="fa fa-check"></i> Confirmar
          </button>
          <button type="button" class="btn btn-danger btn-sm" onclick={!!"'eliminar_ingreso(".$ingreso->id.");'"!!}/>
            <i class="fa fa-remove"></i> Eliminar
          </button>
        </div>

        <div class="btn-group">
          <a href={!! asset('/acta/'.$ingreso->id)!!} class="btn btn-sm btn-dark" target="_blank">
            <i class="fa fa-print"></i> Acta de consentimiento
          </a>
        </div>
      {!!Form::close()!!}
    </center>
  </div>
@else
  <div class="row" style="margin-top: 10px">
    {{-- Paneles izquierdos --}}
    <div class="col-xs-8">
      {{-- Panel principal --}}
      <div class="row">
        <div class="col-xs-12">
          <div class="x_panel">
            @include('Ingresos.dashboard.partes.financiero_r')
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="x_panel">
            @include('Ingresos.dashboard.partes.medico_r')
          </div>
        </div>
        <div class="col-xs-6">
          <div class="x_panel">
            
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-4">
      <div class="row">
        <div class="x_panel">
          @include('Ingresos.dashboard.partes.signos_r')
        </div>
      </div>
      <div class="row">
        <div class="x_panel">
          @include('Ingresos.dashboard.partes.producto_r')
        </div>
      </div>
      <div class="row">
        <div class="x_panel">
          @include('Ingresos.dashboard.partes.servicio_r')
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-4">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.laboratorio_r')
      </div>
    </div>
    <div class="col-xs-4">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.rayos_x_r')
      </div>
    </div>
    <div class="col-xs-4">
      <div class="x_panel">
        @include('Ingresos.dashboard.partes.ultra_r')
      </div>
    </div>
  </div>
@endif
@include('Ingresos.dashboard.modales.acciones')
@include('Ingresos.dashboard.modales.cambio_habitacion')
@include('Ingresos.dashboard.modales.cambio_hospitalizacion')