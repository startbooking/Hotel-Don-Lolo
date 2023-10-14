<?php 

require '../../../res/php/app_topHotel.php'; 

$resFac = $hotel->getResolucion(1);

echo json_encode($resFac);