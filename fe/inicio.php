<?php
// require_once '../res/php/titles.php';
require_once '../res/php/app_topFE.php';


?>

<!DOCTYPE html>
<html>
  <head>
    <title>SACTel - Facturacion Electronica</title>
    <?php 
      include_once '../res/shared/archivo_head.php'; 
      ?>
    <link rel="stylesheet" type="text/css" href="res/css/fe.css">
  </head>
  <body class="skin-green sidebar-mini sidebar-collapse">
    <?php
      /* if(FE==0){
        require 'views/nofe.php';
      }else{ */
        include_once 'menus/menu_titulo.php';
        include_once 'menus/menuFE.php';
  
        if (!isset($_GET['section'])) {
          require 'views/home.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'home') {
          require 'views/home.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'facturas') {        
          echo $_GET['section'];
          require 'views/facturas.php';
        }
        /* 
      }
} elseif (isset($_GET['section']) && $_GET['section'] == 'proveedores') {
    require 'views/proveedores.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'entradas') {
    require 'views/entradas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'movimientoEntradas') {
    require 'views/movimientoEntradas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'salidas') {
    require 'views/salidas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'movimientoSalidas') {
    require 'views/movimientoSalidas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'traslados') {
    require 'views/traslados.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'movimientoTraslado') {
    require 'views/movimientoTraslado.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'ajustes') {
    require 'views/ajustes.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'movimientoAjuste') {
    require 'views/movimientoAjuste.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'requisiciones') {
    require 'views/requisiciones.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'recetasRequisicion') {
    require 'views/recetasRequisicion.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'recetasPedidos') {
    require 'views/recetasPedidos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'productoRequisicion') {
    require 'views/productoRequisicion.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'pedidos') {
    require 'views/pedidos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'productoPedido') {
    require 'views/productoPedido.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'conteos') {
    require 'views/conteos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'periodosActivos') {
    require 'views/periodosActivos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'cierreMes') {
    require 'views/cierreMes.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'kardex') {
    require 'views/kardex.php';
} */

?>
    <footer>
      <?php include '../res/shared/archivo_pie.php'; ?>    
    </footer>
    <?php
  include_once '../res/shared/archivo_script.php';
  include_once '../views/modal/modalUsuario.php';
?>
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
    <script src="<?php echo BASE_INV; ?>res/js/inventario.js"></script> 
   
    <script src="res/js/fe.js"></script>    
  </body>
</html>