<div class="x_content">
  <div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="datos-tab">
  <table class="table">
      <tr>
        <th colspan="2">Nombre</th>
        <th>Apellido</th>
        <th>Teléfono</th>
        <th>Opción</th>
      </tr>
    <tbody id="visitadores">
      <!--Aqui se agregan los tr por parte de la función agregarVisitador-->
    </tbody>
  </table>
  <div id="ocultos"></div>
</div>
  </div>
  <div class="form-group">
    <center>
      <!--<input name="registrarProveedor" id="registrarProveedor" type="button" value="Guardar" onClick="guardarProveedor()"/>-->
      {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
      <button type="reset" name="button" class="btn btn-default">Limpiar</button>
      <a href={!! asset('/pacientes') !!} class="btn btn-default">Cancelar</a>
    </center>
  </div>
</div>
