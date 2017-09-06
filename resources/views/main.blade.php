@extends('dashboard')
@section('layout')
<!-- page content -->
<!--Panel-->
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Usuarios<small>Activos</small></h2>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div class="row">
        <div class="btn-group">
          <button class="btn btn-success" type="button" data-toggle="modal" data-target=".modal-new">Nuevo</button>
          <button class="btn btn-default" type="button">Pantalla1</button>
          <button class="btn btn-default" type="button">Pantalla2</button>
          <button class="btn btn-default" type="button">Pantalla3</button>
          <button class="btn btn-default" type="button">Reporte</button>
          <button class="btn btn-danger" type="button">Papelera</button>
          <button class="btn btn-info" type="button">Ayuda</button>
        </div>
      </div>
      <br>
      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
            <th>Extn.</th>
            <th>E-mail</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Tiger</td>
            <td>Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
            <td>5421</td>
            <td>t.nixon@datatables.net</td>
          </tr>
          <tr>
            <td>Garrett</td>
            <td>Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>63</td>
            <td>2011/07/25</td>
            <td>$170,750</td>
            <td>8422</td>
            <td>g.winters@datatables.net</td>
          </tr>
          <tr>
            <td>Ashton</td>
            <td>Cox</td>
            <td>Junior Technical Author</td>
            <td>San Francisco</td>
            <td>66</td>
            <td>2009/01/12</td>
            <td>$86,000</td>
            <td>1562</td>
            <td>a.cox@datatables.net</td>
          </tr>
          <tr>
            <td>Cedric</td>
            <td>Kelly</td>
            <td>Senior Javascript Developer</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>2012/03/29</td>
            <td>$433,060</td>
            <td>6224</td>
            <td>c.kelly@datatables.net</td>
          </tr>
          <tr>
            <td>Airi</td>
            <td>Satou</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>33</td>
            <td>2008/11/28</td>
            <td>$162,700</td>
            <td>5407</td>
            <td>a.satou@datatables.net</td>
          </tr>
          <tr>
            <td>Brielle</td>
            <td>Williamson</td>
            <td>Integration Specialist</td>
            <td>New York</td>
            <td>61</td>
            <td>2012/12/02</td>
            <td>$372,000</td>
            <td>4804</td>
            <td>b.williamson@datatables.net</td>
          </tr>
          <tr>
            <td>Herrod</td>
            <td>Chandler</td>
            <td>Sales Assistant</td>
            <td>San Francisco</td>
            <td>59</td>
            <td>2012/08/06</td>
            <td>$137,500</td>
            <td>9608</td>
            <td>h.chandler@datatables.net</td>
          </tr>
          <tr>
            <td>Rhona</td>
            <td>Davidson</td>
            <td>Integration Specialist</td>
            <td>Tokyo</td>
            <td>55</td>
            <td>2010/10/14</td>
            <td>$327,900</td>
            <td>6200</td>
            <td>r.davidson@datatables.net</td>
          </tr>
          <tr>
            <td>Colleen</td>
            <td>Hurst</td>
            <td>Javascript Developer</td>
            <td>San Francisco</td>
            <td>39</td>
            <td>2009/09/15</td>
            <td>$205,500</td>
            <td>2360</td>
            <td>c.hurst@datatables.net</td>
          </tr>
          <tr>
            <td>Sonya</td>
            <td>Frost</td>
            <td>Software Engineer</td>
            <td>Edinburgh</td>
            <td>23</td>
            <td>2008/12/13</td>
            <td>$103,600</td>
            <td>1667</td>
            <td>s.frost@datatables.net</td>
          </tr>
          <tr>
            <td>Jena</td>
            <td>Gaines</td>
            <td>Office Manager</td>
            <td>London</td>
            <td>30</td>
            <td>2008/12/19</td>
            <td>$90,560</td>
            <td>3814</td>
            <td>j.gaines@datatables.net</td>
          </tr>
          <tr>
            <td>Quinn</td>
            <td>Flynn</td>
            <td>Support Lead</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>2013/03/03</td>
            <td>$342,000</td>
            <td>9497</td>
            <td>q.flynn@datatables.net</td>
          </tr>
          <tr>
            <td>Charde</td>
            <td>Marshall</td>
            <td>Regional Director</td>
            <td>San Francisco</td>
            <td>36</td>
            <td>2008/10/16</td>
            <td>$470,600</td>
            <td>6741</td>
            <td>c.marshall@datatables.net</td>
          </tr>
          <tr>
            <td>Haley</td>
            <td>Kennedy</td>
            <td>Senior Marketing Designer</td>
            <td>London</td>
            <td>43</td>
            <td>2012/12/18</td>
            <td>$313,500</td>
            <td>3597</td>
            <td>h.kennedy@datatables.net</td>
          </tr>
          <tr>
            <td>Tatyana</td>
            <td>Fitzpatrick</td>
            <td>Regional Director</td>
            <td>London</td>
            <td>19</td>
            <td>2010/03/17</td>
            <td>$385,750</td>
            <td>1965</td>
            <td>t.fitzpatrick@datatables.net</td>
          </tr>
        </tbody>
      </table>


    </div>
  </div>
  <div class="modal fade modal-new" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Usuario <small> Nuevo </small></h4>
        </div>
        <div class="modal-body">
          <!--Cuerpo del modal-->
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">
                  <br />

                  {!!Form::open(['class'=>'form-horizontal form-label-left input_mask'])!!}
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      {!!Form::text('nombre',null,['placeholder'=>'Primer nombre','focusable','class'=>'form-control has-feedback-left'])!!}
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">

                      {!!Form::text('nombre',null,['placeholder'=>'Apellido','focusable','class'=>'form-control has-feedback-left'])!!}
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" class="form-control has-feedback-left" id="inputSuccess4" placeholder="Email">
                      <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                      <input type="text" class="form-control" id="inputSuccess5" placeholder="Phone">
                      <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Default Input</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" placeholder="Default Input">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Disabled Input </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" disabled="disabled" placeholder="Disabled Input">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Read-Only Input</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" readonly="readonly" placeholder="Read-Only Input">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                      </label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                      </div>
                    </div>

                </div>
              </div>


            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      {!!Form::close()!!}

      </div>
    </div>
  </div>
</div>
<!-- /page content -->
@stop
