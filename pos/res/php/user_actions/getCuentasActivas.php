<?php
  require_once '../../../../res/php/app_topPos.php';
  $idamb = $_POST['idamb'];
  $comandas = $pos->getComandasActivas($idamb, 'A');
  echo json_encode($comandas);

  ?>
  