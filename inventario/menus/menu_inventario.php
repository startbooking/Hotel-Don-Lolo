<aside class="main-sidebar" style="margin-top:0px">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li style="text-align: center">
        <a href="home" style="font-weight: 700">
          <img class="img-thumbnail" src="<?=BASE_IMG.LOGO?>" alt="" style="width: 50px;margin-top:0px;"> 
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Datos</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="productos"><i class="fa fa-cubes"></i> Productos</a></li>
          <li><a href="proveedores"><i class="fa fa-user-circle"></i> Proveedores</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-files-o"></i> <span>Movimientos</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="topNavManageOrder" class="active"><a href="entradas"><i class="fa fa-sign-in"></i> Entradas</a></li>
          <li><a href="salidas"><i class="fa fa-sign-out"></i> Salidas</a></li>
          <li><a href="traslados"><i class="fa fa-window-restore"></i> Traslados</a></li>
          <li><a href="ajustes"><i class="fa fa-random"></i> Ajustes</a></li>
          <!--
          <li><a href="index2.html"><i class="fa fa-circle-o"></i> Porcionamiento</a></li>
          <li><a href="index2.html"><i class="fa fa-circle-o"></i> Productos en Produccion</a></li>
        -->
        </ul>
      </li>
      <li>
        <a href="kardex">
          <i class="fa fa-calendar"></i> <span>Kardex</span>
          <small class="label pull-right bg-red"></small>
        </a>
      </li>
       <li class="treeview">
        <a href="#">
          <i class="fa fa-inbox" aria-hidden="true"></i>
          <span>Requisiciones</span>
          <span class="fa fa-angle-left pull-right"></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="requisiciones"><i class="fa fa-inbox"></i> Requisiciones </a></li>
          <li><a href="recetasRequisicion"><i class="fa fa-window-restore" aria-hidden="true"></i> Requisicion Recetas</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>

          <span>Pedidos</span>
          <span class="fa fa-angle-left pull-right"></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pedidos"><i class="fa fa-cart-plus"></i> Pedidos </a></li>
          <!--
          <li><a href=""><i class="fa fa-circle-o"></i> Pedido Automatico</a></li>
          -->
          <li><a href="recetasPedidos"><i class="fa fa-pie-chart" aria-hidden="true"></i> Pedido Recetas</a></li>
        </ul>
      </li>
     <li class="treeview">
        <a href="#">
          <i class="fa fa-th"></i> 
          <span>Procesos</span> 
          <small class="fa fa-angle-left pull-right"></small>
        </a>
        <ul class="treeview-menu">
          <li><a href="periodosActivos"><i class="fa fa-ellipsis-v"></i> Periodos Activos </a></li>
          <!--
          <li><a href="conteos"><i class="fa fa-circle-o"></i> Ingreso Conteo Inventario</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> Ajustes por Conteo</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i>Actualizar Promedios</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i>Etiquetas de Conteo</a></li>
          -->
          <li><a href="cierreMes"><i class="fa fa-download"></i> Cierre de Mes</a></li>
        </ul>              
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Consultas</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href=""><i class="fa fa-circle-o"></i> Movimientos</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i>Productos</a></li>
          <li><a href=""><i class="fa fa-circle-o"></i> Recetas</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-share"></i> <span>Informes</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>Movimientos</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i>Productos</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i>Requisiciones</a></li>
          <!--
          <li><a href="#"><i class="fa fa-circle-o"></i>Recetas</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i>Pedidos</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i>Materia Prima</a></li>
        -->
          <li>
            <a href="#"><i class="fa fa-circle-o"></i>Historicos<i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i>Movimientos</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i>Productos</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i>Pedidos</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i>Requisiciones</a></li>
              <!--
                <li><a href="#"><i class="fa fa-circle-o"></i>Recetas</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i>Materia Prima</a></li>
            -->
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </section>
</aside>