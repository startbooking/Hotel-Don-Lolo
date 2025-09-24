<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  extract($_POST);
  $nuevoest = $cambio.substr($estado,1,1);
  $estHabi = $hotel->cambiaEstadoHabitacionHK($habi,$cambio);

  echo $estHabi;

