<?php
$info = $inven->traeInfoMovimientos();

$entradas = $info[0]['entradas'];
$salidas = $info[0]['salidas'];
$ajustes = $info[0]['ajustes'];
$requisiciones = $info[0]['requisicion'];
$pedidos = $info[0]['pedidos'];

?>
<div class="content-wrapper"> 
  <section class="content">
    <h1 style="font-size:34px;font-weight: bold;">
    Panel de Control <br>
      <small class="badge btn btn-success" style="padding:5px;font-weight: bold;">DashBoard</small>
    </h1>
    <div class="content">
      <div class="row moduloCentrar">
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $entradas; ?></h3>
              <p>Entradas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="entradas" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $requisiciones; ?><sup style="font-size: 20px"></sup></h3>
              <p>Requisiciones</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="requisiciones" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $pedidos; ?></h3>
              <p>Pedidos</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="pedidos" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $salidas; ?></h3>
              <p>Salidas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="salidas" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $ajustes; ?></h3>
              <p>Ajustes</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="ajustes" class="small-box-footer">Detalles<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row" ></div>
    </div>
    <section class="container-fluid" style="margin-top:0px;margin-bottom: 5px;">
    <div class="container-fluid">
      <div class="col-md-6 col-xs-12">
        <h2 class="accesos">Accesos Directos <i class="fa fa-external-link" aria-hidden="true"></i></h2>
      </div>
    </div>
    <div class="container-fluid">
      <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <a
            href="kardex">
            <span class="info-box-icon bg-aqua"><i class="fa fa-calendar-plus-o"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Kardex</span>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <a
            href="proveedores">
            <span class="info-box-icon bg-red"><i class="fa fa-user-plus"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Proveedores</span>
            </div>
          </a>
        </div>
      </div>
      <div class="clearfix visible-sm-block"></div>
      <div class="col-lg-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <a href="productos">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Productos</span>
            </div>
          </a>
        </div>
      </div>
      <!-- <div class="col-lg-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <a href="forecast">
            <span class="info-box-icon bg-yellow"><i class="fa fa-area-chart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Forecast</span>
            </div>
          </a>
        </div>
      </div> -->
    </div>
    </section>
  </section>
</div>