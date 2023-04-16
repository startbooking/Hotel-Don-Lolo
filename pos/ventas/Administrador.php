<?php
	session_start();
  
  include_once('../../Conn/seciones.php');
  //include_once("../../Conn/Conn.php");
  include_once("../../Conn/funciones.php");
  include_once('../../Conn/valida_ingreso.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $titulo; ?> Sistema de Puntos de Ventas</title>
    <?php include_once('../../bases/archivo_head.php') ?>
    <script language="JavaScript" type="text/javascript" src="<?= $_SESSION['BASE_POS']?>js/ajax.js"></script>
  </head>
  <body class="skin-yellow sidebar-mini" id="ppal" onload="getAmbientes();">
    <?php 
    include_once('../menus/menu_titulo_venta.php'); 
    include_once('../menus/menu_pos.php');
    ?>
    <div class="content-wrapper" id="Escritorio" style="background-color:#FCFCEF;padding:10px"></div>   
    <?php 
      include("../../bases/archivo_pie.php");
    ?>
  </body>
  <?php include("../../bases/archivo_script.php") ?>
</html>