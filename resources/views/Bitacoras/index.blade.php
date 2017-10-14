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
        @include('Bitacoras.form.tabla');
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
