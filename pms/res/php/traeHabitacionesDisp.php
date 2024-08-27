<?php

require '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$hab = $hotel->traeHabitacionesDisp($tipo);
 
 echo json_encode($hab);
 
?>
  



