<?php 
session_start() ;
if ($_SESSION['entro'] != "SI") {
    echo"<script>alert('Usuario Sin Autentiacion, no Puede ingresar a esta pagina'); 
    window.location.href=\"../../index.php\"</script>"; 
	}
?>

<!DOCTYPE html>
<html>
  <head>
  	<title>Movimientos de Productos </title>
    <?php include("../../bases/archivo_head.php") ?>
  </head>
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper">
      <?php  include("../menus/menu_inventario.php"); ?>
      <?php  include("../menus/menu_titulo.php"); ?>
        <div class="content-wrapper"> 
          <section class="content">
            <div class="box-header">    
              <iframe alignt="center" width="100%" height="600px" frameborder="0" framespacing="0" scrolling="auto" border="0" src="productos2.php" ></iframe>
            </div>
          </section>
  	    </div>
    </div>
    <?php include("../../bases/archivo_pie.php") ?>
    <?php include("../../bases/archivo_script.php") ?>
  </body> 
</html>

