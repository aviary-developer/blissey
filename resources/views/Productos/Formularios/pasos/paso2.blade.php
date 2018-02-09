<div class="col-md-6 col-sm-6 col-xs-12">
  <h4 class="StepTitle">Componentes del producto</h4>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar componente </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-search form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('componente',null,['id'=>'componente','class'=>'form-control has-feedback-left','placeholder'=>'Buscar componente']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Contenido *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
      {!! Form::text('cantidad_componente',1,['id'=>'cantidad_componente','class'=>'form-control has-feedback-left','placeholder'=>'Cantidad de componente','min'=>'0.00']) !!}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Unidad *</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <span class="fa fa-list-alt form-control-feedback left" aria-hidden="true"></span>
      <select class="form-control has-feedback-left" name="divisionSelect" id = "unidad">
        @foreach ($unidades as $unidad)
          <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <h4 class="StepTitle">Resultado de busqueda</h4>
  <table class="table" id="tablaBuscarComponente">
    <thead>
      <th>Componente</th>
      <th style="width : 80px">Acción</th>
    </thead>
  </table>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
  <h4 class="StepTitle">Componentes</h4>
  <table class="table" id="tablaComponente">
    <thead>
      <th>Componente</th>
      <th>Contenido</th>
      <th style="width : 80px">Acción</th>
    </thead>
    <tbody>
      @if (!$create)
        @php
          $auxiliar_componente = 0;
        @endphp
        <input type="hidden" name="componentes_eliminados[]" value="ninguno" id="componente_eliminado">
        @foreach ($componentes_productos  as $key => $componente)
          <tr>
            <td>{{$componente->nombreComponente($componente->f_componente)}}</td>
            <td>{{$componente->cantidad.' '.$componente->nombreUnidad($componente->f_unidad)}}</td>
            <td>
              <input type="hidden" id={{"componente".$key}} value={{$componente->f_componente}}>
              <input type="hidden" value={{$componente->id}}>
              <button type="button" name="button" class="btn btn-xs btn-danger" id="eliminar_componente_antiguo">
                <i class="fa fa-remove"></i>
              </button>
            </td>
          </tr>
          @php
            $auxiliar_componente = $key;
          @endphp
        @endforeach
        <input type="hidden" id="contador_componente" value={{$auxiliar_componente}}>
      @endif
    </tbody>
  </table>
</div>