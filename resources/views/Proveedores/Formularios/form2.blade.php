<div class="x_content">
  <div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
  <table class="table">
      <thead>
        <th colspan="2">Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Opción</th>
      </thead>
    <tbody id="visitadores">
      <!--Aqui se agregan los tr por parte de la función agregarVisitador-->
      @if (isset($nombrev))
        @for($a=0;$a<count($nombrev);$a++)
          <tr>
            <td>
              <input type='hidden' name='nombrev[]' value={{$nombrev[$a]}}>
              <input type='hidden' name='apellidov[]' value={{$apellidov[$a]}}>
              <input type='hidden' name='telefonov[]' value={{$telefonov[$a]}}>
            </td>
            <td>{{$nombrev[$a]}}</td>
            <td>{{$apellidov[$a]}}</td>
            <td>{{$telefonov[$a]}}</td>
            <td class='deleteVisitador' style='cursor:pointer;'>
              <a class='btn btn-danger btn-xs'>
                <i class='fa fa-remove'></i>
              </a>
            </td>
          </tr>
        @endfor
      @endif
    </tbody>
  </table>
  <div id="ocultos"></div>
</div>
  </div>
  <div class="form-group">
    <center>
      {{-- <input class="btn btn-primary" name="registrarProveedor" id="registrarProveedor" type="button" value="Guardar" onClick="guardarProveedor()"/> --}}
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/proveedores') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
