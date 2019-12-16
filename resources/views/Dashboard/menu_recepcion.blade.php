<li>
  <a>
    <i class="far fa-hospital"></i> Hospital
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
      <a href={{asset( '/pacientes')}}>Pacientes</a>
    </li>
    <li>
      <a href={{asset( '/ingresos')}}>Hospitalización</a>
    </li>
    <li>
      <a>Mantenimiento
        <span class="fas fa-chevron-down float-right"></span>
      </a>
      <ul class="nav child_menu submenu">
        <li>
          <a href={{asset( '/servicios')}}>Servicios</a>
        </li>
        <li>
          <a href={{asset( '/categoria_servicios')}}>Categorías de servicios</a>
        </li>
        <li>
          <a href={{asset( '/habitaciones')}}>Habitaciones</a>
        </li>
      </ul>
    </li>
  </ul>
</li>
<li>
  <a>
    <i class="fas fa-microscope"></i> Solicitud de Examen
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
    <a href={{asset( '/solicitudex?tipo=examenes')}}>Laboratorio Clínico</a>
    </li>
    <li>
      <a href={{asset( '/solicitudex?tipo=ultras')}}>Ultrasonografía</a>
    </li>
    <li>
      <a href={{asset( '/solicitudex?tipo=rayosx')}}>Rayos X</a>
    </li>
    <li>
      <a href={{asset( '/solicitudex?tipo=tac')}}>TAC</a>
		</li>
		<li>
      <a>Mantenimiento
        <span class="fas fa-chevron-down float-right"></span>
      </a>
      <ul class="nav child_menu submenu">
        <li>
					<a href={{asset( '/rayosx')}}>Rayos X</a>
				</li>
        <li>
					<a href={{asset( '/ultrasonografias')}}> Ultrasonografías</a>
				</li>
        <li>
          <a href={{asset( '/tacs')}}>TAC</a>
        </li>
      </ul>
    </li>
  </ul>
</li>
<li>
  <a>
    <i class="fas fa-medkit"></i> Botiquín
    <span class="fas fa-chevron-down float-right"></span>
  </a>
  <ul class="nav child_menu">
    <li>
      <a href={{asset( '/inventarios')}}>Inventario</a>
    </li>
    <li>
      <a href={{asset( '/transacciones?tipo=0')}}>Pedidos</a>
    </li>
    <li>
      <a href={{asset( '/transacciones/create?tipo=2')}}>Ventas</a>
    </li>
    <li>
      <a>Requisiciones
        <span class="fas fa-chevron-down float-right"></span>
      </a>
      <ul class="nav child_menu submenu">
        <li>
          <a href={{asset( '/requisiciones?tipo=4')}}>Enviadas</a>
        </li>
        <li>
          <a href={{asset( '/verrequisiciones?tipo=4')}}>Recibidas</a>
        </li>
      </ul>
    </li>
    <li>
      <a>Movimiento de caja
        <span class="fas fa-chevron-down float-right"></span>
      </a>
      <ul class="nav child_menu submenu">
        <li>
          <a href={{asset( '/detalleCajas/create')}}>Apertura/Cierre</a>
        </li>
        @if (App\DetalleCaja::cajaApertura())
          <li>
            <a href={{asset( '/arqueo')}}>Arqueo</a>
          </li>
        @endif
      </ul>
    </li>
    <li>
      <a>Mantenimiento
        <span class="fas fa-chevron-down float-right"></span>
      </a>
      <ul class="nav child_menu submenu">
        <li>
          <a href={{asset( '/productos')}}>Productos</a>
        </li>
        <li>
          <a href={{asset( '/categoria_productos')}}>Categorías de productos</a>
        </li>
        <li>
          <a href={{asset( '/presentaciones')}}>Presentaciones</a>
        </li>
        <li>
          <a href={{asset( '/componentes')}}>Componentes</a>
        </li>
        <li>
          <a href={{asset( '/divisiones')}}>Divisiones</a>
        </li>
        <li>
          <a href={{asset( '/estantes')}}>Estantes</a>
        </li>
        <li>
          <a href={{asset( '/unidades')}}>Unidades de medida</a>
        </li>
        <li>
          <a href={{asset( '/cajas')}}>Cajas</a>
        </li>
        <li>
          <a href={{asset( '/proveedores')}}>Proveedores</a>
        </li>
      </ul>
    </li>
  </ul>
</li>