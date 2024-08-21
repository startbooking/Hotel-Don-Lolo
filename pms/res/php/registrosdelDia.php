<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $fecha = FECHA_PMS;

  $registro = $hotel->registrosHotelerosSinImprimir($fecha);

  echo count($registro);
