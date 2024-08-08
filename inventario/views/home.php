<?php
$entradas = count($inven->getMovimientosInventarios(1));
$salidas = count($inven->getSalidasInventarios(2));
$requisiciones = count($inven->getRequisiciones());
$pedidos = count($inven->getPedidos());

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
      </div>
      <div class="row" ></div>
    </div>
    <!-- <section class="container-fluid" style="margin-top:0px;margin-bottom: 5px;">
        <div class="container-fluid">
          </div> 
    </section> -->
  </section>
</div>