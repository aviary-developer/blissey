@extends('dashboard')
@section('layout')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Historial
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="btn-group">
              <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target=".bs-modal-lg">
                <i class="fa fa-search"></i>
                Busqueda
              </button>
              <a href={!! asset('#') !!} class="btn btn-dark btn-sm"><i class="fa fa-file"></i> Reporte</a>
              <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
        </div>
        <br>
        @include('Bitacoras.form.tabla')
        <div class="ln_solid"></div>
        <center>
           {!! str_replace ('/?', '?', $bitacoras->appends(Request::only(['usuario','fecha_max','fecha_min','store','update','activate','desactivate','destroy','login','logout']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>

  {{-- Modal --}}
  <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    {!!Form::open(['route'=>'historial.index','method'=>'GET','role'=>'search'])!!}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Busqueda</h4>
        </div>
        <div class="modal-body">
          <div class="x_panel">
            <div class="form-group col-sm-6 col-xs-12">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha incial</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                <input type="datetime-local" name="fecha_min" class="form-control has-feedback-left" value={{$fechaInicial->created_at->format('Y-m-d').'T'.$fechaInicial->created_at->format('H:i')}} max={{$fechaFinal->created_at->format('Y-m-d').'T'.$fechaFinal->created_at->format('H:i')}} min={{$fechaInicial->created_at->format('Y-m-d').'T'.$fechaInicial->created_at->format('H:i')}}>
              </div>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha final</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-calendar form-control-feedback left" aria-hidden="true"></span>
                <input type="datetime-local" name="fecha_max" class="form-control has-feedback-left" value={{$fechaFinal->created_at->format('Y-m-d').'T'.$fechaFinal->created_at->format('H:i')}} max={{$fechaFinal->created_at->format('Y-m-d').'T'.$fechaFinal->created_at->format('H:i')}} min={{$fechaInicial->created_at->format('Y-m-d').'T'.$fechaInicial->created_at->format('H:i')}}>
              </div>
            </div>
            <div class="form-group col-sm-6 col-xs-12">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                <select class="form-control has-feedback-left" name="usuario">
                  <option value="0">Todos</option>
                  @foreach ($usuarios as $usuario)
                    <option value={{$usuario->id}}>{{$usuario->nombre.' '.$usuario->apellido}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group col-md-12 col-xs-12">
              <div class="row">
                <center>
                  <label class="control-label col-md-12 col-sm-12 col-xs-12">Acción</label>
                </center>
              </div>
              
              <div class="row">
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12 btn-sm" data-color="success">
                    Creación
                  </button>
                  <input type="checkbox" class="hidden" name="store" value="1" checked>
                </span>
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12 btn-sm" data-color="success">
                    Edición
                  </button>
                  <input type="checkbox" class="hidden" name="update" value="1" checked>
                </span>
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12 btn-sm" data-color="success">
                    Eliminar
                  </button>
                  <input type="checkbox" class="hidden" name="destroy" value="1" checked>
                </span>
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12 btn-sm" data-color="success">
                    Activar
                  </button>
                  <input type="checkbox" class="hidden" name="activate" value="1" checked>
                </span>
              </div>
              <br>
              <div class="row">
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12 btn-sm" data-color="success">
                    Papelera
                  </button>
                  <input type="checkbox" class="hidden" name="desactivate" value="1" checked>
                </span>
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12 btn-sm" data-color="success">
                    Ingreso
                  </button>
                  <input type="checkbox" class="hidden" name="login" value="1" checked>
                </span>
                <span class="button-checkbox col-md-3 col-sm-3 col-xs-12">
                  <button type = "button" class="btn col-md-12 col-sm-12 col-xs-12 btn-sm" data-color="success">
                    Salida
                  </button>
                  <input type="checkbox" class="hidden" name="logout" value="1" checked>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Buscar</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </div>
    {!!Form::close()!!}
  </div>
@endsection
