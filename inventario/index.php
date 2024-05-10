<?php
require_once '../res/php/titles.php';
require_once '../res/php/app_topInventario.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo TITLE_INV; ?> | Sistema de Inventarios</title>
    <?php include_once '../res/shared/archivo_head.php'; ?>
    <link rel="stylesheet" type="text/css" href="res/css/inventario.css">
  </head>
  <body class="skin-green sidebar-mini sidebar-collapse">
    <?php
      include_once 'menus/menu_inventario.php';
include_once 'menus/menu_titulo.php';
if (!isset($_GET['section'])) {
    require 'views/home.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'home') {
    require 'views/home.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'productos') {
    require 'views/productos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'proveedores') {
    require 'views/proveedores.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'entradas') {
    require 'views/entradas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'movimientoEntradas') {
    require 'views/movimientoEntradas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'importaXML') {
  require 'views/importaXML.php';
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
}

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
    <script src="<?php echo BASE_INV; ?>res/js/ajax.js"></script> 
    <script src="<?php echo BASE_INV; ?>res/js/inventario.js"></script> 
    <script src="../res/js/inicio.js"></script> 
    <?php
if (isset($_GET['section']) && $_GET['section'] == 'productos') {
    include_once 'views/modal/modalProductos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'proveedores') {
    include_once 'views/modal/modalProveedores.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'kardex') {
    include_once 'views/modal/modalKardex.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'entradas') {
    include_once 'views/modal/modalMovimientosProducto.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'salidas') {
    include_once 'views/modal/modalMovimientosProducto.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'traslados') {
    include_once 'views/modal/modalMovimientosProducto.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'ajustes') {
    include_once 'views/modal/modalMovimientosProducto.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'requisiciones' || isset($_GET['section']) && $_GET['section'] == 'pedidos') {
    include_once 'views/modal/modalRequisicion.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'recetasPedidos') {
    include_once 'views/modal/modalEstadoHotel.php';
}
?>
    <script>
      sesion = JSON.parse(localStorage.getItem('sesion'))
      var { user: {usuario_id, usuario, nombres, apellidos, tipo, estado_usuario_pms} } = sesion;
      $('#usuarioActivo').val(usuario)
      $('#nombreUsuario').html(`${apellidos} ${nombres} <span class="caret"></span>`)
      $('#cambiaPass').data('status','enviar') 
      activaSesion()
    </script>
    <?php
  if (isset($_GET['section']) && $_GET['section'] == 'movimientoEntradas') { ?>
      <script>
        listaEntradas();
      </script>
    <?php
  } elseif (isset($_GET['section']) && $_GET['section'] == 'movimientoSalidas') { ?>
      <script>
        listaSalidas();
      </script>
    <?php
  } elseif (isset($_GET['section']) && $_GET['section'] == 'movimientoTraslado') { ?>
      <script>
        listaTraslados();
      </script>
    <?php
  } elseif (isset($_GET['section']) && $_GET['section'] == 'movimientoAjuste') { ?>
      <script>
        listaAjustes();
      </script>
    <?php
  } elseif (isset($_GET['section']) && $_GET['section'] == 'productoRequisicion') { ?>
      <script>
        listaRequisicion();
      </script>
    <?php
  } elseif (isset($_GET['section']) && $_GET['section'] == 'productoPedido') { ?>
      <script>
        listaPedido();
      </script>
    <?php
  } elseif (isset($_GET['section']) && $_GET['section'] == 'recetasRequisicion') { ?>
      <script>
        listaRecetasReq();
      </script>
    <?php
  } elseif (isset($_GET['section']) && $_GET['section'] == 'recetasPedidos') { ?>
      <script>
        listaRecetasPed();
      </script>
    <?php
  }

?>
  </body>
</html>