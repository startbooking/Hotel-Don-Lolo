<?php 
session_start() ;
if ($_SESSION['entro'] != "SI") {
    echo"<script>alert('Usuario Sin Autentiacion, no Puede ingresar a esta pagina'); 
    window.location.href=\"../../login/ingreso.php\"</script>"; 
	}
?>

<!DOCTYPE html>
<html>
  <head>
	<title>Movimientos de Productos </title>
    <?php include("../config/archivo_head.php") ?>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
   	  <?php  include("../config/menu_izq.php"); ?>
	    <div class="content-wrapper"> 
        <section class="content-header">
          <h1>
          <small>Kardex</small>
            <p>Movimientos de Productos</p>
          </h1>
        </section>
        <section>
		  	<div align="center">
			<?php include("../../config/Activos.php") ;  ?>
		 	</div>
		</section>
	</div>
   	<?php include("../config/archivo_foot.php") ?>
	<?php include("../config/archivo_script.php") ?>
  </body> 
</html>

