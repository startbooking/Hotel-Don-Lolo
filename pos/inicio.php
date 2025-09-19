<?php
  // require_once '../res/php/titles.php';
  require_once '../res/php/app_topPos.php';

  ?>
<!DOCTYPE html>
<html>
  <head>
    <title>SACTel Cloud | Sistema de Puntos de Ventas</title>
    <?php include_once '../res/shared/archivo_head.php'; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_POS; ?>res/css/estilo.css">
    <?php
      include_once '../res/shared/archivo_script.php';
    ?>
    <script src="<?php echo BASE_POS; ?>res/js/pos.js"></script>
    <script src="<?php echo BASE_WEB; ?>res/js/inicio.js"></script>
    <script src="<?php echo BASE_POS; ?>res/js/facturas.js"></script>
    <script src="<?php echo BASE_RES; ?>dist/jquery.dataTables.min.js"></script>
  </head>
  <body class="skin-green sidebar-mini sidebar-collapse" id="ppal">
    <div class="wrapper">
      <?php
        include_once 'menus/menu_titulo_venta.php';
        include_once 'menus/menu_pos.php';
      ?>
      <div class="content-wrapper" id="Escritorio" style="background-color:#FCFCEF;"> 
        <div class="container-fluid pd0" id="pantalla" style="margin-bottom:0px;min-height:300px;">
          <?php
            include_once 'res/php/escritorio_pos.php';
          ?>
        </div>
      </div>
      <div class="control-sidebar-bg"></div>
    </div>
    <?php include_once '../res/shared/archivo_pie.php'; ?>
  </body>
  <?php
    include_once '../views/modal/modalUsuario.php'; 
    include_once 'views/modal/modalKardex.php';
  ?>
</html>