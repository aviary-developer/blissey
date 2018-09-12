<div class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="calendar-create" data-backdrop="static">
  <div class="modal-dialog">
    <div class="row">
      <div class="col-xs-12">
        <div class="m_panel x_panel">

          <div class="row">
            <center>
              <h3 id="cal-title">Titulo</h3>
              <input type="hidden" id="start-date" value="">
              <input type="hidden" id="end-date" value="">
            </center>
          </div>

          <form action="" class="form-horizontal form-label-left">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Hora inicio: *</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::time('hora-inicio',$hora_i->format('H:i'),['id'=>'hora-inicio','class'=>'form-control has-feedback-left']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Hora final: *</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::time('hora-final',$hora_f->format('H:i'),['id'=>'hora-final','class'=>'form-control has-feedback-left']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Título: *</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::text('titulo-ev',null,['id'=>'titulo-ev','class'=>'form-control has-feedback-left','placeholder'=>'Nombre del evento']) !!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción:</label>
              <div class="col-md-7 col-sm-7 col-xs-12">
                <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                {!! Form::textarea('desc-ev',null,['id'=>'desc-ev','class'=>'form-control has-feedback-left','placeholder'=>'Descripción del evento', 'rows'=>'3']) !!}
              </div>
            </div>
            @if (Auth::user()->tipoUsuario == "Recepción")
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Usuario: *</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <select name="" id="sel-user" class="form-control">
                    <option value="0">Todos</option>
                    @foreach ($usuarios as $usuario)
                        <option value={{$usuario->id}}>{{$usuario->nombre.' '.$usuario->apellido}}</option>
                    @endforeach 
                  </select>
                </div>
              </div>
              <div class="form-group" id="tipo-u-div">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de usuario: *</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <select name="" id="sel-t-user" class="form-control">
                    <option value="0">Todos</option>
                    <option value="Gerencia">Gerencia</option>
                    <option value="Médico">Médico</option>
                    <option value="Recepción">Recepción</option>
                    <option value="Laboaratorio">Laboratorio Clínico</option>
                    <option value="Ultrasonografía">Ultrasonografía</option>
                    <option value="Rayos X">Rayos X</option>
                    <option value="Farmacia">Farmacia</option>
                    <option value="Enfermería">Enfermería</option>
                    <option value="TAC">TAC</option>
                    </select>
                </div>
              </div>
            @endif
          </form>
        </div>
      </div>
    </div>
    <div class="row alignright">
      <button type="button" class="btn btn-primary btn-sm" id="guardar_evento">
        Guardar
      </button>
      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
</div>