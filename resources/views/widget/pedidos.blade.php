@php
      setlocale(LC_ALL,'es');
@endphp
<div class="flex-row">
    <center>
      <h5>
          <a href="{{asset('transacciones?tipo=0')}}" class="text-success">
          Pedidos por confirmar
        </a>
      </h5>
    </center>
  </div>
  
  <div class="flex-row border border-success"></div>
  
  <div class="flex-row">
    <table class="table table-striped table-sm">
      <tbody>
          @php
              $transacciones=App\Transacion::buscar("",0);
          @endphp
        @foreach ($transacciones as $transaccion)
            <tr>
                <td>{{$transaccion->proveedor->nombre}}</td>
                <td>Pedido realizado: {{$transaccion->fecha->formatLocalized('%d de %B de %Y')}}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  