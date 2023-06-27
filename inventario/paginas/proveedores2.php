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
    <?php include("../../config/archivo_head.php") ?>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
   	  <?php  include("../config/menu_izq.php"); ?>
	  <div class="content-wrapper"> 
        <section class="content-header">
          <div class="box-tools pull-right" align="fixed">
            <ul class="pagination pagination-sm inline">
              <li><a href="#"><img src="../../img/cero/addi.png" width="40px">  Adicionar Proveedor</a></li>
              <li><a href="../index.php" ><img src="../../img/cero/home.png" width="40px">  Retornar</a></li>
            </ul>
          </div>
          <h1>
	        <small>Datos</small>
	        <p>Catalogo de Proveedores</p>
          </h1>
        </section>
	    <section class="content">
	      <div class="box-header">    
  		    <iframe alignt="center" width="100%" height="420" frameborder="0" src="../code/sele_prov.php" >
  		 	</iframe>
		  </div>
	    </section>
	  </div>
  	</div>
 	<?php include("../../config/archivo_foot.php") ?>
	<?php include("../../config/archivo_script.php") ?>
  </body> 
</html>

