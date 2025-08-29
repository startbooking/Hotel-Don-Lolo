<input type="hidden" name="usuarioActivo" id="usuarioActivo" value="">
<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cogs"></i> <span>Parametros Generales</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="dataCompany">
              <i class="fa fa-industry"></i> <span>Configuracion Compañia</span>
              <small class="label pull-right bg-red"></small>
            </a>
          </li>
          <li>
            <a href="usuarios">
              <i class="fa-solid fa-users"></i> <span>Usuarios</span>
              <small class="label pull-right bg-red"></small>
            </a>
          </li>
          <li>
            <a href="impuestos">
              <i class="fa fa-bank"></i> <span>Impuestos</span>
              <small class="label pull-right bg-red"></small>
            </a>
          </li>
<li>
            <a href="retenciones">
              <i class="fa fa-bank"></i> <span>Retenciones</span>
              <small class="label pull-right bg-red"></small>
            </a>
          </li>          <li>
            <a href="deptos">
              <i class="glyphicon glyphicon-th-large"></i> <span>Departamentos - Areas</span>
              <small class="label pull-right bg-red"></small>
            </a>
          </li>
          <li>
            <a href="centrosdeCosto">
              <i class="glyphicon glyphicon-th"></i> <span>Centros de Costo</span>
              <small class="label pull-right bg-red"></small>
            </a>
          </li>
          <!-- <li>
            <a href="equipos">
              <i class="fa fa-desktop"></i><span>Equipos Asociados</span>
              <small class="label pull-right bg-red"></small></a>
          </li> -->
        </ul>
      </li>
      <?php
      if (INV == 1) { ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-equalizer"></i> <span>Inventarios</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="bodegas">
                <i class="fa fa-book"></i> <span>Bodegas</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bars"></i> <span>Grupos de Almacenamiento</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="familias"><i class="fa fa-clone"></i> Familias</a></li>
                <li><a href="gruposInventario"><i class="fa fa-th-list"></i> Grupos</a></li>
                <li><a href="subgrupos"><i class="fa fa-th"></i> Subgrupos</a></li>
              </ul>
            </li>
            <li>
              <a href="unidades">
                <i class="fa fa-balance-scale "></i> <span>Unidades de Medida</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="conversiones">
                <i class="fa fa-object-group"></i> <span>Conversiones de Medidas</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="tipoMovimientos">
                <i class="fa fa-cubes"></i> <span>Movimientos de Inventarios</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
          </ul>
        </li>
      <?php
      }
      if (PMS == 1) { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bed"></i> <span>PMS Hotel</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="glyphicon glyphicon-cog"></i> <span>Configuracion Hotel</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="infoHotel"><i class="glyphicon glyphicon-info-sign"></i> Informacion Hotel</a></li>
                <li><a href="consecutivos"><i class="glyphicon glyphicon-sort"></i> Consecutivos Hotel</a></li>
                <li><a href="resolucionHotel"><i class="glyphicon glyphicon-sort"></i> Resolucion de Facturacion</a></li>
              </ul>
            </li>
            <li>
              <a href="formasdePago">
                <i class="fa-solid fa-money-bills"></i> <span>Formas de Pago</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="agrupaciones">
                <i class="glyphicon glyphicon-object-align-bottom"></i> <span>Agrupaciones de Ventas</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="codigosVentas">
                <i class="glyphicon glyphicon-th"></i> <span>Codigos de Ventas</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="sectoresHabitacion">
                <i class="glyphicon glyphicon-th-list"></i> <span>Sectores Habitaciones</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="tipoHabitaciones">
                <i class="glyphicon glyphicon-align-left"></i> <span>Tipos de Habitaciones</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="habitaciones">
                <i class="fa fa-calendar"></i> <span>Habitaciones</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="paquetes">
                <i class="glyphicon glyphicon-paperclip"></i> <span>Paquetes</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="gruposTarifa">
                <i class="fa fa-usd"></i> <span>Tarifas</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
            <li>
              <a href="ciudades">
                <i class="fa fa-usd"></i> <span>Ciudades</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
          </ul>
        </li>
      <?php
      }
      if (POS == 1) { ?>
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-cutlery"></i> <span>Puntos de Venta</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="ambientes"><i class="fa fa-cubes"></i>Ambientes</a>
            </li>
            <li>
              <a href="mesas"><i class="fa fa-cubes"></i>Mesas</a>
            </li>
            <li>
              <a href="formasPagoPos">
                <i class="fa-solid fa-money-bills"></i><span>Formas de Pago</span>
                <small class="label pull-right bg-red"></small></a>
            </li>
            <li>
              <a href="tiposdePlatos"><i class="fa fa-object-group"></i>Tipos de Platos</a>
            </li>
            <!-- 
              <li>
                <a href="<?= BASE_POS ?>datos/productos.php"><i class="ion-clipboard"></i> Productos</a>
              </li>
              -->
            <li>
              <a href="descuentos"><i class="fa fa-window-restore "></i> Descuentos</a>
            </li>
            <li>
              <a href="periodos">
                <i class="fa-solid fa-copy"></i>
                Periodos de Servicio</a>
            </li>
            <!--
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-bars"></i> <span>Utilidades</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href=""><i class="fa fa-circle-o"></i> Importar Recetas a Ambientes</a></li>
                  <li><a href=""><i class="fa fa-circle-o"></i> Importar Producto de Inventario</a></li>
                    <li><a href="subgrupos"><i class="fa fa-circle-o"></i> Subgrupos</a></li>
                </ul>
              </li>
              -->
          </ul>
        </li>
      <?php
      }
      if (RES == 1) { ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-object-group"></i> <span>Recetas Estandar</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="../paginas/tipos_recetas.php">
                <i class="fa fa-calendar"></i> <span>Tipos de Recetas</span>
                <small class="label pull-right bg-red"></small>
              </a>
            </li>
          </ul>
        </li>
      <?php
      }
      ?>
    </ul>
  </section>
</aside>