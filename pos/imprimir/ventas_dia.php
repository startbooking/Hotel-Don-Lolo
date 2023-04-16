<?php 
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php';
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title><?= TITLE_POS?></title>
    <meta charset="UTF-8">
    <?php include_once('../../bases/archivo_head.php') ?>
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <script language="JavaScript" type="text/javascript" src="<?= BASE_POS?>js/ajax.js"></script>
  </head>
  <body class="skin-yellow sidebar-mini" id="ppal" onload="getSecciones();">
    <?php 
	    include_once('../menus/menu_titulo_venta.php'); 
	    include_once('../menus/menu_pos.php');
    ?>
    <div class="content-wrapper">
	    <section class="content-header">
	      <h1 align="center" style="font-size:2em;font-weight:bold">
	        Informes de Ventas Puntos de Venta
	      </h1>
	      <h4 align="center">Ventas del Dia</h4>
			<h3 align="center">Ambiente:<?=$_SESSION['NOMBRE_AMBIENTE']?></</h3>      
	    </section>
	    <section class="content">
				<div class="container-fluid">
					<div id="loader" class="text-center"> 
						<img src="<?=BASE_IMG?>loader.gif">
					</div>
					<div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
					<div class="outer_div"></div><!-- Datos ajax Final -->
				</div>
	   	</section>
    </div>

  </body>
  <script src="../js/facturas.js" type="text/javascript" charset="utf-8"></script>
  <?php 
  include("../../bases/archivo_script.php") 
  ?>
    <script src="<?= BASE_RES ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_RES ?>plugins/datatables/dataTables.bootstrap.min.js"></script> 
    <script>
      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "language": {
            "next": "Siguiente",
            "search": "Buscar:",
            "entries": "registros"
          },
        });
      });
    </script>
		<script src="../js/ajax.js"></script>
		<script>
			$(document).ready(function(){
				load(1);
			});
		</script>

</html>

