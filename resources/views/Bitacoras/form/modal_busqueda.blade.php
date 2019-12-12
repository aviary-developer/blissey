<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-bitacora" data-backdrop="static">
    {!!Form::open(['route'=>'historial.index','method'=>'GET','role'=>'search'])!!}
    <div class="modal-dialog">
      <div class="x_panel m_panel text-danger">
        <center>
          <h4 class="mb-1">
            <i class="fas fa-search"></i>
            Buscar
          </h4>
        </center>
      </div>

      <div class="x_panel m_panel">

        <div class="row">

          <div class="form-group col-sm-6">
            <label class="" for="fecha_min">Fecha inicial</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
              </div>
              <input type="datetime-local" name="fecha_min" class="form-control form-control-sm" value={{$fechaInicial->created_at->format('Y-m-d').'T'.$fechaInicial->created_at->format('H:i')}} max={{$fechaFinal->created_at->format('Y-m-d').'T'.$fechaFinal->created_at->format('H:i')}} min={{$fechaInicial->created_at->format('Y-m-d').'T'.$fechaInicial->created_at->format('H:i')}}>
            </div>
          </div>
  
          <div class="form-group col-sm-6">
            <label class="" for="fecha_max">Fecha final</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-calendar"></i></div>
              </div>
              <input type="datetime-local" name="fecha_max" class="form-control form-control-sm" value={{$fechaFinal->created_at->format('Y-m-d').'T'.$fechaFinal->created_at->format('H:i')}} max={{$fechaFinal->created_at->format('Y-m-d').'T'.$fechaFinal->created_at->format('H:i')}} min={{$fechaInicial->created_at->format('Y-m-d').'T'.$fechaInicial->created_at->format('H:i')}}>
            </div>
          </div>
  
          <div class="form-group col-sm-12">
            <label class="" for="usuario">Usuario</label>
            <div class="input-group mb-2 mr-sm-2">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
              </div>
              <select class="form-control form-control-sm" name="usuario">
                <option value="0">Todos</option>
                @foreach ($usuarios as $usuario)
                  @if(Auth::user()->administrador==1)
                  <option value={{$usuario->id}}>{{$usuario->nombre.' '.$usuario->apellido}}</option>
                  @else
                  @if(Auth::user()->id==$usuario->id)
                  <option value={{$usuario->id}}>{{$usuario->nombre.' '.$usuario->apellido}}</option>
                  @endif
                  @endif
                @endforeach
              </select>
            </div>
          </div>
        </div>

        <div class="flex-row">
          <center>
            <h6>Acciones</h6>
            <div class="ln_solid mt-2 mb-2"></div>
          </center>
        </div>

        <div class="row">
          <span class="button-checkbox col-3">
            <button type = "button" class="btn col-12 btn-sm" data-color="primary">
              Creación
            </button>
            <input type="checkbox" hidden name="store" value="1" checked>
          </span>

          <span class="button-checkbox col-3">
            <button type = "button" class="btn col-12 btn-sm" data-color="primary">
              Edición
            </button>
            <input type="checkbox" hidden name="update" value="1" checked>
          </span>

          <span class="button-checkbox col-3">
            <button type = "button" class="btn col-12 btn-sm" data-color="primary">
              Eliminar
            </button>
            <input type="checkbox" hidden name="destroy" value="1" checked>
          </span>

          <span class="button-checkbox col-3">
            <button type = "button" class="btn col-12 btn-sm" data-color="primary">
              Activar
            </button>
            <input type="checkbox" hidden name="activate" value="1" checked>
          </span>

          <span class="button-checkbox col-3">
            <button type = "button" class="btn col-12 btn-sm" data-color="primary">
              Papelera
            </button>
            <input type="checkbox" hidden name="desactivate" value="1" checked>
          </span>

          <span class="button-checkbox col-3">
            <button type = "button" class="btn col-12 btn-sm" data-color="primary">
              Ingreso
            </button>
            <input type="checkbox" hidden name="login" value="1" checked>
          </span>

          <span class="button-checkbox col-3">
            <button type = "button" class="btn col-12 btn-sm" data-color="primary">
              Salida
            </button>
            <input type="checkbox" hidden name="logout" value="1" checked>
          </span>
        </div>

      </div>

      <div class="m_panel x_panel bg-transparent" style="border: 0px !important">
        <center>
          <button type="submit" class="btn btn-primary btn-sm col-2">Buscar</button>
          <button type="button" class="btn btn-light btn-sm col-2" data-dismiss="modal">Cerrar</button>
        </center>
      </div>
    </div>
    {!!Form::close()!!}
  </div>