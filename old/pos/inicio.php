<?php
  require '../res/php/titles.php';
  require '../res/php/app_topPos.php'; 

?>
<!DOCTYPE html>    
<html> 
  <head>
        <title><?php echo TITLE_POS; ?> Sistema de Puntos de Ventas</title>
    <?php include_once('../res/shared/archivo_head.php') ?>
    <link rel="stylesheet" type="text/css" href="<?= BASE_POS?>res/css/estilo.css">
  </head>
  <body class="skin-green sidebar-mini" id="ppal" onunload="cierraSesion()"> 
    <?php 
    include_once('menus/menu_titulo_venta2.php');  
    include_once('menus/menu_pos.php');
    ?>
    <div class="content-wrapper" id="Escritorio" style="background-color:#FCFCEF;padding:0px"></div>   
    <?php 
      include_once("../res/shared/archivo_pie.php");
    ?>
  </body>
  <?php 
    include_once "../res/shared/archivo_script.php" ;
    include_once '../views/modal/modalUsuario.php';    
  ?>
  <script src="<?=BASE_WEB?>res/js/inicio.js"></script>
  <script src="<?=BASE_POS?>res/js/facturas.js"></script>
  <script src="<?=BASE_POS?>res/js/pos.js"></script>
  <script src="<?=BASE_RES?>dist/jquery.dataTables.min.js"></script>

  <script>
    ingresoPos() 
  </script> 
</html>