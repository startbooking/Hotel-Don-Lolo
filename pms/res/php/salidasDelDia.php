<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $fecha = FECHA_PMS;

  $salidas = $hotel->salidasPendientes($fecha);

  echo $salidas;
