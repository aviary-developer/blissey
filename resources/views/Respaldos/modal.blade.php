<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-respaldo" data-backdrop="static">
  <div class="modal-dialog">
    {!!Form::open(['url' =>'/subirRespaldo','method' =>'POST','enctype'=>'multipart/form-data'])!!}
      <div class="x_panel m_panel text-danger">
        <center>
          <h4 class="mb-1">
            <i class="fas fa-upload"></i>
            Subir respaldo
          </h4>
        </center>
      </div>

      <div class="x_panel m_panel">
        <div class="form-group">
          <label class="" for="subirRespaldo">Archivo </label>
          <div class="input-group mb-2 mr-sm-2">
            <div class="custom-file input-group">
              <input type="file" name="subirRespaldo" class="custom-file-input" id="subirRespaldo" lang="es" accept=".sql" required>
              <label class="form-control-sm custom-file-label " for="customFileLang">Seleccionar archivo</label>
            </div>
          </div>
        </div>
      </div>

      <div class="m_panel x_panel bg-transparent" style="border:0px !important">
        <center>
          <button type="submit" class="btn btn-primary btn-sm col-2">Subir</button>
          <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
        </center>
      </div>
    {!!Form::close()!!}

  </div>
</div>