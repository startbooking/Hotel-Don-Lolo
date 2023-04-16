<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  $ambSel = $_POST['codigo'];

  $ambienteSeleccionado        = $pos->getAmbienteSeleccionado($ambSel);
  $ambi                        = $ambienteSeleccionado;
  $_SESSION['NOMBRE_AMBIENTE'] = $ambienteSeleccionado[0]['nombre'];
  $_SESSION['AMBIENTE']        = $ambienteSeleccionado[0]['id_ambiente'];
  $_SESSION['BODEGA_AMBIENTE'] = $ambienteSeleccionado[0]['id_bodega'];
  $_SESSION['LOGO_POS']        = $ambienteSeleccionado[0]['logo'];
  $ventaPos                    = $pos->sumSalesDay($idamb); 
  $comandaPos                  = $pos->countComandasPos($idamb,'A');
  $comandaAnuladaPos           = $pos->countComandasPos($idamb,'X'); 
  $facturasPos                 = $pos->countFacturasPos($idamb);

  echo print_r($ambienteSeleccionado);

?>
<!DOCTYPE html> 
<html>
  <head>
    <title><?php echo TITLE_POS; ?> Sistema de Puntos de Ventas</title>
    <?php include_once('../../res/shared/archivo_head.php') ?>
    <link rel="stylesheet" type="text/css" href="<?= BASE_POS?>res/css/estilo.css">
  </head>
  <body class="skin-red sidebar-mini" id="ppal">
    <?php 
    include_once('../menus/menu_titulo_venta2.php'); 
    include_once('../menus/menu_pos.php');
    ?>
    <div class="content-wrapper" id="Escritorio" style="background-color:#FCFCEF;padding:10px;">
      <div class="container-fluid" style='margin-top:70px'>
        <section class="container-fluid" style="margin-bottom: 5px;margin-top: 0px;">
          <div class="container-fluid">
            <input type="hidden" name="ubicacion" id="ubicacion" value="home">
            <div class="col-md-8 col-sm-6 col-xs-12">          
              <h1 class="fontModule">
                <?=$ambienteSeleccionado[0]['nombre'];?><br>
                <small>Panel de Control</small>
              </h1>
            </div>
            <div class="col-sm-4 col-sm-6 col-xs-12" style="">          
              <img style="width: 150px;margin-top:5px;float: right;" class="img-thumbnail" src="../img/<?=$ambienteSeleccionado[0]['logo']?>" alt=""> 
            </div>  
          </div>
        </section>
        <section class="container-fluid" style="margin-bottom: 5px;">
          <?php 
            if($ambienteSeleccionado[0]['plano']!=1){
              include_once 'views/plano.php'
            }else {
              ?>
              <div class="container-fluid moduloCentrar" style='display:flex;'>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="cursor:pointer;">
                  <a onclick="muestraTouch()" class="small-box-footer">
                    <div class="small-box bg-green-gradient">
                      <div class="inner">
                        <h3>Ingresar Venta</h3>
                        <p>Crea una Nueva Cuenta</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-cash"></i>
                      </div>
                      <small class="small-box-footer" style="font-size:12px">Ingresar<i class="fa fa-arrow-circle-right"></i></small>
                    </div>
                  </a>
                </div>
              </div>
              <div class="container-fluid">
                <h3 align="center" class="tituloEscritorio">Informes y Estadisticas</h3>
                <div class="row moduloCentrar">
                  <div class="col-md-4 col-xs-6" style="cursor: pointer;">
                    <a onclick="cuentasActivas()" class="small-box-footer">
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <?php 
                          echo '<h3> '.number_format($comandaPos,0,",",".").'</h3>';
                          ?>
                          <p>Cuentas Activas</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-archive"></i>
                        </div>
                        <small class="small-box-footer" style="font-size:12px">Detalles<i class="fa fa-arrow-circle-right"></i></small>

                      </div>
                    </a> 
                  </div>
                  <div class="col-md-4 col-xs-6" style="cursor: pointer;">
                    <a onclick="ventasDia()" class="small-box-footer">
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <?php 
                          echo '<h3> '.number_format($facturasPos,0,",",".").'</h3>';
                          ?>
                            <p>Facturas Generadas </p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-ios-cart-outline"></i>
                        </div>
                        <small class="small-box-footer" style="font-size:12px">Detalles<i class="fa fa-arrow-circle-right"></i></small>
                      </div>
                    </a> 
                  </div>
                  <div class="col-md-4 col-xs-6" style="cursor: pointer;">
                    <div class="small-box bg-red">
                      <div class="inner">
                        <?php 
                        echo '<h3> '.number_format($comandaAnuladaPos,0,",",".").'</h3>';
                        ?>
                        <p>Cuentas Anuladas</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-archive"></i>
                      </div>
                        <a href="<?= BASE_POS?>" class="small-box-footer">Ingresar<i class="fa fa-arrow-circle-right"></i></a> 
                    </div>
                  </div>
                </div>
              </div>
              <?php 
            }
            ?>
        </section>
      </div>

    </div>   
    <?php 
      include("../../res/shared/archivo_pie.php");
    ?>
  </body>
  <?php include("../../res/shared/archivo_script.php") ?>
  <script src="<?= BASE_POS?>res/js/facturas.js"></script>
  <script src="<?= BASE_POS?>res/js/pos.js"></script>
</html>