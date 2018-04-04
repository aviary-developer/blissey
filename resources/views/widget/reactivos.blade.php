<div>
  <h4>
    <a href="{{asset('/reactivos')}}">
      Reactivos
    </a>
  </h4>
</div>
<div class="clearfix"></div>
<table class="table">
  <tbody>
    @if (count($tercero)>0)
      @foreach ($tercero as $reactivo)
        <tr>
          <td>{{$reactivo->nombre}}</td>
          <td>
              <span class="label label-warning col-xs-10 label-lg">
                Por agotarse {{$reactivo->contenidoPorEnvase}} en existencias
              </span>
          </td>
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
