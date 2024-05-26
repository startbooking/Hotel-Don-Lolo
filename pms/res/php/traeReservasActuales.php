<?php

require '../../../res/php/app_topHotel.php';

extract($_POST)

$reservas = $hotel->getReservasActuales($tipo);
 
 echo json_encode($reservas);
 
?>
  



