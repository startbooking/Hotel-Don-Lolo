<?php

  require '../../../../res/php/app_topPos.php';
  $idamb = $_POST['id_ambiente'];
  $secciones = $pos->getSeccionesPos();

  echo json_encode($secciones);
