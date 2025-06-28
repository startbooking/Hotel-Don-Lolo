<?php

require '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$valores = $hotel->traeValorRetencionIca($nroReserva, $nroFolio);

echo json_encode($valores); 
   