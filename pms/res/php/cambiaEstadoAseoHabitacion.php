<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  extract($_POST);
  $estHabi = $hotel->cambiaEstadoHabitacion($habi,$sucia);

  echo $estHabi;

