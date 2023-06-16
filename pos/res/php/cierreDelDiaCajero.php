<?php

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topPos.php';

  $iduser = $_POST['usuario_id'];
  $user = $_POST['usuario'];
  $fecha = $_POST['fecha_auditoria'];
  $idamb = $_POST['id_ambiente'];
  $amb = $_POST['nombre'];
  $logo = $_POST['logo'];

  include_once '../../imprimir/imprimeCierreCajero.php';

  $cierra = $pos->cambiaEstadoCajero($iduser, 2);

  $filepdf = 'imprimir/cierres/cierre_Cajero_'.$user.'_'.$fecha.'.pdf';

  echo $filepdf;

  ?>
   