{{-- MODAL 2--}}
<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Editar división: <label id='cod' value=""></label></h4>
      </div>
      {!!Form::open(['url'=>'editarDivisionProducto','method'=>'POST','autocomplete'=>'off'])!!}
      <div class="modal-body">
        <div class="x_panel">
        <div class="form-group">
        <input type="hidden" name='idDiv' value="" id='idDiv'>
      <label class="col-md-3 col-sm-12 col-xs-12">Precio de venta </label>
      <div class="col-md-8 col-sm-12 col-xs-12">
        <span class="fa fa-dollar form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('pre',null,['class'=>'form-control has-feedback-left','placeholder'=>'Precio','id'=>'pre','min'=>'0.01','step'=>'0.01']) !!}
      </div>
    </div>
    {{-- <p>&nbsp;</p> --}}
    <br><br>
    <div class="form-group">
      <label class="col-md-3 col-sm-12 col-xs-12">Stock mínimo</label>
      <div class="col-md-8 col-sm-12 col-xs-12">
        <span class="fa fa-cubes form-control-feedback left" aria-hidden="true"></span>
        {!! Form::number('stock',null,['class'=>'form-control has-feedback-left','placeholder'=>'Stock','id'=>'stock','min'=>'1.00','step'=>'0']) !!}
      </div>
    </div>
    <br><br>
    <div class="form-group">
      <label class="col-md-3 col-sm-12 col-xs-12">Notificar </label>
      <div class="col-md-4 col-sm-4 col-xs-12">
        <span class="fa fa-warning form-control-feedback left" aria-hidden="true"></span>
        {!!Form::select('mes',
          [1=>'1 mes',2=>'2 meses',3=>'3 meses',4=>'4 meses',5=>'5 meses']
          ,3, ['class'=>'form-control has-feedback-left','id'=>'mes'])!!}
      </div>
      <label class="control-label col-md-3 col-sm-3 col-xs-12">antes de vencer</label>
    </div>
  </div>
    </div>
      <div class="modal-footer">
        {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
          {!!Form::close()!!}
    </div>
  </div>
</div>
{{-- FIN 2--}}
