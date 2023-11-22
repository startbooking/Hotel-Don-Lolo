<?php
require_once '../res/php/titles.php';
require_once '../res/php/app_topAdmin.php';
?>
<!DOCTYPE html>
<html> 
  <head>
    <title>SACTel PMS | Parametros Generales</title>
    <?php include_once '../res/shared/archivo_head.php'; ?>
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_RES; ?>dist/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="res/css/admin.css">
    <?php
      include_once '../res/shared/archivo_script.php';
?>
    <script src="<?php echo BASE_ADM; ?>res/js/admin.js"></script> 
    <script src="<?php echo BASE_WEB; ?>res/js/inicio.js"></script> 
  </head>

  <body class="skin-green sidebar-mini">
    <?php
include_once 'menus/menu_titulo.php';
include_once 'menus/menu_config.php';

if (!isset($_GET['section'])) {
    require 'views/home.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'home') {
    require 'views/home.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'dataCompany') {
    require 'views/dataCompany.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'usuarios') {
    require 'views/usuarios.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'impuestos') {
    require 'views/impuestos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'formasdePago') {
    require 'views/formasPago.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'deptos') {
    require 'views/deptosAreas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'centrosdeCosto') {
    require 'views/centrosCosto.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'bodegas') {
    require 'views/bodegas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'ciudades') {
    require 'views/ciudades.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'unidades') {
    require 'views/unidadesdeMedida.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'familias') {
    require 'views/familiasInventarios.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'gruposInventario') {
    require 'views/gruposInventarios.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'subgrupos') {
    require 'views/subGruposInventarios.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'conversiones') {
    require 'views/conversiones.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'tipoMovimientos') {
    require 'views/tipoMovimientos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'infoHotel') {
    require 'views/infoHotel.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'consecutivos') {
    require 'views/consecutivosHotel.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'agrupaciones') {
    require 'views/agrupaciones.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'codigosVentas') {
    require 'views/codigosVentas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'sectoresHabitacion') {
    require 'views/sectoresHabitacion.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'tipoHabitaciones') {
    require 'views/tipoHabitaciones.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'habitaciones') {
    require 'views/habitaciones.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'paquetes') {
    require 'views/paquetes.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'gruposTarifa') {
    require 'views/gruposTarifa.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'ambientes') {
    require 'views/ambientes.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'formasPagoPos') {
    require 'views/formasPagoPos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'tiposdePlatos') {
    require 'views/tiposdePlatos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'equipos') {
    require_once 'views/equiposAsociados.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'descuentos') {
    require_once 'views/descuentos.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'periodos') {
    require_once 'views/periodos.php';
}
?>
    <footer>
      <?php
    include_once '../res/shared/archivo_pie.php';
?>
    </footer>
    <?php
include_once '../views/modal/modalUsuario.php';
?>
    <script src="<?php echo BASE_RES; ?>dist/jquery.dataTables.min.js"></script>
    <script>
      $(function () {
        $('#example1').DataTable({
          "iDisplayLength": 25,
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
      
      $('#usuarioActivo').val(usuario)
      $('#nombreUsuario').html(`${apellidos} ${nombres} <span class="caret"></span>`)
    </script>
    <?php
 if (isset($_GET['section']) && $_GET['section'] == 'usuarios') {
     include_once 'views/modal/modalUsuarios.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'impuestos') {
     include_once 'views/modal/modalImpuestos.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'formasdePago') {
     include_once 'views/modal/modalFormasPago.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'deptos') {
     include_once 'views/modal/modalDeptos.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'centrosdeCosto') {
     include_once 'views/modal/modalCentrosCosto.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'bodegas') {
     include_once 'views/modal/modalBodegas.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'ciudades') {
    include_once 'views/modal/modalCiudades.php';
} elseif (isset($_GET['section']) && $_GET['section'] == 'unidades') {
     include_once 'views/modal/modalUnidadesdeMedida.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'familias') {
     include_once 'views/modal/modalFamiliaInventarios.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'gruposInventario') {
     include_once 'views/modal/modalGruposInventarios.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'subgrupos') {
     include_once 'views/modal/modalsubGruposInventarios.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'conversiones') {
     include_once 'views/modal/modalConversiones.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'tipoMovimientos') {
     include_once 'views/modal/modalTipoMovimiento.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'agrupaciones') {
     include_once 'views/modal/modalAgrupaciones.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'codigosVentas') {
     include_once 'views/modal/modalCodigosVentas.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'tipoHabitaciones') {
     include_once 'views/modal/modalTipoHabitaciones.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'sectoresHabitacion') {
     include_once 'views/modal/modalSectoresHabitacion.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'habitaciones') {
     include_once 'views/modal/modalHabitaciones.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'paquetes') {
     include_once 'views/modal/modalPaquetes.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'gruposTarifa') {
     include_once 'views/modal/modalGruposTarifa.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'ambientes') {
     require 'views/modal/modalAmbientes.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'formasPagoPos') {
     include_once 'views/modal/modalFormasPagoPos.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'equipos') {
     include_once 'views/modal/modalEquipos.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'descuentos') {
     include_once 'views/modal/modalDescuentos.php';
 } elseif (isset($_GET['section']) && $_GET['section'] == 'periodos') {
     include_once 'views/modal/modalPeriodosServicio.php';
 }
?>
 
  </body>
</html>