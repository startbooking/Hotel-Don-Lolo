<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

  if($_SESSION['NOMBRE_AMBIENTE']==NULL){ ?>
    <script>
      swal('Precaucion', 'Punto de Venta no Seleccionado','warning')
    </script> 
    <?php 
    echo ("<script>location.href='../index.php'</script>");
  };

  $resol = $pos->getResolucionFacturacion($_SESSION['AMBIENTE_ID']);
  $rpre  = $resol[0]['prefijo'];

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_POS?></title>
    <meta charset="UTF-8">
    <?php include_once('../../res/shared/archivo_head.php') ?>
    <link rel="stylesheet" type="text/css" href="../res/css/estilo.css">
  </head>
  <?php 
    $idamb = $_SESSION['AMBIENTE_ID'] ; 
  ?>
  <body class="skin-red sidebar-mini" id="ppal" onload="getVentasDia('<?=$idamb?>');">
    <?php 
      include_once('../menus/menu_titulo_venta2.php') ;
      include_once('../menus/menu_pos.php');
    ?> 
    <div class="content-wrapper" style="background-color: #F5FBFC;margin-right: 5px;min-height: 535px;margin-bottom: 0px">
      <div class="container"> 
        <div class="row-fluid">         
          <div class="col-lg-4 col-md-4">
            <h3 align="center" style="font-weight:700">Facturas del Dia</h3>
            <input type="hidden" name="facturaActiva" id="facturaActiva">
            <input type="hidden" name="prefijoFac" id="prefijoFac" value="<?=$rpre?>">
          </div>
          <div class="col-lg-8 col-md-8">
            <div class="col-lg-6 col-md-6 ">
              <h3 align="center" style="font-weight:700">Productos Factura</h3>
            </div>            
          </div>
        </div>
      </div>
      <div class="container-fluid" style="padding:0">
        <div class="col-lg-4 col-md-4 col-xs-12" id="ComandasList" style="padding-right: 0"></div>   
        <div class="col-lg-8 col-md-8 col-xs-12" id="ventasList" style="padding :0"></div>
      </div>
    </div>
  </body>
  <?php 
  include("../../res/shared/archivo_pie.php");
   ?>
  <script language="JavaScript" type="text/javascript" src="<?= BASE_POS?>res/js/pos.js"></script>
  <script src="<?= BASE_POS?>res/js/facturas.js" type="text/javascript" charset="utf-8"></script>
  <?php include("../../res/shared/archivo_script.php") ?>

</html>