<?php 
  $rutaPMS = BASE_POS."datos/huespedesCasa.php" ;
  $rutaINV = BASE_POS."datos/kardex.php" ;
?>
 
<aside class="main-sidebar" style="padding-top:0px;min-height: 100%">
	<section class="sidebar">
    <ul class="sidebar-menu">
      <li id="nombreAmbiente"></li>
      <li class="treeview">
        <a href="#">
          <i class="glyphicon glyphicon-th-list"></i> 
          <span>Datos</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="menuPpal" onclick="clientes()"><i class="fa fa-address-card-o" aria-hidden="true"></i> Clientes</a>
          </li>
          <li>
            <a class="menuPpal" onclick="recetas()"><i class="fa fa-pie-chart" aria-hidden="true"></i> Recetas</a>
          </li>
          <li>
            <a class="menuPpal" onclick="productos()"><i class="fa fa-coffee" aria-hidden="true"></i> Productos</a>
          </li>
        </ul>
      </li>
      <li>
    		<a class="menuPpal" onclick="enviaInicio()"><i class="fa fa-cutlery" aria-hidden="true"></i> Ventas</a>
    	</li>
    	<!--
      <li>
        <a class="menuPpal" onclick="cuentasActivas()"><i class="fa fa-cubes"></i> Cuentas Activas</a>
      </li>
      -->
      <li class="treeview">
        <a href="#">
          <i class="ion ion-clipboard"></i> 
          <span>Cajeros</span> 
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="menuPpal" onclick="cuentasActivasCajero()"><i class="fa fa-users"></i> Comandas Activas Cajero</a>
          </li>
          <li>
            <a class="menuPpal" onclick="cuentasAnuladasCajero()"><i class="fa fa-users"></i> Comandas Anuladas Cajero</a>
          </li>
          <li>
            <a class="menuPpal" onclick="devolucionesCajero()"><i class="fa fa-users"></i> Devolucion Productos Cajero</a>
          </li>
          <li>
            <a class="menuPpal" onclick="facturasCajero()"><i class="fa fa-users"></i> Facturas Cajero</a>
          </li>
          <li>
            <a class="menuPpal" onclick="facturasAnuladasCajero()"><i class="fa fa-users"></i> Facturas Anuladas Cajero</a>
          </li>
          <li>
            <a class="menuPpal" onclick="balanceDiarioCajero()"><i class="fa fa-users"></i> Balance Diario Cajero</a>
          </li>
          <li>
            <a class="menuPpal" onclick="cierreDiarioCajero()"><i class="fa fa-users"></i> Cierre del Dia Cajero</a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
           <i class="ion ion-clipboard"></i> 
           <span>Interfases </span> 
           <small class="fa fa-angle-left pull-right"></small>
         </a>
        <ul class="treeview-menu">
          <li id="moduloPms">
            <a class="menuPpal" onclick="huespedesenCasa()"><i class='fa fa-users'></i> Huespedes en Casa</a>
          </li>
          <li id="moduloInv">
            <a class="menuPpal" onclick="kardexInventario()"><i class='fa fa-cubes'></i> Existencias Almacen</a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-object-group" aria-hidden="true"></i>
          <span>Auditoria</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li> 
            <a class="menuPpal" onclick="ventasDiaAuditoria()"><i class="fa fa-clipboard"></i> Facturas del Dia</a>
          </li>
          <li>
            <a class="menuPpal" onclick="cuentasAnuladasAuditoria()"><i class="fa fa-clipboard"></i> Comandas Anuladas del Dia</a>
          </li>
          <li>
            <a class="menuPpal" onclick="cuentasActivasAuditoria()"><i class="fa fa-clone"></i> Comandas Activas</a>
          </li> 
          <li>
            <a class="menuPpal" onclick="devolucionesDia()"><i class="fa fa-clipboard"></i> Devolucionde del Dia</a>
          </li> 
          <li>
            <a class="menuPpal" onclick="cierreDiarioAuditoria()"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i> Cierre Diario</a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-database" aria-hidden="true"></i>
          <span>Consultas</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="menuPpal" onclick="catalogoRecetas()">
            <i class="fa fa-book" aria-hidden="true"></i>
            Libro de Recetas</a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="ion-ios-printer-outline"></i>
          <span>Informes</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="menuPpal" onclick="cuentasActivasAuditoria()"><i class="fa fa-calendar"></i> Comandas Activas</a>
          </li>
          <li>
            <a class="menuPpal" onclick="cuentasAnuladasAuditoria()"><i class="fa fa-calendar"></i> Comandas  Anuladas</a>
          </li>
          <li>
            <a class="menuPpal" onclick="devolucionProductos()"><i class="fa fa-calendar"></i> Devolucion Productos</a>
          </li>
					<li>
            <a class="menuPpal" onclick="ventasDiaAuditoria()"><i class="fa fa-money"></i> Ventas del Dia</a>
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
          <li>
            <a class="menuPpal" onclick="ventasPorCliente()"><i class="fa fa-clone"></i> Ventas por Cliente</a>
          </li>
          <li>
            <a href="#"><i class="fa fa-balance-scale"></i>Historico Movimientos<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a class="menuPpal" onclick="ventasHistoricoPeriodos()"><i class="fa fa-files-o"></i>Historico Periodos de Servicio</a></li>
              <li><a class="menuPpal" onclick="historicoCajeros()"><i class="fa fa-files-o"></i>Historico Cajeros</a></li>
              <li><a class="menuPpal" onclick="historicoListadoFacturas()"><i class="fa fa-files-o"></i>Historico Facturas</a></li> 
              <li><a class="menuPpal" onclick="historicoAuditorias()"><i class="fa fa-calendar"></i> Historico Auditorias</a></li>
              <li><a class="menuPpal" onclick="historicoClientes()"><i class="fa fa-calendar"></i> Ventas Acumuladas por Cliente</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a class="menuPpal" onclick="cierraSesion()"><i class="fa fa-clone"></i> Salir</a>
      </li>
    </ul>
	</section>
</aside>