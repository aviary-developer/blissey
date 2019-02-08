<div class="flex-row">
  <center>
    <h5>Componentes del Producto</h5>
  </center>
</div>
<div class="row">
  <div class="col-sm-6">
    <div class="form-group col-sm-4">
      <label class="" for="componente">Buscar componente</label>
    </div>
    <div class="form-group col-sm-8">
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-cog"></i></div>
        </div>
        {!! Form::text('componente',null,['id'=>'componente','class'=>'form-control form-control-sm','placeholder'=>'Buscar componente']) !!}
      </div>
    </div>
    <div class="form-group col-sm-4">
      <label class="" for="cantidad_componente">Contenido *</label>
    </div>
    <div class="form-group col-sm-8">
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-cog"></i></div>
        </div>
        {!! Form::text('cantidad_componente',1,['id'=>'cantidad_componente','class'=>'form-control form-control-sm','placeholder'=>'Cantidad de componente','min'=>'0.00']) !!}
      </div>
    </div>
    <div class="form-group col-sm-4">
      <label class="" for="unidad">Unidad *</label>
    </div>
    <div class="form-group col-sm-8">
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-cog"></i></div>
        </div>
        <select class="form-control form-control-sm" name="divisionSelect" id = "unidad">
          @foreach ($unidades as $unidad)
            <option value={{ $unidad->id }}>{{ $unidad->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group col-sm-12">
      <h6>Resultado de búsqueda</h6>
      <table class="table table-sm" id="tablaBuscarComponente">
        <thead>
          <th>Componente</th>
          <th style="width : 80px">Acción</th>
        </thead>
      </table>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group col-sm-12">
      <h6>Componentes</h6>
      <table class="table table-sm" id="tablaComponente">
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
                  <button type="button" name="button" class="btn btn-sm btn-danger" id="eliminar_componente_antiguo" data-toggle="tooltip" data-placement="top" title="Eliminar">
                    <i class="fa fa-times"></i>
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
  </div>
</div>
