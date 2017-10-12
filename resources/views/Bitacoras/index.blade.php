@extends('dashboard')
@section('layout')
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Bitacora
        </h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-md-6 col-xs-12">
            <div class="btn-group">
              <button type="button" class="btn btn-dark btn-ms" data-toggle="modal" data-target=".bs-modal-lg">
                <i class="fa fa-sliders"></i>
                Filtros
              </button>
              <a href={!! asset('#') !!} class="btn btn-dark btn-ms"><i class="fa fa-file"></i> Reporte</a>
              <button class="btn btn-primary btn-ms" type="button"><i class="fa fa-question"></i> Ayuda</button>
            </div>
          </div>
        </div>
        <br>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Hora</th>
              <th>Usuario</th>
              <th colspan="2">Acción</th>
              <th>Ver</th>
            </tr>
          </thead>
          <tbody>
            @if (count($bitacoras)>0)
              @php
              $correlativo = 1;
              @endphp
              @foreach ($bitacoras as $bitacora)
                <tr>
                  <td>{{ $correlativo }}</td>
                  <td>{{ $bitacora->created_at->format('d/m/Y')}}</td>
                  <td>{{ $bitacora->created_at->format('H:i:s')}}</td>
                  <td>{{ $bitacora->nombreUsuario($bitacora->f_usuario) }}</td>
                  <td>
                    <center>
                      @if ($bitacora->tipo == 'store')
                        <span class="label label-success">Creación</span>
                      @elseif ($bitacora->tipo == 'update')
                        <span class="label label-warning">Edición</span>
                      @elseif ($bitacora->tipo == 'destroy')
                        <span class="label label-danger">Eliminar</span>
                      @elseif ($bitacora->tipo == 'activate')
                        <span class="label label-info">Activar</span>
                      @elseif ($bitacora->tipo == 'desactivate')
                        <span class="label label-purple">Papelara</span>
                      @elseif ($bitacora->tipo == 'login')
                        <span class="label label-primary">Ingreso</span>
                      @elseif ($bitacora->tipo == 'logout')
                        <span class="label label-default">Salida</span>
                      @endif
                    </center>
                  </td>
                  <td>
                    @php
                      if($bitacora->tipo == 'store')
                      {
                        echo "Se ha creado un registro en ".$bitacora->tabla.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
                      }
                      else if($bitacora->tipo == 'update')
                      {
                        echo "Se ha editado un registro en ".$bitacora->tabla.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
                      }
                      else if($bitacora->tipo == 'destroy')
                      {
                        echo "Se ha eliminado un registro en ".$bitacora->tabla.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
                      }
                      else if($bitacora->tipo == 'activate')
                      {
                        echo "Se ha activado un registro en ".$bitacora->tabla.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
                      }
                      else if($bitacora->tipo == 'desactivate')
                      {
                        echo "Se ha enviado a papelera un registro en ".$bitacora->tabla.' id: '.str_pad($bitacora->indice,7,'0',STR_PAD_LEFT);
                      }
                      else if($bitacora->tipo == 'logout')
                      {
                        echo "Cerró sesión";
                      }
                      else
                      {
                        echo "Abrió sesión";
                      }
                    @endphp
                  </td>
                  <td>
                    @if ($bitacora->existeRegistro($bitacora->indice,$bitacora->tabla) > 0)
                      <a href={!! asset($bitacora->ruta.'/'.$bitacora->indice)!!} class="btn btn-xs btn-primary">
                        <i class="fa fa-eye"></i>
                      </a>
                    @else
                      <a href="#" class="btn btn-xs btn-default">
                        <i class="fa fa-ban"></i>
                      </a>
                    @endif
                  </td>
                </tr>
                @php
                $correlativo++;
                @endphp
              @endforeach
            @else
              <tr>
                <td colspan="7">
                  <center>
                    No hay registros que coincidan con los terminos de busqueda indicados
                  </center>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
        <div class="ln_solid"></div>
        <center>
           {!! str_replace ('/?', '?', $bitacoras->appends(Request::only(['usuario','fecha_max','fecha_min','store','update','activate','desactivate','destroy','login','logout']))->render ()) !!}
        </center>
      </div>
    </div>
  </div>

  {{-- Modal --}}
  <div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    {!!Form::open(['route'=>'bitacoras.index','method'=>'GET','role'=>'search'])!!}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Filtros</h4>
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
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Acción</label>
              <label>
                {!!Form :: checkbox ( "store",1,true,['class'=>'flat'])!!} Creación &nbsp;
              </label>
              <label>
                {!!Form :: checkbox ( "update",1,true,['class'=>'flat'])!!} Edición &nbsp;
              </label>
              <label>
                {!!Form :: checkbox ( "destroy",1,true,['class'=>'flat'])!!} Eliminar &nbsp;
              </label>
              <label>
                {!!Form :: checkbox ( "activate",1,true,['class'=>'flat'])!!} Activar &nbsp;
              </label>
              <label>
                {!!Form :: checkbox ( "desactivate",1,true,['class'=>'flat'])!!} Papelera &nbsp;
              </label>
              <label>
                {!!Form :: checkbox ( "login",1,true,['class'=>'flat'])!!} Ingreso &nbsp;
              </label>
              <label>
                {!!Form :: checkbox ( "logout",1,true,['class'=>'flat'])!!} Salida &nbsp;
              </label>
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
