<?php
  require '../../res/php/titles.php';
  require '../../res/php/app_topPos.php'; 

?>

<!DOCTYPE html>
<html lang="es"> 
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= TITLE_POS?> | Balance Diario</title>
    <?php include_once("../../res/shared/archivo_head.php") ?>
  </head>

  <body class="skin-red sidebar-mini"> 
    <?php 
      include_once('../menus/menu_titulo_venta2.php') ;
      include_once("../menus/menu_pos.php");  
    ?>


    <div class="content-wrapper">
      <div class="content-fluid">
        <section class="content-header">
          <h1 align="center" style="font-weight:bold">
            Cuentas Anuladas en el Dia
          </h1>
          <h3 align="center">
            <?php 
            echo FECHA_POS;
            ?>
          </h3>
        </section>
      </div>
    </div>

    <?php 
      include("../../res/shared/archivo_pie.php");
      include("../../res/shared/archivo_script.php") 
    ?>
    <script src="../../res/dist/dataTables.bootstrap.js"></script>
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
    <script src="../res/js/pos.js"></script>
  </body>
</html>


