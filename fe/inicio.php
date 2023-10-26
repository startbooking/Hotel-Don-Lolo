<?php require_once '../res/php/app_topFE.php'; ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>SACTel - Facturacion Electronica</title>
    <?php include_once '../res/shared/archivo_head.php'; ?>
    <!-- <link rel="stylesheet" href="https://pos.creatantech.com/theme/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> -->
    <link rel="stylesheet" href="https://pos.creatantech.com/theme/plugins/select2/select2.min.css">    
    <link rel="stylesheet" href="https://pos.creatantech.com/theme/dist/css/AdminLTE.min.css">
    <!-- 
      <link rel="stylesheet" href="https://pos.creatantech.com/theme/dist/css/skins/_all-skins.min.css"> 
      -->
    
    <link rel="stylesheet" type="text/css" href="res/css/fe.css">
  </head>
  <body class="skin-green sidebar-collapse">
    
    <?php
        include_once 'menus/menu_titulo.php';
        include_once 'menus/menuFE.php'; ?>
        <section class="content">
          <?php
        if (!isset($_GET['section']) || $_GET['section'] == 'home' ) {
          require 'views/home.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'index') {
          require 'views/home.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'proveedores') {
          require 'views/proveedores.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'facturas') {
          require 'views/facturas.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'productos') {
          require 'views/productos.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'docSoporte') {
          require 'views/docSoporte.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'nuevoDocumento') {
          require 'views/nuevoDocumento.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'nuevaFactura') {
          require 'views/nuevaFactura.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'formasPago') {
          require 'views/formasPago.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'impuestos') {
          require 'views/impuestos.php';
        }
        ?>
      </section>
    <footer>
      <?php include '../res/shared/archivo_pie.php'; ?>    
    </footer>
    <?php
  include_once '../res/shared/archivo_script.php';
  include_once '../views/modal/modalUsuario.php';
?>
    <script src="<?php echo BASE_WEB; ?>res/js/inicio.js"></script>
    <script src="<?php echo BASE_RES; ?>dist/jquery.dataTables.min.js"></script>
    <script>
      $(function () {
        $('#example1').DataTable({
          "iDisplayLength" : 25,
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
    <script src="res/js/fe.js"></script>    
  </body>
</html>