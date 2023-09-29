<aside id="menuFE"class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="treeview" id="menuDatos">
        <a href="#">
          <i class="glyphicon glyphicon-th-list"></i>
          <span>Ingresos</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li> 
            <a href="facturas" class="menuPpal" ><i class="fa fa-address-card-o" aria-hidden="true"></i> Facturas de Venta</a>
          </li>
          <li>
            <a class="notasCredito" ><i class="fa fa-pie-chart" aria-hidden="true"></i> Notas Credito</a>
          </li>
          <!-- <li>
            <a class="menuPpal" ><i class="fa fa-coffee" aria-hidden="true"></i> Productos</a>
          </li> -->
        </ul>
      </li>
      <li class="treeview" id="menuDatos">
        <a href="#">
          <i class="glyphicon glyphicon-th-list"></i>
          <span>Gastos</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li> 
            <a href="facturas" class="menuPpal" ><i class="fa fa-address-card-o" aria-hidden="true"></i> Documento Soporte de Venta</a>
          </li>
          <li>
            <a class="notasCredito" ><i class="fa fa-pie-chart" aria-hidden="true"></i> Notas Credito</a>
          </li>
          <!-- <li>
            <a class="menuPpal" ><i class="fa fa-coffee" aria-hidden="true"></i> Productos</a>
          </li> -->
        </ul>
      </li>      
      <li id="menuVenta">        
        <a href="#">
          <i class="glyphicon glyphicon-th-list"></i>
          <span>Configuracion</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="proveedores" ><i class="fa fa-pie-chart" aria-hidden="true"></i> Empresa</a>
          </li>
          <li> 
          <li>
            <a class="proveedores" ><i class="fa fa-pie-chart" aria-hidden="true"></i> Proveedores</a>
          </li>
          <li> 
            <a href="facturas" class="termiosPago" ><i class="fa fa-address-card-o" aria-hidden="true"></i> Retenciones</a>
          </li>
          <li> 
            <a href="facturas" class="termiosPago" ><i class="fa fa-address-card-o" aria-hidden="true"></i> Terminos de Pagos</a>
          </li>
          <!-- <li>
            <a class="menuPpal" ><i class="fa fa-coffee" aria-hidden="true"></i> Productos</a>
          </li> -->
        </ul>
      </li>


      <!-- <li class="treeview" id="menuInfo" style="display: none;">
        <a href="#">
          <i class="fa fa-print"></i> <span>Informes</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu menu-open" >
          <li class="" id="menuDiar" style="display: none;" >
            <a href="#"><i class="fa fa-print" aria-hidden="true"></i> Movimientos Diarios <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li>
                <a class="menuPpal" onclick="balanceCaja()"><i class="fa fa-users"></i> Balance de Caja</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasDiaAuditoria()"><i class="fa fa-money"></i> Ventas del Dia</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasCreditoDia()"><i class="fa fa-money"></i> Ventas Empleados</a>
              </li>
              <li>
                <a class="menuPpal" onclick="cuentasActivasAuditoria()"><i class="fa fa-calendar"></i> Comandas Activas</a>
              </li>
              <li>
                <a class="menuPpal" onclick="cuentasAnuladasAuditoria()"><i class="fa fa-calendar"></i> Comandas Anuladas</a>
              </li>
              <li>
                <a class="menuPpal" onclick="devolucionProductos()"><i class="fa fa-calendar"></i> Devolucion Productos</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasFormaPago()"><i class="fa fa-clone"></i> Ventas por Forma de Pago</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasProducto()"><i class="fa fa-clone"></i> Ventas por Productos</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasGrupos()"><i class="fa fa-clone"></i> Ventas por Grupo de Producto</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasPorPeriodo()"><i class="fa fa-clone"></i> Ventas por Periodo de Servicio</a>
              </li>
            </ul> 
          </li>          
        </ul>
      </li> -->
      <li>
        <a class="menuPpal" onclick="cierraSesion()">
        <i class="fa fa-power-off" aria-hidden="true"></i>
        <span>Salir</span>
      </a>
      </li>
    </ul>
  </section>
</aside> 