<?php
require_once '../res/php/rutas.php';
require_once '../res/php/app_topHotel.php';
require_once 'res/php/utilities.php';
?>

<!DOCTYPE html>
<html>

<head>
  <title>House Keeping | SACTel PMS Cloud</title>
  <?php include_once("../res/shared/archivo_head.php") ?>
  <link rel="stylesheet" type="text/css" href="../res/css/style.css">
  <link rel="stylesheet" type="text/css" href="../pms/res/css/pms.css">
  <!-- <link rel="stylesheet" type="text/css" href="res/css/pms.css"> -->
</head>

<body class="skin-red sidebar-mini">

  <?php
  include_once("menus/menu_titulo.php"); ?>
  <div class="content-fluid" id="plantilla">
    <?php
    include_once 'controlador/estadoHabitaciones.php';
    ?>
  </div>

  <footer>
    <?php
    include_once '../res/shared/archivo_pie.php';
    ?>
  </footer>
  <?php
  include_once '../res/shared/archivo_script.php';
  include_once '../views/modal/modalUsuario.php';
  ?>
  <script>
    // Lógica para guardar en localStorage movida a la vista
    userHK = {
      usuario_id: 99,
      usuario: 'CAMARERA',
      nombres: 'CAMARERA',
      apellidos: '<?= htmlspecialchars(NAME_HOTEL) ?>',
    };
    localStorage.setItem("sesion", JSON.stringify({
      userHK
    }));
    document.querySelector('#nombreUsuario').innerHTML = `${userHK.nombres} ${userHK.apellidos}`
  </script>
</body>

</html>