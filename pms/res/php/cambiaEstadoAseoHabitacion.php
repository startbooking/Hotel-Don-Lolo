<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $habi   =  $_POST['habi'];
  $cambio =  $_POST['cambio'];

  // $nuevoest = $cambio.substr($estado,1,1);

  $estHabi = $hotel->cambiaEstadoHabitacion($habi,$cambio);

  echo $estHabi;

