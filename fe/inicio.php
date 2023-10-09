<?php
// require_once '../res/php/titles.php';
require_once '../res/php/app_topFE.php';


?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <title>SACTel - Facturacion Electronica</title>
    <?php include_once '../res/shared/archivo_head.php'; ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="res/css/fe.css">
  </head>
  <body class="skin-green sidebar-collapse">
    
    <?php
      /* if(FE==0){
        require 'views/nofe.php';
      }else{ */
        include_once 'menus/menu_titulo.php';
        include_once 'menus/menuFE.php'; ?>
        <section class="content">
          <?php
        if (!isset($_GET['section'])) {
          require 'views/home.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'index') {
          require 'views/home.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'proveedores') {
          require 'views/proveedores.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'facturas') {
          require 'views/facturas.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'productos') {
          require 'views/codigosVentas.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'docSoporte') {
          require 'views/docSoporte.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'nuevoDocumento') {
          require 'views/nuevoDocumento.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'formaPagos') {
          require 'views/formasPago.php';
        }elseif (isset($_GET['section']) && $_GET['section'] == 'impuestos') {
          require 'views/impuestos.php';
        }
        ?>
      </section>
      <?php
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
    <!-- <script src="<?php echo BASE_INV; ?>res/js/inventario.js"></script>  -->
    <!-- <script src="<?php echo BASE_FE; ?>res/js/proveedores.js"></script> -->

    <script src="res/js/fe.js"></script>    
  </body>
</html>