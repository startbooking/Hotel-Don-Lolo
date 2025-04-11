<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $hues      =  $_POST['hues'];
  $rese      =  $_POST['rese'];

  $cambia = $hotel->cambiaHuespedReserva($rese,$hues);

  echo $cambia;

?>
