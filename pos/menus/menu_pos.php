<?php
  $rutaINV = BASE_POS.'datos/kardex.php';
?>

<aside id="menuPos" class="main-sidebar apaga" style="margin-top: 54px;">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="treeview" id="menuDatos" style="display:none">
        <a href="#">
          <i class="glyphicon glyphicon-th-list"></i>
          <span>Datos</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li> 
            <a class="menuPpal" onclick="clientes()"><i class="fa fa-address-card" aria-hidden="true"></i> Clientes</a>
          </li>
          <li>
            <a class="menuPpal" onclick="recetas()"><i class="fa fa-pie-chart" aria-hidden="true"></i> Recetas</a>
          </li>
          <li>
            <a class="menuPpal" onclick="productos()"><i class="fa fa-coffee" aria-hidden="true"></i> Productos</a>
          </li>
        </ul>
      </li>
      <li id="menuVenta" style="display:none">
        <a class="menuPpal" onclick="enviaInicio()">
          <i class="fa fa-cutlery" aria-hidden="true"></i>
          <span>Ventas</span>
        </a>
      </li>
      <!-- <li class="treeview" id="menuCaja" style="display:none;">
        <a href="#">
          <i class="glyphicon glyphicon-lock"></i>
          <span>Caja </span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="menuPpal" onclick="baseCaja()"><i class='fa fa-money'></i> Base Caja</a>
          </li>
          <li>
            <a class="menuPpal" onclick="comprasCaja()"><i class='glyphicon glyphicon-inbox'></i> Compras X Caja </a>
          </li>
          <li>
            <a class="menuPpal" onclick="ingresoCartera()"><i class='glyphicon glyphicon-briefcase'></i> Recaudos Cartera</a>
          </li>
          <li>
            <a class="menuPpal" onclick="estadoCartera()"><i class='glyphicon glyphicon-briefcase'></i> Estado Cartera Clientes</a>
          </li>
        </ul>
      </li> -->
      <li class="treeview" id="menuMovi" style="display:none;">
        <a href="#">
          <i class="fa fa-pencil-square" aria-hidden="true"></i>
          <span>Movimientos del Dia</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li>
            <a class="menuPpal" onclick="cuentasActivas()"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Cuentas Activas </a>
          </li>
          <li>
            <a class="menuPpal" onclick="facturasDia()"><i class="fa fa-bars"></i> Facturas del Dia</a>
          </li>
          <li> 
            <a class="menuPpal" onclick="verComandasAnuladas()"><i class="fa fa-minus-circle"></i> Comandas Anuladas</a>
          </li>
        </ul>
      </li> 
      <li class="treeview" id="menuCaje" style="display:none;">
        <a href="#">
          <i class="ion ion-clipboard"></i>
          <span>Cajeros</span>
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">  
          <li> 
            <a class="menuInfoCaje" onclick="balanceCajaCajero()"><i class="fa fa-users"></i> Balance de Caja</a>
          </li>
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
            <a class="menuInfoCaje" onclick="facturasCajero()"><i class="fa fa-users"></i> Facturas Cajero</a>
          </li> 
          <!-- <li>
            <a class="menuPpal" onclick="abonosCajero()"><i class="fa fa-users"></i> Abonos Cajero</a>
          </li> -->
          <li>
            <a class="menuPpal" onclick="facturasAnuladasCajero()"><i class="fa fa-users"></i> Facturas Anuladas Cajero</a>
          </li>
          <li>
            <a class="menuInfoCaje" style="display:none;" onclick="balanceDiarioCajero()"><i class="fa fa-users"></i> Balance Diario Cajero</a>
          </li>
          <li>
            <a class="menuPpal" onclick="cierreDiarioCajero()"><i class="fa fa-users"></i> Cierre del Dia Cajero</a>
          </li> 
        </ul>
      </li>  
      <!-- <li id="menuKardex" style="display:none;">
        <a class="menuPpal" onclick="kardexInventario()">
          <i class='fa fa-cubes'></i>
          <span> Kardex Almacen </span>
        </a>
      </li> -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-clone" aria-hidden="true"></i>
          <span>Hotel </span>
          <small class="fa fa-angle-left pull-right"></small>
        </a> 
        <ul class="treeview-menu">
          <li>
            <a class="menuKardex" onclick="kardexInventario()" style="display:none;">
              <i class='fa fa-cubes'></i>
              <span> Kardex Almacen </span>
            </a>
          </li>
          <li>
            <a class="menuPpal" onclick="huespedesenCasa()">
              <i class="fa fa-home" aria-hidden="true"></i>
              <span> Huespedes en Casa </span>
            </a>
          </li>
          <li>
            <a class="menuPpal" onclick="planillaDesayunos()">
              <i class="fa fa-bed" aria-hidden="true"></i>
              <span> Planilla de Desayunos </span>
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview" id=menuAudi style="display:none;">
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
            <a class="menuPpal" onclick="cuentasActivasAuditoria()">
              <i class="fa fa-check-square" aria-hidden="true"></i>
            Comandas Activas</a>
          </li>
          <li>
            <a class="menuPpal" onclick="devolucionesDia()"><i class="fa fa-clipboard"></i> Devolucionde del Dia</a>
          </li>
          <li>
            <a class="menuPpal" onclick="ventasCreditoDia()"><i class="fa fa-clipboard"></i> Ventas Empleados del Dia</a>
          </li>
          <li>
            <a class="menuPpal" onclick="cierreDiarioAuditoria()"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i> Cierre Diario</a>
          </li>
        </ul>
      </li>

      <li class="treeview" id="menuInfo" style="display: none;">
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
              <!-- <li>
                <a class="menuPpal" onclick="abonosDia()"><i class="fa fa-users"></i> Abonos del Dia</a>
              </li> --> 
              <li>
                <a class="menuPpal" onclick="ventasDiaAuditoria()">
                <i class="fa-solid fa-money-bill"></i> Ventas del Dia</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasCreditoDia()">
                <i class="fa-solid fa-money-bill"></i> Ventas Empleados</a>
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
          <li id="menuHist" style="display: none;">
            <a href="#">
              <i class="fa fa-history" aria-hidden="true"></i>
              Historico Movimientos
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              <li> 
                <a class="menuPpal" onclick="balanceHistorico()"><i class="fa fa-users"></i>Historico Balance de Caja</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasHistoricoProductos()">
                <i class="fa-regular fa-file"></i>Historico Productos</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasHistoricoGrupos()">
                  <i class="fa fa-clone"></i> Historico por Grupo de Producto</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasHistoricoFormaPago()"><i class="fa fa-clone"></i> Historico Forma de Pago</a>
              </li>
              <li>
                <a class="menuPpal" onclick="ventasHistoricoPeriodos()">
                <i class="fa-regular fa-file"></i>Historico Periodos de Servicio </a>
              </li>
              <li><a class="menuPpal" onclick="historicoCajeros()"><i class="fa-regular fa-file"></i>Historico Cajeros</a></li>
              <li><a class="menuPpal" onclick="historicoListadoFacturas()"><i class="fa-regular fa-file"></i>Historico Facturas</a></li>
              <li><a class="menuPpal" onclick="historicoAuditorias()"><i class="fa fa-calendar"></i> Historico Auditorias</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li>
        <a class="menuPpal" onclick="cierraSesion()">
        <i class="fa fa-power-off" aria-hidden="true"></i>
        <span>Salir</span>
      </a>
      </li>
    </ul>
  </section>
</aside> 