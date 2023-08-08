<?php 
  # error_reporting(0);
  session_start();
  include_once('../../Conn/Conn.php');
  include_once('../../Conn/seciones.php');
  if ($_SESSION['entro'] != "SI") {
    echo"<script>alert('Usuario Sin Autentiacion, no Puede ingresar a esta pagina'); 
    window.location.href=\"../../index.php\"</script>"; 
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titulo?> Proveedores</title>
    <?php include("../../bases/archivo_head.php") ?>
  </head>
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper">
      <?php  include("../menus/menu_inventario.php"); ?>
      <?php  include("../menus/menu_titulo.php"); ?>
        <div class="content-wrapper"> 
          <section class="content">
            <div class="box-header">    
              <iframe alignt="center" width="100%" height="600px" frameborder="0" framespacing="0" scrolling="auto" border="0" src="proveedor.php" ></iframe>
            </div>
          </section>
  	    </div>
    </div>
    <?php include("../../bases/archivo_pie.php") ?>
    <?php include("../../bases/archivo_script.php") ?>
  </body> 
</html>

